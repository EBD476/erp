<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundNonCurrent extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_non_current_assets';

}
