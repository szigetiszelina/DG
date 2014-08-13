<?php $this->load->view('header.php'); ?>
<div class="clear_fix">
    <div id="container" >
       <div class="clear_fix">
            <div id="question" ng-app="dg" ng-controller="QuizController">
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
        </div>
        <script src="<?=base_url()?>public/js/angular/QuizController.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
    </div>
</div>

<!--<script src="../public/js/quiz.js" type="text/javascript"></script>-->
<?php $this->load->view('footer.php'); ?>