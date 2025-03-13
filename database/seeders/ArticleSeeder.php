<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Retrieve the countries from the JSON file
        $articles = json_decode(file_get_contents(database_path('references/articles.json')), true);

        foreach ($articles as $article) {
            
            // Get content from html file
            $path = database_path('references/articles/' . $article['slug'] . '.html'); 
            $content = file_get_contents($path);
            
            // Create the article
            Article::updateOrCreate(
                ['slug' => $article['slug']],
                [
                    'title' => $article['title'],
                    'slug' => $article['slug'],
                    'summary' => $article['summary'],
                    'short_description' => $article['short_description'],
                    'content' => $content,
                    'published' => $article['published'],
                    'author_id' => $article['author_id'],
                ]
            );

        }

    }
}
