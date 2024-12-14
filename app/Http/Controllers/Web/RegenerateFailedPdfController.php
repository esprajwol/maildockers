<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\GeneratePdfJob;
use App\Jobs\Outlook\GenerateOutlookJsonFileJob;
use App\Jobs\Outlook\GenerateOutlookPdfFromJsonFileJob;
use App\Jobs\WkHtmlToPdf\WkHtmlToPdfJob;
use App\Models\Order;
use App\Services\Google\OrderMessageService;
use App\Services\Outlook\OutlookService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class RegenerateFailedPdfController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ], [
            'order_id.*' => __('pdf-regeneration.invalid-order')
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], 422);
        }

        // Get validated input
        $validated = $validator->validated();

        // Fetch email from session
        $user_email = $this->getUserEmail();
        if (!$user_email) {
            return response()->json(['status' => false, 'message' => __('pdf-regeneration.invalid-session')], 403);
        }

        // Transaction block
        return \DB::transaction(function () use ($validated, $user_email) {
            $order = Order::where('status', 'Failed')
                ->where('from_email', $user_email)
                ->where('is_paid', true)
                ->where('id', $validated['order_id'])
                ->first();

            if (!$order) {
                return response()->json(['status' => false, 'message' => __('pdf-regeneration.invalid-order')], 422);
            }

            if ($order->platform_type == 1) {
                return $this->handleGmailOrder($order);
            } else {
                return $this->handleOutlookOrder($order);
            }
        });
    }

    /**
     * Get the user email from session
     */
    private function getUserEmail()
    {
        return session('yourEmail') ?: session('userEmail');
    }

    /**
     * Handle Gmail Orders
     */
    private function handleGmailOrder($order)
    {
        if ($order->msg_json_file && File::exists(storage_path('app/public/' . $order->msg_json_file))) {
            return $this->regeneratePdfFromJson($order, 'gmail');
        }

        $tokenData = LaravelGmail::getToken();
        if (!$tokenData || !isset($tokenData["access_token"])) {
            return response()->json(['status' => false, 'message' => __('pdf-regeneration.invalid-session')], 403);
        }

        $messages = (new OrderMessageService())->getMessages($order, false);
        Redis::set($this->getRedisMessagesKey($order->id), json_encode($messages));

        $this->dispatchPdfJob($order, $tokenData["access_token"], 'gmail');
        $this->updateOrderProgress($order->id, 25);

        return response()->json(['status' => true, 'message' => __('pdf-regeneration.request-success')], 200);
    }

    /**
     * Regenerate PDF from JSON file
     */
    private function regeneratePdfFromJson($order, $platform)
    {
        $order->update(['status' => 'Generating']);

        \DB::afterCommit(function () use ($order, $platform) {
            if ($platform === 'gmail') {
                WkHtmlToPdfJob::dispatch($order, stringSplit($order->keyword) ?? []);
            } else {
                GenerateOutlookPdfFromJsonFileJob::dispatch($order);
            }
        });

        return response()->json(['status' => true, 'message' => __('pdf-regeneration.request-success')], 200);
    }

    /**
     * Get Redis messages key
     */
    private function getRedisMessagesKey($orderId)
    {
        return 'order_messages_' . $orderId;
    }

    /**
     * Dispatch PDF generation job
     */
    private function dispatchPdfJob($order, $accessToken = null, $platform)
    {
        \DB::afterCommit(function () use ($order, $accessToken, $platform) {
            if ($platform === 'gmail') {
                $inc_array = stringSplit(json_decode($order->request, true)["inc_keywords"]) ?? [];
                GeneratePdfJob::withChain([
                    new WkHtmlToPdfJob($order, $inc_array)
                ])->dispatch($order->id, $this->getRedisMessagesKey($order->id), $order->from_email, $order->language, $inc_array, $accessToken);
            } else {
                GenerateOutlookJsonFileJob::withChain([
                    new GenerateOutlookPdfFromJsonFileJob($order)
                ])->dispatch($order);
            }
        });
    }

    /**
     * Update order progress
     */
    private function updateOrderProgress($orderId, $progress)
    {
        Redis::set("job_progress_{$orderId}", json_encode(['status' => 'processing', 'progress' => $progress]));
    }

    /**
     * Handle Outlook Orders
     */
    private function handleOutlookOrder($order)
    {
        $jsonFile = storage_path('app/public/' . ($order->msg_json_file??""));
        if ($order->msg_json_file && File::exists($jsonFile) && count(json_decode(File::get($jsonFile), true)) > 0) {
            return $this->regeneratePdfFromJson($order, 'outlook');
        }
        $request = json_decode($order->request, true);
        
        $messages = OutlookService::GetMessages(
            $request["your_email"],
            $request["inc_keywords"],
            $request["start_date"],
            $request["end_date"],
            isset($request["search_keyword_list"])?$request["search_keyword_list"]:"",
            $request["email_from"],
        );

        Redis::set($this->getRedisMessagesKey($order->id), json_encode($messages));
        $this->dispatchPdfJob($order, null, 'outlook');
        $this->updateOrderProgress($order->id, 25);

        return response()->json(['status' => true, 'message' => __('pdf-regeneration.request-success')], 200);
    }

}
