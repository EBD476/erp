<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BankAccountType extends Model
{
    use SoftDeletes;
    protected $table ='hnt_bank_account_type';
}
