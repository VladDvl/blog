<div id="template-post-meta" class="row justify-content-between pb-4 mb-4 border-bottom container">
    <p class="blog-post-meta">{{__('menu.Loads')}}: {{(isset($one->loads)) ? $one->loads : ''}}</p>
    <p class="blog-post-meta">{{__('menu.Published')}}: {{(isset($one->created_at)) ? $one->created_at : ''}}</p>
</div>