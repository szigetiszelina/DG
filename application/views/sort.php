<?php $this->load->view('header.php'); ?>
    <div id="container" class="col-lg-7 col-md-7 col-sm-7">
        <div ng-controller="SortController">
            <div class="row">
                <div class="col-lg-5">
                    <ul ui-sortable="sortableOptions" ng-model="sentence" class="list">
                        <li ng-repeat="item in sentence" class="item">
                            {{item.text}}
                        </li>
                    </ul>
                    <div class="button paragraph" ng-hide="buttonDisabled" >
                        <a href="#" ng-click="nextSentence()">Tovább</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <ul class="list logList">
                        <li ng-repeat="entry in sortingLog track by $index" class="logItem">
                            {{entry}}
                        </li>
                    </ul>
                </div>
            </div>
            <?php $this->load->view('modaldialog.php'); ?>
            
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>       
            <script src="<?= base_url() ?>public/js/angular/SortController.js" type="text/javascript" ></script>
            <script src="<?= base_url() ?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-5">
    </div>
    </div><!--row -->
    <?php $this->load->view('footer.php'); ?>