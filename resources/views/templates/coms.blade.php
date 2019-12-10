<div id="template-post-meta" class="row justify-content-between pb-4 mb-4 border-bottom container">
    <p class="blog-post-meta">Автор: <a href="{{(isset($one->author_id)) ? $one->author_id : ''}}">{{isset($obj->usersss->name) ? $obj->usersss->name : ''}}</a></p>
    @if($obj->usersss->avatar)
        <img src="{{asset('public/uploads/'.$obj->usersss->avatar)}}"/>
    @endif
</div>