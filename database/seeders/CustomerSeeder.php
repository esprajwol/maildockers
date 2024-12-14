<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfMonths = 12;
        $usersPerMonth  = 8;
        $faker = \Faker\Factory::create("en_GB");

        $user  = User::query()->where('username', '=', 'london')->first();

        for ($month = 1; $month <= 12; $month++) {
            for ($i = 0; $i < 8; $i++) {

                $uniqueUsername = $this->generateUniqueUsername($faker->unique()->userName);

                DB::table('users')->insert([
                    'parent_user_id' => $user->id ?? null,
                    'country_id'     => Country::query()->first()?->id ?: null,
                    'first_name'     => $faker->firstName,
                    'middle_name'    => $faker->optional()->firstName,
                    'last_name'      => $faker->lastName,
                    'username'       => $uniqueUsername,
                    'user_type'      => 'customer',
                    'is_real'        => 0,
                    'email'          => $faker->unique()->safeEmail,
                    'password'       => Hash::make('password'),
                    'created_at'     => now()->subMonths(12 - $month),
                    'updated_at'     => now()->subMonths(12 - $month),
                ]);
            }
        }
    }

    private function generateUniqueUsername($username)
    {
        $username = slugMaker($username);
        $user = User::query()
            ->where('username', '=', $username)
            ->exists();

        if(!$user){
            return $username;
        }


        $faker = \Faker\Factory::create("en_GB");

        return $this->generateUniqueUsername($faker->unique()->userName);
    }
}
