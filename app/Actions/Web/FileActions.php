<?php
namespace App\Actions\Web;

use Illuminate\Support\Facades\Storage;

class FileActions
{
    
    public function download( $request, $file ) {

        if( !auth()->check() ) {
            abort(404);
        }
        
        // Check if user_id if the auth user or admin user
        if( 
            $file->user_id == auth()->user()->id || 
            auth()->user()->isAdmin() ||
            auth()->user()->isManager()
            ) {
            return Storage::download( $file->path );
        }

    }

}