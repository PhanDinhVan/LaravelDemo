<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;


class PagesController extends Controller
{
    //
    function home(){
    	$theloai = TheLoai::all();

    	return view('pages.home',['theloai'=>$theloai]);
    }
}
