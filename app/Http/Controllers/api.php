<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class api extends Controller
{
    public function getAll(){
        return DB::select("SELECT * FROM tasks");
    }
    public function add(){

    }
}
