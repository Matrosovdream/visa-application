<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleGroupLink extends Model
{
    
    protected $table = 'article_group_article';
    protected $fillable = ['article_id', 'article_group_id'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(ArticleGroup::class, 'article_group_id', 'id');
    }

}
