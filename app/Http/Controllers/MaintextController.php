<?php

namespace App\Http\Controllers;

use App\Maintext;

class MaintextController extends Controller
{
    public function getIndex($url = null)
    {
        $one = Maintext::where('url',$url)->first();
        return view('maintext',compact('one'));
    }
}
