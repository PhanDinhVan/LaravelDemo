@extends('layout.index')

@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">
       @include('layout.menu')

       <?php 
       		// thay doi cac mau sac cho tu khoa tim kiem
       		function editColor($str,$keyWord){
       			return str_replace($keyWord, "<span style='color:red; background-color:yellow;'>$keyWord</span>", $str);
       		}
       ?>

        <div class="col-md-9 ">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>Search : {{$keyWord}}</b></h4>
                </div>
                @foreach($tintuc as $value)
	                <div class="row-item row">
	                    <div class="col-md-3">

	                        <a href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html">
	                            <br>
	                            <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$value->Hinh}}" alt="">
	                        </a>
	                    </div>

	                    <div class="col-md-9">
	                        <h3>{!! editColor($value->TieuDe,$keyWord) !!}</h3>
	                        <p>{!! editColor($value->TomTat,$keyWord) !!}</p>
	                        <a class="btn btn-primary" href="tintuc/{{$value->id}}/{{$value->TieuDeKhongDau}}.html">Chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
	                    </div>
	                    <div class="break"></div>
	                </div>
                @endforeach

                <div style="text-align: center;">
                	<!-- Pagination -->
	                {{$tintuc->links()}}
	                <!-- /.row -->
                </div>
            </div>
        </div> 

    </div>

</div>
<!-- end Page Content -->

@endsection