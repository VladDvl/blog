<div id="template-post-meta-com" class="comment-post col-md-2 justify-content-between pb-4 mb-4 border-bottom container">
    <p class="blog-post-meta">Автор: <a href="{{(isset($one->author_id)) ? $one->author_id : ''}}">{{isset($obj->usersss->name) ? $obj->usersss->name : ''}}</a></p>
    @if($obj->usersss->avatar)
        <img width="100px" height="100px" src="{{asset('public/uploads/'.$obj->usersss->avatar)}}"/>
    @endif
</div>