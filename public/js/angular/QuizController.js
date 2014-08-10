var dg = angular.module('dg',[]);

dg.controller('QuizController',['$scope',"$http", '$location', function ($scope, $http, $location) {
    $scope.score = 0;
    $scope.index = 0;
    $http.get('Play/get_questions' + document.location.search).success( function(data){
        $scope.questions = data;
        $scope.question = $scope.questions[$scope.index];
    }).error( function(){
        alert("hiba a lekérésben");
    });

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
                $http.post('Play/save_results' + document.location.search).success( function(data){
                    $scope.questions = data;
                    $scope.question = $scope.questions[$scope.index];
                }).error( function(){
                    alert("hiba a lekérésben");
                });
                $scope.toggleModal();
            }
        }else{
            alert("Nem adtál válszt!");
        }
    };
}]);