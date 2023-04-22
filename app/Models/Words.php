<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['english', 'translation', 'modules_id', 'user_id'];

    public function modules()
    {
        return $this->belongsTo(modules::class);
    }

}
