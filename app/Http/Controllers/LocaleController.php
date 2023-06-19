<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LocaleController extends Controller
{
    public function switchLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locale' => 'required|in:lv,en',
        ]);
		
        if ($validator->fails()) {
            return redirect()->back();
        }
		
        $locale = $request->input('locale');
		
        session()->put('locale', $locale);
		
        App::setLocale($locale);
		
        return redirect()->back();
    }
}