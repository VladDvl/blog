<?php

namespace App\Http\Controllers;
use App\Categories;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getIndex($slug = null)
    {
        $one = Categories::where('slug', $slug)->paginate(6);
        return view('category',compact('one'));
    }
}