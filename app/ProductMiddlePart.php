<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMiddlePart extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_product_middle_part';
}
