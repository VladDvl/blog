<h2>{{$obj->title}}</h2>
@if($obj->image)
<img src="{{asset('public/uploads/posts/' . $obj->image)}}" width="100%"/>
@else
<!-- <img src="{{asset('no-photo')}}" width="100%" alt="no-photo"/> -->
@endif
{!!$obj->body!!}
<a href="{{asset('#')}}">{{__('menu.Back')}} ^</a>