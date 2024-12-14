<?php

namespace App\Services\Chart;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChartService
{
   public function orderDataGroupBy($orders, $formatType = "H")
    {
        return $orders->groupBy(function($date) use($formatType){
            return Carbon::parse($date->created_at)->format($formatType);
        })
            ->map(function($orders) {
                return [
                    $orders->count(),
                    $orders->sum('paid_amount'),
                ];
            })
            ->toArray();
    }
    public function orderCountAndMoneyLoop($orderData, $ordersCount, $data)
    {

        foreach ($orderData as $day => $amount) {
            $ordersCount[intval($day)] = $amount[0];
            $data[intval($day)] = priceFormat($amount[1]);
        }

        return [$ordersCount, $data];
    }

    public function grandReports($request, $userId = true)
    {
        $type = $request->get('type') ?? "today";
        $now = Carbon::now();
        $data = [];
        $ordersCount = [];

        $pastData = [];
        $pastOrdersCount = [];


        $categories = [];
        $benchMark = 0;
        $isDateRange = false;

        $title = "";

        if($type =="today"){
            $startOfDay = $now->copy()->startOfDay();
            $endOfDay   = $now->copy()->endOfDay();
            $orders     = $this->makeOrderQuery($startOfDay,$endOfDay, $userId);

            $yesterdayOrders = $this->makeOrderQuery(
                Carbon::now()->yesterday()->startOfDay(),
                Carbon::now()->yesterday()->endOfDay(),
                $userId
            );

            $title = "Series 1 : ".$startOfDay->format("Y-m-d H:i:s") . " - " . $endOfDay->format("Y-m-d H:i:s")." <br> Series 2 : ".Carbon::now()->yesterday()->startOfDay()->format("Y-m-d H:i:s")." - ".Carbon::now()->yesterday()->endOfDay()->format("Y-m-d H:i:s");

            $benchMark = calculateBenchMark($yesterdayOrders->count(), $orders->count());

            $orderData = $orders->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('H');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();

            $categories  = range(0, 23);
            $data        = array_fill_keys($categories, 0);
            $ordersCount = array_fill_keys($categories, 0);

            $total = 0;


            foreach ($orderData as $hour => $amount) {
                $ordersCount[intval($hour)] = $amount[0];
                $data[intval($hour)] = priceFormat($amount[1]);
                $total+=$amount[1];
            }

            $ordersCount = array_values($ordersCount);
            $data = array_values($data);


            // Yesterday
            $pastData        = array_fill_keys($categories, 0);
            $pastOrdersCount = array_fill_keys($categories, 0);

            $pastOrderData = $yesterdayOrders->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('H');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();
            $total1 = 0;

            foreach ($pastOrderData as $hour => $amount) {
                $pastOrdersCount[intval($hour)] = $amount[0];
                $pastData[intval($hour)] = priceFormat($amount[1]);
                $total1+=$amount[1];
            }

            $earningBenchMark = calculateBenchMark($total1, $total);

            $pastData        = array_values($data);
            $pastOrdersCount = array_values($ordersCount);
        }

        if($type == "yesterday"){
            $startOfDay = Carbon::yesterday()->startOfDay();
            $endOfDay   = Carbon::yesterday()->endOfDay();

            $orders     = $this->makeOrderQuery($startOfDay,$endOfDay, $userId);

            $yesterdayOrders = $this->makeOrderQuery(
                Carbon::now()->subDays(2)->startOfDay(),
                Carbon::now()->subDays(2)->endOfDay(),
                $userId
            );

            $title = "Series 1 : ".$startOfDay->format("Y-m-d H:i:s") . " - " . $endOfDay->format("Y-m-d H:i:s")." and Series 2 : ".Carbon::now()->subDays(2)->startOfDay()->format("Y-m-d H:i:s")." - ".Carbon::now()->subDays(2)->endOfDay()->format("Y-m-d H:i:s");


            $benchMark = calculateBenchMark($yesterdayOrders->count(), $orders->count());

            $orderData = $orders->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('H');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();

            $categories  = range(0, 23);
            $data        = array_fill_keys($categories, 0);
            $ordersCount = array_fill_keys($categories, 0);
            $total = 0;

            foreach ($orderData as $hour => $amount) {
                $ordersCount[intval($hour)] = $amount[0];
                $data[intval($hour)] = priceFormat($amount[1]);
                $total+=$amount[1];
            }
            $data        = array_values($data);
            $ordersCount = array_values($ordersCount);

            // Yesterday
            $pastData        = array_fill_keys($categories, 0);
            $pastOrdersCount = array_fill_keys($categories, 0);

            $pastOrderData = $yesterdayOrders->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('H');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();

            $total1 = 0;
            foreach ($pastOrderData as $hour => $amount) {
                $pastOrdersCount[intval($hour)] = $amount[0];
                $pastData[intval($hour)] = priceFormat($amount[1]);
                $total1+=$amount[1];
            }

            $earningBenchMark = calculateBenchMark($total1, $total);

            $pastData        = array_values($data);
            $pastOrdersCount = array_values($ordersCount);
        }

        if($type == "last7days"){
            $start  = Carbon::now()->subWeek()->startOfWeek();
            $end    = Carbon::now()->subWeek()->endOfWeek();

            $orders = $this->makeOrderQuery($start,$end, $userId);

            $lastLast7days = $this->makeOrderQuery(
                Carbon::now()->subWeeks(2)->startOfWeek(),
                Carbon::now()->subWeeks(2)->endOfWeek(),
                $userId
            );


            $title = "Series 1 : ".$start->format("Y-m-d H:i:s") . " - " . $end->format("Y-m-d H:i:s")." and Series 2 : ".Carbon::now()->subWeeks(2)->startOfWeek()->format("Y-m-d H:i:s")." - ".Carbon::now()->subWeeks(2)->endOfWeek()->format("Y-m-d H:i:s");

            $benchMark = calculateBenchMark($lastLast7days->count(), $orders->count());

//            $orderData = $this->orderDataGroupBy($orders,'l');
            $orderData = $orders->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();

            info("Last 7 Order Data".json_encode($orderData));

            $categories = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $data        = array_fill_keys($categories, 0);
            $ordersCount = array_fill_keys($categories, 0);

            $total = 0;
            foreach ($orderData as $day => $amount) {
                $ordersCount[$day] = $amount[0];
                $data[$day] = priceFormat($amount[1]);
                $total+=$amount[1];
            }

            $data        = array_values($data);
            $ordersCount = array_values($ordersCount);


            // past 7 days before last 7 days
            $pastData        = array_fill_keys($categories, 0);
            $pastOrdersCount = array_fill_keys($categories, 0);

            $pastOrderData = $lastLast7days->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            })
                ->map(function($orders) {
                    return [
                        $orders->count(),
                        $orders->sum('paid_amount'),
                    ];
                })
                ->toArray();

