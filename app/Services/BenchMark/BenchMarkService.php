<?php

namespace App\Services\BenchMark;

use App\Models\Order;
use App\Services\Models\User\PartnerService;
use Carbon\Carbon;

class BenchMarkService
{

    public function getYearEarningsAndBenchmark($userId = true)
    {
        $startDate = Carbon::now()->subYear()->startOfDay();
        $endDate = Carbon::now();

        $currentYear = Carbon::now()->year;
        $previousYear = Carbon::now()->subYear()->year;

        $query = Order::whereBetween('created_at', [$startDate, $endDate]);
        $userId ? $query->where("partner_id", userId()) : false;

        $prevYearQuery = Order::whereYear('created_at', $previousYear);
        $userId ? $prevYearQuery->where("partner_id", userId()) : false;
        $data = (new PartnerService())->getAllYearsReport(userId());
        $currentYearEarnings = $query->sum('paid_amount'); //$data["grandTotalEarnings"];
        $previousYearEarnings = $prevYearQuery->sum('paid_amount');

        $yearEarningsBenchmark = $this->calculatePercentageChange($previousYearEarnings, $currentYearEarnings);

        return [
            priceFormat($currentYearEarnings),
            priceFormat($previousYearEarnings),
            $yearEarningsBenchmark,
            $currentYear,
            $previousYear,
            $currentYearEarnings
        ];
    }

    public function getYearBenchmark($userId = true)
    {
        $query = Order::whereYear('created_at', Carbon::now()->year);
        $userId ? $query->where("partner_id", userId()) : false;


        $currentYearOrders = $query->count();

        $query2 = Order::whereYear('created_at', Carbon::now()->subYear()->year);
        $userId ? $query2->where("partner_id", userId()) : false;

        $previousYearOrders = $query2->count();

        $yearBenchmark = $this->calculatePercentageChange($previousYearOrders, $currentYearOrders);

        return $yearBenchmark;
    }

    public function getMonthBenchmark($userId = true)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        $query = Order::whereBetween('created_at',[$startDate,$endDate]);

        $userId ? $query->where("partner_id", userId()) : false;

        $currentMonthOrders = $query->count();


