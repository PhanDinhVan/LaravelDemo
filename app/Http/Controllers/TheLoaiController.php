<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    //admin/theloai/list
    public function getList(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.list',['theloai'=>$theloai]);
    }

    //
    public function getEdit($id){
    	// find dung de tim the loai co id = $id
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.edit',['theloai'=>$theloai]);
    }

    //
    public function postEdit(Request $request, $id){ 
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		[

    			'Ten'=> 'required|unique:TheLoai,Ten|min:3|max:50'
    		],
    		[
    			'Ten.required'=>'Vui lòng nhập tên thể loại',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    			'Ten.min'=>'Tên thể phải có ít nhất 3 kí tự',
    			'Ten.max'=>'Tên thể loại không quá 50 kí tự'
    		]);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/edit/'.$id)->with('thongbao','Sửa thành công!');
    }

    //
    public function getAdd(){
    	return view('admin.theloai.add');
    }

    //
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|max:50'
    		],
    		[
    			'Ten.required'=>'Vui lòng nhập tên thể loại',
    			'Ten.min'=>'Tên thể phải có ít nhất 2 kí tự',
    			'Ten.max'=>'Tên thể loại không được quá 50 kí tự',
    		]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai -> save();

    	return redirect('admin/theloai/add')->with('thongbao','Bạn đã thêm thành công.');
    }

    public function getDelete($id){
    	$theloai = TheLoai::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/list')->with('thongbao','Bạn đã xóa thành công!');
    }
}
