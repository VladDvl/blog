@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            <label for="shortDescription">Короткое описание</label>
                            <textarea class="form-control" id="shortDescription" name="except"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editor">Описание</label>
                            <textarea class="form-control" id="editor" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Catalogue">Каталог</label>
                            <input type="text" class="form-control" id="Catalogue" name="category_id" placeholder="Каталог">
                        </div>
                        <div class="form-group">
                            <label for="postImage">Изображение</label>
                            <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
                        </div>
                        <div class="form-group">
                            <label for="Status">Статус</label>
                            <input type="text" class="form-control" id="Status" name="status" placeholder="Статус">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table>
    @foreach($objs as $one)
    <tr>
      <td><a href="{{asset('#')}}">{{isset($one->title) ? $one->title : ''}}</a></td>
      <td><a href="{{asset('#')}}">{{isset($one->category->name) ? $one->category->name : ''}}</a></td>
    </tr>
    @endforeach
    </table>
    <div>{!!$objs->links()!!}</div>
</div>
@endsection
