<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'key' => 'home'
            ],

            [
                'key' => 'about'
            ],

        ];

        // Insert Pages
        Page::insert($pages);
    }
}
