 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                                <th>Tên</th>
                                <th>Hình</th>
                                <th>Nội dung</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $value)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->Ten}}</td>
                                    <td>
                                        <img width="400px" height="300px" src="upload/slide/{{$value->Hinh}}">
                                    </td>
                                    <td>{{$value->NoiDung}}</td>
                                    <td><a href="{{$value->link}}"> {{$value->link}}</a></td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/delete/{{$value->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/edit/{{$value->id}}">Edit</a></td>
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