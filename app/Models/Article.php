<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model
{

    use softDeletes;
    use Translatable;

    public $translatedAttributes = ['title', 'summary', 'short_description', 'content'];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'short_description',
        'content',
        'published',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function groups()
    {
        return $this->hasManyThrough(ArticleGroup::class, ArticleGroupLink::class, 'article_id', 'id', 'id', 'article_group_id');
    }

    public function groupLinks()
    {
        return $this->hasMany(ArticleGroupLink::class, 'article_id', 'article_group_id');
    }

    public function scopeSearch($query, $s)
    {
        // Search in name and description, content
        if ( $s != '' ) {
            $query->where('title', 'like', '%'.$s.'%')
                ->orWhere('short_description', 'like', '%'.$s.'%')
                ->orWhere('content', 'like', '%'.$s.'%');
        }

        return $query;
    }

}
