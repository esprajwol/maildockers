<?php

namespace App\Http\Controllers\Admin;

use App\Models\Code;
use App\Models\Order;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Chart\ChartService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\BenchMark\BenchMarkService;
use App\Services\Google\OrderMessageService;
use App\Services\Models\User\PartnerService;
use App\Services\Models\User\DistributorService;
use App\Services\Notification\NotificationService;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    public function index(
    ) {
        return view('dashboard.version1.dashboard');
    }

    public function indexBk(
        Request $request,
        OrderMessageService $orderMessageService,
        PartnerService $partnerService,
        ChartService $chartService,
        BenchMarkService $benchMarkService
    ) {
        $data["currentWeekOrders"] = [0,0,0,0];
        $data["chartOrders"]        = $partnerService->last30daysOrders();
        $data['lastMonthBenchMark'] = $benchMarkService->getMonthBenchmark(false);
        $data['lastYearBenchMark']  = $benchMarkService->getYearBenchmark(false);
        $data['weekBenchMark']      = $benchMarkService->getWeekBenchmark(false);
        $data['currentYearBenchMarkWithOrderTotal']  = $benchMarkService->getYearEarningsAndBenchmark(false);

        $data["orderCounts"] = $partnerService->quickReport(false);

        $data["numberOfYears"] = appStatic()::ORDER_NUMBER_OF_YEARS;
        // Total Order Data Year wise
        $data["ordersData"] = $partnerService->getYearsWiseMonthlyReport($data["numberOfYears"]);

        //        $data["orders"] = Order::query()->latest("id")->paginate(maxPaginateNo());
        $userId = null;
        $data['orders']     = $orderMessageService->getAll(true, null, $userId);
        $data['orderCount'] = $orderMessageService->getAll(false, null, $userId);


        /*yearly chart report or total order*/
        $year = Carbon::now()->year;

        $orders = Order::select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $data['yearlyTotalReport'] = collect(range(1, 12))->map(function ($month) use ($orders) {
            $order = $orders->firstWhere('month', $month);
            return $order ? $order->count : 0;
        });


        /**
         * daily and hourly repoert
         */
        $orders = $partnerService->last24HoursOrders(false);

        // Prepare data for chart
        $hours       = [];
        $orderCounts = [];

        // Initialize hours with 0 counts for all 24 hours
        for ($i = 0; $i < 24; $i++) {
            $hours[]       = $i;
            $orderCounts[] = 0;
        }

        // Populate the counts with actual data
        // if (isset($orders)) {
        //     foreach ($orders as $order) {
        //         $orderCounts[$order->hour] = ROUND($order->order_count);
        //     }
        // }

        $data['hours']             = $hours;
        $data['hourlyOrderCounts'] = $orderCounts;
        $collection                = collect($data['hourlyOrderCounts']);
        $data['hourlyTotalOrder']  = $collection->sum();

        /*last week report*/
        $data['lastWeekOrder'] = $partnerService->lastWeekOrders();

        // Last 7 day's report
        $data["last7days"] = $partnerService->showLast7DaysOrders();

        $data["grandReports"] = $chartService->grandReports($request);

        if ($request->ajax()) {
            $grandReports = $chartService->grandReports($request);

            return response()->json([
                "data"       => $grandReports["data"],
                "categories" => $grandReports["categories"],
            ]);
        }


        // $data["orderCounts"] = DB::table('orders')
        // ->select(
        //     DB::raw('COUNT(*) as total_orders'),
        //     DB::raw('SUM(CASE WHEN created_at >= CURDATE() THEN 1 ELSE 0 END) as today_orders'),
        //     DB::raw('SUM(CASE WHEN created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as last_30_days_orders')
        // )
        // ->where('is_paid', 1)
        // ->first();

        $data["adminOrders"] = Order::query()->latest("id")->paginate(maxPaginateNo());

        return view('dashboard.version1.dashboard')->with($data);
        //        return view('dashboard.pages.dashboard')->with($data);
    }

    public function notifications(Request $request)
    {
        // Get unread notifications
        $data["notifications"] = user()->notifications;

        return view('dashboard.admin.notifications.index')->with($data);
    }

    public function calculatePercentage($oldNumber, $newNumber)
    {
        $decreaseValue =  $newNumber - $oldNumber;
        if ($decreaseValue == 0 || $oldNumber == 0) {
            return 0;
        }
        return ($decreaseValue / $oldNumber) * 100;
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function allDistributors(Request $request, DistributorService $distributorService)
    {
        $data["distributors"] = $distributorService->getAll(true);

        return view("dashboard.distributor.index")->with($data);
    }

    public function markNotification(Request $request, NotificationService $notificationService)
    {
        try {
            $notification = $notificationService->markNotificationAsReadById($request->id);

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "Notification marked as read successfully."
            );
        } catch (\Throwable $e) {
            return $this->sendResponse(
                appStatic()::INTERNAL_SERVER_ERROR,
                "Failed to update notification",
                errorArray($e)
            );
        }
    }

    public function order(){
        $from_email = Auth::user()->email;
        $orders = Order::with(['refund.latestStatus'])->where('from_email', $from_email) // Filter by the email
                ->where('is_paid', true) // Ensure is_paid is true
                ->whereNotNull('status') // Exclude records where status is null
                ->orderBy('id', 'desc') // Order by id in descending order
                ->get(); // Paginate results to 10 per page
            //dd($orders);
            // Get progress for each order
            foreach ($orders as $order) {
                if ($order->status == "Generating" || $order->is_paid == true) {
                    $progress = '';//Redis::get("job_progress_{$order->id}");
                    $order->progress = $progress ? json_decode($progress, true) : null;
                } else {
                    $order->progress = null;
                }
            }
            
            // return response()->json([
            //     'orders' => view('web.pages.order_list', compact('orders'))->render(),
            //     'pagination' => (string)$orders->links()
            // ]);
            return view('dashboard.version1.pages.order', compact('orders'))->render();
    }
}
