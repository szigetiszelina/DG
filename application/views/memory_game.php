<?php $this->load->view('header.php');?>
    <div id="container" class="col-lg-7 col-md-7 col-sm-7">
        <div class="row" />
            <?php for($i=0;$i<count($words);$i++){?>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="height: 105px;">
                    <div class="memory_wrapper" >
                        <div id='word_<?= $i ?>' class="memorize turn" data-id="<?= $words[$i]['id'] ?>"><div class="vertical_center"><?= $words[$i]['word'] ?></div></div>
                        <button id='cover_<?= $i ?>' class="memory_cover" data-id="<?= $words[$i]['id'] ?>">
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-5">
    </div>
</div>
<!--<script src="<?=base_url()?>public/js/angular/MemoryController.js" type="text/javascript" ></script>
<script src="<?=base_url()?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>-->
<script src="<?=base_url()?>public/js/memory.js" type="text/javascript"></script>
