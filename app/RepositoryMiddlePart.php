<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepositoryMiddlePart extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_repository_middle_part';
}
