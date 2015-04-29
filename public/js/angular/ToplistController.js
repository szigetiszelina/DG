dg.controller('ToplistController', ['$scope', '$http', '$location', function($scope, $http, $location) {
    $scope.modelShow = false;
    $scope.error = false;
    if (document.location.pathname == 'DG/toplist/index' || document.location.pathname == 'DG/toplist') {
        $scope.use_filter = true;
    } else {
        $scope.use_filter = false;
    }
    $http({url: '/DG/toplist/get_toplist_data_json',
        method: "GET"}).success(function(data) {
        if (data['toplist_data'] !== '' && data['toplist_data'] !== null) {
            var user_id = data['current_user'];
            if(data['toplist_data']['friend_score_list']!=='' && data['toplist_data']['friend_score_list'] !=null){
                $scope.friend_score_list = data['toplist_data']['friend_score_list'];
                if ($scope.use_filter) {
                    $scope.friend_score_list = $scope.filter_list($scope.friend_score_list, user_id);
                } else{
                    $scope.set_index($scope.friend_score_list);
                }
                for (var i = 0; i < $scope.friend_score_list.length; i++) {
                    $scope.friend_score_list[i].score = ($scope.friend_score_list[i].score !== null) ? $scope.friend_score_list[i].score : 0;
                }
                $scope.friend_score_list_post = $scope.create_fb_post_message($scope.friend_score_list, "Pontszámod barátaidhoz képest \n\n");
            } else{
                $scope.friend_score_list = false;
                $scope.friend_score_list_post = false;
            }
            if(data['toplist_data']['daily_toplist'] !=='' && data['toplist_data']['daily_toplist'] != null){
                $scope.daily_toplist = data['toplist_data']['daily_toplist'];
                if ($scope.use_filter) {
                    $scope.daily_toplist = $scope.filter_list($scope.daily_toplist, user_id);
                }else{
                    $scope.set_index($scope.daily_toplist);
                }
                $scope.daily_toplist_post = $scope.create_fb_post_message($scope.daily_toplist, "Mai toplistások \n\n");
            }else{
               $scope.daily_toplist = false;
               $scope.daily_toplist_post = false; 
            }
            if(data['toplist_data']['monthly_toplist'] !=='' && data['toplist_data']['monthly_toplist'] != null){
                $scope.monthly_toplist = data['toplist_data']['monthly_toplist'];
                if ($scope.use_filter) {
                    $scope.monthly_toplist = $scope.filter_list($scope.monthly_toplist, user_id);
                } else{
                    $scope.set_index($scope.monthly_toplist);
                }
                $scope.monthly_toplist_post = $scope.create_fb_post_message($scope.monthly_toplist, "A hónap toplistásai \n\n");
            }else{
                $scope.monthly_toplist = false;
                $scope.monthly_toplist_post = false;
            }
        }

    }).error(function() {
        $scope.modalShow = true;
        $scope.error = true;
        $scope.modalMessage = "Hiba történt a toplisták lekérdezése közben.";
    });

    $scope.filter_list = function(toplist, user_id) {
        var filtered_toplist = [];
        var user_index_in_list;
        for (var i = 0; i < toplist.length; i++) {
            toplist[i].index = i;
            if (toplist[i].id === user_id) {
                user_index_in_list = i;
            }
        }
        var first_limit = 5;
        var before_limit = 3;
        var after_limit = 3;
        if (user_index_in_list < first_limit) {
            return toplist.slice(0, first_limit + before_limit + 1 + after_limit);
        }

        if ((user_index_in_list - before_limit) < first_limit) { //ellenőrzi, hogy ne legyen átfedés az első x ember és a felhasználót megelőző y emberek között
            //after_limit += (first_limit - (user_index_in_list - before_limit));
            before_limit = before_limit - (first_limit - (user_index_in_list - before_limit));
        }
        return (toplist.slice(0, first_limit).concat(toplist.slice(user_index_in_list - before_limit, user_index_in_list)).concat(toplist.slice(user_index_in_list, user_index_in_list + after_limit + 1)));
    };

    $scope.create_fb_post_message = function(list, title) {
        var message = title;
        for (var i = 0; i < list.length; i++) {
            message += (list[i].index + 1) + ". " + list[i].name + " " + list[i].score + "\n";
        }
        return message;
    };

    $scope.set_index = function(toplist){
        if(toplist!=null){
            for (var i = 0; i < toplist.length; i++) {
                toplist[i].index = i;
            }
            return toplist;
        }
    };
}]);