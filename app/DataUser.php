<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DataUser extends Model
{
    use SoftDeletes;
    protected $table='users';
}
