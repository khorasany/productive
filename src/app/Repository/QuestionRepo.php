<?php

namespace App\Repository;

use App\Models\Question;

class QuestionRepo
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function questions()
    {
        return Question::with('setup')
            ->where('show','=',1)
            ->get();
    }

    /**
     * @param array $question
     * @return mixed
     */
    public static function create(array $question)
    {
        return Question::create($question);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function question($id)
    {
        return Question::with('setup')
            ->where('id','=',$id)
            ->where('show','=',1)
            ->get();
    }

    /**
     * @param array $question
     * @param $id
     * @return mixed
     */
    public static function update(array $question, $id)
    {
        return Question::where('id',$id)
            ->update($question);
    }

    /**
     * @param $id
     * @return void
     */
    public static function destroy($id)
    {
        Question::where('id',$id)
            ->update(['show' => 0]);
    }
}
