<?php

namespace App\Http\Controllers;

use App\Constant\FileType;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    const IMAGE_DIR ='/images/';

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


    public function uploadFile(Request $request)
    {

        $request->validate([
            'image' => 'required|image'
        ]);

        $fileName = $request->file('image')->getClientOriginalName();

        Storage::disk('local')->put(self::IMAGE_DIR.$fileName, $request->file('image'));

        $this->saveFile($fileName, $request);

        return redirect()->route('files');
    }

    public function deleteImage($id)
    {
        $file = File::findOrFail($id);
        $path = Storage::path($file->name);
        Storage::delete($path);
        $file->delete();

        return back();
    }

    private function saveFile($fileName, Request $request)
    {
        $saveFile = new File();
        $saveFile->name = $fileName;
        $saveFile->file_type = FileType::IMAGE;
        $saveFile->user_id = $request->user()->id;

        $saveFile->save();
    }
}
