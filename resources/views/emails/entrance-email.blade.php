<h2>Entrance request</h2>
<p>A new user asking you about entrace to the group.</p>
<p>From user: <a href="{{(isset($user->id)) ? 'http://laravel/user/' . $user->id : ''}}">{{(isset($user->name)) ? $user->name : ''}}.</a></p>
<p>To group: <a href="{{(isset($group->id)) ? 'http://laravel/group/' . $group->id : ''}}">{{(isset($group->name)) ? $group->name : ''}}.</a></p>