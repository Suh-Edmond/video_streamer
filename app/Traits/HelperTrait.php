<?php

namespace App\Traits;

use App\Constant\FileType;
use App\Constant\UserRole;
use App\Models\File;
use App\Models\User;

trait HelperTrait {
    private static string $imgDir ='/storage/uploads/images/';
    private static string $videoDir ='storage/uploads/videos/';

    public static function getFilePath($fileId, $fileType)
    {
        $file = File::findOrFail($fileId);
        $user = "USER_".$file->user_id;
        if($fileType == FileType::IMAGE){
            $path = HelperTrait::$imgDir. $user . "/". $file->name;
        }else {
            $path = HelperTrait::$videoDir. $user . "/". $file->name;
        }
        return $path;
    }

    public static  function getImageDeletePath($userId, $fileName)
    {
        $user = "USER_".$userId;
        return "uploads/images/".$user."/".$fileName;
    }

    public static function getAdminInfo()
    {
        return User::where('role', UserRole::ADMIN)->first();
    }

    public static function generateFileShareLink($file, $sharedCode, $key)
    {
        return env('APP_URL') . '/files/'.$file->id.'/sharer/'.$sharedCode.'/code?key='.$key;
    }
}
