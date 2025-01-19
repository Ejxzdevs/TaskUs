<?php 
namespace App\Services;
use App\Models\User;

class UsersApi {
    public static function show()
    {
        return User::all();
    }
}
