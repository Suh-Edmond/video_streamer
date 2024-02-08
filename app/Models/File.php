<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    const IMAGE_DIR ='/storage/uploads/images/';
    protected $fillable = [
        'name',
        'file_type',
        'user_id'
    ];


    public function getFilePath($fileId)
    {
        $file = File::findOrFail($fileId);
        $user = "USER_".$file->user_id;
        return self::IMAGE_DIR. $user . "/". $file->name;
    }

    public function getImageDeletePath($userId, $fileName)
    {
        $user = "USER_".$userId;
        return "uploads/images/".$user."/".$fileName;
    }
}
