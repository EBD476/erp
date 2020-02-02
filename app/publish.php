<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class publish extends Model
{
    use SoftDeletes;
   public function user()
   {
       return $this->belongsto('App\User');
   }
}
