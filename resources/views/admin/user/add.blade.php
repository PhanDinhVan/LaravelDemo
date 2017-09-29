 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Add</small>
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
                        <form action="admin/user/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Your Name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Please Enter Your Email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Please Enter Your Password" />
                            </div>
                            <div class="form-group">
                                <label>Password Again</label>
                                <input class="form-control" type="password" name="passwordAgain" placeholder="Please Enter Your Password" />
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

 @endsection