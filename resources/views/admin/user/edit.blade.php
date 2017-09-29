 @extends('admin.layout.index')

 @section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/edit/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$user->name}}" placeholder="Please Enter Your Name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" value="{{$user->email}}" placeholder="Please Enter Your Email" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Change Password</label>
                                <input class="form-control password" type="password" name="password" placeholder="Please Enter Your Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Password Again</label>
                                <input class="form-control password" type="password" name="passwordAgain" placeholder="Please Enter Your Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio"
                                        @if($user->quyen == 1)
                                            {{"checked"}}
                                        @endif
                                    >Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio"
                                        @if($user->quyen == 0)
                                            {{"checked"}}
                                        @endif
                                    >User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
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


 @section('script')
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
 @endsection