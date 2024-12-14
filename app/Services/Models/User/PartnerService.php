<?php

namespace App\Services\Models\User;

use App\Models\Order;
use App\Models\Partner;
use App\Models\User;
use App\Models\Currency;
use App\Traits\File\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use App\Utils\AppStatic;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PartnerService
{
    use FileUploadTrait;

    public function getAll(
        $isPaginateOrGet = false,
        $isActiveOnly = null,
        array $withRelationships = []
    ) {
        $query = User::query()->userType(AppStatic::TYPE_PARTNER)->latest();

        // Bind With Relationships
        (!is_null($withRelationships) ? $query->with($withRelationships) : $query);

        if (is_null($isPaginateOrGet)) {
            return $query->pluck("first_name", "id");
        }

        return $isPaginateOrGet ? $query->paginate(maxPaginateNo()) : $query->get();
    }


    /**
     * @incomingParams $data received validated and merged data
     * */
    public function store(array $data)
    {

        $request            = request();
        $data['password']   = Hash::make($data['password']);
        $data['state_id'] = $data['state_id'] ?: null;
        // check user photo is selected
        if ($request->hasFile("photo")) {
            $data["photo"] = $this->uploadFile($request->file("photo"), fileService()::DIR_PARTNER_IMAGE);
        }

        $user = User::query()->create($data);

        return $user;
    }

    public function orderByEmail()
    {
        return Order::select(DB::raw('from_email, count(*) as total'))
            ->groupBy('from_email')
            ->orderBy('total', 'DESC')
            ->limit(5)
            ->get();
    }

    public function update(object $partner, array $data): object
    {
        $request            = request();
        $data['state_id'] = $data['state_id'] ?: null;
        if($data['password']){
            $data['password']   = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile("photo")) {
            $data["photo"] = $this->uploadFile($request->file("photo"), $this->getModelDirName());
            // Delete the previous image if it exists
            if ($partner->photo) {
                $previousImagePath = public_path($partner->photo);
                if ($previousImagePath && file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
        }

        $partner->update($data);

        // Unset User Data
        $data = $this->unsetUserData($data);

        return $partner;
    }
    public function getModelDirName()
    {
        return fileService()::DIR_PARTNER_IMAGE . "/user_id_" . userId();
    }

    public function getModelDirName2()
    {
        return fileService()::DIR_PARTNER_COMPANY_IMAGE . "/user_id_" . userId();
    }

    public function unsetUserData(array $payloads)
    {
        unset(
            $payloads["first_name"],
            $payloads["middle_name"],
            $payloads["last_name"],
            $payloads["username"],
            $payloads["email"],
            $payloads["is_active"],
            $payloads["user_type"],
            $payloads["photo"],
        );

        return $payloads;
    }

    public function benchMark($value)
    {

        // Get the current date
        $currentDate = Carbon::now();

        // Get the first and last day of the previous month
        if ($value == 'month') {
            $previous = $currentDate->subMonth(1)->format('Y-m');
            $current = $currentDate->now()->format('Y-m');
        }
        if ($value == 'year') {
            $previous = $currentDate->subYear(1)->format('Y');
            $current = $currentDate->now()->format('Y');
        }

        if ($value == 'week') {


            // Get the start and end of the current week
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();

            // Get the start and end of the previous week
            $startOfPreviousWeek = Carbon::now()->startOfWeek()->subWeek();
            $endOfPreviousWeek = Carbon::now()->endOfWeek()->subWeek();

            $currentMonthOrdersCount = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
            $previousMonthOrdersCount = Order::whereBetween('created_at', [$startOfPreviousWeek, $endOfPreviousWeek])->count();
        } else {
            // Retrieve the orders count for the previous month
            $previousMonthOrdersCount = Order::query()->where('created_at', 'like', $previous . '%')->count();
            $currentMonthOrdersCount = Order::query()->where('created_at', 'like', $current . '%')->count();
        }
        // Calculate the percentage difference
        $percentageDifference = 0;
        if ($previousMonthOrdersCount > 0) {
            if ($currentMonthOrdersCount > $previousMonthOrdersCount) {
                if ($currentMonthOrdersCount > 0) {
                    $percentageDifference = (($currentMonthOrdersCount - $previousMonthOrdersCount) / $currentMonthOrdersCount) * 100;
                }
            } else {
                if ($currentMonthOrdersCount > 0) {
                    $percentageDifference = (($previousMonthOrdersCount - $currentMonthOrdersCount) / $currentMonthOrdersCount) * 100;
                }
            }
        }

        // Prepare the result
        $result = [
            $previousMonthOrdersCount,
            $currentMonthOrdersCount,
            $percentageDifference,
        ];


        return $result;
    }

    public function weeklyBenchMark()
    {
    }


    public function last30daysOrders()
    {
        return Order::getOrdersForCurrentMonth();
    }


    private function initializeDaysArray($date, $days)
    {
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $data[$i] = [
                'date' => $date->copy()->subDays($days - $i - 1)->format('Y-m-d'),
                'count' => 0,
                'total_amount' => 0,
            ];
        }
        return $data;
    }

    public function prevMonthOrder()
    {
        return Order::prevMonthOrder();
    }

    public function quickReport($bindUserId = true)
    {
        $query = DB::table('orders')
            ->select(
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(CASE WHEN created_at >= CURDATE() THEN 1 ELSE 0 END) as today_orders'),
                DB::raw('SUM(CASE WHEN created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as last_30_days_orders')
            );

        ($bindUserId ? $query->where("partner_id", userId()) : false);

        return $query->first();
    }

    public function getAllYearsReport($userId)
    {

        if (!$userId) {
            throw new Exception("User ID is required");
        }


        $query = Order::query()
            ->selectRaw('COUNT(*) as order_count, SUM(paid_amount) as total_paid, SUM(total_messages) as grandTotalCorrespondences,SUM(total_pages) as grandTotalDocuments')
            ->where('partner_id', $userId);
        $result = $query->first();


        $totalOrders = $result->order_count;
        $totalEarnings = $result->total_paid;
        $grandTotalCorrespondences = $result->grandTotalCorrespondences;
        $grandTotalDocuments = $result->grandTotalDocuments;

        $uniqueRegistrantsQuery = Order::query()
            ->selectRaw('COUNT(DISTINCT from_email) as unique_registrants')
            ->where('partner_id', $userId);

        $uniqueRegistrantsResult = $uniqueRegistrantsQuery->first();
        $totalUniqueRegistrants = $uniqueRegistrantsResult->unique_registrants;

        return [
            "grandTotalOrders" => $totalOrders,
            "grandTotalCorrespondences" => $grandTotalCorrespondences,
            "grandTotalEarnings" => round($totalEarnings, 2),
            "totalUniqueRegistrants" => $totalUniqueRegistrants,
            "grandTotalDocuments" => $grandTotalDocuments,
        ];
    }

    /**
     * @incomingParams $lastTotalYear will contain integer value as last years amount.
     * Here, $lastTotalYear = 3 year means 2024,23,22
     * */
    public function getYearsWiseMonthlyReport($lastTotalYear = 3, $userId = true)
    {

        $year  = Carbon::now()->year;
        $query = Order::query()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as order_count, SUM(paid_amount) as total_paid')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderByRaw('YEAR(created_at), MONTH(created_at)');

        info("Yearly Report Query : " . $query->toSql());
        info("Yearly Report Query Bindings: " . json_encode($query->getBindings()));

        $userId ? $query->where("partner_id", userId()) : false;

        $monthlyReports = $query->get();

        // Initialize an array with 12 months
        $reports       = collect();
        $totalOrders   = 0;
        $totalEarnings = 0;

        for ($month = 1; $month <= 12; $month++) {
            $reports->push([
                'month'       => $month,
                'order_count' => 0,
                'total_paid'  => 0.00
            ]);
        }

        // Fill the reports with actual data
        foreach ($monthlyReports as $report) {
            $monthWisePayloads = [
                'month'       => $report->month,
                'order_count' => $report->order_count,
                'total_paid'  => round($report->total_paid, 2)
            ];

            info("Monthly Info : " . json_encode($monthWisePayloads));

            $reports[$report->month - 1] = $monthWisePayloads;
            $totalOrders += $report->order_count;
            $totalEarnings += $report->total_paid;
        }

        return  [
            'reports'     => $reports,
            'year'        => $year,
            "totalOrders" => $totalOrders,
            "earnings"    => round($totalEarnings, 2)
        ];
    }
    public function gettotalIncomeOfLastWeek($userId = null)
    {
        // Set the start and end date for the last seven days
        $startDate = Carbon::now()->subWeek()->startOfWeek(Carbon::MONDAY);
        $endDate = Carbon::now()->subWeek()->endOfWeek(Carbon::SUNDAY);

        // Initialize the query
        $query = Order::selectRaw('SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Filter by user ID if provided
        if ($userId) {
            $query->where('partner_id', $userId);
        }
        // Execute the query and get the result
        $result = $query->first();

        // Extract and format the total income
        $totalIncome = $result->total_income ?? 0;
        $totalIncomeFormatted = round($totalIncome, 1); // Rounded to 1 decimal place

        return $totalIncomeFormatted;
    }

    public function getTotalIncomeOfYesterday($userId = null)
    {
        // Set the start and end date for yesterday
        $startDate = Carbon::yesterday()->startOfDay();
        $endDate = Carbon::yesterday()->endOfDay();

        // Initialize the query
        $query = Order::selectRaw('SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Filter by user ID if provided
        if ($userId) {
            $query->where('partner_id', $userId);
        }

        // Execute the query and get the result
        $result = $query->first();

        // Extract and format the total income
        $totalIncome = $result->total_income ?? 0;
        $totalIncomeFormatted = round($totalIncome, 1); // Rounded to 1 decimal place

        return $totalIncomeFormatted;
    }

    public function getTotalIncomeOfTodayDays($userId = null)
    {
        // Set the start and end date for the last seven days
        $startDate = Carbon::today(); // Start of today
        $endDate = Carbon::now(); // Current time today
        // Initialize the query
        $query = Order::selectRaw('SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Filter by user ID if provided
        if ($userId) {
            $query->where('partner_id', $userId);
        }

        // Execute the query and get the result
        $result = $query->first();

        // Extract and format the total income
        $totalIncome = $result->total_income ?? 0;
        $totalIncomeFormatted = round($totalIncome, 1); // Rounded to 1 decimal place

        return $totalIncomeFormatted;
    }
    public function getTotalIncomeThisMonth($userId = null)
    {
        // Set the start and end date for this month
        $startDate = Carbon::now()->startOfMonth(); // Start of the current month
        $endDate = Carbon::now(); // End of the current month

        // Initialize the query
        $query = Order::selectRaw('SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate]);


        if ($userId) {
            $query->where('partner_id', $userId);
        }
        $result = $query->first();

        // Extract and format the total income
        $totalIncome = $result->total_income ?? 0;
        $totalIncomeFormatted = round($totalIncome, 1); // Rounded to 1 decimal place

        return $totalIncomeFormatted;
    }

    public function showLast7DaysOrders($userId = true)
    {
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate   = Carbon::now()->subWeek()->endOfWeek();

        $query = Order::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as order_count, SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day');

        $userId ? $query->partnerId() : false;

        // Initialize days and order counts
        $daysOfWeek   = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $orderCounts  = array_fill(0, 7, 0);
        $total_income = array_fill(0, 7, 0);

        $totalOrders = 0;

        // Populate the counts with actual data
        foreach ($query->get() as $order) {
            $orderCounts[$order->day - 1] = $order->order_count;
            $totalOrders += $order->order_count;
            $total_income[$order->day - 1] = round($order->total_income, 2);
        }


        return [
            $daysOfWeek,
            $orderCounts,
            $totalOrders,
            $total_income
        ];
    }

    public function currentWeekOrders($userId = true)
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate   = Carbon::now()->endOfWeek();

        $query = Order::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as order_count, SUM(paid_amount) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day')
            ->orderBy('day');

        $userId ? $query->partnerId() : false;

        // Initialize days and order counts
        $daysOfWeek   = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $orderCounts  = array_fill(0, 7, 0);
        $total_income = array_fill(0, 7, 0);

        $totalOrders = 0;

        // Populate the counts with actual data
        foreach ($query->get() as $order) {
            // Shift day of the week to start from Monday
            $dayIndex = $order->day == 1 ? 6 : $order->day - 2;
            $orderCounts[$dayIndex] = $order->order_count;
            $totalOrders += $order->order_count;
            $total_income[$dayIndex] = priceFormat($order->total_income, 2);
        }

        return [
            $daysOfWeek,
            $orderCounts,
            $totalOrders,
            $total_income
        ];
    }

    public function lastWeekOrders($userId = true)
    {
        $startDate = Carbon::now()->subWeek()->startOfWeek();
        $endDate   = Carbon::now()->subWeek()->endOfWeek();

        $query = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc');

        $userId ? $query->partnerId() : false;

        return $query->get();
    }

    public function last24HoursOrders($userId = true)
    {

        // Prepare data for chart
        $hours       = [];
        $orderCounts = [];
        $hourIncomes = [];

        $startDate = Carbon::today()->startOfDay();
        $endDate    = Carbon::today()->endOfDay();

        $query = Order::selectRaw('HOUR(created_at) as hour, COUNT(*) as order_count, ROUND(SUM(paid_amount),2) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('hour')
            ->orderBy('hour');

        $userId ? $query->partnerId() : false;

        $orders = $query->get();
        // Initialize hours with 0 counts for all 24 hours
        for ($i = 0; $i < 24; $i++) {
            $hours[]       = $i;
            $orderCounts[] = 0;
            $hourIncomes[] = 0;
        }

        // Populate the counts with actual data
        foreach ($orders as $order) {
            $orderCounts[$order->hour] = $order->order_count;
            $hourIncomes[$order->hour] +=  $order->total_income;
        }

        $priceFormatHourly = [];

        foreach ($hourIncomes as $key => $hourIncome) {
            $priceFormatHourly[$key] = priceFormat($hourIncome);
        }


        return [
            $orders,
            $hours,
            $orderCounts,
            $hourIncomes,
            $priceFormatHourly
        ];
    }

    public function yesterDayHoursOrders($userId = true)
    {

        // Prepare data for chart
        $hours       = [];
        $orderCounts = [];
        $hourIncomes = [];

        $startDate = Carbon::now()->yesterday()->startOfDay();
        $endDate = Carbon::now()->yesterday()->endOfDay();

        $query = Order::selectRaw('HOUR(created_at) as hour, COUNT(*) as order_count, ROUND(SUM(paid_amount),2) as total_income')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('hour')
            ->orderBy('hour');

        $userId ? $query->partnerId() : false;

        $orders = $query->get();
        // Initialize hours with 0 counts for all 24 hours
        for ($i = 0; $i < 24; $i++) {
            $hours[]       = $i;
            $orderCounts[] = 0;
            $hourIncomes[] = 0;
        }

        // Populate the counts with actual data
        foreach ($orders as $order) {
            $orderCounts[$order->hour] = $order->order_count;
            $hourIncomes[$order->hour] +=  $order->total_income;
        }

        $priceFormatHourly = [];

        foreach ($hourIncomes as $key => $hourIncome) {
            $priceFormatHourly[$key] = priceFormat($hourIncome);
        }

        return [
            $orders,
            $hours,
            $orderCounts,
            $hourIncomes,
            $priceFormatHourly
        ];
    }
    public function getCountryCode($userId = true)
    {
        $user = User::with('country')->find($userId);
        if ($user) {
            return $user->country?->code;
        }
        return null;
    }

    public function getCurrencyCode($userId = true)
    {
        $user = User::with('country')->find($userId);

        if ($user) {

            $currency = Currency::where('country', $user->country?->name)->first();

            if ($currency) {
                return $currency->code;
            } else {
                return null;
            }
        }

        return null;
    }
}
