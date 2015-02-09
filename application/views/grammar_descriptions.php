<?php $this->load->view('header.php'); ?>
<div id="container" class="col-lg-7 col-md-7 col-sm-7 <?= (($is_login == false) ? ' align-center' : '') ?>">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h1>Névelők</h1>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?php $this->load->view('articles.php'); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h1>Igeragozás</h1>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <?php $this->load->view('verbs.php'); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h1>Szórend</h1>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <?php $this->load->view('word_order.html'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($is_login) { ?>
    <div class="col-lg-2 col-md-4 col-sm-5">
        <?php $this->load->view('toplist_box.html'); ?>
    </div>
<?php } ?>
</div><!--row -->
<?php $this->load->view('footer.php'); ?>
