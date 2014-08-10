<?php $this->load->view('header.php'); ?>
<div class="clear_fix">
    <div id="container" >
        <?php /*var_dump($sentences) */?>
        <div ng-app="dg" ng-controller="sortController" class="container">
        <div class="floatleft">
          <ul ui-sortable="sortableOptions" ng-model="list" class="list">
            <li ng-repeat="item in list" class="item">
              {{item.text}}
            </li>
          </ul>
        </div>
        <?php /* foreach($sentences[0]['sentence'] as $sentence_part){ ?>
                    <li class="item">
                        <?= $sentence_part ?>
                    </li>
        <?php } */?>
        <div class="floatleft" style="margin-left: 20px;">
          <ul class="list logList">
            <li ng-repeat="entry in sortingLog track by $index" class="logItem">
              {{entry}}
            </li>
          </ul>
        </div>

        <div class="clear"></div>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://rawgithub.com/angular-ui/ui-sortable/master/src/sortable.js"></script>        
        <script src="<?=base_url()?>public/js/angular/SortController.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
    </div>
</div>

<!--<script src="../public/js/quiz.js" type="text/javascript"></script>-->
<?php $this->load->view('footer.php'); ?>