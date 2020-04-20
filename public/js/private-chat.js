var socket = io.connect('http://localhost:3003');
socket.on('connect', function () {
    console.log('connected');
});

var first_draw = true;

socket.on('echo', function (rows) {
    //var html = JSON.stringify(rows);
    console.log('socket on');

    var msg_sender = document.getElementById('sender').value;
    var msg_resiver = document.getElementById('resiver').value;
    //console.log('Dialog:', msg_sender, msg_resiver);

    for( n in rows )
    {
        if( rows[n].resiver_id == null || rows[n].group_id != null || ((rows[n].sender_id != msg_sender || rows[n].resiver_id != msg_resiver) && (rows[n].sender_id != msg_resiver || rows[n].resiver_id != msg_sender)) ) {
            delete rows[n];
        }
    }

    //console.log(rows);

    if( first_draw == true ) {
        first_draw = false;
        var timer = setTimeout(draw, 2000);
        clearTimeout(timer);
    } else {
        draw();
    }

    function draw()
    {
        var block = document.getElementById("display-private");
        var removable = document.querySelectorAll(".message").forEach( el => el.remove() );
        for( i in rows )
        {
            var body = rows[i].body;
            var sender_id = rows[i].sender_id;
            var name = rows[i].name;
            var avatar = rows[i].avatar;
            var created_at = rows[i].created_at;

            var date = new Date(created_at);
            var time = date.getFullYear() + '-' +
            ('00' + (date.getMonth()+1)).slice(-2) + '-' +
            ('00' + date.getDate()).slice(-2) + ' ' + 
            ('00' + date.getHours()).slice(-2) + ':' + 
            ('00' + date.getMinutes()).slice(-2) + ':' + 
            ('00' + date.getSeconds()).slice(-2);

            console.log(sender_id, name, body, avatar, created_at);

            var message = document.createElement('div');
            message.classList.add("message");
            var msg_div = document.createElement('div');
            msg_div.classList.add("mssg");
            var div_info = document.createElement('div');
            div_info.classList.add("justify-content-between");
            div_info.classList.add("message-info");
            var msg_author = document.createElement('div');
            msg_author.classList.add("message-author");
            var msg_a = document.createElement('a');
            var href = `http://laravel/user/${sender_id}`;
            msg_a.setAttribute("href", href);
            msg_a.innerHTML = name + ":";
            msg_author.appendChild(msg_a);
            var div_time = document.createElement('div');
            div_time.classList.add("text-muted");
            div_time.classList.add("message-time");
            div_time.innerHTML = time;
            div_info.appendChild(msg_author);
            div_info.appendChild(div_time);
            var msg_body = document.createElement('p');
            msg_body.classList.add("message-body");
            msg_body.innerHTML = body;
            msg_div.appendChild(div_info);
            msg_div.appendChild(msg_body);
            var img = document.createElement('img');
            img.classList.add("message-avatar");

            if( avatar == "" || avatar == "users/default.png" ) {
                var src = "http://laravel/public/img/default-avatar.png";
            } else {
                var src = `http://laravel/public/uploads/avatars/${avatar}`;
            }
            
            img.setAttribute("src", src);
            img.setAttribute("width", 36);
            img.setAttribute("height", 36);
            img.setAttribute("alt", "avatar");
            message.appendChild(img);
            message.appendChild(msg_div);

            block.appendChild(message);
        }
    }
});