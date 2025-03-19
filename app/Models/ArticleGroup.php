<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleGroup extends Model
{
    
    protected $table = 'article_groups';
    protected $fillable = [
        'name', 
        'slug',
        'description',
        'is_active'
    ];

    public function articles()
    {
        return $this->hasMany(ArticleGroupLink::class, 'article_group_id', 'id');
    }

    public function getArticlesCountAttribute()
    {
        return $this->articles()->count();
    }
    
}
