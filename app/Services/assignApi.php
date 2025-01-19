<?php 
namespace App\Services;
use App\Models\Assign;
class AssignApi 
{
    public static function viewAssignTask($id){

        return $data = Assign::with('task', 'user')
                    ->whereHas('task', function ($query) {
                    $query->where('id', 2);  
        })
        ->get();
    }

}