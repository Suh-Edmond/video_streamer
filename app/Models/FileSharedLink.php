<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSharedLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'file_link',
        'expire_at',
        'shared_code'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
