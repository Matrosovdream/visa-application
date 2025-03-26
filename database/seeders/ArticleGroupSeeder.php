<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArticleGroup;

class ArticleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $orderStatuses = [
            ['name' => 'USA', 'slug' => 'usa',  'is_active' => 1],
            ['name' => 'Australia', 'slug' => 'australia', 'is_active' => 1],
            ['name' => 'India', 'slug' => 'india', 'is_active' => 1],
            ['name' => 'Sweden', 'slug' => 'sweden', 'is_active' => 1],
        ];
        
        foreach ($orderStatuses as $orderStatus) {
            ArticleGroup::updateOrCreate(
                ['slug' => $orderStatus['slug']], 
                $orderStatus
            );
        }

    }
}
