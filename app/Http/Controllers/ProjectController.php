<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project', compact('projects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'status' => 'required|in:1,2'
        ]);
        $project = Project::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        if ($project) {
            return back()->with('success', 'Project added successfully');
        } else {
            return back()->with('error', 'Project added successfully');
        }
    }
}
