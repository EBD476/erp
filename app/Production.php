<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{


    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function project_state()
    {
       return $this->belongsto('App\Project_State');
    }

}
