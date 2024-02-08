<?php

namespace App\Http\Controllers;

use App\Models\File;

class FileController extends Controller
{
    public function manageFiles()
    {

        $user_id = $this->getUser()->id;
        $files = File::all();

        $data = [
            'items' => $files,
            'gridView' => true,
            'filter' => true
        ];

        return view('dashboard/files')->with('data',$data);
    }

    private function getUser() {
        if(auth()->check()) {
            return auth()->user();
        }
    }
}
