@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
  <script src="{{asset('public/js/home.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">

            <div class="card">
                <div class="card-header">{{__('menu.Messages')}}</div>
                <div class="card-body justify-content-start col">
                    @if(count($msgs) != 0)
                        @foreach($msgs as $msg)
                        <div>
                            <a href="{{asset('chat/' . $msg->sender->id)}}">Example</a>
                        </div>
                        @endforeach
                    @else
                        <div>
                            {{__('menu.NoMessages')}}.
                        </div>
                    @endif
                </div>
            </div><!--chats-->

            <div class="card">
                <div class="card-header">{{__('menu.Avatar')}}</div>
                <div class="card-body justify-content-start row">
                    @if( Auth::user()->avatar != 'users/default.png' and Auth::user()->avatar != '' )
                        <img src="{{asset('public/uploads/avatars/' . Auth::user()->avatar)}}" alt="avatar">
                    @else
                        <img src="{{asset('public/img/default-avatar.png')}}" alt="avatar">
                    @endif

                    <form class="col" method="post" action="{{asset('home/avatar')}}" enctype="multipart/form-data">
                        {!!csrf_field()!!}
                        @if(count($errors)>0)
                            @foreach($errors->all() as $ers)
                                <div class="red">
                                    {{$ers}}
                                </div>
                            @endforeach
                        @endif
                        <div id="input-avatar-div" class="form-group row">
                            <button id="input-avatar-button" type="submit" class="btn btn-primary" name="action" value="change">{{__('menu.Change')}}</button>
                            <input id="input-avatar-img" type="file" class="col form-control" id="avatarImage" name="avatar1" placeholder="Изображение">
                        </div>
                        <div id="delete-avatar-div" class="form-group">
                            <button id="delete-avatar-button" type="submit" class="btn btn-primary" name="action" value="delete">{{__('menu.Delete')}}</button>
                        </div>
                    </form>
                </div>
            </div><!--avatar-->

            <div class="card">
                <div class="card-header">{{__('menu.AddPost')}}</div>

                <div class="card-body">
                    <!--@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!-->

                    <form method="post" action="{{asset('home')}}" enctype="multipart/form-data">
                        {!!csrf_field()!!}
                        @if(count($errors)>0)
                            @foreach($errors->all() as $ers)
                                <div class="red">
                                    {{$ers}}
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <label for="postName">{{__('menu.Title')}}</label>
                            @if( !empty($post_id) )
                              <input type="text" class="form-control" id="postName" name="title" value="{{$edit_post->title}}">
                            @else
                              <input type="text" class="form-control" id="postName" name="title" placeholder="{{__('menu.WriteTitle')}}">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="editor">{{__('menu.Description')}}</label>
                            @if( !empty($post_id) )
                              <textarea class="form-control" id="editor" name="body">{!!$edit_post->body!!}</textarea>
                            @else
                              <textarea class="form-control" id="editor" name="body"></textarea>
                            @endif
                        </div>
                        <label for="Category">{{__('menu.Category')}}</label>
                        <select class="form-group" id="Category" name="category_id">
                            @if( !empty($post_id) )

                              @if( App::getLocale() == 'en')
                                <option selected value="{{$edit_post->category->id}}">{{ucfirst($edit_post->category->slug)}}</option>
                              @else
                                <option selected value="{{$edit_post->category->id}}">{{ucfirst($edit_post->category->name)}}</option>
                              @endif

                            @foreach($cats as $cat)
                              @if( App::getLocale() == 'en')
                                <option value="{{$cat->id}}">{{ucfirst($cat->slug)}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach

                            @else

                            @foreach($cats as $cat)
                              @if( App::getLocale() == 'en')
                                <option value="{{$cat->id}}">{{ucfirst($cat->slug)}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach

                            @endif
                        </select>
                        <div class="form-group">
                            <label for="postImage">{{__('menu.Image')}}</label>
                            <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
                        </div>
                        @if( !empty($post_id) )
                          <button type="submit" class="btn btn-primary" name="update" value="{{$edit_post->id}}">{{__('menu.Save')}}</button>
                        @else
                          <button type="submit" class="btn btn-primary" name="create">{{__('menu.Save')}}</button>
                        @endif
                    </form>
                </div>
            </div>


            <form id="table-form" method="post" action="{{asset('home/table')}}" enctype="multipart/form-data">
                {!!csrf_field()!!}
                @if(count($errors)>0)
                    @foreach($errors->all() as $ers)
                        <div class="red">
                            {{$ers}}
                        </div>
                    @endforeach
                @endif

            <table class="home-table">
            <tr>
                <th>{{__('menu.Title')}}</th>
                <th>{{__('menu.Category')}}</th>
                <th>{{__('menu.Short')}}</th>
                <th>{{__('menu.Comments')}}</th>
                <th>{{__('menu.Created')}}</th>
                <th>{{__('menu.Updated')}}</th>
                <th>{{__('menu.Actions')}}</th>
            </tr>
            @foreach($objs as $one)
            <tr>
                <td><a href="{{asset('post/' . $one -> slug)}}">{{isset($one->title) ? $one->title : ''}}</a></td>
                @if( App::getLocale() == 'en')
                  <td><a href="{{asset('cat/' . $one->category->slug)}}">{{isset($one->category->slug) ? ucfirst($one->category->slug) : ''}}</a></td>
                @else
                  <td><a href="{{asset('cat/' . $one->category->slug)}}">{{isset($one->category->name) ? $one->category->name : ''}}</a></td>
                @endif
                <td>{!!isset($one->body) ? mb_substr($one->body, 0, 95) : ''!!}</td>
                <td>{{__('menu.Comments')}}: {{isset($one->comments) ? $one->comments : ''}}</td>
                <td>{{isset($one->created_at) ? $one->created_at : ''}}</td>
                <td>{{isset($one->updated_at) ? $one->updated_at : ''}}</td>
                <td>
                    <button class="edit-post-button" type="sybmit" name="edit" value="{{$one->id}}">{{__('menu.Edit')}}</button><br>
                    <button class="delete-post-button" type="sybmit" name="delete" value="{{$one->id}}">{{__('menu.Delete')}}</button>
                </td>
            </tr>
            @endforeach
            </table>
            <div>{!!$objs->links()!!}</div>


            </form>

        </div><!--div col md-12-->
    </div>
</div>
@endsection
