<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiddlePart extends Model
{
   use SoftDeletes;
   protected $table = 'hnt_middle_part';

   protected $dates = ['deleted_at'];
}
