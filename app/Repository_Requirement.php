<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Repository_Requirement extends Model
{
    use SoftDeletes;
    protected $table="hnt_repository__requirements";
}
