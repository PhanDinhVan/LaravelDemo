<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    // declare table - khai bao table
    protected $table = "LoaiTin";

    public function theloai(){
    	return $this->belongTo('App\TheLoai','idTheLoai','id');
    }

    public function tintuc(){
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
