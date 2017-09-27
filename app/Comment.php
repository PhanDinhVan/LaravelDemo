<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // declare table - khai bao table
    protected $table = "Comment";

    public function tintuc(){
    	return $this->belongTo('App\TinTuc','idTinTuc','id');
    }

    public function user(){
    	return $this->belongTo('App\User','idUser','id');
    }
}
