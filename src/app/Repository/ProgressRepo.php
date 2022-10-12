<?php

namespace App\Repository;

use App\Models\Progress;

class ProgressRepo
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public static function progresses(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Progress::with('user')
            ->with('habit')
            ->where('status','=',1)
            ->get();
    }

    /**
     * @param int $habit_id
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public static function progress(int $habit_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return Progress::with('user')
            ->with('habit')
            ->where('status','=',1)
            ->where('habit_id',$habit_id)
            ->get();
    }

    /**
     * @param array $progress
     * @return mixed
     */
    public static function create(array $progress)
    {
        return Progress::create($progress);
    }

    /**
     * @param int $habit_id
     * @return mixed
     */
    public static function destroy(int $habit_id)
    {
        return Progress::where('habit_id',$habit_id)
            ->update([
                'status' => 0
            ]);
    }
}
