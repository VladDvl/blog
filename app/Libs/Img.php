<?php
namespace App\Libs;
use Image;
use Auth;

class Img
{
    public function __construct(){}
    
    public function url($content, $path, $directory = null, $name = null)
    {
        if($path != null) {
            if($directory != null) {
                $dir = public_path().$directory;//надо проверить, создана ли папка
                if(! file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
            } else {

                if($content == 'post') {
                    $dir = public_path().'/uploads/posts';
                } elseif($content == 'comment') {
                    $dir = public_path().'/uploads/comments';
                } elseif($content == 'avatar') {
                    $dir = public_path().'/uploads/avatars';
                } elseif($content == 'group-avatar') {
                    $dir = public_path().'/uploads/group-avatars';
                } else {
                    $dir = public_path().'/uploads';
                }
                
            }
            if($name != null) {
                $filename = $name;
            } else {
                $filename = date('y_m_d_h_i_s').'.jpg';
            }

            $img = Image::make($path);
            $img->save($dir.'/'.$filename);
            
            return $filename;
            
        } else {
            return false;
        }
    }
}