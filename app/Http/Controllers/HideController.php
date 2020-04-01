<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class HideController extends Controller
{
    public function hideComment()
    {
        //dd($_GET);
        $comment_id = $_GET['comment-id'];
        $type_of_action = $_GET['submit'];

        if( $type_of_action == 'hide-admin' ) {

            $query = Comments::where('id', $comment_id)->update(['status' => 'DRAFT']);
            
        } elseif( $type_of_action == 'hide' ) {

            $query = Comments::where('id', $comment_id)->update(['status' => 'PENDING']);

        }
        
        return redirect()->back();
    }
}
