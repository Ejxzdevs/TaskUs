<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')
        ->leftJoin('assigns', 'assigns.task_id', '=', 'tasks.id')
        ->leftJoin('users', 'assigns.user_id', '=', 'users.id')
        ->select('tasks.id as t_id', 'tasks.*', 'assigns.*', 'users.*')  // Select everything with tasks.id renamed
        ->get();
        return view('pages.task', ['tasks' => $tasks ]);
    }

    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:50',
            'task_priority_level' => 'required|string|max:50',
            'task_description' => 'string'
        ]);
        Task::create([
            'task_name' => $request->task_name,
            'task_priority_level' => $request->task_priority_level,
            'task_description' => $request->task_description
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
        DB::table('assigns')
        ->where('task_id', $id)
        ->update([
            'user_id' => $request->has('user_id') && $request->user_id ? $request->user_id : DB::raw('user_id')
        ]);

        $validated = $request->validate([
            'task_name' => 'nullable|string|max:255',
            'task_description' => 'nullable|string',
            'task_priority_level' => 'nullable|string|in:Low Priority,Medium Priority,High Priority',
            'task_status' => 'nullable|string|in:Todo,In Progress,Completed,Approved,Revise',
        ]);
    
        $task = Task::findOrFail($id);
    
        // Update fields only if a new value is passed, otherwise retain the existing value
        if($request->has('task_name')) {
            $task->task_name = $validated['task_name'];
        }
        
        if($request->has('task_description')) {
            $task->task_description = $validated['task_description'];
        }
        
        if ($request->has('task_priority_level')) {
            $task->task_priority_level = $validated['task_priority_level'];
        }
        
        if ($request->has('task_status')) {
            $task->task_status = $validated['task_status'];
            
            if ($validated['task_status'] === 'In Progress' && !$task->task_started_at) {
                $task->task_started_at = now();
            }
    
            if ($validated['task_status'] === 'Completed' && !$task->task_ended_at) {
                $task->task_ended_at = now();
            }
        }
    
        // Save the updated task
        $task->save();
        
        if($task->task_status === 'Approved' || $task->task_status === 'Revise'){
            return redirect()->route('review')->with('success', 'Task updated successfully.');
        }else{
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        }
    }
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
