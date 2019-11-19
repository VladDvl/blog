<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Categories extends Model
{
    public $table = "categories";

    public function posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'), 'category_id');
    }
}