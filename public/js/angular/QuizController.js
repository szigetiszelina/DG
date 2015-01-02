var dg = angular.module('dg', []);

dg.controller('QuizController', ['$scope', "$http", '$location', function($scope, $http, $location) {
        $scope.score = 0;
        $scope.index = 0;

        $http.get('play/get_questions' + document.location.search).success(function(data) {
            $scope.questions = data;
            console.log($scope.questions);
            $scope.question = $scope.questions[$scope.index];
        }).error(function() {
            alert("hiba a kérdések lekérésében");
        });

       /* $http({ //így megy a poszt
            url: 'Play/save_word_results',
            data: $.param({
                words: [
                    {"id": 15, "guessed_well": true},
                    {"id": 20, "guessed_well": false}
                ]}),
            method: 'POST',
            headers: {"Content-Type": "application/x-www-form-urlencoded"}}
        ).success(function(data) {
            if (data == 'ok') {
                alert("mentve");
            }
        }).error(function() {
            alert("hiba a szavak eredményének mentésében");
        });*/

        $scope.modalShow = false;
        
        $scope.checkAnswer = function() {
            $scope.index++;
            if ($scope.answer) {
                if ($scope.answer === $scope.question.answer) {
                    $scope.question.solution = true;
                    $scope.score++;
                } else {
                    $scope.question.solution = false;
                }
                if ($scope.questions[$scope.index]) {
                    $scope.answer = null;
                    $scope.question = $scope.questions[$scope.index];
                    yAngle -= 90;
                    document.getElementById('cube').style[prop] = "rotateX("+xAngle+"deg) rotateY("+yAngle+"deg)";
                } else {
                    console.log('index'+$scope.index);
                    //alert($scope.scoreMessage + "megoldasok: "+$scope.questions);
                    var score = 0;
                    if ($scope.score > 0) {
                        score = ($scope.score / $scope.index) * 100;
                    }
                    $scope.modalMessage = 'Helyes/összes: ' + $scope.score + '/' + $scope.index  + ', eredmény: '+ score +'%';
                    $scope.modalShow = true;
                    $http({url: 'play/save_results' + document.location.search + '&score=' + score,
                        method: "GET"}).success(function(data) {
                        if (data == 'ok') {
                            $scope.questions = data;
                            $scope.question = $scope.questions[$scope.index];
                        }
                    }).error(function() {
                        alert("hiba a játék eredményének mentésében");
                    });
                }
            } else {
                alert("Nem adtál választ!");
            }
        };
    }]);