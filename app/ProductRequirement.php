<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRequirement extends Model
{
    use SoftDeletes;
    protected $table ='hnt_product_requirements';
}
