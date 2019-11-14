<div class="row justify-content-between pb-4 mb-4 border-bottom container">
    <p class="blog-post-meta">Автор: <a href="{{(isset($one->author_id)) ? $one->author_id : ''}}">{{isset($one->userss->name) ? $one->userss->name : ''}}</a></p>
    <p class="blog-post-meta">Опубликовано: {{(isset($one->created_at)) ? $one->created_at : ''}}</p>
</div>