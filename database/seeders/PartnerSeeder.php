<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PartnerSeeder extends Seeder
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
        $usersPerMonth = 5;
        $totalMonths = 12;

        $faker = \Faker\Factory::create();

        for ($month = 1; $month <= $totalMonths; $month++) {
            for ($user = 1; $user <= $usersPerMonth; $user++) {
                DB::table('users')->insert([
                    'country_id' => 1,
                    'first_name' => $faker->firstName,
                    'middle_name' => $faker->optional()->firstName,
                    'last_name' => $faker->lastName,
                    'username' => $faker->unique()->userName,
                    'user_type' => 'partner',
                    'is_real'        => 0,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('password'), // or any other default password
                    'provider_type' => $faker->randomElement(['email', 'outlook']),
                    'created_at' => now()->subMonths(12 - $month),
                    'updated_at' => now()->subMonths(12 - $month),
                ]);
            }
        }
    }
}
