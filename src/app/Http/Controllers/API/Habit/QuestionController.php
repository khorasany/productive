<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Repository\QuestionRepo;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(QuestionRepo::questions());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $question = $request->validate([
            'question' => 'required|string',
            'answer' => 'string',
            'answers' => 'required|array',
            'parent' => 'int',
            'show' => 'bool'
        ]);
        $question['answers'] = json_encode($question['answers'],JSON_UNESCAPED_UNICODE);
        return response()->json(QuestionRepo::create($question),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        return response()->json(QuestionRepo::question($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $question = $request->validate([
            'question' => 'string',
            'answer' => 'string',
            'answers' => 'array',
            'parent' => 'int',
        ]);
        return response()->json(QuestionRepo::update($question,$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        QuestionRepo::destroy($id);
        return response()->json([
            'message' => 'question has been deleted',
            'question id' => $id
        ]);
    }
}
