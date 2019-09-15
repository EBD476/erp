<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LOM extends Model
{
    protected $table='hnt_invoice_items';

    function product()
    {
        return $this->belongsTo('App\Product','hnt_products_hnt_product_order_id_foreign');
    }
}
