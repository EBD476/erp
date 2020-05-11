<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agreement extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_contract';
}
