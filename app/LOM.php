<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LOM extends Model
{
    use SoftDeletes;
    protected $table='hnt_invoice_items';

    function product()
    {
        return $this->belongsTo('App\Product','hnt_products_hnt_product_order_id_foreign');
    }
}
