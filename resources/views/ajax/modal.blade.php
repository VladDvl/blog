<h2>{{$obj->title}}</h2>
@if($obj->image)
<img src="{{asset('public/uploads/' . $obj->image)}}" width="100%"/>
@else
<img src="{{asset('no-photo')}}" width="100%"/>
@endif
{!!$obj->body!!}
<a href="{{asset('#')}}">Вверх ^</a>