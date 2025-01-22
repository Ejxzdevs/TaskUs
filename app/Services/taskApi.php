<?php 
namespace App\Services;
use App\Models\Task;

class TaskApi {
    public static function show()
    {
        return Task::all();
    }
}
