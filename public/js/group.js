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