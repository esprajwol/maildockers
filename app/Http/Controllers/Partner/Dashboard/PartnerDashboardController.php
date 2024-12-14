<?php

namespace App\Http\Controllers\Partner\Dashboard;

use App\Models\Order;
use App\Models\OrderRefund;
use App\Models\OrderRefundStatus;
use App\Services\BenchMark\BenchMarkService;
use App\Services\Chart\ChartService;
use App\Services\Models\User\PartnerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Google\OrderMessageService;

class PartnerDashboardController extends Controller
{
    use ApiResponseTrait;
    public function index(
        Request $request,
        OrderMessageService $orderMessageService,
        PartnerService $partnerService,
        ChartService $chartService,
        BenchMarkService $benchMarkService
    ) {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        return redirect()->route('partner.orders');
        // if ($request->ajax()) {
        //     info("Request for : " . $request->type);
        //     /*Date Range Ajax Filters */
        //     if ($request->type == "dateRange") {

        //         $startDate = Carbon::parse($request->start_date);
        //         $endDate   = Carbon::parse($request->end_date);

        //         return response()->json([
        //             "orders" => $chartService->dateRangeOrders($request),
        //             "title" => "Start : " . $startDate->format("Y-m-d H:i:s") . " End : " . $endDate->format("Y-m-d  H:i:s"),
        //         ]);
        //     }

        //     $grandReports = $chartService->grandReports($request);

        //     return response()->json([
        //         "data"        => $grandReports["data"],
        //         'orderCounts' => $grandReports["orderCounts"],
        //         "categories"  => $grandReports["categories"],
        //         "benchMark"   => $grandReports["benchMark"],
        //         "isDateRange"     => $grandReports["isDateRange"],
        //         'pastData'        => $grandReports["pastData"],
        //         'pastOrderCounts' => $grandReports["pastOrderCounts"],
        //         'earningBenchmark' => $grandReports["earningBenchmark"],
        //         "title"       => $grandReports["title"],
        //     ]);
        // }

        // $data["chartOrders"]        = $partnerService->last30daysOrders();

        // $data['lastMonthBenchMark'] = $benchMarkService->getMonthBenchmark();
        // $data['lastYearBenchMark']  = $benchMarkService->getYearBenchmark();
        // $data['weekBenchMark']      = $benchMarkService->getWeekBenchmark();
        // $data['currentYearBenchMarkWithOrderTotal']  = $benchMarkService->getYearEarningsAndBenchmark();

        // $data["orderCounts"] = $partnerService->quickReport();

        // $data["numberOfYears"] = appStatic()::ORDER_NUMBER_OF_YEARS;
        // // Total Order Data Year wise
        // $data["ordersData"] = $partnerService->getYearsWiseMonthlyReport($data["numberOfYears"]);

        // //        dd(
        // //            $data["ordersData"],
        // //            $data["ordersData"]["reports"]->pluck("order_count"),
        // //            $data["ordersData"]["reports"]->pluck("total_paid"),
        // //        );
        // //        $data["orders"] = Order::query()->latest("id")->paginate(maxPaginateNo());
        // $userId = userId();
        // $data['orders']     = $orderMessageService->getAll(true, null, $userId);
        // $data['orderCount'] = $orderMessageService->getAll(false, null, $userId);


        // /* All years data*/
        // $data["grandDataOfAllYears"] = $partnerService->getAllYearsReport($userId);

        // /*yearly chart report or total order*/
        // $year = Carbon::now()->year;

        // $orders = Order::select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
        //     ->whereYear('created_at', $year)
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->get();

        // $data['yearlyTotalReport'] = collect(range(1, 12))->map(function ($month) use ($orders) {
        //     $order = $orders->firstWhere('month', $month);
        //     return $order ? $order->count : 0;
        // });


        // /**
        //  * daily and hourly report. will get array as response
        //  *
        //  * index 0 : Orders,
        //  * index 1 : hours
        //  * index 2 : order counts
        //  * index 3 : Hour Incomes (24)
        //  * index 4 : price format hourly
        //  */
        // $running24Hours = $partnerService->last24HoursOrders();

        // // Prepare data for chart
        // $orders            = $running24Hours[0];
        // $hours             = $running24Hours[1];
        // $orderCounts       = $running24Hours[2];
        // $hourIncomes       = $running24Hours[3];
        // $priceFormatHourly = $running24Hours[4];


        // $data['hours']               = $hours;
        // $data['hourlyOrderCounts']   = $orderCounts;
        // $data['hourlyOrderEarnings'] = $priceFormatHourly;

        // $collection                   = collect($data['hourlyOrderCounts']);
        // $data['hourlyTotalOrder']     = $collection->sum();
        // $data['hourlyTotalEarnings']  = priceFormat(collect($hourIncomes)->sum());

        // /**
        //  * Yesterday orders part Start
        //  * */
        // $yesterDayHoursOrders = $partnerService->yesterDayHoursOrders();

        // $yesterday_hours             = $yesterDayHoursOrders[1];
        // $yesterday_orderCounts       = $yesterDayHoursOrders[2];
        // $yesterday_hourIncomes       = $yesterDayHoursOrders[3];
        // $yesterday_priceFormatHourly = $yesterDayHoursOrders[4];

        // $data['yesterday_hours']               = $yesterday_hours;
        // $data['yesterday_hourlyOrderCounts']   = $yesterday_orderCounts;
        // $data['yesterday_hourlyOrderEarnings'] = $yesterday_priceFormatHourly;

        // $collection                             = collect($data['yesterday_hourlyOrderCounts']);
        // $data['yesterday_hourlyTotalOrder']     = $collection->sum();
        // $data['yesterday_hourlyTotalEarnings']  = priceFormat(collect($yesterday_hourIncomes)->sum());

        // /**
        //  * Yesterday orders part End
        //  * */

        // /*last week report*/
        // $data['lastWeekOrder']     = $partnerService->lastWeekOrders();
        // $data['currentWeekOrders'] = $partnerService->currentWeekOrders();

        // // Last 7 day's report
        // $data["last7days"] = $partnerService->showLast7DaysOrders();

        // /*return customer*/
        // $data['returnCustomer'] = $partnerService->OrderByEmail();

        // $data["grandReports"] = $chartService->grandReports($request);

        // $data["today"]        = $benchMarkService->getTodaysBenchMark();

        // $data["registrantBenchMarkFromLastMonth"]        = $benchMarkService->getMonthBenchmarkWithUniqueRegistrants($userId);
        // $data["documentBenchMarkFromLastMonth"]        = $benchMarkService->getMonthBenchmarkWithGrandTotalDocuments($userId);
        // $data["correspondenceBenchMarkFromLastMonth"]        = $benchMarkService->getMonthBenchmarkWithCorrespondence($userId);
        // $data["incomeBenchMarkFromLastMonth"]        = $benchMarkService->getMonthBenchmarkWithPaidAmount($userId);

        // $oldestOrderDate = Order::oldest('created_at')->value('created_at');
        // $oldestOrderDateConverted = Carbon::parse($oldestOrderDate)->format('jS M Y');
        // $today = Carbon::now();
        // $todayConverted = Carbon::parse($today)->format('jS M Y');
        // $data['dateRange'] = $oldestOrderDateConverted . '-' . $todayConverted;
        // $data['countryCode']=$partnerService->getCountryCode($userId);

        return view('dashboard.version1.pages.dashboard_partner');
        // return view('dashboard.version1.pages.dashboard_partner')->with($data);
        //       return view('dashboard.pages.dashboard_partner')->with($data);
    }

