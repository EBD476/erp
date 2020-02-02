<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HDtype extends Model
{
    use SoftDeletes;
    protected $table='hnt_th_type';
}
