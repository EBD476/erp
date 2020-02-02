<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StateLevel extends Model
{
    use SoftDeletes;
    protected $table='hnt_order_state';
}
