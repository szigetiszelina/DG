var dg = angular.module('dg', ['ui.sortable']);

dg.controller('sortController', function($scope, $http) {

    $scope.score = 0;
    $scope.index = 0;
    $http.get('Play/get_sentences' + document.location.search).success(function(data) {
        $scope.sentences = data;
        $scope.buttonDisabled = false;
        setSentence();
    }).error(function() {
        alert("hiba a mondatok lekérésében");
    });

    function setSentence() {
        $scope.sentence = [];
        if($scope.sentences[$scope.index]){
            angular.forEach($scope.sentences[$scope.index]["mixed"], function(word, key) {
                word = word.replace(".", "").replace("!", "").replace("?", "");
                $scope.sentence.push({text: word, index: key});
            });
        }else{
            $scope.buttonDisabled = true;
        }
        $scope.index++;
    }

    $scope.nextSentence = function() {
        if (checkAnswer()) {
            $scope.sortingLog.push("A sorrend helyes: " + $scope.sentences[$scope.index - 1]["sentence"]);
        }

        //save result

        setSentence();
    };

    function checkAnswer() {
        var isOrderGood = true;
        angular.forEach($scope.sentence, function(word, key) {
            if (word.index !== key) {
                isOrderGood = false;
            }
        });
        return isOrderGood;
    }

    $scope.sortingLog = [];

    $scope.sortableOptions = {
        update: function(e, ui) {
            var logEntry = $scope.sentence.map(function(i) {
                return i.index;
            });
            $scope.sortingLog.push('Update: ' + logEntry);
        },
        stop: function(e, ui) {
            $scope.sentence.map(function(i) {
                return i.index;
            });
        }
    };
});