<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BankAccounts extends Model
{
    use SoftDeletes;
  protected $table ='hnt_bank_accounts';
}
