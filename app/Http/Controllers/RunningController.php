<?php

namespace App\Http\Controllers;

use App\Models\RunningProgram;
use Illuminate\Http\Request;
use Whoops\Run;

class RunningController extends Controller
{
    public function index(){
        $title = 'Program Running';
        $active = 'running';
        $getRunning = RunningProgram::get();
        foreach ($getRunning as $key => $running) {
            $getRunning[$key]['description'] = json_decode($running->description);
        }
        
        return view('admin.program.running', compact('title', 'active', 'getRunning'));
    }
    public function update(Request $request){
        for ($i=1; $i <= 4; $i++) { 
            $tempDesc = [];
            foreach ($request->all() as $key => $value) {
                if(in_array($key, list_days($i))){
                    $tempDesc[] = $value;
                }
                
            }
            if(!empty($tempDesc)){
                $tempDesc = json_encode($tempDesc);
            }
            RunningProgram::updateOrCreate([
                'week' => $request->get('week'. $i),
            ],[
                'description' => $tempDesc 
            ]);
        }
        return redirect()->back()->with('success', 'Program Running updated successfully');
    }
}
