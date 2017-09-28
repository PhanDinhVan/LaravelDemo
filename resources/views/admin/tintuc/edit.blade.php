 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <!-- enctype="multipart/form-data"  dung de add file trong Form-->
                        <form action="admin/tintuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $value)
                                    <option 
                                        @if($tintuc->loaitin->theloai->id == $value->id)
                                            {{"selected"}}
                                        @endif
                                        value="{{$value->id}}">{{$value->Ten}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $value)
                                    <option 
                                        @if($tintuc->loaitin->id == $value->id)
                                            {{"selected"}}
                                        @endif
                                        value="{{$value->id}}">{{$value->Ten}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="demo" name="TomTat" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p>
                                    <img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}" >
                                </p>
                                <input type="file" name="Hinh" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio"
                                        @if($tintuc->NoiBat == 0)
                                            {{"checked"}}
                                        @endif
                                    >Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio"
                                        @if($tintuc->NoiBat == 1)
                                            {{"checked"}}
                                        @endif
                                    >Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>
                                <td>
                                    <p> {{$value->user->name}} </p>
                                    <img width="100px" src="upload/tintuc/{{$value->Hinh}}" />
                                </td>
                                <td>{{$value->NoiDung}}</td>
                                <td>{{$value->created_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/delete/{{$value->id}}/{{$tintuc->id}}"> Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

 @endsection


 @section('script')
    <script>
        $(document).ready(function(){
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai, function(data){
                    $("#LoaiTin").html(data);
                    // alert(data);
                });
            });
        });
    </script>

 @endsection