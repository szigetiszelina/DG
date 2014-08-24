var dg = angular.module('dg', []);

dg.controller('chartController', function($http) {
    var colors = ["#D88F66", "#3F7A2F", "#FF4747", "#FCF8B6", "#2F537A"];
    $http.get('get_grammars_level').success(function(data) {
        var barChart = [];
        for (var i = 0; i < data.length; i++) {
            barChart.push({grammar: data[i]['grammar'], percentLevel: ((data[i]['all_score'] / data[i]['summarize']) * 100), color: colors[i % parseInt(colors.length)]});
        }

        var chart = AmCharts.makeChart("chartdiv", {
            "theme": "chalk",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": barChart,
            "valueAxes": [{
                    "position": "left",
                    "title": "Elért eredmény (%)"
                }],
            "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "valueField": "percentLevel"
                }],
            "depth3D": 20,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "grammar",
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

        var chart2 = AmCharts.makeChart("chartdiv2", {
            "type": "serial",
            "theme": "chalk",
            "depth3D": 20,
            "angle": 30,
            "legend": {
                "horizontalGap": 10,
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": [{
                    "year": 2003,
                    "europe": 2.5,
                    "namerica": 2.5,
                    "asia": 2.1,
                    "lamerica": 1.2,
                    "meast": 0.2,
                    "africa": 0.1
                }, {
                    "year": 2004,
                    "europe": 2.6,
                    "namerica": 2.7,
                    "asia": 2.2,
                    "lamerica": 1.3,
                    "meast": 0.3,
                    "africa": 0.1
                }, {
                    "year": 2005,
                    "europe": 2.8,
                    "namerica": 2.9,
                    "asia": 2.4,
                    "lamerica": 1.4,
                    "meast": 0.3,
                    "africa": 0.1
                }],
            "valueAxes": [{
                    "stackType": "regular",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }],
            "graphs": [{
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Europe",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "europe"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "North America",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "namerica"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Asia-Pacific",
                    "type": "column",
                    "newStack": true,
                    "color": "#000000",
                    "valueField": "asia"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Latin America",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "lamerica"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Middle-East",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "meast"
                }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Africa",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "africa"
                }],
            "categoryField": "year",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
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

        var chart3 = AmCharts.makeChart("chartdiv3", {
            "type": "pie",
            "theme": "chalk",
            "titles": [{
                    "text": "Visitors countries",
                    "size": 16
                }],
            "dataProvider": [{
                    "country": "United States",
                    "visits": 7252
                }, {
                    "country": "China",
                    "visits": 3882
                }, {
                    "country": "Japan",
                    "visits": 1809
                }, {
                    "country": "Germany",
                    "visits": 1322
                }, {
                    "country": "United Kingdom",
                    "visits": 1122
                }, {
                    "country": "France",
                    "visits": 414
                }, {
                    "country": "India",
                    "visits": 384
                }, {
                    "country": "Spain",
                    "visits": 211
                }],
            "valueField": "visits",
            "titleField": "country",
            "startEffect": "elastic",
            "startDuration": 2,
            "labelRadius": 15,
            "innerRadius": "50%",
            "depth3D": 10,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
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
            "dataProvider": [{
                    "country": "Lithuania",
                    "value": 260
                }, {
                    "country": "Ireland",
                    "value": 201
                }, {
                    "country": "Germany",
                    "value": 65
                }, {
                    "country": "Australia",
                    "value": 39
                }, {
                    "country": "UK",
                    "value": 19
                }, {
                    "country": "Latvia",
                    "value": 10
                }],
            "valueField": "value",
            "titleField": "country",
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
        alert("hiba a mondatok lekérésében");
    });

});