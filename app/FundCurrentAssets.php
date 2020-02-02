<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundCurrentAssets extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_current_assets';

}
