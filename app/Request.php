<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table="hnt_requests";
    public function user()
    {
        return $this->belongsto('App\User');
    }
}
