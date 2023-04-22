<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class modules extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['module', 'user_id'];

    public function words()
    {
        return $this->hasMany(Words::class);
    }

    public static function getUserModules()
    {
        $userId = Auth::id();
        $data = modules::select()->where('user_id', $userId)->get();
        return $data;
    }

    public static function getUserModule($id)
    {
        $userId = Auth::id();
        $data = modules::select()->where('user_id', $userId)->where('id', $id)->get();
        return $data;
    }
}
