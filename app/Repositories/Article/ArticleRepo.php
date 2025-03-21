<?php
namespace App\Repositories\Article;

use App\Repositories\AbstractRepo;
use App\Repositories\User\UserRepo;
use App\Models\Article;

class ArticleRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $userRepo;
    protected $articleGroupRepo;
    protected $articleGroupLinkRepo;
    protected $withRelations = ['groups'];
    protected $translatableFields = ['title', 'content'];

    public function __construct()
    {

        $this->model = new Article();

        $this->userRepo = new UserRepo();

        $this->articleGroupRepo = new ArticleGroupRepo();
        $this->articleGroupLinkRepo = new ArticleGroupLinkRepo();

    }

    public function getAllByGroup($group_id, $filters = [], $paginate = 10)
    {

        // Get a group by ID
        $group = $this->articleGroupRepo->getById($group_id);

        // Retrieve article IDs for the group
        $articles = $group['Model']->articles()->paginate($paginate);

        // Retrieve articles by IDs
        $articles = $this->model->whereIn('id', $articles->pluck('article_id'));

        // Apply filters
        foreach ($filters as $key => $value) {
            $articles = $articles->where($key, $value);
        }

        // Get the paginated result
        $articles = $articles->get();

        return $this->mapItems($articles);
    }

    public function mapItem($item)
    {

        if (empty($item)) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'title' => $item->title,
            'slug' => $item->slug,
            'short_description' => $item->short_description,
            'summary' => $item->summary,
            'content' => $item->content,
            'author' => $this->userRepo->mapItem($item->author),
            'groups' => $this->articleGroupRepo->mapItems($item->groups),
            'published' => $item->published,
            'isTranslated' => $this->isTranslated($item),
            'contentLinks' => $this->prepareContentLinks($item->content),
            'Model' => $item
        ];

        return $res;
    }

    public function prepareContentLinks($content)
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