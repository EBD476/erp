<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ConversationView extends Model
{
    use SoftDeletes;
   protected $table ='hnt_conversation_view';
}
