<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        /*$cat1 = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $cat2 = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        $user1 = User::create([
            'username' => 'jonaspauleta',
            'name' => 'João Santos',
            'email' => 'jonaspauleta2@gmail.com',
            'password' => 'password*'
        ]);

        $user2 = User::create([
            'username' => 'suzete',
            'name' => 'Suzete Santos',
            'email' => 'suzete.santos@gmail.com',
            'password' => 'password*'
        ]);

        $user3 = User::create([
            'username' => 'paulo',
            'name' => 'Paulo Santos',
            'email' => 'paulo.ines.santos@gmail.com',
            'password' => 'password*'
        ]);

        $post1 = Post::create([
            'user_id' => $user1->id,
            'category_id' => $cat1->id,
            'slug' => '',
            'title' => '',
            'excerpt' => '',
            'body' => '',
        ]);*/

        Post::factory(6)->create();
    }
}
