<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable = ['user_id','task_id'];
    public function task() {
        return $this->belongsTo(Task::class);  // Assuming 'Assign' belongs to 'Task'
    }

    public function user() {
        return $this->belongsTo(User::class);  // Assuming Assign belongs to User
    }
}
