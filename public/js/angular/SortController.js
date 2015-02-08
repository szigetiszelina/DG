dg.controller('SortController', function($scope, $http) {
    $scope.score = 0;
    $scope.index = 0;    
    $scope.modelShow = false;
    $scope.buttonDisabled = false;
    
    $http.get('play/get_sentences' + document.location.search).success(function(data) {
        $scope.sentences = data;
        $scope.buttonDisabled = false;
        setSentence();
    }).error(function() {
        alert("hiba a mondatok lekérésében");
    });

    function setSentence() {
        $scope.sentence = [];
        if($scope.sentences[$scope.index]){
            angular.forEach($scope.sentences[$scope.index]["mixed"], function(item, key) {
                var word = item["word"].replace(".", "").replace("!", "").replace("?", "");
                $scope.sentence.push({text: word, index: item["key"]});
            });
        }else{
            $scope.buttonDisabled = true;
            finishGame();
        }
        $scope.index++;
    }

    $scope.nextSentence = function() {
        if (checkAnswer()) {
            $scope.score++;
            $scope.sortingLog.push("A sorrend helyes: " + $scope.sentences[$scope.index - 1]["sentence"]);
        }else{
            $scope.sortingLog.push("A sorrend helytelen: " + $scope.sentences[$scope.index - 1]["sentence"]); 
        }

        //save result per sentences

        setSentence();
    };
    
    function finishGame(){
        var score = 0;
        if($scope.score >0){
            score = ($scope.score/$scope.index)*100;
        }
        $scope.modalShow = true;
        $scope.modalMessage = "Helyes/összes: "+$scope.score+"/"+$scope.sentences.length + ", eredmény:" + score + "%";
        $http({url:'play/save_results' + document.location.search + '&score=' + score, method: "GET"});
    }
    
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
            //$scope.sortingLog.push('Update: ' + logEntry);
        },
        stop: function(e, ui) {
            $scope.sentence.map(function(i) {
                return i.index;
            });
        }
    };
    
});