<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HDTypeRole extends Model
{
    use SoftDeletes;
   protected $table = 'hnt_hhd_help_desk_type_role';
}
