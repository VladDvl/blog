<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Post;

class ModalController extends Controller
{
    public function postIndex()
    {
        $id = (int) $_POST['id'];  //int для безопасности, можно передать любые данные без этого
        //можго проверять строки регуляркой
        //любо создать массив с разрещенными значениями и проверять на совпадения

        $obj = Post::find($id);
        return view('ajax.modal', compact('obj'));
    }
}
