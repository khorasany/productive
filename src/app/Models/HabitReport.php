<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitReport extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'habit_id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function habit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Habit::class, 'habit_id', 'id');
    }
}
