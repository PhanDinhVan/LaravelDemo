@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

	@include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
    	<!-- Menu Left -->
    	@include('layout.menu')
        <!-- Content - Right -->
        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
            	</div>

            	<div class="panel-body">
            		<!-- item -->
            		@foreach($theloai as $value)
            			@if(count($value->loaitin) > 0)
						    <div class="row-item row">
			                	<h3>
			                		<a href="category.html">{{$value->Ten}}</a> | 	
			                		@foreach($value->loaitin as $lt)
			                			<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
			                		@endforeach
			                	</h3>
			                	<?php 
			                		// lay ra 5 tin moi nhat(sx giam dan) tu table tintuc thong qua funtion tin tuc trong model TheLoai cua the loai
			                		$data = $value->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
			                		// ham shift dung de lay du lieu ra tu data, dong thoi du lieu trong data se giam di theo so bien ma shift lay ra(lay ra 1 data)
			                		// ham shift se tra ve kieu du lieu mang
			                		$news1 = $data->shift();
			                	?>
			                	<div class="col-md-8 border-right">
			                		<div class="col-md-5">
				                        <a href="tintuc/{{$news1->id}}/{{$news1->TieuDeKhongDau}}.html">
				                            <img class="img-responsive" src="upload/tintuc/{{$news1['Hinh']}}" alt="">
				                        </a>
				                    </div>

				                    <div class="col-md-7">
				                        <h3>{{$news1['TieuDe']}}</h3>
				                        <p>{{$news1['TomTat']}}</p>
				                        <a class="btn btn-primary" href="tintuc/{{$news1['id']}}/{{$news1['TieuDeKhongDau']}}.html">Chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>

			                	</div>
			                    

								<div class="col-md-4">
									@foreach($data->all() as $tintuc)
										<a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
											<h4>
												<span class="glyphicon glyphicon-list-alt"></span>
												{{$tintuc['TieuDe']}}
											</h4>
										</a>
									@endforeach
								</div>
								
								<div class="break"></div>
			                </div>
		                @endif
	                @endforeach
	                <!-- end item -->
				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection