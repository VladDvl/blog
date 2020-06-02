@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
@endsection

@section('content')

<div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
        {{__('menu.Groups')}}
    </h3>
</div>

@if( count($all_groups) != 0 )

<div class="card">
<div class="card-body all-groups-list justify-content-start col">
    @foreach($all_groups as $group)
        <a class="group-link" href="{{asset('group/' . $group->id)}}">
        <div class="group">

            @if($group->avatar != '')
                <img class="group-small-avatar" src="{{asset('public/uploads/group-avatars/' . $group->avatar)}}" alt="avatar" width="52" height="52">
            @else
                <img class="group-small-avatar" src="{{asset('public/img/default-group.png')}}" alt="avatar" width="52" height="52">
            @endif

                <div class="group-info">
                    <div class="group-info1">
                        <p class="group-name">{{(isset($group->name)) ? $group->name : ''}}</p>
                        <p class="text-muted">{{__('menu.Author')}}: {{(isset($group->group_creator->name)) ? $group->group_creator->name : ''}}</p>
                        <p class="text-muted">{{__('menu.Type')}}: {{(isset($group->type)) ? $group->type : ''}}</p>
                        <p class="text-muted">{{__('menu.Created')}}: {{(isset($group->created_at)) ? $group->created_at : ''}}</p>
                    </div>
                    <div class="group-info2">
                        <p class="text-muted">{{__('menu.Partitipants')}}: {{(isset($group->partitipantss)) ? count($group->partitipantss) : ''}}</p>
                        <p class="text-muted">{{__('menu.Messagess')}}: {{(isset($group->messagee)) ? count($group->messagee) : ''}}</p>
                    </div>
                </div>
        </div>
        </a>
    @endforeach
</div><!--groups list-->
</div>

<div>{!!$all_groups->links()!!}</div>

@else
<p>{{__('menu.User_no_groups')}}.</p>
@endif

@endsection