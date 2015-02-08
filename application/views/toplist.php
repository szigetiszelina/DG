<?php $this->load->view('header.php'); ?>
    <div id="container" class="col-lg-7 col-md-7 col-sm-7">
        <h1>Toplisták</h1>
        <h2>Pontszámod barátaidhoz képest</h2>
        <?php if(count($friend_score_list)>0){ ?>
            <ul class="toplist">
            <?php for($i=0; $i<count($friend_score_list); $i++){?>
                <li>
                    <div><?= ($i+1)."." ?>
                    <img src="<?= $friend_score_list[$i]['profil_image']?>" />
                    <span><?= $friend_score_list[$i]['name']?></span>
                    <span class="score">
                        <?= $friend_score_list[$i]['score']!=null?$friend_score_list[$i]['score']:0 ?>
                    </span>
                    </div>
                </li>
            <?php } ?>
            </ul>
            <button class="share_button" type="submit" btn="" btn-block="" btn-social="">Megosztás</button>
        <?php } else {?>
        <p>Nincs eredmény.</p>
        <?php } ?>
        
       
        <!--
        <?php /* if(count($words_score_toplist)>0){ ?>
            <ul class="toplist">
            <?php for($i=0; $i<count($words_score_toplist); $i++){?>
                <li>
                    <div><?= ($i+1)."." ?>
                    <img src="<?= $words_score_toplist[$i]['profil_image']?>" />
                    <span><?= $words_score_toplist[$i]['name']?></span>
                    <span class="score">
                        <?= $words_score_toplist[$i]['score']!=null?$words_score_toplist[$i]['score']:0 ?>
                    </span>
                    </div>
                </li>
            <?php } ?>
            </ul>
        <?php } else {?>
        <p>Nincs eredmény.</p>
        <?php } */ ?> -->
        
        <h2>Mai toplistások</h2>
        <?php if(count($daily_toplist)>0){ ?>
            <ul class="toplist">
            <?php for($i=0; $i<count($daily_toplist); $i++){?>
                <li>
                    <div><?= ($i+1)."." ?>
                    <img src="<?= $daily_toplist[$i]['profil_image']?>" />
                    <span><?= $daily_toplist[$i]['name']?></span>
                    <?php if($daily_toplist[$i]['score']!=null){ ?>
                        <span class="score"><?= $daily_toplist[$i]['score'] ?></span>
                    <?php } ?>
                    </div>
                </li>
            <?php } ?>
            </ul>
        <?php } else {?>
        <p>Nincs eredmény.</p>
        <?php } ?>
        
        <h2>Ehavi toplistások</h2>
        <?php if(count($monthly_toplist)>0){ ?>
            <ul class="toplist">
            <?php for($i=0; $i<count($monthly_toplist); $i++){?>
                <li>
                    <div><?= ($i+1)."." ?>
                    <img src="<?= $monthly_toplist[$i]['profil_image']?>" />
                    <span><?= $monthly_toplist[$i]['name']?></span>
                    <?php if($monthly_toplist[$i]['score']!=null){ ?>
                        <span class="score"><?= $monthly_toplist[$i]['score'] ?></span>
                    <?php } ?>
                    </div>
                </li>
            <?php } ?>
            </ul>
        <?php } else {?>
        <p>Nincs eredmény.</p>
        <?php } ?>
        
         <h2>A legtöbb szót tudók</h2>
        Még nincs kész
    </div>
</div><!--row -->
<?php $this->load->view('footer.php'); ?>