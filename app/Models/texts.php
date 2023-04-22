<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class texts extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['english', 'translation', 'module_id', 'user_id'];

}
