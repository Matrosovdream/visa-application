<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $table = 'files';

    protected $fillable = [
        'filename',
        'path',
        'type',
        'size',
        'extension',
        'description',
        'disk',
        'visibility'
    ];

    

}
