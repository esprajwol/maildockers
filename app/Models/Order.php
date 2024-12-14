<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        "fetch_start_at",
        "fetch_end_at",
        "pdf_gen_start_at",
        "pdf_gen_end_at",
        "msg_json_file",
        "processing_status",
        'pdf_file',
        'notify_channel',
        'notify_value',
        'user_id',
        'partner_id',
        'country_id',
        'state_id',
        'payable_amount',
        'paid_amount',
        'total_messages',
        'pdf_filepath',
        'platform_type',
        'from_email',
        'recipient_email',
        'keyword',
        'status',
        'exclude_keyword',
        'start_date',
        'end_date',
        'search_attachments_list',
        'is_paid',
        'payment_gateway',
        'transaction_payloads',
        'language',
        'request',
        'created_at',
        'total_pages',
        'pdf_downloaded_at',
        'pdf_deleted_at',
        'timezone',
        'currency_id',
        'notify'
    ];

    public function orderMessages() : HasMany
    {
        return $this->hasMany(OrderMessage::class);
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state() : BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function getOrderByAttribute()
    {
       return email_encrypt($this->from_email);
    }

    public function getTargetAttribute()
    {
        return email_encrypt($this->recipient_email);
    }

    public function scopePartnerId($query){
        $query->where("partner_id", userId());
    }

    public function getMonthlyReportData() {
        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth()->month;
        $year = Carbon::now()->year;

        $currentMonthData = DB::table('orders')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(paid_amount) as total_earnings'))
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();

        $previousMonthData = DB::table('orders')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(paid_amount) as total_earnings'))
            ->whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();

        return [
            'currentMonthData' => $currentMonthData,
            'previousMonthData' => $previousMonthData
        ];
    }

    public static function getOrdersForCurrentMonth()
    {
        $daysInMonth = collect(range(1, date('t')));

        $previousMonth = Carbon::now()->subMonth()->month;
        $year          = Carbon::now()->year;

        $orders = DB::table('orders')
            ->select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('count(*) as orders'),
                DB::raw('SUM(paid_amount) as total_earnings'),
            )
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->groupBy(DB::raw('DAY(created_at)'));

        $prevOrders = DB::table('orders')
            ->select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('count(*) as prevOrders'),
                DB::raw('SUM(paid_amount) as total_earnings'),
            )
            ->whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('DAY(created_at)'));

        isPartner() ? $orders->where("partner_id",userId()) : false;
        isPartner() ? $prevOrders->where("partner_id",userId()) : false;

        $orders = $orders->get();
        $prevOrders = $prevOrders->get();

        return $daysInMonth->map(function ($day) use ($orders,$prevOrders) {

            $dayOrders       = 0;
            $dayOrderEarning = 0;

            $prevDayOrders       = 0;
            $prevDayOrderEarning = 0;

            foreach ($prevOrders as $order){
                if($order->day == $day){
                    $prevDayOrders = $order->prevOrders;
                    $prevDayOrderEarning = ROUND($order->total_earnings);
                    break;
                }
            }

            foreach ($orders as $order){
                if($order->day == $day){
                    $dayOrders = $order->orders;
                    $dayOrderEarning = ROUND($order->total_earnings);
                    break;
                }
            }

            return [
                'day'            => $day,
                'orders'         => $dayOrders,
                "total_earnings" => priceFormat($dayOrderEarning),
                'prevOrders'     => priceFormat($prevDayOrders),
                'prev_total_earnings' => priceFormat($prevDayOrderEarning) ,
            ];
        });
    }

    public function scopeOrderFilters($query)
    {
        $request = request();
        $user_timezone = getTimeZone();
        // Star Date & End Date
        if( $request->has("start_date") &&
            $request->has("end_date") &&
            !empty($request->start_date && $request->end_date))
        {
            $start_date = Carbon::parse($request->start_date,$user_timezone)->startOfDay(); //->format("Y-m-d H:i:s");
            $end_date   = Carbon::parse($request->end_date,$user_timezone)->endOfDay(); //->format("Y-m-d H:i:s");

            // If both dates are the current day, set the end_date to the current time
            if (Carbon::parse($request->end_date,$user_timezone)->isToday()) {
                $end_date = Carbon::now();  // Current time
            }

            info("Orders Start Date : {$start_date} End Date : {$end_date} timezone : {$user_timezone}")  ;

            $query->whereBetween("created_at",[$start_date,$end_date]);
        }


    }

    public function refund()
    {
        return $this->hasOne(OrderRefund::class);
    }

}
