<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

//запись снизу это примесь, сделана для того
//чтобы были подсказки для Eloquent без query()
/**
 * Class Country
 * @package App
 * @mixin Builder
 */
class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

}
