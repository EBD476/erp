<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProcessLevel extends Model
{
    use SoftDeletes;
    protected $table ='hnt_process';
}
