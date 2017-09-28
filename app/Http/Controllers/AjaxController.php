<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai){
        $loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();
        foreach ($loaitin as $value) {
            echo "<option value='".$value->id."'>".$value->Ten."</option>";
        }
    }
}
