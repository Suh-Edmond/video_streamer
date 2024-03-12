<?php

namespace App\Http\Controllers;

use App\Constant\FileType;
use App\Models\File;
use App\Models\FileSharedLink;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'admin'   => HelperTrait::getAdminInfo()
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
        $data['gridView'] = true;
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5120'
            ]);

            $fileName = $request->file('image')->getClientOriginalName();
            $size = $request->file('image')->getSize();
            $fileName = str_replace(' ', '', $fileName);

            $authUserId = auth()->user()->getAuthIdentifier();
            $user = "USER_".$authUserId;

            $request->file('image')->storeAs(self::IMAGE_DIR.$user, $fileName, 'public');

            $this->saveFile($fileName, $request, $size, FileType::IMAGE);

            $notification = array(
                'message' => __('messages.uploadImageSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => __('messages.uploadImageFailMsg'),
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($data)->with($notification);
    }

    public function uploadVideo(Request $request)
    {
        //video/avi, video/mpeg, video/quicktime,mimetypes
        $data['gridView'] = true;
        try {
            $request->validate([
                'video' => 'required'
            ]);

            $fileName = $request->file('video')->getClientOriginalName();
            $size = $request->file('video')->getSize();

            $authUserId = auth()->user()->getAuthIdentifier();
            $user = "USER_".$authUserId;

            $request->file('video')->storeAs(self::VIDEO_DIR.$user, $fileName, 'public');

            $this->saveFile($fileName, $request, $size, FileType::VIDEO);

            $notification = array(
                'message' => __('messages.uploadVideoSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => __('messages.uploadVideoFailMsg'),
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($data)->with($notification);
    }

    public function deleteFile(File $file)
    {
        try {
            $path = $file->getFileDeletePath($file->user_id, $file->name, $file->file_type);
            Storage::delete($path);
            $file->delete();

            $notification = array(
                'message' => __('messages.deleteFileSuccessMsg'),
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => __('message.deleteFileFailMsg'),
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
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

    public function setStreamVideo($id, $sharedCode)
    {
        $data['hasExpired'] = false;
        $data['notAvailable'] = false;
        $sharedLink = FileSharedLink::where('shared_code', $sharedCode)->first();
        $file = File::find($id);
        if(!isset($sharedLink)){
            $data['notAvailable'] = true;
        }
        if(isset($sharedLink) && Carbon::now()->greaterThan($sharedLink->expire_at)){
            $data['hasExpired'] = true;
        }
        if(!isset($file)){
            $data['notAvailable'] = true;
        }else {
            $data['file'] = $file;
            $data['title'] = $file->file_type == FileType::VIDEO? __('messages.streaming').$file->name: $file->name;
        }

        return view('stream.index')->with($data);
    }

    /**
     * @param Request $request
     * @throws \Exception
     * This end is used by an upload to play his/her uploaded video
     */
    public function playVideo(Request $request)
    {
        $file = File::findOrFail($request['path']);
        $path = HelperTrait::getFilePath($file->id, $file->file_type);
        VideoStreamer::streamFile($path);
    }


    public function getStreamVideo(Request $request)
    {
       if(!$request['hasExpired'] || !$request['notAvailable']){
           $file = File::find($request['fileId']);
           $path = HelperTrait::getFilePath($file->id, $file->file_type);
           VideoStreamer::streamFile($path);
       }
        $notification = array(
            'message' => __('messages.resourceHasBeenRemovedMsg'),
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }


}
