<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;

class LoaiTinController extends Controller
{
    //
    public function getList(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list',['loaitin'=>$loaitin]);
    }

    //
    public function getEdit($id){
    	// find dung de tim the loai co id = $id
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.edit',['loaitin'=>$loaitin]);
    }

    //
    public function postEdit(Request $request, $id){
    	$loaitin = LoaiTin::find($id);
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
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->save();

    	return redirect('admin/theloai/edit/'.$id)->with('thongbao','Sửa thành công!');
    }

    //
    public function getAdd(){
    	return view('admin.loaitin.add');
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

    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin -> save();

    	return redirect('admin/theloai/add')->with('thongbao','Bạn đã thêm thành công.');
    }

    public function getDelete($id){
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();

    	return redirect('admin/loaitin/list')->with('thongbao','Bạn đã xóa thành công!');
    }
}
