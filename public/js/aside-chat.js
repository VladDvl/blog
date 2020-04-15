var container = $('.chat-field');
    element = $('.chat-message:last-child');
    scrolled = false;
    position = element.offset().top - container.offset().top;

container.scrollTop( position );

function scrollToBottom() {
    if(!scrolled) {
        container.scrollTop( position );
    }
}

var scrollInterval = setInterval( scrollToBottom, 1000 );

$('.chat-field').on('scroll', function() {
    scrolled = true;
    clearInterval( scrollInterval );
});