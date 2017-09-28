 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
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
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th>Thể loại</th>
                                <th>Loại tin</th>
                                <th>Lượt xem</th>
                                <th>Nổi bật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>
                                <td>
                                    <p> {{$value->TieuDe}} </p>
                                    <img width="100px" src="upload/tintuc/{{$value->Hinh}}" />
                                </td>
                                <td>{{$value->TomTat}}</td>
                                <td>{{$value->loaitin->theloai->Ten}}</td>
                                <td>{{$value->loaitin->Ten}}</td>
                                <td>{{$value->SoLuotXem}}</td>
                                <td>
                                    @if($value->NoiBat == 0)
                                        {{'Có'}}
                                    @else
                                        {{'Không'}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/delete/{{$value->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/edit/{{$value->id}}">Edit</a></td>
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