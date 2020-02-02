<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundIntangibleAssets extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_intangible_assets';
}
