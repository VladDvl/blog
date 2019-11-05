<?php

namespace App\Providers\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Categories;

class BaseComposer
{
    public function compose(View $view)
    {
        $test = Categories::orderBy('id')->limit(12)->get();
        $view->with('test',$test);
    }
}