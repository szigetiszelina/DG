/*var dg = angular.module('dg',[]);

dg.controller('MemoryController',['$scope',"$http", '$location', function ($scope, $http, $location) {
    $scope.score = 0;
    $scope.start = new Date();
    
    $http.get('Play/get_words' + document.location.search).success( function(data){ console.log(data)
        $scope.memory_words = data;
    }).error( function(){
        alert("hiba a lekérésben");
    });
    $scope.turn_on = function(item){ console.log(this);
       this.addClass('turn');
       // $('#word_'+$(this).attr('id').replace('cover_','')).removeClass('turn');
    };
    $scope.turn_off = function(item){ console.log(item);
        $('#cover_'+item.attr('id').replace('word_','')).removeClass('turn');
        item.addClass('turn');
    };
    
    $scope.memory_cover_click = function(){        
        if($('.memorize').not('.turn').length===0){
           $scope.turn_on($(this));
        } else { 
            if($('.memorize').not('.turn').length===1){
                $scope.turn_on($(this));
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
                       $scope.turn_off(items[0]);
                       $scope.turn_off(items[1]);
                    },2000);                    
                }
            }
        }
    };
    
    $scope.showAlert= function(){
        alert("Okét nyomtál");
    }
    $scope.hidePopup= function(){
            $scope.modalShown = false;
    }
    $scope.modalShown = false;
    $scope.toggleModal = function() {
        $scope.modalShown = !$scope.modalShown;
    };
    $scope.checkAnswer = function(){
        $scope.index++;
        if($scope.answer){
            if($scope.answer === $scope.question.answer) {
                $scope.score++;
            }
            if($scope.questions[$scope.index]){
              $scope.answer = null;
              $scope.question = $scope.questions[$scope.index];
            } else {
                $scope.scoreMessage="Gratulálunk a pontjaid: "+$scope.index+'/'+$scope.score;
               /* $http.post('Play/save_results' + document.location.search).success( function(data){
                    $scope.questions = data;
                    $scope.question = $scope.questions[$scope.index];
                }).error( function(){
                    alert("hiba a lekérésben");
                });*/
   /*             $scope.toggleModal();
            }
        }else{
            alert("Nem adtál válszt!");
        }
    };
}]);*/