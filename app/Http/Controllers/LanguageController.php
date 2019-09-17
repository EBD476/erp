<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * @param $lan
     * @return mixed
     */
    public function  locale($lan){
        if (Session::has('locale')){
            App::setLocale($lan);
            Session::put('locale', $lan);
        } else{
            Session::put('locale','fa');
            App::SetLocale('fa');
        }

        return redirect()->back();
    }
}