        $query1 = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year);

        $userId ? $query1->where("partner_id", userId()) : false;


        $previousMonthOrders = $query1->count();


        $monthBenchmark = $this->calculatePercentageChange($previousMonthOrders, $currentMonthOrders);

        return $monthBenchmark;
    }
    public function getMonthBenchmarkWithPaidAmount($userId = true)
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        // Query for the current month's paid_amount
        $query = Order::whereBetween('created_at', [$startDate,$endDate]);

        if ($userId) {
            $query->where("partner_id", userId());
        }

        $currentMonthPaidAmount = $query->sum('paid_amount');

        // Query for the previous month's paid_amount
        $query1 = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year);

        if ($userId) {
            $query1->where("partner_id", userId());
        }

        $previousMonthPaidAmount = $query1->sum('paid_amount');
        $monthBenchmark = $this->calculatePercentageChange($previousMonthPaidAmount, $currentMonthPaidAmount);
        return $monthBenchmark;
    }
    public function getMonthBenchmarkWithGrandTotalDocuments($userId = true)
    {
        // Define the start and end dates for the current month and the previous month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        // Query for the current month's total sum of total_pages
        $query = Order::query()
            ->selectRaw('COUNT(*) as grandTotalPages')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentMonthGrandTotalPages = $query->value('grandTotalPages');
        info("Current month grand total documents: $currentMonthGrandTotalPages");

        // Query for the previous month's total sum of total_pages
        $query1 = Order::query()
            ->selectRaw('COUNT(*) as grandTotalPages')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth]);

        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousMonthGrandTotalPages = $query1->value('grandTotalPages');
        info('Previous month grand total documents: ' . $previousMonthGrandTotalPages);

        $monthBenchmarkOfDocuments = $this->calculatePercentageChange($previousMonthGrandTotalPages, $currentMonthGrandTotalPages);
        return $monthBenchmarkOfDocuments;
    }
    public function getMonthBenchmarkWithCorrespondence($userId = true)
    {
        // Define the start and end dates for the current month and the previous month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        // Query for the current month's total sum of total_messages
        $query = Order::query()
            ->selectRaw('SUM(total_messages) as grandTotalCorrespondences')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentMonthGrandTotalCorrespondence = $query->value('grandTotalCorrespondences');
        info("Current month grand total Correspondence: $currentMonthGrandTotalCorrespondence");

        // Query for the previous month's total sum of total_messages
        $query1 = Order::query()
            ->selectRaw('SUM(total_messages) as grandTotalCorrespondences')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth]);

        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousMonthGrandTotalCorrespondence = $query1->value('grandTotalCorrespondences');
        info('Previous month grand total Correspondence: ' . $previousMonthGrandTotalCorrespondence);

        // Calculate the benchmark percentage change
        $monthBenchmarkCorrespondence = $this->calculatePercentageChange($previousMonthGrandTotalCorrespondence, $currentMonthGrandTotalCorrespondence);

        return $monthBenchmarkCorrespondence;
    }

    public function getWeekBenchmark($userId = true)
    {
        $query = Order::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()
        ]);

        $userId ? $query->where("partner_id", userId()) : false;

        $currentWeekOrders = $query->count();

        $query1 = Order::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ]);

        $userId ? $query1->where("partner_id", userId()) : false;

        $previousWeekOrders = $query1->count();

        $weekBenchmark = $this->calculatePercentageChange($previousWeekOrders, $currentWeekOrders);

        return  $weekBenchmark;
    }
    public function getMonthBenchmarkWithUniqueRegistrants($userId = true)
    {
        // Define the start and end dates for the current month and the previous month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        // Query for the current month's total unique registrants
        $query = Order::query()
            ->selectRaw('COUNT(DISTINCT from_email) as unique_registrants')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);

        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentMonthUniqueRegistrants = $query->value('unique_registrants');
        info("Current month unique registrants: $currentMonthUniqueRegistrants");

        // Query for the previous month's total unique registrants
        $query1 = Order::query()
            ->selectRaw('COUNT(DISTINCT from_email) as unique_registrants')
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth]);

        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousMonthUniqueRegistrants = $query1->value('unique_registrants');
        info('Previous month unique registrants: ' . $previousMonthUniqueRegistrants);

        $monthBenchmark = $this->calculatePercentageChange($previousMonthUniqueRegistrants, $currentMonthUniqueRegistrants);

        return $monthBenchmark;
    }

    public function getDayBenchmarkWithPaidAmount($userId = true)
    {
        // Define the start and end times for today and yesterday
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now();
        $startOfPreviousDay = Carbon::now()->subDay()->startOfDay();
        $endOfPreviousDay = Carbon::now()->subDay()->endOfDay();

        // Query for today's total paid amount
        $query = Order::whereBetween('created_at', [$startOfDay, $endOfDay]);
        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentDayPaidAmount = $query->sum('paid_amount');
        info("Current day paid amount: $currentDayPaidAmount");

        // Query for yesterday's total paid amount
        $query1 = Order::whereBetween('created_at', [$startOfPreviousDay, $endOfPreviousDay]);
        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousDayPaidAmount = $query1->sum('paid_amount');
        info('Previous day paid amount: ' . $previousDayPaidAmount);

        // Calculate the benchmark percentage change
        $dayBenchmark = $this->calculatePercentageChange($previousDayPaidAmount, $currentDayPaidAmount);

        return $dayBenchmark;
    }

    public function getYesterdayBenchmark($userId = true)
    {
        // Define the start and end times for today and yesterday
        $startOfDay = Carbon::yesterday()->startOfDay();
        $endOfDay = Carbon::yesterday()->endOfDay();

        $startOfPreviousDay = Carbon::yesterday()->subDay()->startOfDay();
        $endOfPreviousDay = Carbon::yesterday()->subDay()->endOfDay();

        // Query for yesterday's total
        $query = Order::whereBetween('created_at', [$startOfDay, $endOfDay]);
        if ($userId) {
            $query->where("partner_id", $userId);
        }

        $yesterdayOrders = $query->count();

        $query1 = Order::whereBetween('created_at', [$startOfPreviousDay, $endOfPreviousDay]);
        if ($userId) {
            $query1->where("partner_id", $userId);
        }

        $dayBeforeYesterdayOrders = $query1->count();

        info($dayBeforeYesterdayOrders);
        info($yesterdayOrders);
        $yesterdayBenchmark = $this->calculatePercentageChange($dayBeforeYesterdayOrders, $yesterdayOrders);

        return $yesterdayBenchmark;
    }
    public function getYesterdayBenchmarkWithPaidAmount($userId = true)
    {
        // Define the start and end times for today and yesterday
        $startOfDay = Carbon::yesterday()->startOfDay();
        $endOfDay = Carbon::yesterday()->endOfDay();

        $startOfPreviousDay = Carbon::yesterday()->subDay()->startOfDay();
        $endOfPreviousDay = Carbon::yesterday()->subDay()->endOfDay();

        // Query for today's total paid amount
        $query = Order::whereBetween('created_at', [$startOfDay, $endOfDay]);
        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentDayPaidAmount = $query->sum('paid_amount');
        info("Current day paid amount: $currentDayPaidAmount");

        // Query for yesterday's total paid amount
        $query1 = Order::whereBetween('created_at', [$startOfPreviousDay, $endOfPreviousDay]);
        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousDayPaidAmount = $query1->sum('paid_amount');
        info('Previous day paid amount: ' . $previousDayPaidAmount);

        // Calculate the benchmark percentage change
        $dayBenchmark = $this->calculatePercentageChange($previousDayPaidAmount, $currentDayPaidAmount);

        return $dayBenchmark;
    }

    public function getWeekBenchmarkWithPaidAmount($userId = true)
    {
        // Define the start and end dates for the current week, week start from monday
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek(Carbon::SUNDAY);

         // Define the start and end dates for the week before last week
        $startOfPreviousWeek = Carbon::now()->subWeek(2)->startOfWeek(Carbon::MONDAY);
        $endOfPreviousWeek = Carbon::now()->subWeek(2)->endOfWeek(Carbon::SUNDAY);

        // Query for the current week's total paid amount
        $query = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        if ($userId) {
            $query->where("partner_id", $userId);
        }
        $currentWeekPaidAmount = $query->sum('paid_amount');

        // Query for the previous week's total paid amount
        $query1 = Order::whereBetween('created_at', [$startOfPreviousWeek, $endOfPreviousWeek]);
        if ($userId) {
            $query1->where("partner_id", $userId);
        }
        $previousWeekPaidAmount = $query1->sum('paid_amount');
        // Calculate the benchmark percentage change
        $weekBenchmark = $this->calculatePercentageChange($previousWeekPaidAmount, $currentWeekPaidAmount);

        return $weekBenchmark;
    }

    public function getTodaysBenchMark($userId = true)
    {
        $today = Carbon::now();
        $yesterday =  Carbon::now()->subDay();

        $query = Order::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]);

        if ($userId) {
            $query = $query->partnerId();
        }

        $todayOrdersCount = $query->count();


        $yesterdayOrdersCount = Order::whereBetween('created_at', [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->count();

        $todayBenchmark = $this->calculatePercentageChange($yesterdayOrdersCount, $todayOrdersCount);

        $todayOrders = Order::whereBetween('created_at', [Carbon::now()->startOfDay(),  Carbon::now()->endOfDay()])->sum('paid_amount');

        $yesterdayOrders = Order::whereBetween('created_at', [
            Carbon::now()->subDay()->startOfDay(),
            Carbon::now()->subDay()->endOfDay()
        ])
            ->sum('paid_amount');

        return [
            $todayOrdersCount,
            $yesterdayOrdersCount,
            $todayBenchmark,
            priceFormat($todayOrders),
            priceFormat($yesterdayOrders),
        ];
    }

    private function calculatePercentageChange($previous, $current)
    {
        if ($previous == 0) {
            return $current == 0 ? 0 : 100;
        }
        return (($current - $previous) / $previous) * 100;
    }
}
