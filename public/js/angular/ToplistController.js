dg.controller('ToplistController', ['$scope', '$http', function($scope, $http) {
    $scope.modelShow = false;
    $scope.error = false;
    $http({url: '/DG/toplist/get_toplist_data_json',
        method: "GET"}).success(function(data) {
        if (data !== '' && data !== null) {
            $scope.friend_score_list = data['friend_score_list'];
            for(var i = 0; i<$scope.friend_score_list.length; i++){
                $scope.friend_score_list[i].score = ($scope.friend_score_list[i].score!==null)?$scope.friend_score_list[i].score:0 ;
            }
            $scope.daily_toplist = data['daily_toplist'];
            $scope.monthly_toplist = data['monthly_toplist'];
            $scope.friend_score_list_post = 'Teszt üzenet';
        }
    }).error(function() {
        $scope.modalShow = true;
        $scope.error = true;
        $scope.modalMessage = "Hiba történt a toplisták lekérdezése közben.";
    });
}]);