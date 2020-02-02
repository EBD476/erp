<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Part extends Model
{
    use SoftDeletes;
    protected $table ='hnt_parts';
}
