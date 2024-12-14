<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Order;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        ini_set('max_execution_time', 1);
        set_time_limit(-1);

        try {
            $faker = Faker::create();

            for ($i = 1; $i <= 12; $i++) {
                $month = Carbon::now()->subMonths($i);

                $monthDays = $month->daysInMonth;
                info($month);
                for ($start = 1; $start <= $monthDays; $start++) {
                    $max = mt_rand(20, 300);

                    for ($j = 0; $j < $max; $j++) {

                        $hour    = mt_rand(0, 23);
                        $minutes = mt_rand(0, 59);
                        $seconds = mt_rand(0, 59);

                        $hour   = ($hour < 10) ? "0{$hour}" : $hour;
                        $minutes = ($minutes < 10) ? "0{$minutes}" : $minutes;
                        $seconds = ($seconds < 10) ? "0{$seconds}" : $seconds;

                        $stringDateTime = $month->format("Y-m-{$start}") . " {$hour}:{$minutes}:{$seconds}";
                        $createdDate = Carbon::parse($stringDateTime);

                        $randomMonth = Carbon::now()->subMonths(random_int(1, 12));

                        $payloads = [
                            'user_id'              => User::where('user_type', 'customer')->inRandomOrder()->first()?->id ?: null,
                            'partner_id'           => User::where('user_type', 'partner')->inRandomOrder()->first()?->id ?: null,
                            'country_id'           => 1, // $faker->randomNumber(2),
                            'state_id'             => 1, //$faker->randomNumber(2),
                            'payable_amount'       => 9.90,
                            'paid_amount'          => 9.90,
                            'total_messages'       => $faker->numberBetween(10, 2000),
                            'total_pages'          => $faker->numberBetween(10, 1000), // it's not necessary for partner dashboard
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
                            'created_at' => $createdDate
                        ];

                        Order::query()->create($payloads);
                    }
                }
            }
        } catch (\Throwable $exception) {
            info("Failed to insert data: " . json_encode(errorArray($exception)));
        }
    }
}
