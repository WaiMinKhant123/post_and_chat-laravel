<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
 /**
 * Seed the application's database.
 *
 * @return void
 */
 public function run()
 {
 $this->call([
            PostSeeder::class,
            UserSeeder::class,
        ]);
}}