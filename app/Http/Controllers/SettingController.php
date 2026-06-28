<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = $request->user()->setting()->firstOrCreate([
            'user_id' => $request->user()->id,
        ]);

        return view('settings.index', compact('setting'));
    }
}
