<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project_State extends Model
{
    use SoftDeletes;
    protected $table = 'hnt_project_address_state';
    public  function production1()
    {
        return $this->hasmany('App\Production');
    }
}
