<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'habit_type',
        'habit_goal',
        'several_time',
        'time',
        'repeat_every_day',
        'selected_days',
        'repeat_daily',
        'daily_momentum',
        'end_of_habit',
        'type_end_of_habit',
        'end_date',
        'goal_amount',
        'reminder_time',
        'description',
        'elapsed_time_habituation',
        'status',
        'done_status',
    ];
}
