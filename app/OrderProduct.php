<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderProduct extends Model
{
    use SoftDeletes;
    protected $table='hnt_invoice_items';
}
