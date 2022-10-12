<?php

namespace App\Repository;

use App\Models\Habit;

class HabitRepo
{
    public static function create(array $habit)
    {
        return Habit::create($habit);
    }

    public static function habits()
    {
        return Habit::with('user')
            ->where('status','=',1)
            ->get();
    }

    public static function habit($id)
    {
        return Habit::with('user')
            ->where('status','=',1)
            ->where('id','=',$id)
            ->get()[0];
    }

    public static function destroy($id)
    {
        return Habit::where('id',$id)
            ->update(['status' => 0]);
    }

    public static function update(array $habit,$id)
    {
        return Habit::where('id',$id)
            ->update($habit);
    }

    public static function check(int $id,int $user_id)
    {
        $habit = Habit::where('id',$id)
            ->where('user_id',$user_id)
            ->where('status',1)
            ->get()[0];
        if (!empty($habit)) {

        }
        return false;
    }

    /**
     * @param array $habit
     * @return array|\Illuminate\Http\JsonResponse
     */
    public static function habit_validation(array $habit)
    {
        if (!empty($habit['habit_type']) && !in_array($habit['habit_type'], config('global.habit_type')))
            return response()->json([
                'message' => 'habit type requested is not type of defined',
                'errors' => [
                    'habit_type' => [
                        $habit['habit_type']
                    ]
                ]
            ], 422);
        if (!empty($habit['daily']) && !empty($habit['weekly']) && !empty($habit['monthly']))
        if ($habit['habit_goal'] === true)
            if (empty($habit['several_times']) && empty($habit['time']))
                return response()->json([
                    'message' => 'several_times or time must have some values',
                    'errors' => [
                        'several_times' => [
                            null
                        ],
                        'time' => [
                            null
                        ]
                    ]
                ], 422);
        if ($habit['repeat_daily'] === true)
            $habit['daily_momentum'] = null;
        elseif ($habit['repeat_daily'] === false && !in_array($habit['daily_momentum'], config('global.daily_momentum')))
            return response()->json([
                'message' => 'daily momentum requested is not type of defined',
                'errors' => [
                    'daily_momentum' => [
                        $habit['daily_momentum']
                    ]
                ]
            ], 422);

        $habit['selected_days'] = !empty($habit['selected_days']) ? json_encode($habit['selected_days'], JSON_UNESCAPED_UNICODE) : null;
        if ($habit['end_of_habit'] === true && !in_array($habit['type_end_of_habit'], config('global.type_end_of_habit')))
            return response()->json([
                'message' => 'type end of habit is not type of defined',
                'errors' => [
                    'type_end_of_habit' => [
                        $habit['type_end_of_habit']
                    ]
                ]
            ], 422);

        if ($habit['end_of_habit'] === true) {
            $habit['goal_amount'] = !empty($habit['end_date']) ? null : $habit['goal_amount'];
            $habit['end_date'] = !empty($habit['goal_amount']) ? null : $habit['end_date'];
            if (!empty($habit['goal_amount']) && !empty($habit['end_date']))
                return response()->json([
                    'message' => 'one of these fields must have a value : goal amount | end date',
                    'errors' => [
                        'goal_amount' => [
                            $habit['goal_amount']
                        ],
                        'end_date' => [
                            $habit['end_date']
                        ]
                    ]
                ], 422);
        }
        if ($habit['reminder'] === true && empty($habit['reminder_time'])) {
            return response()->json([
                'message' => 'reminder time cannot be empty',
                'errors' => [
                    'reminder_time' => [
                        $habit['reminder_time']
                    ]
                ]
            ], 422);
        }
        return $habit;
    }
}
