<?php 
namespace App\Services;

use Illuminate\Support\Facades\DB;

class AssignApi 
{
    public static function viewCompletedTask() {
        return DB::table('tasks')
            ->leftJoin('assigns', 'assigns.task_id', '=', 'tasks.id')
            ->leftJoin('users', 'assigns.user_id', '=', 'users.id')
            ->select('tasks.id as task_id', 'tasks.*', 'assigns.*', 'users.*') 
            ->get();
    }
}
