<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiddleSectionPart extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_middle_section_part';
}
