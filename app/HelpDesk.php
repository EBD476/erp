<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HelpDesk extends Model
{
    use SoftDeletes;
    protected $table='hnt_help_desk';
}
