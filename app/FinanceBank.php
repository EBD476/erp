<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FinanceBank extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_finance_bank';
}
