<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    protected $table = 'article_translations';

    protected $fillable = ['title', 'short_description', 'content'];

}
