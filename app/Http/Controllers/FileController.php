<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

use App\Actions\Web\FileActions;

class FileController extends Controller
{

    protected $fileActions;

    public function __construct(FileActions $fileActions)
    {
        $this->fileActions = $fileActions;
    }
    
    public function download(Request $request, File $file)
    {
        return $this->fileActions->download($request, $file);
    }

}
