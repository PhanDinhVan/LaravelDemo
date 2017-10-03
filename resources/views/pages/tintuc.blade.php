 @extends('layout.index')

 @section('content')
 <!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">admin</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead"> 
            	<!-- dung cho nhung noi dung co the html -->
            		{!! $tintuc->NoiDung !!}
            </p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            @if(Auth::check())

            <div class="well">
                @if(session('thongbao'))
                    {{session('thongbao')}}
                @endif
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form action="comment/{{$tintuc->id}}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>
            @endif

            <!-- Posted Comments -->

            @foreach($tintuc->comment as $value)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                	<!-- lay ten nguoi comment -->
                    <h4 class="media-heading">{{$value->user->name}}
                        <small>{{$value->created_at}}</small>
                    </h4>
                    {{$value->NoiDung}}
                </div>
            </div>
            @endforeach

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">

                	@foreach($tinlienquan as $value)
	                    <!-- item -->
	                    <div class="row" style="margin-top: 10px;">
	                        <div class="col-md-5">
	                            <a href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html">
	                                <img class="img-responsive" src="upload/tintuc/{{$value->Hinh}}" alt="">
	                            </a>
	                        </div>
	                        <div class="col-md-7">
	                            <a href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html"><b>{{$value->TieuDe}}</b></a>
	                        </div>
	                        <p style="padding-left: 5px;">{{$value->TomTat}}</p>
	                        <div class="break"></div>
	                    </div>
	                    <!-- end item -->
                    @endforeach

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                	@foreach($tinnoibat as $value)
	                    <!-- item -->
	                    <div class="row" style="margin-top: 10px;">
	                        <div class="col-md-5">
	                            <a href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html">
	                                <img class="img-responsive" src="upload/tintuc/{{$value->Hinh}}" alt="">
	                            </a>
	                        </div>
	                        <div class="col-md-7">
	                            <a href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html"><b>{{$value->TieuDe}}</b></a>
	                        </div>
	                        <p style="padding-left: 5px;">{{$value->TomTat}}</p>
	                        <div class="break"></div>
	                    </div>
	                    <!-- end item -->
                    @endforeach
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection