<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use App\Models\Task;
use App\Models\Project;
class TimeEntryController extends Controller
{
    public function index()
    {
        $time_entries = TimeEntry::all();
        $tasks= Task::select('name','id')->where('status',Task::ACTIVE)->get();
        return view('time', compact('time_entries','tasks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'task'=> 'required',
            'date' => 'required|date',
            'hours' => 'required',
            'description' => 'required|max:250'
        ]);
        $TimeEntry = TimeEntry::create([
            'hours' => $request->hours,
            'entry_date' => $request->date,
            'description' => $request->description,
            'task_id' => $request->task
        ]);

        if ($TimeEntry) {
            return back()->with('success', 'TimeEntry added successfully');
        } else {
            return back()->with('error', 'TimeEntry added successfully');
        }
    }
    public function report(){
        return view('report');

    }

    public function search(Request $request)
    {   
        $projects = Project::where('status',Project::ACTIVE);
        if($searchTerm=$request->search){
            $projects->where('name','like','%'.$searchTerm.'%');
        }
        $projects=$projects->get();
        $data=array();
        foreach ($projects as $project) { 
            if($project->project_time>0){
                $data[$project->id]['name']=$project->name;
                $data[$project->id]['time']=$this->convertToHour($project->project_time);
                foreach($project->tasks as $task) {
                    if($task->task_time>0){
                        $data[$project->id]['tasks'][$task->id]['name']=$task->name;
                        $data[$project->id]['tasks'][$task->id]['time']=$this->convertToHour($task->task_time);
                    }
                }
            }
        }
        return response()->json($data);

    }
    public function convertToHour($seconds){
        
        return floor($seconds / 3600).':'.floor(($seconds % 3600) / 60);
    }
    public function view(Request $request){
        return view('layout');

    }
}
