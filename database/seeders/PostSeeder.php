<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $totalPosts = 10000; 
        $batchSize = 500;   

        $this->command->info("Starting to seed {$totalPosts} posts and media...");

        // ဇယားဟောင်းရှိခဲ့ရင် Data ရှင်းရန် (သို့မဟုတ် migrate:fresh သုံးနေရင် ပြီးသားဖြစ်ပါတယ်)
        // DB::table('media')->delete();
        // DB::table('posts')->delete();

        for ($i = 0; $i < $totalPosts; $i += $batchSize) {
            $postsData = [];
            $now = now();

            // 1. Posts များကို Batch တည်ဆောက်ခြင်း
            for ($j = 0; $j < $batchSize; $j++) {
                $postsData[] = [
                    'category_id' => rand(1, 5),
                    'title'       => $faker->sentence(3),
                    'body'        => $faker->paragraph(2),
                    'user_id'     => rand(1, 10) == 1 ? 17 : 3,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }

            // Posts များကို Bulk Insert လုပ်ပြီး ထွက်လာမည့် IDs များကို ရယူရန်
            // PostgreSQL မှာ returning id ကို သုံးနိုင်ပါသည်
            $insertedPostIds = [];
            
            // Chunk လိုက် ထည့်ပြီး ID များကို Database ထეကနေ ပြန်ဆွဲထုတ်ခြင်း
            foreach ($postsData as $post) {
                $postId = DB::table('posts')->insertGetId($post);
                
                // 2. Media Data များ ချက်ချင်း ချိတ်ဆက်ရန်
                $mediaCount = rand(1, 2);
                $mediaData = [];
                for ($m = 0; $m < $mediaCount; $m++) {
                    $isVideo = (rand(1, 15) === 1);
                    
                    $mediaData[] = [
                        'file_path'  => $isVideo 
                            ? 'https://res.cloudinary.com/nuorpfl9/video/upload/v1790433241/videos/sample.mp4' 
                            : 'https://picsum.photos/seed/' . rand(1, 50000) . '/600/400',
                        'file_type'  => $isVideo ? 'video' : 'photo',
                        'post_id'    => $postId,
                        'user_id'    => 3,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                
                // Media ကို Bulk Insert လုပ်မည်
                if (!empty($mediaData)) {
                    DB::table('media')->insert($mediaData);
                }
            }

            $currentProcessed = min($i + $batchSize, $totalPosts);
            $this->command->info("Processed {$currentProcessed} / {$totalPosts} records...");
        }

        $this->command->info("Mock data seeding completed successfully!");
    }
}