<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $title = 'Setting Page';
        $active = 'setting';

        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.setting.index', compact('title', 'active', 'settings'));
    }

    public function update(Request $request){
        $validate = [
            'header' => 'image|mimes:jpeg,png,jpg|max:5120',
            'motivation' => 'image|mimes:jpeg,png,jpg|max:5120',
            'instagram' => '',
            'tiktok' => '',
            'whatsapp' => 'numeric',
            'strava' => '',
            'location' => '',
            'about-image' => 'image|mimes:jpeg,png,jpg|max:5120',
            'about-content' => '',
        ];
        $data = $this->validate($request, $validate);
        if ($request->hasFile('header')) {
            $imageSetting = Setting::where('key', 'header')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['header'] = $request->file('header')->store('uploads/header');
        }
        if ($request->hasFile('motivation')) {
            $imageSetting = Setting::where('key', 'motivation')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['motivation'] = $request->file('motivation')->store('uploads/motivation');
        }
        if ($request->hasFile('about-image')) {
            $imageSetting = Setting::where('key', 'about-image')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['about-image'] = $request->file('about-image')->store('uploads/about-image');
        }
        foreach ($data as $key => $val) {
            $getData = Setting::firstOrCreate([
                'key' => $key
            ], [
                'title' => ucfirst(trans($key))
            ]);

            $getData->value = $val;
            $getData->save();
        }
        return redirect()->back()->with('success', 'Setting updated successfully');
    }
}
