<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileSharedLink;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileSharedLinkController extends Controller
{
    public function createFileSharedLink(Request $request, $fileId)
    {
        $file = File::findOrFail($fileId);
        $sharedCode = Str::random(10);
        $key = substr(encrypt($file->id),0, 30);
        $link = env('APP_URL') . '/files/'.$file->id.'/sharer/'.$sharedCode.'/code?key='.$key;
        FileSharedLink::create([
            'file_id'   => $file->id,
            'expire_at' => $request['expire_at'],
            'file_link'  => $link,
            'shared_code' => $sharedCode,
        ]);

        return response()->json(['data' => $link]);
    }
    public function getFileSharedLinks(Request $request, $fileId)
    {
        $file = File::findOrFail($fileId);
        $query = FileSharedLink::where('file_id', $fileId);
        $sort = $request->query('sort');
        if(isset($sort)) {
            switch ($sort) {
                case 'EXPIRED':
                    $query->where('expire_at','<', Carbon::now());
                    break;
                case 'NOT_EXPIRED':
                    $query->where('expire_at','>', Carbon::now());
                    break;
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        }
        $links = $query->paginate(10);
        $data['file'] = $file;
        $data['links'] =$links;
        $data['filter'] = true;
        $data['admin']   = HelperTrait::getAdminInfo();
        $data['title'] = 'Sharable Links for '.$data['file']->name;

        return view('dashboard.file-links')->with('data', $data);
    }

    public function updateFileLink(Request $request, FileSharedLink $fileSharedLink)
    {
        $fileSharedLink->update([
            'expire_at' => $request->expire_at
        ]);
        $notification = array(
            'message' => 'File Shared link updated successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function deleteFileLink(FileSharedLink $fileSharedLink)
    {
        try {
            $fileSharedLink->delete();
            $notification = array(
                'message' => 'File Shared link deleted successfully',
                'alert-type' => 'success'
            );
        }catch (\Exception $exception){
            $notification = array(
                'message' => 'An error occurred!Could not delete file sharable link',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }
}


