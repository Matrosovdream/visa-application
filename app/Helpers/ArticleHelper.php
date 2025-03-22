<?php
namespace App\Helpers;

class ArticleHelper {

    public function extractArticleCursors($content)
    {
        $links = [];

        // Load HTML content
        libxml_use_internal_errors(true); // Suppress HTML5 parsing warnings
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

        // Find all h2 tags with id
        $h2Tags = $dom->getElementsByTagName('h2');

        foreach ($h2Tags as $h2) {
            $id = $h2->getAttribute('id');
            $text = trim($h2->textContent);

            if ($id && $text) {
                $links[] = [
                    'link' => '#' . $id,
                    'text' => $text,
                ];
            }
        }

        return $links;
    }

}