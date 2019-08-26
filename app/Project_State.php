<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_State extends Model
{
    protected $table = 'hnt_projects';
    public  function production1()
    {
        return $this->hasmany('App\Production');
    }
}
