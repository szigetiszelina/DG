function turn_on(item) {
    item.addClass('turn');
    $('#word_' + item.attr('id').replace('cover_', '')).removeClass('turn');
}
function turn_off(item) {
    $('#cover_' + item.attr('id').replace('word_', '')).removeClass('turn');
    item.addClass('turn');
}
var start = null;
var limit;
$(document).ready(function() {
    limit = $(".memory_cover").length/2;
});
$(".memory_cover").click(function() {
    if(start==null){
        start = new Date;
    }
    if ($('.memorize').not('.turn').length === 0) {
        turn_on($(this));
    } else {
        if ($('.memorize').not('.turn').length === 1) {
            turn_on($(this));
            var ids = new Array();
            var items = new Array();
            $('.memorize').not('.turn').each(function() {
                items.push($(this));
                ids.push($(this).data('id'))
            });
            
            if (ids[0] === ids[1]) {
                setTimeout(function() {
                    $('#results').append('<p>' + items[0].text() + ' = ' + items[1].text() + '</p>');
                    $('[data-id=' + ids[0] + ']').remove();
                    if ($('.memorize').length === 0) {
                        var score_time = (new Date - start) / 1000;
                        $.ajax({
                            type: "GET",
                            url: "play/save_memory_results"+document.location.search,
                            data: {time: score_time, limit: limit},
                            dataType: "text",
                            cache: false,
                            success:
                                    function(data) {
                                        alert('Eredményed:' + data + '%, időd:' + score_time + ' másodperc');
                                    }
                        });
                    }
                }, 500); //fél másodperc
            } else {
                setTimeout(function() {
                    turn_off(items[0]);
                    turn_off(items[1]);
                }, 2000); //2 másodperc
            }
        }
    }
});
$(".memorize").click(function(event) {
    turn_off($(this));
});
        