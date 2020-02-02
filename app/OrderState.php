<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderState extends Model
{
    use SoftDeletes;
   protected $table='hnt_order_state';
   protected  $fillable = ['order_id','ho_process_id','ho_verifier_id'];
}
