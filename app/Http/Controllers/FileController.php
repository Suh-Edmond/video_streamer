<?php

namespace App\Http\Controllers;

use App\Constant\FileType;
use App\Models\File;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Iman\Streamer\VideoStreamer;

class FileController extends Controller
{
    const IMAGE_DIR ='/uploads/images/';
    const VIDEO_DIR ='/uploads/videos/';

    use HelperTrait;


    public function manageFiles(Request $request)
    {
        $user_id = $this->getUser()->id;
        $query = File::query()->where('user_id', $user_id);

        $sort = $request->query('sort');
        $filter = $request->query('filter');
        $layout = $request->query('layout');
        $layout ??= 'grid';

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

        $files = $query->paginate(10);
        $data = [
            'items' => $files,
            'gridView' => strtolower($layout) == 'grid',
            'filter' => true,
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
        $size = $request->file('image')->getSize();
        $fileName = str_replace(' ', '', $fileName);

        $authUserId = auth()->user()->getAuthIdentifier();
        $user = "USER_".$authUserId;

        $request->file('image')->storeAs(self::IMAGE_DIR.$user, $fileName, 'public');

        $this->saveFile($fileName, $request, $size, FileType::IMAGE);

        $data['gridView'] = true;

        return redirect()->route('files')->with($data);
    }

    public function uploadVideo(Request $request)
    {
        //video/avi, video/mpeg, video/quicktime,mimetypes
        $request->validate([
            'video' => 'required|max:50240'
        ]);

        $fileName = $request->file('video')->getClientOriginalName();
        $size = $request->file('video')->getSize();

        $authUserId = auth()->user()->getAuthIdentifier();
        $user = "USER_".$authUserId;

        $request->file('video')->storeAs(self::VIDEO_DIR.$user, $fileName, 'public');

        $this->saveFile($fileName, $request, $size, FileType::VIDEO);

        $data['gridView'] = true;
        return redirect()->back()->with($data);
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id);

        $path = $file->getFileDeletePath($file->user_id, $file->name, $file->file_type);
        Storage::delete($path);
        $file->delete();

    }

    private function saveFile($fileName, Request $request, $size, $fileType)
    {
        $saveFile = new File();
        $saveFile->name = $fileName;
        $saveFile->file_type = $fileType;
        $saveFile->user_id = $request->user()->id;
        $saveFile->size = $size;

        $saveFile->save();
    }

    public function getVideoFilePath($id)
    {
        $file = File::findOrFail($id);
        $path = HelperTrait::getFilePath($file->id, $file->file_type);

        return response()->json(['data' => $path]);
    }

    public function getFile($id) {
        $file = File::findOrFail(1);

        return view('file')->with(['data'=>$file]);
    }

    public function setStreamVideo(Request $request)
    {
        $filePath = decrypt($request['file']);
        $data['path'] = $filePath;
        $data['title'] = "Streaming Video ".$this->getFileNameFromPath($filePath);

        return view('stream.index')->with($data);
    }

    public function getStreamVideo(Request $request)
    {
        VideoStreamer::streamFile($request['path']);
    }

    public function viewSharedImage(Request $request, $name)
    {
        $filePath = decrypt($request['file']);
        $data['path']  = $filePath;
        $data['title']  = $name;

        return view('stream.index-image')->with($data);
    }

    private function getFileNameFromPath($path)
    {
        $exploded = (explode('/', $path));
        $length = count($exploded);
        $index = $length - 1;
        return $exploded[$index];
    }
}
