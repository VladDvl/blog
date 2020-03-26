@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
@endsection

@section('content')

<div class="col-md-14">

@if($objs)
<div>
Найдено публикаций: {{count($objs['objs_posts'])}}.
@if(count($objs['objs_posts'])>0)
  @foreach($objs['objs_posts'] as $post)
    {{$post->title}}
  @endforeach
@endif
</div>
<div>
Найдено пользователей: {{count($objs['objs_users'])}}.
@if(count($objs['objs_users'])>0)
  @foreach($objs['objs_users'] as $user)
    {{$user->name}}
  @endforeach
@endif
</div>
<div>
Найдено комментариев: {{count($objs['objs_comments'])}}.
@if(count($objs['objs_comments'])>0)
  @foreach($objs['objs_comments'] as $comment)
    {{$comment->body}}
  @endforeach
@endif
</div>
<div>
Найдено категорий: {{count($objs['objs_categories'])}}.
@if(count($objs['objs_categories'])>0)
  @foreach($objs['objs_categories'] as $category)
    {{$category->name}}
  @endforeach
@endif
</div>
@else
Введите минимум 3 символа.
@endif

</div>

@endsection