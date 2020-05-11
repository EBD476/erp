<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartRequirement extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_part_requirements';
}
