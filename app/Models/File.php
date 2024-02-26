<?php

namespace App\Models;

use App\Constant\FileType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    const IMAGE_DIR ='/storage/uploads/images/';
    const VIDEO_DIR ='storage/uploads/videos/';
    protected $fillable = [
        'name',
        'file_type',
        'user_id',
        'size'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fileLinks()
    {
        return $this->hasMany(FileSharedLink::class);
    }


    public function getFilePath($fileId, $fileType)
    {
        $file = File::findOrFail($fileId);
        $user = "USER_".$file->user_id;
        if($fileType == FileType::IMAGE){
            $path = self::IMAGE_DIR. $user . "/". $file->name;
        }else {
            $path = self::VIDEO_DIR. $user . "/". $file->name;
        }
        return $path;
    }

    public function getFileDeletePath($userId, $fileName, $fileType)
    {
        $user = "USER_".$userId;
        if($fileType == FileType::IMAGE){
            $path = "uploads/images/".$user."/".$fileName;
        }else {
            $path = "uploads/videos/".$user."/".$fileName;
        }
        return $path;
    }

    public function generateFileShareLink($file, $sharedCode, $key)
    {
        return env('APP_URL') . '/files/'.$file->id.'/sharer/'.$sharedCode.'/code?key='.$key;
    }
}
