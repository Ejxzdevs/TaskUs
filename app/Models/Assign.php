<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable = ['user_id','task_id'];
    public function task() {
        return $this->belongsTo(Task::class);  
    }

    public function user() {
        return $this->belongsTo(User::class); 
    }
}
