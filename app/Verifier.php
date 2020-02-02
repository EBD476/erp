<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Verifier extends Model
{
    use SoftDeletes;
    protected $table='hnt_process_verifiers';
}
