<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{

    //рубрика имеет один пост
    //виртуальное свойство будет называтся как и данная функция
    public function posts()
    {

        return $this->hasMany('App\Models\Post');
    }


}
