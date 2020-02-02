<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundAdvancesAndDeposits extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_advances_and_deposits';

}
