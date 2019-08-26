<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{
   protected $table='hnt_order_state';
   protected  $fillable = ['order_id','ho_process_id','ho_verifier_id'];
}
