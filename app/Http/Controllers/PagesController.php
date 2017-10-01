<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;

class PagesController extends Controller
{
	// dung view()->share de truyen 1 bien vao tat ca cac view co trong controller
	function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai',$theloai);
		view()->share('slide',$slide);
	}
    //
    function home(){
    	
    	return view('pages.home');
    }

    function contact(){

    	return view('pages.contact');
    }
}
