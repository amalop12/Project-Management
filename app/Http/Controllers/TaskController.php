<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status',Task::ACTIVE)->get();
        $projects= Project::select('name','id')->where('status',Project::ACTIVE)->get();
        return view('task', compact('tasks','projects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'status' => 'required|in:1,2',
            'project'=>'required'
        ]);
        $Task = Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'project_id' => $request->project
        ]);

        if ($Task) {
            return back()->with('success', 'Task added successfully');
        } else {
            return back()->with('error', 'Task added successfully');
        }
    }}
