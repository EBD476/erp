<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiddlePartRequirement extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_middle_part_requirements';

}
