<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'vega-io',
                'name' => 'VegaIO',
                'title' => 'Vega I/O',
                'description' => 'Root category!',
            ],
            [
                'slug' => 'blog',
                'name' => 'Blog',
                'title' => 'المدونة',
                'description' => 'Blog category',
            ],
            [
                'slug' => 'services',
                'name' => 'Services',
                'title' => 'الخدمات',
                'description' => 'Services category',
            ],
            [
                'slug' => 'general',
                'name' => 'General',
                'title' => 'عامة',
                'description' => 'This is a general category',
            ],
        ];

        // Category::factory()->createMany($categories);
        Category::upsert($categories, ['slug']);
    }
}
