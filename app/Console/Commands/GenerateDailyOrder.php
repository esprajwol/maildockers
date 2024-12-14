<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Console\Command;

class GenerateDailyOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-daily-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates orders between 7 AM and midnight, with 90% during peak hours (9 AM - 6 PM)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', 1);
        set_time_limit(-1);

        try {

            $faker = Faker::create();

            // Generate a random number of orders between 200 and 350
            // as order amount is 9.90 income will be between 2000 - 3500 GBP
            $orderCount = rand(200, 350);

            // Track the total generated orders
            for ($i = 0; $i < $orderCount; $i++) {
                // Create a new order
                $order = new Order();

                // Set the creation time based on the desired random distribution
                $created_at = $this->generateRandomTime($i === 0, $i === $orderCount - 1, $this->isPeakHour());

                // Set order details
                $order->user_id = User::where('user_type', 'customer')->inRandomOrder()->first()?->id ?: null;
                $order->partner_id = User::where('user_type', 'partner')->inRandomOrder()->first()?->id ?: null;
                $order->country_id = 1; // Replace with your actual country ID
                $order->state_id = 1; // Replace with your actual state ID
                $order->payable_amount = 9.90;
                $order->paid_amount = 9.90;
                $order->total_messages = $faker->numberBetween(10, 2000);
                $order->total_pages = $faker->numberBetween(10, 1000);
                $order->pdf_filepath = $faker->url;
                $order->platform_type = $faker->numberBetween(1, 2);
                $order->from_email = $faker->randomElement([$faker->safeEmail, $faker->safeEmail('gmail.com')]);
                $order->recipient_email = $faker->randomElement([$faker->safeEmail, $faker->safeEmail('outlook.com')]);
                $order->keyword = $faker->word;
                $order->exclude_keyword = $faker->word;
                $order->start_date = $created_at->addSeconds(10);
                $order->end_date = $created_at->addSeconds(20);
                $order->is_paid = $faker->boolean;
                $order->is_real = 0;
                $order->payment_gateway = $faker->randomElement(['paypal', 'stripe', 'credit_card']);
                $order->transaction_payloads = $faker->text;
                $order->created_at = $created_at;

                // Save the order
                $order->save();
            }

        } catch (\Exception $exception) {
            info("Failed to insert data: " . json_encode(errorArray($exception)));
        }
    }

    private function generateRandomTime($isFirstOrder, $isLastOrder, $isPeakHour)
    {
        if ($isFirstOrder) {
            // First order created at around 7 AM
            $hour = 7;
            $minutes = rand(0, 59);
        } elseif ($isLastOrder) {
            // Last order created at midnight
            $hour = 23;
            $minutes = rand(0, 59);
        } elseif ($isPeakHour) {
            // 90% of orders between 9 AM and 6 PM
            $hour = rand(9, 18);
            $minutes = rand(0, 59);
        } else {
            // 10% of orders outside peak hours (7 AM to 9 AM or 6 PM to midnight)
            $hour = rand(7, 23);
            $minutes = rand(0, 59);
        }

        $seconds = rand(0, 59);
        return Carbon::now()->hour($hour)->minute($minutes)->second($seconds);
    }

    private function isPeakHour()
    {
        // Generate a random number between 0 and 1
        $randomProbability = mt_rand(0, 100) / 100;

        // Return true if the probability falls within 90%
        return $randomProbability <= 0.90;
    }

}
