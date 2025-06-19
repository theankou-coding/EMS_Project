<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FullDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Insert Users first and collect their UUIDs
        $userIds = [];
        foreach (range(1, 13) as $id) {
            $uuid = $faker->uuid;
            DB::table('users')->insert([
                'user_id'           => $uuid,
                'username'          => $faker->name(),
                'gender'            => $faker->randomElement(['Male', 'Female']),
                'date_of_birth'     => $faker->date('Y-m-d', '2005-01-01'),
                'location'          => $faker->city,
                'email'             => $faker->unique()->safeEmail(),
                'password'          => bcrypt('password'),
                'phone_number'      => $faker->phoneNumber(),
                'registration_date' => $faker->date(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
            $userIds[] = $uuid;
        }

        // Insert Events
        foreach (range(1, 10) as $id) {
            DB::table('events')->insert([
                'event_id'   => $id,
                'event_name' => $faker->sentence(3),
                'category'   => $faker->randomElement(['Education', 'Music', 'Cultural', 'Technology', 'Food & Beverage', 'Arts', 'Business', 'Sports', 'Reunion']),
                'start_date' => $faker->date(),
                'end_date'   => $faker->date(),
                'location'   => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert Participations — use valid user_ids from $userIds array
        foreach (range(1, 8) as $id) {
            DB::table('participations')->insert([
                'participation_id' => $id,
                'event_id'         => $faker->numberBetween(1, 10),
                'user_id'          => $faker->randomElement($userIds), // ensure FK integrity here!
                'participate_date' => $faker->date(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // Insert Admins (optional)
        foreach (range(1, 3) as $id) {
            DB::table('admins')->insert([
                'admin_id'   => $faker->uuid,
                'username'   => $faker->name(),
                'email'      => $faker->unique()->safeEmail(),
                'password'   => bcrypt('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
