<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher extends Controller
{
    // Switch to Arabaic
    public function switch($lang) {
        if(!in_array($lang, ['en', 'ar'])) {
            App::setLocale('en');
        }
        App::setLocale($lang);
        return redirect()->back();
    }
}