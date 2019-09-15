<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table='hnt_products';
   function lom()
   {
      return  $this->hasMany('App\LOM');
   }
}
