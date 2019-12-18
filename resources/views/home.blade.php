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
                <div class="card-header">Аватар пользователя</div>
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
                            <button id="input-avatar-button" type="submit" class="btn btn-primary" name="action" value="change">Изменить</button>
                            <input id="input-avatar-img" type="file" class="col form-control" id="avatarImage" name="avatar1" placeholder="Изображение">
                        </div>
                        <div id="delete-avatar-div" class="form-group">
                            <button id="delete-avatar-button" type="submit" class="btn btn-primary" name="action" value="delete">Удалить</button>
                        </div>
                    </form>
                </div>
            </div><!--avatar-->

            <div class="card">
                <div class="card-header">Добавить пост</div>

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
                            <label for="postName">Название</label>
                            <input type="text" class="form-control" id="postName" name="title" placeholder="Введите название">
                        </div>
                        <div class="form-group">
                            <label for="editor">Описание</label>
                            <textarea class="form-control" id="editor" name="body"></textarea>
                        </div>
                        <label for="Category">Категория</label>
                        <select class="form-group" id="Category" name="category_id">
                            @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="postImage">Изображение</label>
                            <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>

            <table class="home-table">
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Краткое описание</th>
                <th>Комментариев</th>
                <th>Создан</th>
                <th>Обновлен</th>
                <th>Действия</th>
            </tr>
            @foreach($objs as $one)
            <tr>
                <td><a href="{{asset('post/' . $one -> slug)}}">{{isset($one->title) ? $one->title : ''}}</a></td>
                <td><a href="{{asset('cat/' . $one->category->slug)}}">{{isset($one->category->name) ? $one->category->name : ''}}</a></td>
                <td>{!!isset($one->body) ? mb_substr($one->body, 0, 95) : ''!!}</td>
                <td>Комментариев: {{isset($one->comments) ? $one->comments : ''}}</td>
                <td>{{isset($one->created_at) ? $one->created_at : ''}}</td>
                <td>{{isset($one->updated_at) ? $one->updated_at : ''}}</td>
                <td>
                    <button>Edit</button><br>
                    <button>Delete</button>
                </td>
            </tr>
            @endforeach
            </table>
            <div>{!!$objs->links()!!}</div>

        </div><!--div col md-12-->
    </div>
</div>
@endsection
