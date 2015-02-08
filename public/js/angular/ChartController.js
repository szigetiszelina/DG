dg.controller('chartController', ['$http','$scope', function($http, $scope) {
    var colors = ["#D88F66", "#3F7A2F", "#FF4747", "#FCF8B6", "#2F537A"];
    var months = ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"];
    $scope.months = [];
    for(var i = 1; i<13; i++){
        $scope.months.push({id:i,text:months[i-1]});
    }
        
    $scope.selectable_years = [""];
    var current_year = new Date().getFullYear();
    for(var i = current_year; i>= 2014; i--){
        $scope.selectable_years.push(i);
    }
    
    $scope.createChart = function (itemName, title, barChart){ AmCharts.makeChart(itemName, {
            "theme": "chalk",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": barChart,
            "valueAxes": [{
                    "position": "left",
                    "title": title
                }],
            "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "valueField": "value"
                }],
            "depth3D": 20,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "label",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90
            },
            "exportConfig": {
                "menuTop": "20px",
                "menuRight": "20px",
                "menuItems": [{
                        "icon": '/lib/3/images/export.png',
                        "format": 'png'
                    }]
            }
        });
    }
    $http.get('get_grammars_level').success(function(data) {
        var barChart = [];
        var title = "Elért eredmény (%)";
        var itemName = "chartdiv";
        for (var i = 0; i < data.length; i++) {
            barChart.push({
                label: data[i]['grammar'],
                value: ((data[i]['all_score'] / data[i]['summarize']) * 100),
                color: colors[i % parseInt(colors.length)]});
        }
        $scope.createChart(itemName, title, barChart);
    }).error(function() {
        alert("hiba az eredmények lekérésében");
    });
    
    $http.get('get_this_month_result').success(function(data) {
        
        //játék nyelvtan eredmény
        var barChart3 = [];
        for (var i = 0; i < data.length; i++) {
            barChart3.push({
                title: data[i]['hu_name'] + " - " + data[i]['name'],
                score: ((data[i]['score'] / (data[i]['db']*100))*100),
            });
        }
        var monthNumber = new Date().getMonth();
        var month = months[monthNumber];
        
        var chart3 = AmCharts.makeChart("chartdiv3", {
            "type": "pie",
            "theme": "chalk",
            "titles": [{
                    "text": month + " eredményei játék és nyelvtan szerinti felbontásban",
                    "size": 16
                }],
            "dataProvider": barChart3,
            "valueField": "score",
            "titleField": "title",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 5,
            "fontSize" : 14,
            "maxLabelWidth" : "200",
            "innerRadius": "50%",
            "depth3D": 10,
            "angle": 15,
            "exportConfig": {
                menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
            }
        });

        var chart4 = AmCharts.makeChart("chartdiv4", {
            "type": "pie",
            "theme": "chalk",
            "dataProvider": barChart3,
            "valueField": "percentLevel",
            "titleField": "grammar",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "exportConfig": {
                menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
            }
        });
    }).error(function() {
        alert("hiba az eredmények lekérésében");
    });
    $scope.refresh_monthly = function (){
        $http({
            url: 'get_monthly_result', 
            method: "GET",
            params: {year: $scope.year_monthly}
        }).success(function(data) {
            console.log(data);
            if($scope.year_monthly == null){
                $scope.year_monthly = new Date().getFullYear();
            }
            var barChart = [];
            var itemName = "chartdiv5";
            var title = "Elért összpontszám " + $scope.year_monthly;
            for (var i = 0; i < data.length; i++) {
                barChart.push({
                    value: data[i]['all_score'],
                    label: months[data[i]['month']-1],
                    color: colors[i % parseInt(colors.length)]});
            }
            $scope.createChart(itemName, title, barChart);
    /*
            var chart5 = AmCharts.makeChart("chartdiv5", {
                "theme": "chalk",
                "type": "serial",
                "startDuration": 2,
                "dataProvider": barChart,
                "valueAxes": [{
                        "position": "left",
                        "title": "Elért összpontszám " + $scope.year
                    }],
                "graphs": [{
                        "balloonText": "[[category]]: <b>[[value]]</b>",
                        "colorField": "color",
                        "fillAlphas": 0.8,
                        "lineAlpha": 0.1,
                        "type": "column",
                        "valueField": "all_score"
                    }],
                "depth3D": 20,
                "angle": 30,
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "month",
                "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 90
                },
                "exportConfig": {
                    "menuTop": "20px",
                    "menuRight": "20px",
                    "menuItems": [{
                            "icon": '/lib/3/images/export.png',
                            "format": 'png'
                        }]
                }
            });*/
        }).error(function() {
            alert("hiba az eredmények lekérésében");
        });
    };
    $scope.refresh_daily = function (){
        $http({
            url: 'get_daily_result', 
            method: "GET",
            params: {year: $scope.year_daily, month: $scope.month_daily}
        }).success(function(data) {
            if(data != null && data.length >0){
                if($scope.year_daily == null){
                    $scope.year_daily = new Date().getFullYear();
                }
                if($scope.month_daily == null){
                    $scope.month_daily = new Date().getMonth()+1;
                }
                var barChart = [];
                var itemName = "chartdiv6";
                var title = "Elért összpontszám " + $scope.year_daily + " " + $scope.month_daily + ". hó";
                for (var i = 0; i < data.length; i++) {
                    barChart.push({
                        value: data[i]['all_score'],
                        label: data[i]['day'],
                        color: colors[i % parseInt(colors.length)]});
                }
                $scope.createChart(itemName, title, barChart);
            } else{
                angular.element("#chartdiv6").html("<span class='chartMessage'>Nincs eredmény a megadott hónapban.</span>");
            }
        }).error(function() {
            alert("hiba az eredmények lekérésében");
        }); 
    };
    
    $scope.refresh_daily();
    $scope.refresh_monthly();
}]);