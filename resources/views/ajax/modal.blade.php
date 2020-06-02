<h2>{{$obj->title}}</h2>
@if($obj->image)
<img src="{{asset('public/uploads/posts/' . $obj->image)}}" width="100%"/>
@endif
{!!$obj->body!!}
<a href="{{asset('#')}}">{{__('menu.Back')}} ^</a>