<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Console\Command;

class MonthOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'month-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running Month Order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $today = Carbon::today();
        $days = (int) $today->format("d");

        ini_set('max_execution_time', -1);
        set_time_limit(-1);
        try {
            $faker = Faker::create();

            $month = Carbon::now();

            for($start = 1; $start<= $days; $start++){
                $max = mt_rand(30, 300);

                $orderArray = [];
                for ($j = 0; $j < $max; $j++) {

                    $hour    = mt_rand(0,23);
                    $minutes = mt_rand(0,59);
                    $seconds = mt_rand(0,59);

                    $hour   = ($hour < 10) ? "0{$hour}" : $hour;
                    $minutes = ($minutes < 10) ? "0{$minutes}" : $minutes;
                    $seconds = ($seconds < 10) ? "0{$seconds}" : $seconds;

                    $dynamicDate = $month->format("Y-m-{$start}");

                    $stringDateTime = $dynamicDate." {$hour}:{$minutes}:{$seconds}";

                    $randomMonth = Carbon::now()->subMonths(random_int(1,12));

                    $payloads = [
                        'user_id'              => User::where('user_type', 'customer')->inRandomOrder()->first()?->id ?: null,
                        'partner_id'           => User::where('user_type', 'partner')->inRandomOrder()->first()?->id ?: null,
                        'country_id'           => 1,
                        'state_id'             => 1,
                        'payable_amount'       => 9.90,
                        'paid_amount'          => 9.90,
                        'total_messages'       => $faker->numberBetween(10, 2000),
                        'total_pages'          => $faker->numberBetween(15, 2000),
                        'pdf_filepath'         => $faker->url,
                        'platform_type'        => $faker->numberBetween(1, 2),
                        'from_email'           => $faker->randomElement([$faker->safeEmail, $faker->safeEmail('gmail.com')]),
                        'recipient_email'      => $faker->randomElement([$faker->safeEmail, $faker->safeEmail('outlook.com')]),
                        'keyword'              => $faker->word,
                        'exclude_keyword'      => $faker->word,
                        'start_date'           => $randomMonth->startOfMonth(),
                        'end_date'             => $randomMonth->endOfMonth(),
                        'is_paid'              => $faker->boolean,
                        'is_real'              => 0,
                        'payment_gateway'      => $faker->randomElement(['paypal', 'stripe', 'credit_card']),
                        'transaction_payloads' => $faker->text,
                        'created_at'           => Carbon::parse($stringDateTime)
                    ];

                    $orderArray[] = Order::query()->create($payloads);
                }
            }
        }
        catch (\Throwable $exception){
            info("Running Month till today error : ".$exception->getMessage());
        }
    }
}