            info("Last 7 & Before 7 Days ".json_encode($pastOrdersCount));

            $total1 = 0;

            foreach ($pastOrderData as $day => $amount) {
                $pastOrdersCount[$day] = $amount[0];
                $pastData[$day]        = priceFormat($amount[1]);
                $total1+=$amount[1];
            }

            $earningBenchMark = calculateBenchMark($total1, $total);

            $pastOrdersCount = array_values($pastOrdersCount);
            $pastData        = array_values($pastData);
        }

        // last30Days
        if ($type == "last30days") {
            $data            = [];
            $ordersCount     = [];
            $pastData        = [];
            $pastOrdersCount = [];
            $categories      = [];

//        $categories  = range(1, 30);
//        $data        = array_fill_keys($categories, 0);
//        $ordersCount = array_fill_keys($categories, 0);

            /**
             * Last 30 Day's
             * */

            $startDate1 = Carbon::now()->subDays(29)->startOfDay();
            $endDate1   = Carbon::now()->endOfDay();

            $orders = $this->customQuery($startDate1, $endDate1);

            /**
             * Last 30 day's back 30 day's
             * */
            $endDate2 = Carbon::now()->subDays(30)->startOfDay();
            $startDate2 = Carbon::now()->subDays(59)->endOfDay();

            $title = "Series 1 : {$startDate1->toDateTimeString()} - {$endDate1->toDateTimeString()} and Series 2 : {$startDate2->toDateTimeString()} - {$endDate2->toDateTimeString()}";

            $pastOrders = $this->customQuery($startDate2, $endDate2);

            $orderData     = $orders->toArray();
            $pastOrderData = $pastOrders->toArray();

            $dataTotalOrderCounts     = collect($data)->sum("order_count");
            $pastDataTotalOrderCounts = collect($pastData)->sum("order_count");

            $dataEarnings     = collect($data)->sum("total_earnings");
            $pastDataEarnings = collect($pastData)->sum("total_earnings");

            $benchMark        = calculateBenchMark($pastDataTotalOrderCounts, $dataTotalOrderCounts);
            $earningBenchMark = calculateBenchMark($pastDataEarnings,$dataEarnings);


            foreach ($orderData as $day => $amount) {
                $ordersCount[$amount["date"]] = $amount["order_count"];
                $data[$amount["date"]]        = priceFormat($amount["total_earnings"]);

                $categories[] = $amount["date"];
            }

            foreach ($pastOrderData as $day => $amount) {
                $pastOrdersCount[$amount["date"]] = $amount["order_count"];
                $pastData[$amount["date"]]        = priceFormat($amount["total_earnings"]);
            }
        }

//        return [
//            'data'             => $data,
//            'orderCounts'      => $ordersCount,
//            'categories'       => $categories,
//            "benchMark"        => $benchMark,
//            "isDateRange"      => $isDateRange,
//            'pastData'         => $pastData,
//            'pastOrderCounts'  => $pastOrdersCount,
//            'earningBenchmark' => $earningBenchMark,
//            "title"            => $title,
//        ];

        return [
            'data'            => array_values($data),
            'orderCounts'     => array_values($ordersCount),
            'categories'      => $categories,
            "benchMark"       => $benchMark,
            "isDateRange"     => $isDateRange,
            'pastData'        => array_values($pastData),
            'pastOrderCounts' => array_values($pastOrdersCount),
            'earningBenchmark' => $earningBenchMark,
            "title"       => $title,
        ];
    }

    public function customQuery($startDate, $endDate)
    {

        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(paid_amount) as total_earnings')
            )
            ->groupBy('date')
            ->get()
            ->keyBy('date');
    }


    public function dateRangeOrders($request)
    {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate   = Carbon::parse($request->end_date)->endOfDay();

        return Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(paid_amount) as total_paid')
            ->groupBy('date')
            ->orderBy("date")
            ->get();
    }


    public function makeOrderQuery($start, $end, $userId = true){

        $query = Order::whereBetween('created_at', [$start, $end]);

        $userId ? $query->partnerId() : false;

        return $query->get();
    }
}
