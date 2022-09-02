<?php

namespace App\Repository;

use App\Models\Habit;
use App\Models\User;

class AdminRepo
{
    public static function users()
    {
        return User::with('habit')->get();
    }

    public static function habits()
    {
        return Habit::where('user_id',null)->get();
    }
}
