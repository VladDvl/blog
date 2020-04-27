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

$('.partitipants').hide();

$(function(){
    var fx = {
        'initModal' : function() {
            if($('.modal-window-group').length == 0) {
                $('<div>').attr('id', 'jquery-overlay').fadeIn('slow').appendTo('body');
                return $('<div>').addClass('modal-window-group').appendTo('body');
            } else {
                return $('.modal-window-group');
            }
        }
    }

    $('.modal-link').click(function() {
        modal = fx.initModal();
        $('.partitipants').toggle();
        data = $('.partitipants');
        modal.append(data);
        $('<a>').attr('href','#').addClass('modal-window-close').html('&times').click(function(event) {
            event.preventDefault();

            main = $('.blog-main');
            data = $('.partitipants');
            main.append(data);
            data.hide();

            $(modal).remove();
            $('#jquery-overlay').remove();
        }).appendTo(modal);
    });
})
