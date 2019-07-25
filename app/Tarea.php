<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{

    protected $fillable = ['title', 'description', 'id_user', 'due'];
    //protected $guarded = ['user_id'];

    public function creator(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
