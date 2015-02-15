dg.directive('shareFacebookButton', function() {
    return {
        restrict: 'E',
        scope: {
                message: '='
        },
        replace: true,
        controller: function($scope, $http, $timeout) {
            $scope.modalShow = false;
            $scope.confirm = false;
            $scope.confirm_post = function(){
                $scope.confirm = true;
                $scope.post();
            };
            $scope.hideModal = function() {
                $scope.modalShow = false;
                $scope.confirm = false;
            };
            $scope.post = function(){
                $scope.modalShow = true;
                $scope.modalMessage = "Biztosan megosztod?";
                if($scope.confirm){
                    $http({
                        url:'/DG/facebook_post/share_on_facebook',
                        data: $.param({
                            message: $scope.message
                        }),
                        method:'POST',
                        headers: {"Content-Type": "application/x-www-form-urlencoded"}}
                    ).success(function(){
                        $scope.modalMessage="Sikeres megosztás";
                        $timeout($scope.hideModal, 2000);
                    }).error(function() {
                        alert("Hiba történt a posztolás közben.");
                    });
                }
            };
        },
        template: '<div><button class="share_button" ng-click="post()" type="submit">Megosztás</button>' + 
                  '<modal-dialog show="modalShow" error-type="error" width="60%" height="40%">{{modalMessage}}<div ng-hide="confirm" class="confirm_buttons"><button ng-click="confirm_post()">Igen</button><button ng-click="hideModal()">Mégse</button></div></modal-dialog></div>'
    };
});
