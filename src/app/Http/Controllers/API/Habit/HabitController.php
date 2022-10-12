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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(HabitRepo::habits());
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
            'habit_goal' => 'required|bool',
            'several_times' => 'int',
            'time' => 'string',
            'habit_type' => 'required|string',
            'daily' => '',
            'daily_repeat' => '',
            'weekly' => '',
            'monthly' => '',
            'time_of_month' => '',
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
        $habit = HabitRepo::habit_validation($habit);
        $habit = HabitRepo::create($habit);
        return response()->json($habit);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(HabitRepo::habit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $habit = $request->validate([
            'name' => 'required|string',
            'icon' => 'string',
            'habit_goal' => 'required|bool',
            'several_times' => 'int',
            'time' => 'string',
            'habit_type' => 'required|string',
            'daily' => '',
            'daily_repeat' => '',
            'weekly' => '',
            'monthly' => '',
            'time_of_month' => '',
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
        $habit = HabitRepo::habit_validation($habit);
        return response()->json(HabitRepo::update($habit, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(HabitRepo::destroy($id));
    }

    /**
     * @param int $id
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(int $id, int $user_id): \Illuminate\Http\JsonResponse
    {
        return response()->json();
    }
}
