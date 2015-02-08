    <div id="container" class="col-lg-7 col-md-7 col-sm-7">
        <div ng-controller="chartController">
            <script src="<?= base_url() ?>public/js/angular/ChartController.js" type="text/javascript" ></script>
            <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
            <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
            <script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
            <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/chalk.js"></script>
            <h3>Eredményeid nyelvtanonként csoportosítva</h3>
            <div id="chartdiv"></div>
            <!--<div id="chartdiv2"></div>-->
            <div id="chartdiv3"></div>
            <div id="chartdiv4"></div>
            <h3>Eredményeid havi felbontásban egy adott évre</h3>
            <p>Ha nem adsz meg évet, akkor az aktuális évre vonatkozóan</p>
            <select ng-model="year_monthly" ng-change="refresh_monthly()">
                <option  ng-repeat="year in selectable_years" value="{{year}}">
                    {{year}}
                </option>
            </select>
            <div id="chartdiv5"></div>


            <h3>Eredményeid napi felbontásban egy adott évre és hónapra</h3>
            <p>Ha nem adsz meg évet, akkor az aktuális évre és hónapra vonatkozóan</p>
            <select ng-model="year_daily">
                <option  ng-repeat="year in selectable_years" value="{{year}}">
                    {{year}}
                </option>
            </select>
            <select ng-model="month_daily" ng-change="refresh_daily()">
                <option  ng-repeat="month in months" text="{{month.text}}" value="{{month.id}}">
                    {{month.text}}
                </option>
            </select>
            <div id="chartdiv6"></div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-5">
        <?php $this->load->view('toplist_box.html'); ?>
    </div>
</div>