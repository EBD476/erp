<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundCriticism extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_criticism';

}
