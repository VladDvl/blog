var ava1 = document.getElementById('input-avatar-button');
ava1.onclick = function() {
    if(confirm('Изменить аватар?')) {
        var ava1_img = document.getElementById('input-avatar-img').value;
        if( ava1_img != 0 && ava1_img != '' && ava1_img != null ) {
            //alert(ava1_img);
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }
}

var ava2 = document.getElementById('delete-avatar-button');
ava2.onclick = function() {
    if(confirm('Удалить аватар?')) {
        return true;
    } else {
        return false;
    }
}

var edit_actions = document.querySelectorAll('.edit-post-button');
//console.log(edit_actions.length);
edit_actions.forEach(function(edit_item) {
edit_item.onclick = function() {
    if(confirm('Редактировать пост?')) {
        return true;
    } else {
        return false;
    }
}
});

var del_actions = document.querySelectorAll('.delete-post-button');
//console.log(del_actions.length);
del_actions.forEach(function(del_item) {
del_item.onclick = function() {
    if(confirm('Удалить пост?')) {
        return true;
    } else {
        return false;
    }
}
});