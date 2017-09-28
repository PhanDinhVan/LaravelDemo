<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getList(){

        $slide = Slide::all();
        return view('admin.slide.list',['slide'=>$slide]);
    }

    //
    public function getEdit($id){
       $slide = Slide::find($id);
       return view('admin.slide.edit',['slide'=>$slide]);
    }

    //
    public function postEdit(Request $request, $id){
    	
    	$this->validate($request,
            [
                'Ten'=>'required|unique:Slide,Ten|Min:3|Max:100',
                'NoiDung'=>'required|Min:3'
            ],
            [
                'Ten.required'=>'Vui lòng nhập tên slide',
                'Ten.unique'=>'Tên slide đã tồn tại',
                'Ten.Min'=>'Tên slide ít nhất phải 3 kí tự',
                'Ten.Max'=>'Tên slide không vượt quá 100 kí tự',
                'NoiDung'=>'Vui lòng nhập nội dung',
                'NoiDung'=>'Nội dung phải có ít nhất 3 kí tự'
            ]);

        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }
        // hasFile kiểm tra có file hình ảnh hay không?
        if($request->hasFile('Hinh')){
            // lưu file('Hinh') vào biến $file
            $file = $request->file('Hinh');
            // lấy duôi của file hình để kiểm tra
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' and $duoi != 'jpen' and $duoi != 'JPG' && $duoi != 'PNG' and $duoi != 'JPEN'){
                return redirect('admin/slide/edit/'.$id)->with('thongbao','Bạn chỉ được thêm file hình có duôi jpg, jpn và jpeg.');
            }
            // lấy ra tên của hình trong file
            $name = $file->getClientOriginalName();
            // đặt tên mới cho file hình
            $newName = str_random(6)."_".$name;
            //echo $newName;
            // kiem tra ten hinh co ton tai trong thu muc chua
            while (file_exists("upload/slide/".$newName)) {
                $newName = str_random(6)."_".$name;
            }
            // lưu hình trong folder upload/tintuc
            $file ->move("upload/slide",$newName);
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh = $newName;
        }

        $slide->save();

        return redirect('admin/slide/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    //
    public function getAdd(){
       return view('admin.slide.add');
    }

    //
    public function postAdd(Request $request){
    	$this->validate($request,
            [
                'Ten'=>'required|unique:Slide,Ten|Min:3|Max:100',
                'NoiDung'=>'required|Min:3'
            ],
            [
                'Ten.required'=>'Vui lòng nhập tên slide',
                'Ten.unique'=>'Tên slide đã tồn tại',
                'Ten.Min'=>'Tên slide ít nhất phải 3 kí tự',
                'Ten.Max'=>'Tên slide không vượt quá 100 kí tự',
                'NoiDung'=>'Vui lòng nhập nội dung',
                'NoiDung'=>'Nội dung phải có ít nhất 3 kí tự'
            ]);

        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link')){
            $slide->link = $request->link;
        }
        // hasFile kiểm tra có file hình ảnh hay không?
        if($request->hasFile('Hinh')){
            // lưu file('Hinh') vào biến $file
            $file = $request->file('Hinh');
            // lấy duôi của file hình để kiểm tra
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' and $duoi != 'jpen' and $duoi != 'JPG' && $duoi != 'PNG' and $duoi != 'JPEN'){
                return redirect('admin/slide/add')->with('thongbao','Bạn chỉ được thêm file hình có duôi jpg, jpn và jpeg.');
            }
            // lấy ra tên của hình trong file
            $name = $file->getClientOriginalName();
            // đặt tên mới cho file hình
            $newName = str_random(6)."_".$name;
            //echo $newName;
            // kiem tra ten hinh co ton tai trong thu muc chua
            while (file_exists("upload/slide/".$newName)) {
                $newName = str_random(6)."_".$name;
            }
            // lưu hình trong folder upload/tintuc
            $file ->move("upload/slide",$newName);
            $slide->Hinh = $newName;

        }else{
            $slide->Hinh = "";
        }

        $slide->save();

        return redirect('admin/slide/add')->with('thongbao','Bạn đã thêm thành công!');
    }

    //
    public function getDelete($id){
    	$slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/list')->with('thongbao','Bạn đã xóa thành công');
    }
}
