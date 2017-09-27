<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class TinTucController extends Controller
{
    //
    public function getList(){

    	// $tintuc = TinTuc::orderBy('id','DESC')->get();
    	$tintuc = TinTuc::all();
    	return view('admin.tintuc.list',['tintuc'=>$tintuc]);
    }

    //
    public function getEdit($id){
    	
    }

    //
    public function postEdit(Request $request, $id){
    	
    	
    }

    //
    public function getAdd(){
    	
    }

    //
    public function postAdd(Request $request){
    	
    }

    public function getDelete($id){
    	
    }
}
