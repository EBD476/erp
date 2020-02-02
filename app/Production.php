<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Production extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function project_state()
    {
       return $this->belongsto('App\Project_State');
    }

}
