<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundTangibleFixedAssets extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_tangible_fixed_assets';

}
