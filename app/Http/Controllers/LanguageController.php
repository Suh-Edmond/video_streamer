<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($locale){
        if (! in_array($locale, ['en', 'fr'])) {
            abort(400);
        }
        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
