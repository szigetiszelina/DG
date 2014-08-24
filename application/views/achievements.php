<div class="clear_fix">
    <div id="container" >
        <div ng-app="dg" ng-controller="chartController">
          
        </div>
        <script src="<?= base_url() ?>public/js/angular/ChartController.js" type="text/javascript" ></script>
        <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/chalk.js"></script>
        Eredményeid: <?= var_dump($achievements) ?>
<div id="chartdiv"></div>
<div id="chartdiv2"></div>
<div id="chartdiv3"></div>
<div id="chartdiv4"></div>
    </div>
</div>