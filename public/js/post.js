var hide_actions = document.querySelectorAll('.hide-action');
//console.log(hide_actions.length);
hide_actions.forEach(function(hide_item) {
hide_item.onclick = function() {
    if(confirm('Скрыть комментарий?')) {
        return true;
    } else {
        return false;
    }
}
});

var show_actions = document.querySelectorAll('.show-action');
//console.log(hide_actions.length);
show_actions.forEach(function(show_item) {
show_item.onclick = function() {
    if(confirm('Показать комментарий?')) {
        return true;
    } else {
        return false;
    }
}
});

$('.tagss').hide();

$(function(){
    var fx = {
        'initModal' : function() {
            if($('.modal-window-post').length == 0) {
                $('<div>').attr('id', 'jquery-overlay').fadeIn('slow').appendTo('body');
                return $('<div>').addClass('modal-window-post').appendTo('body');
            } else {
                return $('.modal-window-post');
            }
        }
    }

    $('.modal-link').click(function() {
        modal = fx.initModal();
        $('.tagss').toggle();
        data = $('.tagss');
        modal.append(data);
        $('<a>').attr('href','#').addClass('modal-window-close').html('&times').click(function(event) {
            event.preventDefault();

            main = $('.blog-main');
            data = $('.tagss');
            main.append(data);
            data.hide();

            $(modal).remove();
            $('#jquery-overlay').remove();
        }).appendTo(modal);
    });
})