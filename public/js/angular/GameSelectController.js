var dg = angular.module('dg', []);
dg.controller('GameSelectController', ['$scope', function($scope) {
    $scope.game_types = {};
    $scope.game_types.memory = false;
    $scope.game_types.quiz = false;
    $scope.game_types.sort = false;
    $scope.selected_game = "";
    $scope.selected_category = "";
    $scope.showGrammars = function(game_type) {
        $scope.selected_game = game_type;
        angular.forEach($scope.game_types, function(value, key) {
            if (key === game_type) {
                $scope.game_types[key] = true;
            } else {
                $scope.game_types[key] = false;
            }
        });
    };
    $scope.setCategory = function(category_id) {
        if($scope.selected_category === category_id){
            $scope.selected_category = "";
        }else{
            $scope.selected_category = category_id;
        } console.log($scope.selected_category);
    };
}]);