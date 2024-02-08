<?php

namespace App\Traits;

use App\Models\File;

trait HelperTrait {
    private static string $imgDir ='/storage/uploads/images/';
    public static function getFilePath($fileId)
    {
        $file = File::findOrFail($fileId);
        $user = "USER_".$file->user_id;
        return HelperTrait::$imgDir. $user . "/". $file->name;
    }

    public static  function getImageDeletePath($userId, $fileName)
    {
        $user = "USER_".$userId;
        return "uploads/images/".$user."/".$fileName;
    }
}
