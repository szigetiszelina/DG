<?php $this->load->view('header.php'); ?>
        <div id="container" class="col-md-7">
            <div id="question">
                <div style="float:left; margin:3px;">
                    {{question.question}} <br>
                    <div ng-repeat="alternat in question.alternatives">                            
                        <input type="radio" ng-model="$parent.answer" value="{{alternat}}"><span  >{{alternat}}</span> <br/>
                    </div>
                    <button ng-click="checkAnswer()">Tovább</button>
                </div>
                <modal-dialog id="eredmenyek" show='modalShown' width='60%' height='60%'>
                    <div ng-show='modalShown'>
                        <p>{{scoreMessage}}<p>
                            {{questions}}
                            <button ng-click='showAlert()'>Ok</button>
                            <button ng-click='hidePopup()'>Mégse</button>
                    </div>
                </modal-dialog>
            </div>
            <div id="experiment" ng-app="dg" ng-controller="QuizController">
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
        </div>
        <script src="<?= base_url() ?>public/js/experiment.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/QuizController.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
    </div>
    <div class="col-md-2">
        Toplisták
    </div>
</div>

<!--<script src="../public/js/quiz.js" type="text/javascript"></script>-->
<?php $this->load->view('footer.php'); ?>