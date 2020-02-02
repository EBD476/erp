<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class address extends Model
{
    use SoftDeletes;
    protected $table='hnt_project_address_city';

}
