<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGroupTranslation extends Model
{
    protected $table = 'article_group_translations';

    protected $fillable = ['name'];

}
