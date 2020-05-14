<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriptions;

class SubscriptionController extends Controller
{
    public function tagSubscribe()
    {
        $user_id = $_POST["user_id"];
        $tag_id = $_POST["tag_id"];
        $author_id = null;
        $status = "PUBLISHED";
        //dd($_POST);

        $subscription = Subscriptions::where('user_id', $user_id)->where('status', 'PUBLISHED')->first();

        if( isset($subscription) ) {

            $arr_tags_id = explode(',', $subscription->tag_id);

            if( !in_array($tag_id, $arr_tags_id) ) {

                if( $subscription->tag_id == null ) {

                    $subscription->tag_id .= $tag_id;

                } else {

                    $subscription->tag_id .= ',' . $tag_id;

                }
                
                $subscription->save();

            } else {

                return redirect()->back();

            }

        } else {

            Subscriptions::insert([
                'user_id' => $user_id,
                'author_id' => null,
                'tag_id' => $tag_id,
                'status' => $status
            ]);

        }

        return redirect()->back();
    }

    public function userSubscribe()
    {
        $user_id = $_POST["user_id"];
        $tag_id = null;
        $author_id = $_POST["author_id"];
        $status = "PUBLISHED";
        //dd($_POST);

        $subscription = Subscriptions::where('user_id', $user_id)->where('status', 'PUBLISHED')->first();

        if( isset($subscription) ) {

            $arr_authors_id = explode(',', $subscription->author_id);

            if( !in_array($author_id, $arr_authors_id) ) {

                if( $subscription->author_id == null ) {

                    $subscription->author_id .= $author_id;

                } else {

                    $subscription->author_id .= ',' . $author_id;

                }
                
                $subscription->save();

            } else {

                return redirect()->back();

            }

        } else {

            Subscriptions::insert([
                'user_id' => $user_id,
                'author_id' => $author_id,
                'tag_id' => null,
                'status' => $status
            ]);

        }

        return redirect()->back();
    }
}
