<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getList(){

    	$tintuc = TinTuc::orderBy('id','DESC')->get();
    	// $tintuc = TinTuc::all();
        
    	return view('admin.tintuc.list',['tintuc'=>$tintuc]);
    }

    //
    public function getEdit($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);

        return view('admin/tintuc/edit',['tintuc'=>$tintuc,'loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    //
    public function postEdit(Request $request, $id){
    	
    	$tintuc = TinTuc::find($id);
        $this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|max:100|unique:TinTuc,TieuDe',
            'TomTat'=>'required|min:10|max:200',
            'NoiDung'=>'required|min:50'
        ],
        [
            'LoaiTin.required'=>'Vui lòng chọn loại tin',
            'TieuDe.required'=>'Vui lòng nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
            'TieuDe.max'=>'Tiêu đề không được phép quá 100 kí tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Vui lòng nhập tóm tắt',
            'TomTat.min'=>'Tóm tắt phải có ít nhất 10 kí tự',
            'TomTat.max'=>'Tóm tắt có tối đa 200 kí tự',
            'NoiDung.required'=>'Vui lòng nhập dung',
            'NoiDung.min:5'=>'Nội dung phải có ít nhất 50 kí tự'
        ]);

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        // hasFile kiểm tra có file hình ảnh hay không?
        if($request->hasFile('Hinh')){
            // lưu file('Hinh') vào biến $file
            $file = $request->file('Hinh');
            // lấy duôi của file hình để kiểm tra
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' and $duoi != 'jpen' and $duoi != 'JPG' && $duoi != 'PNG' and $duoi != 'JPEN'){
                return redirect('admin/tintuc/edit/'.$id)->with('thongbao','Bạn chỉ được thêm file hình có duôi jpg, jpn và jpeg.');
            }
            // lấy ra tên của hình trong file
            $name = $file->getClientOriginalName();
            // đặt tên mới cho file hình
            $newName = str_random(6)."_".$name;
            //echo $newName;
            // kiem tra ten hinh co ton tai trong thu muc chua
            while (file_exists("upload/tintuc/".$newName)) {
                $newName = str_random(6)."_".$name;
            }
            // lưu hình trong folder upload/tintuc
            $file ->move("upload/tintuc",$newName);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $newName;
        }

        $tintuc->save();

        return redirect('admin/tintuc/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    //
    public function getAdd(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

    	return view('admin.tintuc.add',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    //
    public function postAdd(Request $request){
    	$this->validate($request,
        [
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|max:100|unique:TinTuc,TieuDe',
            'TomTat'=>'required|min:10|max:200',
            'NoiDung'=>'required|min:50'
        ],
        [
            'LoaiTin.required'=>'Vui lòng chọn loại tin',
            'TieuDe.required'=>'Vui lòng nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
            'TieuDe.max'=>'Tiêu đề không được phép quá 100 kí tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Vui lòng nhập tóm tắt',
            'TomTat.min'=>'Tóm tắt phải có ít nhất 10 kí tự',
            'TomTat.max'=>'Tóm tắt có tối đa 200 kí tự',
            'NoiDung.required'=>'Vui lòng nhập dung',
            'NoiDung.min:5'=>'Nội dung phải có ít nhất 50 kí tự'
        ]);

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;

        // hasFile kiểm tra có file hình ảnh hay không?
        if($request->hasFile('Hinh')){
            // lưu file('Hinh') vào biến $file
            $file = $request->file('Hinh');
            // lấy duôi của file hình để kiểm tra
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' and $duoi != 'jpen' and $duoi != 'JPG' && $duoi != 'PNG' and $duoi != 'JPEN'){
                return redirect('admin/tintuc/add')->with('thongbao','Bạn chỉ được thêm file hình có duôi jpg, jpn và jpeg.');
            }
            // lấy ra tên của hình trong file
            $name = $file->getClientOriginalName();
            // đặt tên mới cho file hình
            $newName = str_random(6)."_".$name;
            //echo $newName;
            // kiem tra ten hinh co ton tai trong thu muc chua
            while (file_exists("upload/tintuc/".$newName)) {
                $newName = str_random(6)."_".$name;
            }
            // lưu hình trong folder upload/tintuc
            $file ->move("upload/tintuc",$newName);
            $tintuc->Hinh = $newName;

        }else{
            $tintuc->Hinh = "";
        }

        $tintuc->save();

        return redirect('admin/tintuc/add')->with('thongbao','Bạn đã thêm thành công.');
    }

    public function getDelete($id){
    	$tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/list')->with('thongbao','Bạn đã xóa thành công!');
    }
}
