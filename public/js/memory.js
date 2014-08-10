function turn_on(item){
    item.addClass('turn');
    $('#word_'+item.attr('id').replace('cover_','')).removeClass('turn');
}
function turn_off(item){
   $('#cover_'+item.attr('id').replace('word_','')).removeClass('turn');
   item.addClass('turn');
}
var start;
$(document).ready(function(){
    start = new Date;
});
$(".memory_cover").click(function(){        
    if($('.memorize').not('.turn').length===0){
       turn_on($(this));
    } else { 
        if($('.memorize').not('.turn').length===1){
            turn_on($(this));
            var ids = new Array();
            var items = new Array();
            $('.memorize').not('.turn').each(function(){ items.push($(this)); ids.push($(this).data('id'))});
            console.log(items);
            if(ids[0]===ids[1]){
                setTimeout(function(){       
                    $('#results').append('<p>'+items[0].text()+' = '+items[1].text()+'</p>');
                    $('[data-id='+ids[0]+']').remove();
                    if($('.memorize').length===0){
                        alert('Gratulálunk nyertél!'+(new Date-start)/1000+' second');
                        $.ajax({
                            type: "POST",
                            url: "Index/finish_game",
                            dataType: "JSON",
                            data: {
                                words: ids,
                                game_id: 2,
                                grammar_id: 6,
                                user_id:3                               
                            }
                          }).success(function( content ) {
                            if(content=='OK'){
                                location.reload();
                            }
                        });
                    }
                },500);
            } else {
                setTimeout(function(){
                   turn_off(items[0]);
                   turn_off(items[1]);
                },2000);                    
            }
        }
    }           
});
$(".memorize").click(function(event){ 
  turn_off($(this));
});