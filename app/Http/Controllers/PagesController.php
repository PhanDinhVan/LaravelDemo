<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

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

    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        // paginate la phan trang trong laravel
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();

        return view('pages.tintuc',['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }

    function search(Request $request){
        $keyWord = $request->tukhoa;      
        $tintuc = TinTuc::where('TieuDe','like',"%$keyWord%")->orWhere('TomTat','like',"%$keyWord%")->orWhere('NoiDung','like',"%$keyWord%")->take(30)->paginate(5);

        return view('pages.search',['tintuc'=>$tintuc,'keyWord'=>$keyWord]);
    }

    function about(){
        return view('pages.about');
    }
}
