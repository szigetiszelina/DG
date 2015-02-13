dg.directive('shareFacebookButton', function() {
    return {
        restrict: 'E',
        scope: {
                message: '='
        },
        replace: true,
        controller: function($scope, $http) {
            $scope.post = function(){
                $http({
                    url:'/DG/facebook_post/share_on_facebook',
                    data: $.param({
                        message: $scope.message
                    }),
                    method:'POST',
                    headers: {"Content-Type": "application/x-www-form-urlencoded"}}
                ).error(function() {
                    alert("Hiba történt a posztolás közben.");
                });
            };
        },
        template: '<button class="share_button" ng-click="post()" type="submit">Megosztás</button>'
    };
});
