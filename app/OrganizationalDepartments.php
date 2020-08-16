<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationalDepartments extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_organizational_departments';
}
