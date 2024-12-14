<?php

namespace App\Http\Controllers\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\PartnerPrice;
use App\Services\Google\OrderMessageService;
use App\Services\Models\User\UserService;
use App\Services\PDF\PDFService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePaymentController extends Controller
{
    use ApiResponseTrait;
    public function showPaymentForm()
    {
        return view('paymentGateway.stripe_form');
    }

    public function createCheckoutSession(Request $request)
    {
        session()->put(["coupon_no_submit" => $request->coupon_no_submit ]);
        session()->put(["your_email_coupon_submit" => $request->your_email_coupon_submit]);

        $coupon = Coupon::where([
                ['coupon_no', '=', $request->coupon_no_submit],
                ['used_at', '=', null],
            ])->first();

        if ($coupon) {

            $coupon->email      = $request->your_email_coupon_submit;
            $coupon->used_at    = now();
            $coupon->save();
            
            return redirect(route('payment.success', ['order_id' => session("order_id")]));
        }

        //if env is production then follow the normal payment part else send directly to payment success route
        if (config('app.env') != "production") {
            return redirect(route('payment.success', ['order_id' => session("order_id")]));
        }

        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));

        $legalPdfLogo = "https://legalpdf.co/web/assets/img/resize-image/android-chrome-192x192.png";
        $geoDetails = geoip(request()->ip());

        $countryCode = $geoDetails->iso_code;
        $partnerPrice = PartnerPrice::where('country_code', $countryCode)->first();
        if ($partnerPrice) {
            $currency = Currency::find($partnerPrice->currency_id);
            $currencyCode = $currency->code;
            $currencySymbol = $currency->symbol;
            $price = $partnerPrice->price;
            $unitAmount = $partnerPrice->price * 100;
        } else {
            $currencyCode = 'gbp';
            $currencySymbol = '£';
            $price = '9.90';
            $unitAmount = 990;
        }

        $session = Session::create([
            'payment_method_types' => ["card"],
            'line_items' => [[
                'price_data' => [
                    'currency'        => $currencyCode,
                    'product_data'    => [
                        'name'        => 'You are about to pay ' . $currencySymbol . ' ' . $price . ' to LegalPDF, for a document containing all the correspondence you have selected.',
                        'images'      => [$legalPdfLogo],
                        "description" => "Email's Messages into an Organised Document.",
                        'metadata'    => [
                            'logo'        => $legalPdfLogo,
                            "description" => "Logo Email's Messages into an Organised Document.",
                        ],
                    ],
                    'unit_amount' => $unitAmount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . "?order_id=" . session("order_id"),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        try {
            //TODO:: code optimize
            $order = Order::query()->findOrFail(session()->get('order_id'));

            session()->flash("notify_value", empty($order->notify_value) ? $order->from_email : $order->notify_value);

            session()->flash('total_messages', $order->total_messages);

            session()->put(["session_order_id" => $order->id]);

            $order->update(['is_paid' => 1]);

            if ($order->platform_type == 1) {
                session()->flash('paid_success', 'paid'); // Google
            }

            if ($order->platform_type == 2) {
                session()->flash('outlook_paid_success', 'paid'); // Google
            }

            session()->get('paid', '1');

            // check coupon and make it used if exists
            $coupon_no_submit = session()->get("coupon_no_submit");
            $your_email_coupon_submit = session()->get("your_email_coupon_submit");

            $coupon = Coupon::where([
                ['coupon_no', '=', $coupon_no_submit],
                ['used_at', '=', null],
                ['email', '=', $your_email_coupon_submit],
            ])->first();

            if ($coupon) {
                $coupon->used_at = now();
                $coupon->save();
            }

            // Clear coupon session values
            session()->forget('coupon_no_submit');
            session()->forget('your_email_coupon_submit');

            return redirect("/");
        } catch (\Throwable $e) {
            return redirect("/");
        }
    }

    public function paymentCancel()
    {

        return redirect("/?stripePayment=failed");
    }
}
