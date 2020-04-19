var socket = io.connect('http://localhost:3003');
socket.on('connect', function () {
    console.log('connected');
});
socket.on('echo', function (rows) {
    //var html = JSON.stringify(rows);
    console.log('socket on');
    //document.getElementById("display").innerHTML = html;
    //console.log(rows);
    var block = document.getElementById("display");
    var removable = document.querySelectorAll(".chat-message").forEach( el => el.remove() );
    for( i in rows )
    {
        var body = rows[i].body;
        var sender_id = rows[i].sender_id;
        var name = rows[i].name;
        var avatar = rows[i].avatar;
        var created_at = rows[i].created_at;

        var date = new Date(created_at);
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var time = hours + ':' + minutes;

        console.log(sender_id, name, body, avatar, created_at);

        var p_info = document.createElement('p');
        p_info.classList.add("text-muted");
        p_info.classList.add("msg-info");
        var msg_a = document.createElement('a');
        msg_a.setAttribute("href", "http://laravel/user/${sender_id}");
        var span_name = document.createElement('span');
        span_name.classList.add("name");
        span_name.innerHTML = name;
        msg_a.append(span_name);
        var span_time = document.createElement('span');
        span_time.classList.add("time");
        span_time.innerHTML = time;
        p_info.append(msg_a);
        p_info.append(span_time);
        var p_body = document.createElement('p');
        p_body.classList.add("message-body");
        p_body.innerHTML = body;
        var div_msg = document.createElement('div');
        div_msg.classList.add("chat-message");
        div_msg.append(p_info);
        div_msg.appendChild(p_body);

        block.appendChild(div_msg);
    }
});