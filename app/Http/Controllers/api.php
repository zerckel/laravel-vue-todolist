<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class api extends Controller
{

    public function getAll()
    {
        return DB::select("SELECT * FROM tasks");
    }

    public function add($task)
    {
        return [
            DB::table('tasks')->insert(
                ['task' => $task, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            ),
            $id = DB::getPdo()->lastInsertId()
        ];
    }


    public function delete($id)
    {
        return DB::table('tasks')->where(['id' => $id])->delete();
    }

    public function getOne($id)
    {
        return DB::select("SELECT * FROM tasks WHERE id =" . $id);
    }

    public function update($id, $task)
    {
        return DB::table('tasks')->where(['id' => $id])->update(['task' => $task]);
    }

}
