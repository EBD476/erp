<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPropertyItems extends Model
{
    Use SoftDeletes;
    protected $table = 'hnt_product_property_items';
}
