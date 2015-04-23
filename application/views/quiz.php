<?php $this->load->view('header.php'); ?>
<div id="container" class="empty-style col-lg-7 col-md-7 col-sm-8">
    <div ng-controller="QuizController">
        <h2 class="title_center" ng-hide="error">{{index}}/{{questions.length}} kérdés</h2>
        <div id="experiment" ng-hide="error">
            <div id="cube">
                <div class="face one">
                </div>
                <div class="face two">
                    <?php $this->load->view('question.html'); ?>
                </div>
                <div class="face three">
                    <?php $this->load->view('question.html'); ?>
                </div>
                <div class="face four">
                    <?php $this->load->view('question.html'); ?>
                </div>
                <div class="face five">
                    <?php $this->load->view('question.html'); ?>
                </div>
                <div class="face six">

                </div>
            </div>
        </div>
        <p ng-show="error">
            Ilyen kategóriában nincs gyakorolható szó. Először fejlődj a kategóriában.<br>
            Még nem fejlődtél, a gyakorláshoz először fejlődnöd kell. Gyakorolni csak az 50%-ban helyesen használt szavakat tudod.
        </p>
        <?php $this->load->view('modaldialog.php'); ?>
        <script src="<?= base_url() ?>public/js/experiment.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/QuizController.js" type="text/javascript" ></script>
        <script src="<?= base_url() ?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>
    </div>
</div>
<div class="col-lg-2 col-md-4 col-sm-5">
</div>
</div><!--row -->

<?php $this->load->view('footer.php'); ?>