<?php

namespace App\Http\Controllers;

use App\Constant\FileType;
use App\Models\File;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    use HelperTrait;
    public function generateQRCode(Request $request, $id)
    {
         $file = File::findOrFail($id);
         $path = $file->file_type == FileType::IMAGE ? env('APP_URL') . HelperTrait::getFilePath($file->id, $file->file_type): $this->getVideoPath($file);

        return QrCode::size(300)
            ->generate($path);
    }

    public function generateShareLink($id)
    {
        $file = File::findOrFail($id);
        $path = HelperTrait::getFilePath($file->id, $file->file_type);
        $encryptedPath = encrypt($path);
        $link = env('APP_URL') . '/files/'.$id.'/share/code?key='.$encryptedPath;

        return response()->json(['data' => $link]);

    }

    private function getVideoPath($file)
    {
        $encryptedFilePath = encrypt(HelperTrait::getFilePath($file->id, $file->file_type));

        return env('APP_URL'). '/files/videos/set_stream?file='.$encryptedFilePath;
    }
}
