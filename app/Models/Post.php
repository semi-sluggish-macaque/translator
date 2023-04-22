<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'rubric_id'];

    public function rubric()
    {
//передано строкой
        return $this->belongsTo('App\Models\Rubric');

    }

    public function tags()
    {
        //привязка тегов к постам
        return $this->belongsToMany('App\Models\Tag');

    }

    public function getPostDate()
    {

        return Carbon::parse($this->created_at)->diffForHumans();
    }

    //ниже мутатор, подробнее чит док
    public function setTitleAttribute($value)
    {
        //перед записью в бд, каждое слово в title будет с большой буквы
        $this->attributes['title'] = Str::title($value);
    }

    //ниже accessor
    public function getTitleAttribute($value)
    {
        //при выводе, кадая буква Title будет большой, но в базе ничего не поменяется
        return Str::upper($value);
    }

}
