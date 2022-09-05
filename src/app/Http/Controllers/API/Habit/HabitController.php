<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Repository\HabitRepo;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $habit = $request->validate([
            'user_id' => 'required',
            'name' => 'required|string',
            'icon' => 'string',
            'habit_type' => 'required|string',
            'habit_goal' => 'required|bool',
            'several_times' => 'int',
            'time' => 'string',
            'repeat_every_day' => 'required|bool',
            'selected_days' => 'array',
            'repeat_daily' => 'required|bool',
            'daily_momentum' => 'array',
            'end_of_habit' => 'required|bool',
            'type_end_of_habit' => 'string',
            'end_date' => 'string',
            'goal_amount' => 'int',
            'reminder' => 'required|bool',
            'reminder_time' => 'string',
            'description' => 'string',
        ]);
        if (!empty($habit['habit_type']) && !in_array($habit['habit_type'], config('global.habit_type')))
            return response()->json([
                'message' => 'habit type requested is not type of defined',
                'errors' => [
                    'habit_type' => [
                        $habit['habit_type']
                    ]
                ]
            ], 422);
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
        $habit = HabitRepo::habit($habit);
        return response()->json($habit);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
