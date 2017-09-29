 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content --> 
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $value)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>
                                        @if($value->quyen == 1)
                                            {{"Admin"}}
                                        @else
                                            {{"User Thường"}}
                                        @endif
                                    </td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/delete/{{$value->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/edit/{{$value->id}}">Edit</a></td>
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