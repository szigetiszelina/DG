var dg = angular.module('dg',['ui.sortable']);

dg.controller('sortController', function ($scope) {
  var tmpList = [];
  
  tmpList.push({text: 'Heute' + 1, value: 1});
  tmpList.push({text: 'ist' + 2, value: 2});
  tmpList.push({text: 'Montag' + 3, value: 3});
  
  $scope.list = tmpList; 
  
  $scope.sortingLog = [];
  
  $scope.sortableOptions = {
    update: function(e, ui) {
      var logEntry = tmpList.map(function(i){
        return i.value;
      }).join(', ');
      $scope.sortingLog.push('Update: ' + logEntry);
    },
    stop: function(e, ui) {
      // this callback has the changed model
      var logEntry = tmpList.map(function(i){
        return i.value;
      }).join(', ');
      $scope.sortingLog.push('Stop: ' + logEntry);
    }
  };
});