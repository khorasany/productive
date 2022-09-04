<?php

namespace App\Repository;

use App\Models\Habit;

class HabitRepo
{
    public static function habit(array $habit)
    {
        return Habit::create($habit);
    }
}
