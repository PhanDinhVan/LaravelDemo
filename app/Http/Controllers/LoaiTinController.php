<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
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
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    //
    public function postEdit(Request $request, $id){
    	
    	$this->validate($request,
    		[

    			'Ten'=> 'required|unique:TheLoai,Ten|min:3|max:50',
    			'idTheLoai'=>'required'
    		],
    		[
    			'Ten.required'=>'Vui lòng nhập tên loại tin',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin có ít nhất 3 kí tự',
    			'Ten.max'=>'Tên loại tin không quá 50 kí tự',
    			'idTheLoai.required'=>'Bạn chưa chọn thể loại'
    		]);

    	$loaitin = LoaiTin::find($id);
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->idTheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/edit/'.$id)->with('thongbao','Sửa thành công!');
    }

    //
    public function getAdd(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.add',['theloai'=>$theloai]);
    }

    //
    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:50',
    			'idTheLoai'=>'required'
    		],
    		[
    			'Ten.required'=>'Vui lòng nhập tên loại tin',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin phải có ít nhất 2 kí tự',
    			'Ten.max'=>'Tên loại tin không được quá 50 kí tự',
    			'idTheLoai.required'=>'Bạn chưa chọn thể loại'
    		]);

    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->idTheLoai;
    	$loaitin -> save();

    	return redirect('admin/loaitin/add')->with('thongbao','Bạn đã thêm thành công.');
    }

    public function getDelete($id){
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();

    	return redirect('admin/loaitin/list')->with('thongbao','Bạn đã xóa thành công!');
    }
}