    public function orders(Request $request, OrderMessageService $orderMessageService, PartnerService $partnerService, BenchMarkService $benchMarkService)
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $userId = userId();
        // $data["numberOfYears"] = appStatic()::ORDER_NUMBER_OF_YEARS;
        // $data["ordersDataOfYear"] = $partnerService->getYearsWiseMonthlyReport($data["numberOfYears"]);
        $data['lastMonthBenchMark'] = $benchMarkService->getMonthBenchmark();
        // $data['lastYearBenchMark']  = $benchMarkService->getYearBenchmark();
        $data['weekBenchMark']      = $benchMarkService->getWeekBenchmark();

        // $data['currentYearBenchMarkWithOrderTotal']  = $benchMarkService->getYearEarningsAndBenchmark();
        $data['weekBenchMarkWithPaidAmount']  = $benchMarkService->getWeekBenchmarkWithPaidAmount($userId);
        $data['monthBenchMarkWithPaidAmount']  = $benchMarkService->getMonthBenchmarkWithPaidAmount($userId);
        $data['dayBenchMarkWithPaidAmount']  = $benchMarkService->getDayBenchmarkWithPaidAmount($userId);
        $data['yesterdayBenchMarkWithPaidAmount']  = $benchMarkService->getYesterdayBenchmarkWithPaidAmount($userId);

        $data["totalIncomeOfLastWeek"]  = $partnerService->gettotalIncomeOfLastWeek($userId);
        $data["totalIncomeOfYesterday"] = $partnerService->getTotalIncomeOfYesterday($userId);
        $data["totalIncomeofToday"]     = $partnerService->getTotalIncomeOfTodayDays($userId);
        $data["totalIncomeOfThisMonth"] = $partnerService->getTotalIncomeThisMonth($userId);
        $data['currencyCode']           = $partnerService->getCurrencyCode($userId);

        //dd($data["ordersData"]);
        $paginateOrders = Order::query()->orderFilters()->orderBy('created_at', 'desc');

        if(isPartner()){
            $paginateOrders = $paginateOrders->where('partner_id',userId());
        }

        $perPage = 50;

        if ($request->has("per_page")) {
            $perPage = $request->per_page;
        }

        info("Final Query : " . $paginateOrders->toSql());
        info("Final Query Binding : " . json_encode($paginateOrders->getBindings()));

        $data['orders']     = $paginateOrders->paginate($perPage);
        $data['orderCount'] = $paginateOrders->get();


        if ($request->ajax()) {
            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "Pagination Data",
                view('dashboard.partners.orders.orders_table')->with($data)->render(),
                [
                    "totalDocuments" => $data['orderCount']->count(),
                    "totalMessages"  => $data['orderCount']->sum('total_messages'),
                    "totalAmounts"   => round_value($data['orderCount']->sum('payable_amount')),
                    "totalOrders"    => $data['orders']->total(),
                ]
            );
        }
        return view('dashboard.version1.partners.orders.index')->with($data);
        //        return view('dashboard.partners.orders.index')->with($data);
    }

    public function order_refund_requests(Request $request)
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $userId = userId();
        $data["refund_status_list"] = OrderRefund::getAllStatus();

        $paginateOrders = OrderRefund::with('latestStatus')->where('partner_id', $userId);
        $status = $request->status_filter;
        if (!empty($status)) {
            $paginateOrders->whereHas('latestStatus', function ($query) use ($status) {
                $query->where('status', $status);
            })->get();
        }

        $perPage = 50;

        if ($request->has("per_page")) {
            $perPage = $request->per_page;
        }

        $data['refund_request_list']     = $paginateOrders->paginate($perPage);

        if ($request->ajax()) {
            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "Pagination Data",
                view('dashboard.partners.order_refund.order_refund_table')->with($data)->render()
            );
        }
        return view('dashboard.partners.order_refund.index')->with($data);
    }
}
