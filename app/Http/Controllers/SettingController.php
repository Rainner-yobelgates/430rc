<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $title = 'Setting';
        $active = 'setting';

        $settings = Setting::pluck('value', 'key')->toArray();
        $getCity = City::selectRaw("id, CONCAT(type, ' ', city) as name")
        ->pluck('name', 'id')
        ->toArray();
        return view('admin.setting.index', compact('title', 'active', 'settings', 'getCity'));
    }

    public function update(Request $request){
        $validate = [
            'header' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'motivation' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram' => '',
            'tiktok' => '',
            'whatsapp' => 'numeric',
            'strava' => '',
            'location' => '',
            'city' => '',
            'about-image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'about-content' => '',
            'running-video' => 'mimes:mp4,mov,avi,wmv|max:5120',
            'workout-video' => 'mimes:mp4,mov,avi,wmv|max:5120',
            'running-information' => '',
            'running-disclaimer' => '',
            'workout-information' => '',
            'workout-disclaimer' => '',
            'title-header' => '',
            'sub-title-header' => '',
            'text-header' => '',
        ];
        $data = $this->validate($request, $validate);
        if ($request->hasFile('header')) {
            $imageSetting = Setting::where('key', 'header')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['header'] = $request->file('header')->store('uploads/header', 'public');
        }
        if ($request->hasFile('motivation')) {
            $imageSetting = Setting::where('key', 'motivation')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['motivation'] = $request->file('motivation')->store('uploads/motivation', 'public');
        }
        if ($request->hasFile('about-image')) {
            $imageSetting = Setting::where('key', 'about-image')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['about-image'] = $request->file('about-image')->store('uploads/about-image', 'public');
        }
        if ($request->hasFile('running-video')) {
            $imageSetting = Setting::where('key', 'running-video')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['running-video'] = $request->file('running-video')->store('uploads/program', 'public');
        }
        if ($request->hasFile('workout-video')) {
            $imageSetting = Setting::where('key', 'workout-video')->first();
            if (isset($imageSetting->value)) {
                Storage::delete($imageSetting->value);
            }
            $data['workout-video'] = $request->file('workout-video')->store('uploads/program', 'public');
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
