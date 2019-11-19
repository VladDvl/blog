$(function(){
    var fx = {                      //объект модального окна
        'initModal' : function() {
            if($('.modal-window').length == 0) {    //создать или вывести модальное окно
                $('<div>').attr('id', 'jquery-overlay').fadeIn('slow').appendTo('body');
                return $('<div>').addClass('modal-window').appendTo('body');
            } else {
                return $('.modal-window');
            }
        }       //дальше через запятую можно другие функции
    }

    $('.my-link').click(function() {
        var id = $(this).attr('data-id');
        modal = fx.initModal(); //объектный литерал
        $('<a>').attr('href','#').addClass('modal-window-close').html('&times').click(function(event) { /*кнопка закрытия окна*/
            event.preventDefault();
            $(modal).remove();
            $('#jquery-overlay').remove();
        }).appendTo(modal);
    });
})