<?php

namespace App\Http\Controllers;

use App\Constant\FileType;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    const IMAGE_DIR ='/uploads/images/';

    public function manageFiles(Request $request)
    {
        $user_id = $this->getUser()->id;
        $query = File::query()->where('user_id', $user_id);

        $sort = $request->query('sort');
        $filter = $request->query('filter');
        $layout = $request->query('layout');

        if(isset($sort)) {
            switch ($sort) {
                case 'DATE_ASC':
                    $query->orderBy('created_at');
                    break;
                case 'NAME':
                    $query->orderBy('name');
                    break;
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        }

        if (isset($filter)) {
            $query->where('file_type', $filter);
        }

        $files = $query->get();
        $data = [
            'items' => $files,
            'gridView' => strtolower($layout) === 'grid',
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
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $fileName = $request->file('image')->getClientOriginalName();
        $fileName = str_replace(' ', '', $fileName);

        $authUserId = auth()->user()->getAuthIdentifier();
        $user = "USER_".$authUserId;

        $request->file('image')->storeAs(self::IMAGE_DIR.$user, $fileName, 'public');

        $this->saveFile($fileName, $request);

        return redirect()->route('files');
    }

    public function deleteImage($id)
    {
        $file = File::findOrFail($id);
        $path = $file->getImageDeletePath($file->user_id, $file->name);
        Storage::delete($path);
        $file->delete();

        return $id;
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
