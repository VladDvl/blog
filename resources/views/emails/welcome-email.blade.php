<h2>Welcome</h2>
<p>You was accepted to group: {{(isset($group->name)) ? $group->name : ''}}.</p>
<p>Now you can communicate with other participants.</p>
<p>From group: <a href="{{(isset($group->id)) ? 'http://laravel/group/' . $group->id : ''}}">{{(isset($group->name)) ? $group->name : ''}}.</a></p>