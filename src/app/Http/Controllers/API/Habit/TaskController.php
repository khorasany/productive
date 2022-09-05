<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Repository\TaskRepo;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(TaskRepo::tasks_show());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $task = $request->validate([
            'user_id' => 'required|int',
            'name' => 'required|string',
            'icon' => 'string',
            'color' => 'string',
            'date' => 'string',
            'reminder_time' => 'string'
        ]);
        return response()->json(TaskRepo::create($task), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(TaskRepo::task_show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $task = $request->validate([
            'name' => 'string',
            'icon' => 'string',
            'color' => 'string',
            'date' => 'string',
            'reminder_time' => 'string'
        ]);
        return response()->json(TaskRepo::update($task,$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        TaskRepo::destroy($id);
        return response()->json([
            'message' => 'task has been deleted',
            'task id' => $id
        ]);
    }
}
