<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HDpriority extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_hd_priority';
}
