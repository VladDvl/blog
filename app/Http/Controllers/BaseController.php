<?php

namespace App\Http\Controllers;

use App\Maintext;

class BaseController extends Controller
{
	public function getIndex()
    {
        $objs = Maintext::orderBy('id','DESC')->limit(5)->get();
        return view('welcome',compact('objs'));
    }
}
