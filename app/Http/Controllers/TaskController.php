<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks =  Task::all();
        return view('pages.task', ['tasks' => $tasks ]);
    }

    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:50',
            'task_priority_level' => 'required|string|max:50'
        ]);
        Task::create([
            'task_name' => $request->task_name ,
            'task_priority_level' => $request->task_priority_level
            ]
        );
        return redirect()->route('tasks.index');
        
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
