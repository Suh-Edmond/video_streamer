<?php

namespace App\Http\Controllers;

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
         $path = env('APP_URL') . HelperTrait::getFilePath($file->id, $file->file_type);

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
}
