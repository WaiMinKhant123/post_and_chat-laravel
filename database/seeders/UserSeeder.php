<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $totalUsers = 10000; // လိုချင်သည့် User ပမာဏ (၁၀,၀၀၀)
        $batchSize = 500;   // တစ်ကြိမ်တည်း Batch ထည့်မည့် ပမာဏ

        $this->command->info("Starting to seed {$totalUsers} users...");

        // Password ကို တစ်ခါတည်း Hash လုပ်ထားခြင်းက Seeding ပိုမြန်စေပါတယ်
        $defaultPassword = Hash::make('password123');

        for ($i = 0; $i < $totalUsers; $i += $batchSize) {
            $usersData = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $now = now();
                
                $usersData[] = [
                    'name'              => $faker->name,
                    'email'             => $faker->unique()->safeEmail,
                    'email_verified_at' => rand(0, 1) == 1 ? $now : null, // တစ်ချို့ verified ဖြစ်, တစ်ချို့ မဖြစ်
                    'password'          => $defaultPassword,
                    'avatar'            => 'https://picsum.photos/seed/' . rand(1, 50000) . '/200/200', // Mock Avatar ပုံများ
                    'is_admin'          => 0,
                    'banned'            => 0,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];
            }

            // Bulk Insert ဖြင့် DB ထဲသို့ သိမ်းမည်
            DB::table('users')->insert($usersData);

            $this->command->info("Processed " . ($i + $batchSize) . " / {$totalUsers} users...");
        }

        $this->command->info("User mock data seeding completed successfully!");
    }
}