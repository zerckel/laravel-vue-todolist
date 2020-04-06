<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class api extends Controller
{
    public function getAll(){
        return DB::table('tasks')->get();
    }
}
