<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Repository\QuestionRepo;
use Illuminate\Http\Request;

class UserSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(QuestionRepo::questions_for_users());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request,int $id,int $user)
    {
        $answer = $request->validate([
            'answer' => 'required|string'
        ]);
        $answers = json_decode(QuestionRepo::get_answers($id));
        if (!in_array($answer['answer'],$answers))
            return response()->json([
                'message' => 'answer is not valid',
                'answer' => [
                    $answer['answer']
                ]
            ],422);
        $answer['user_id'] = $user;
        $answer['question_id'] = $id;
        return response()->json(json_decode(QuestionRepo::set_answer($answer)),201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
//     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
