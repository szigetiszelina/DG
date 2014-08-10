<?php $this->load->view('header.php'); ?>
<div class="clear_fix">
    <div id="container">
    <?php for($i=0;$i<count($words);$i++){?>
       <div style="position:relative; float:left; height: 90px;
            width:90px; margin:3px;">
           <div id='word_<?=$i?>' class="memorize turn" data-id="<?=$words[$i]['id']?>"><?=$words[$i]['word']?></div>
            <button id='cover_<?=$i?>' class="memory_cover" data-id="<?=$words[$i]['id']?>" style="position:absolute; -webkit-backface-visibility: hidden;">
            </button>
        </div>
    <?php } ?>
    </div>
</div>
<!--<script src="<?=base_url()?>public/js/angular/MemoryController.js" type="text/javascript" ></script>
<script src="<?=base_url()?>public/js/angular/ModalDialogDirective.js" type="text/javascript" ></script>-->
<script src="http://localhost/dg/public/js/memory.js" type="text/javascript"></script>
