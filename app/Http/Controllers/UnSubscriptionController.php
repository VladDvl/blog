<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriptions;

class UnSubscriptionController extends Controller
{
    public function tagUnSubscribe()
    {
        $user_id = $_POST["user_id"];
        $tag_id = $_POST["tag_id"];
        $author_id = null;
        $status = "PUBLISHED";
        //dd($_POST);

        $subscription = Subscriptions::where('user_id', $user_id)->where('status', 'PUBLISHED')->first();

        if( isset($subscription) ) {

            $arr_tags_id = explode(',', $subscription->tag_id);

            if( in_array($tag_id, $arr_tags_id) ) {

                unset( $arr_tags_id[array_search($tag_id, $arr_tags_id)] );
                $new_tags_id_str = implode(',', $arr_tags_id);
                //dd($new_tags_id_str);

                if( count($arr_tags_id) > 0 ) {

                    $subscription->tag_id = $new_tags_id_str;

                } else {

                    $subscription->tag_id = null;

                    if( $subscription->tag_id == null and $subscription->author_id == null ) {

                        Subscriptions::where('user_id', $user_id)->delete();

                        return redirect()->back();

                    }

                }

                $subscription->save();

                return redirect()->back();

            } else {

                return redirect()->back();

            }

        } else {

            return redirect()->back();

        }

    }

    public function userUnSubscribe()
    {
        $user_id = $_POST["user_id"];
        $tag_id = null;
        $author_id = $_POST["author_id"];
        $status = "PUBLISHED";
        //dd($_POST);

        $subscription = Subscriptions::where('user_id', $user_id)->where('status', 'PUBLISHED')->first();

        if( isset($subscription) ) {

            $arr_authors_id = explode(',', $subscription->author_id);

            if( in_array($author_id, $arr_authors_id) ) {

                unset( $arr_authors_id[array_search($author_id, $arr_authors_id)] );
                $new_authors_id_str = implode(',', $arr_authors_id);
                //dd($new_authors_id_str);

                if( count($arr_authors_id) > 0 ) {

                    $subscription->author_id = $new_authors_id_str;

                } else {

                    $subscription->author_id = null;

                    if( $subscription->tag_id == null and $subscription->author_id == null ) {

                        Subscriptions::where('user_id', $user_id)->delete();
                        
                        return redirect()->back();

                    }

                }

                $subscription->save();

                return redirect()->back();

            } else {

                return redirect()->back();

            }

        } else {

            return redirect()->back();

        }

    }
}
