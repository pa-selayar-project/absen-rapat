@extends('.backend.layout.app')

@section('title','Dashboard')

@section('isi')
<div class="row d-flex p-2 justify-content-around">
	@foreach($menu as $m)
	<div class="card mb-3" style="max-width: 18rem;">
		<div class="card-body text-center">
			<a href="{{url($m->link)}}">
				<i class="fa-8x {{$m->icon}}"></i>
				<div class="text-primary">{{$m->nama_menu}}</div>
			</a> 
		</div>
	</div>
	@endforeach	
</div>    
@endsection
