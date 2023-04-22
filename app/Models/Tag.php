<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function posts()
    {
        //привязка постов к тегам
        return $this->belongsToMany('App\Models\Post');

    }

}
