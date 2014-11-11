<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <title>NémetNyelvtangyakorló</title>
        <script src="<?=base_url()?>public/js/prefixfree.min.js"></script>
        <script src="<?=base_url()?>/public/js/jquery-1.9.1.js"></script>
        <link rel="shortcut icon" href="<?=base_url()?>/public/images/logo.png" />
        <link rel="icon" type="image/png" href="<?=base_url()?>/public/images/logo.png" />
        <link rel="stylesheet" href="<?=base_url()?>public/css/normalize.css" type="text/css" />
        <link rel="stylesheet" href="<?=base_url()?>public/bootstrap/css/bootstrap.css" type="text/css" />
        <!--<link rel="stylesheet" href="<?=base_url()?>public/css/main.css" type="text/css" />-->
        <!--<link rel="stylesheet" href="<?=base_url()?>public/css/style.css" type="text/css" />-->
        <link rel="stylesheet" href="<?=base_url()?>public/css/design.css" type="text/css" />
        <script src="<?=base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-4"><div class="logo">DG</div></div>
                    <div class="col-md-8 col-sm-6 col-xs-4">
                        <h1 class="title">Tanulj német nyelvtant szórakozva!</h1>
                    </div>
                    <?php if ($is_login) { ?>
                        <div class="col-md-2 col-sm-3 col-xs-4">
                            <div class="button">
                                <a href="auth/logout">Kilépés</a>
                            </div>
                        </div>
                    <?php } else { ?>
                    <div class="col-md-2 col-sm-3 col-xs-4">
                        <div class="button">
                            <a href="auth/login">Belépés</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" >
            <?php if($is_login){ ?>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <nav id="menu">
                          <?php
                              $current_url = current_url();
                              $link_to = base_url() ."games/exercise";
                          ?>                
                          <a href="<?= $link_to ?>" class="button letter2 <?=($link_to==$current_url)?'active_button':'' ?>" ><p>Gyakorolj</p></a>
                          <?php $link_to = base_url() ."games/evelove"; ?>
                          <a href="<?= $link_to ?>" class="button letter5 <?=($link_to==$current_url)?'active_button':'' ?>" ><p>Fejlődj</p></a>
                           <?php $link_to = base_url() ."grammars/index"; ?>
                          <a href="<?= $link_to ?>" class="button letter1 <?=($link_to==$current_url)?'active_button':'' ?>" ><p>Nyelvtanok</p></a>
                           <?php $link_to = base_url() ."toplist/index"; ?>
                          <a href="<?= $link_to ?>" class="button letter4 <?=($link_to==$current_url)?'active_button':'' ?>"><p>Toplisták</p></a>
                          <?php $link_to = base_url() ."achievements/index"; ?>
                          <a href="<?= $link_to ?>" class="button letter3 <?=($link_to==$current_url)?'active_button':'' ?>"><p>Eredmények</p></a>
                    </nav>
                </div>
               <?php } ?>         
      