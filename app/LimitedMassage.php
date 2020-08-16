<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LimitedMassage extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_limited_user_massage';
}
