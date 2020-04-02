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