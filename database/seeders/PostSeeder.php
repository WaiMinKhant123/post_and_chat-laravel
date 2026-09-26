<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $totalPosts = 10000; // လိုချင်သည့် Mock Data ပမာဏ (၁၀,၀၀၀)
        $batchSize = 500;   // တစ်ကြိမ်တည်းနဲ့ DB ထဲ Batch ထည့်မည့် ပမာဏ

        $this->command->info("Starting to seed {$totalPosts} posts and media...");

        for ($i = 0; $i < $totalPosts; $i += $batchSize) {
            DB::transaction(function () use ($faker, $batchSize) {
                $postsData = [];
                $mediaData = [];

                for ($j = 0; $j < $batchSize; $j++) {
                    $now = now();
                    
                    // 1. Post Data ဖွဲ့စည်းပုံ
                    $postId = DB::table('posts')->insertGetId([
                        'category_id' => rand(1, 5), // categories ID 1 မှ 5 အတွင်း (Happy, Sad, Angry, Love, Beautiful)
                        'title'       => $faker->sentence(3),
                        'body'        => $faker->paragraph(2),
                        'user_id'     => rand(1, 10) == 1 ? 17 : 3, // သင့် Database ထဲက User ID တွေအတိုင်း (3 သို့မဟုတ် 17)
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);

                    // 2. Media Data ဖွဲ့စည်းပုံ (Post တစ်ခုချင်းစီအတွက် ပုံ သို့မဟုတ် ဗီဒီယို ထည့်ရန်)
                    $mediaCount = rand(1, 2); // Post တစ်ခုမှာ ပုံ ၁ ခု သို့မဟုတ် ၂ ခု ပါဝင်မည်
                    for ($m = 0; $m < $mediaCount; $m++) {
                        $isVideo = (rand(1, 15) === 1); // တစ်ခါတလေ ဗီဒီယိုဖြစ်မည် (ရခိုင်နှုန်းနည်းနည်း)
                        
                        $mediaData[] = [
                            'file_path'  => $isVideo 
                                ? 'https://res.cloudinary.com/nuorpfl9/video/upload/v1790433241/videos/sample.mp4' 
                                : 'https://picsum.photos/seed/' . rand(1, 50000) . '/600/400', // Unsplash/Picsum ပုံအလန်းစားများ
                            'file_type'  => $isVideo ? 'video' : 'photo',
                            'post_id'    => $postId,
                            'user_id'    => 3,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }

                // Media များကို Bulk ဖြင့် တစ်ခါတည်း သိမ်းမည်
                if (!empty($mediaData)) {
                    DB::table('media')->insert($mediaData);
                }
            });

            $this->command->info("Processed " . ($i + $batchSize) . " / {$totalPosts} records...");
        }

        $this->command->info("Mock data seeding completed successfully!");
    }
}