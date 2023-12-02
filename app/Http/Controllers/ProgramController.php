<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RunningProgram;
use App\Models\WorkoutProgram;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
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
    public function indexWo(){
        $title = 'Program Workout';
        $active = 'workout';
        $getWorkout = WorkoutProgram::get();
        foreach ($getWorkout as $key => $workout) {
            $getWorkout[$key]['description'] = json_decode($workout->description);
        }
        
        return view('admin.program.workout', compact('title', 'active', 'getWorkout'));
    }
    public function updateWo(Request $request){
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
            WorkoutProgram::updateOrCreate([
                'week' => $request->get('week'. $i),
            ],[
                'description' => $tempDesc 
            ]);
        }
        return redirect()->back()->with('success', 'Program Workout updated successfully');
    }
}
