dg.controller('QuizController', ['$scope', "$http", '$location', function($scope, $http, $location) {
        $scope.score = 0;
        $scope.index = 0;

        $http.get('play/get_questions' + document.location.search).success(function(data) {
            $scope.questions = data;
            //console.log($scope.questions);
            $scope.question = $scope.questions[$scope.index];
        }).error(function() {
            alert("hiba a kérdések lekérésében");
        });

        $scope.modalShow = false;
        $scope.setNewQuestion = function() {
            $scope.index++;
            if ($scope.answer) {
                checkAnswer();

                if ($scope.questions[$scope.index]) {
                    $scope.answer = null;
                    $scope.question = $scope.questions[$scope.index];
                    yAngle -= 90;
                    document.getElementById('cube').style[prop] = "rotateX(" + xAngle + "deg) rotateY(" + yAngle + "deg)";
                } else {
                    saveResult();
                }
            } else {
                alert("Nem adtál választ!");
            }
        };
        function saveResult() {
            var score = 0;
            if ($scope.score > 0) {
                score = ($scope.score / $scope.index) * 100;
            }
            $scope.modalMessage = 'Helyes/összes: ' + $scope.score + '/' + $scope.index + ', eredmény: ' + score + '%';
            $scope.postMessage = "Kvíz játékban " + score + "%-os eredménnyel végeztél. \n " + $scope.index + " kérdésből " + $scope.score + " kérdésre válaszoltál helyesen.";
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
        function checkAnswer() {
            if ($scope.answer === $scope.question.answer) {
                $scope.question.solution = true;
                $scope.score++;
            } else {
                $scope.question.solution = false;
            }
        }
    }]);