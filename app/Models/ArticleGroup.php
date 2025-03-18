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
    
}
