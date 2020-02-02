<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundAccountsAndDocumentsPayable extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_funds_accounts_and_documents_payable';
}
