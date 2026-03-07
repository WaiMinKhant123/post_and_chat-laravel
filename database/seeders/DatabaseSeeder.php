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
 Post::factory()->count(20)->create();
 Category::factory()->count(9)->create();
 Comment::factory()->count(40)->create();
 User::factory()->create([
    "name" => "Alice",
    "email" => "alice@gmail.com",
    ]);
    User::factory()->create([
    "name" => "Bob",
    "email" => "bob@gmail.com",
    ]);
}}