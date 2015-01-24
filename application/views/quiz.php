<?php $this->load->view('header.php'); ?>
<div id="container" class="empty-style col-lg-7 col-md-7 col-sm-8">
    <div ng-app="dg" ng-controller="QuizController">
        <h2 class="title_center">{{index}}/{{questions.length}} kérdés</h2>
        <div id="experiment">
            <div id="cube">
                <div class="face one">

                </div>
                <div class="face two">
                    {{question.question}} <br>
                    <div ng-repeat="alternat in question.alternatives">
                        <input type="radio" ng-model="$parent.answer" value="{{alternat}}"><span  >{{alternat}}</span> <br/>
                    </div>
                    <button ng-click="checkAnswer()">Tovább</button>
                </div>
                <div class="face three">
                    {{question.question}} <br>
                    <div ng-repeat="alternat in question.alternatives">
                        <input type="radio" ng-model="$parent.answer" value="{{alternat}}"><span  >{{alternat}}</span> <br/>
                    </div>
                    <button ng-click="checkAnswer()">Tovább</button>
                </div>
                <div class="face four">
                    {{question.question}} <br>
                    <div ng-repeat="alternat in question.alternatives">
                        <input type="radio" ng-model="$parent.answer" value="{{alternat}}"><span  >{{alternat}}</span> <br/>
                    </div>
                    <button ng-click="checkAnswer()">Tovább</button>
                </div>
                <div class="face five">
                    {{question.question}} <br>
                    <div ng-repeat="alternat in question.alternatives">
                        <input type="radio" ng-model="$parent.answer" value="{{alternat}}"><span  >{{alternat}}</span> <br/>
                    </div>
                    <button ng-click="checkAnswer()">Tovább</button>
                </div>
                <div class="face six">

                </div>
            </div>
        </div>
        <?php $this->load->view('modaldialog.php'); ?>
        <script src="<?= base_url() ?>public/js/experiment.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/QuizController.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
    </div>
</div>
<div class="col-lg-2 col-md-4 col-sm-5">
    Toplisták
</div>
</div><!--row -->

<?php $this->load->view('footer.php'); ?>