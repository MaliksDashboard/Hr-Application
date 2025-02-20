<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $titles = [
            "Senior Manager",
            "Manager",
            "Senior Executive",
            "Executive",
            "Senior Officer",
            "Officer",
            "Senior Supervisor",
            "Supervisor",
            "Representative",
            "Senior Conductor",
            "Conductor",
            "Senior Supporter",
            "Supporter"
        ];

        for ($i = 0; $i < 400; $i++) {
            DB::table('table_promotions')->insert([
                'employee_id' => $faker->numberBetween(11, 35),
                'old_title' => $faker->randomElement($titles),
                'new_title' => $faker->randomElement($titles),
                'promotion_date' => $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
