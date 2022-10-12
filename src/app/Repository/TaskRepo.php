<?php

namespace App\Repository;

use App\Models\Tasks;

class TaskRepo
{
    public static function tasks()
    {
        return Tasks::all();
    }

    public static function task($id)
    {
        return Tasks::find($id);
    }

    public static function tasks_show()
    {
        return Tasks::where('status',1)->get();
    }

    public static function task_show($id)
    {
        return Tasks::with('user')
            ->where('status','=',1)
            ->where('id','=',$id)
            ->get()[0];
    }

    public static function create(array $task)
    {
        return Tasks::create($task);
    }

    public static function destroy($id)
    {
        $task = Tasks::find($id);
        $task->status = 0;
        $task->save();
    }

    public static function update(array $task,$id)
    {
        return Tasks::where('id',$id)
            ->where('status',1)
            ->update($task);
    }
}
