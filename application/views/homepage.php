<?php $this->load->view('header.php'); ?>
    <div id="container" class="col-lg-7 col-md-7 col-sm-7 <?= (($is_login==false)?' align-center':'') ?>">
         <?php if($is_login && $name != null){ ?>
            <h3>Üdvözlünk <?= $name ?>!</h3>
            <p class="paragraph">
                Játsz ma is a Német nyelvgyakorlóval. Tartsd karban és fejleszd tudásod minden nap.<br>
                Mérd össze tudásod ismerőseiddel és a DG legprofibb játékosaival.
            </p>
            <p class="paragraph">
                Ez az oldal azért jött létre, hogy megkönnyítse a német nyelv elsajátítását. Ebben játékos gyakorlatokkal igyekszünk segíteni neked. 
                A játékok során figyeljük fejlődésedet, így a szavak tanulása is hatékony és változatos lesz. A szavakat kategorizáltuk és gyakoriságuk szerint rendeztük, hogy fontossági sorrendbe tanulhasd meg. Fejlődésedet és eredményeidet te magad is nyomon követheted az eredmények menüpont alatt.
            </p>
            <p> Kellemes tanulást kívánunk!</p>
        <?php }else{ ?>
            <h3>Kedves nyelvtanuló!</h3>
            <p class="paragraph">
                Ez az oldal azért jött létre, hogy megkönnyítse a német nyelv elsajátítását. Ebben játékos gyakorlatokkal igyekszünk segíteni neked. 
                A játékok során figyeljük fejlődésedet, így a szavak tanulása is hatékony és változatos lesz. A szavakat kategorizáltuk és gyakoriságuk szerint rendeztük, hogy fontossági sorrendbe tanulhasd meg. Fejlődésedet és eredményeidet te magad is nyomon követheted az eredmények menüpont alatt.
            </p>
            <p> Kellemes tanulást kívánunk!</p>
        <?php } ?>
    </div>
    <?php if($is_login){ ?>
        <div class="col-lg-2 col-md-4 col-sm-5">
            <?php $this->load->view('toplist_box.html'); ?>
        </div>
    <?php } ?>
<?php $this->load->view('footer.php'); ?>
