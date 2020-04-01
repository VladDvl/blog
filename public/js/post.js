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