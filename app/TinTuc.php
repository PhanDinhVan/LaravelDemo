<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    // declare table - khai bao table
    protected $table = "TinTuc";

    public function loaitin(){
    	return $this->belongTo('App\LoaiTin','idLoaiTin','id');
    }

    public function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
