<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'notes_id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
