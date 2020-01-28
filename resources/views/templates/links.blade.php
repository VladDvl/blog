<div id="template-post-meta" class="row justify-content-between pb-4 mb-4 border-bottom container">
    <p class="blog-post-meta">{{__('menu.Author')}}: <a href="{{(isset($one->postss->author_id)) ? $one->postss->author_id : ''}}">{{isset($one->userss->name) ? $one->userss->name : ''}}</a></p>
    <p class="blog-post-meta">{{__('menu.Comments')}}: {{(isset($one->comments)) ? $one->comments : ''}}</p>
    <p class="blog-post-meta">{{__('menu.Published')}}: {{(isset($one->created_at)) ? $one->created_at : ''}}</p>
</div>