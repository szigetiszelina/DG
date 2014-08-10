<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <title>NémetNyelvtangyakorló</title>
       <!-- <script src="http://code.jquery.com/jquery-2.0.0.js"></script> -->
        <script src="<?=base_url()?>/public/js/jquery-1.9.1.js"></script>
        <link rel="stylesheet" href="<?=base_url()?>public/css/normalize.css" type="text/css" />
        <!--<link rel="stylesheet" href="<?=base_url()?>public/bootstrap/css/bootstrap.css" type="text/css" />-->
        <link rel="stylesheet" href="<?=base_url()?>public/css/main.css" type="text/css" />
        <link rel="stylesheet" href="<?=base_url()?>public/css/style.css" type="text/css" />
        <script src="<?=base_url()?>public/js/prefixfree.min.js"></script>
        <script src="<?=base_url()?>public/bootsrap/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js" type="text/javascript"></script>
       <!-- <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  
        <style>
  #droppable { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }
  #draggable, #draggable-nonvalid { width: 100px; height: 100px; padding: 0.5em; float: left; margin: 10px 10px 10px 0; }
  </style>
  <script>
  $(function() {
    $( "#draggable, #draggable-nonvalid" ).draggable();
    $( "#droppable" ).droppable({
      accept: "#draggable",
      activeClass: "ui-state-hover",
      hoverClass: "ui-state-active",
      drop: function( event, ui ) {
        /*$( this )
          .addClass( "ui-state-highlight" )
          .find( "p" )
            .html( "Dropped!" );*/
        $(this).droppable('option', 'accept', ui.draggable);
      },
      out: function(event, ui){
        $(this).droppable('option', 'accept', "#draggable");
        }
    });
  });
  </script> -->
    </head>
    <body>
        <div class="header">
            <div class="logo" >DG</div>
            <?php if($is_login){ ?>
                <div style="float:right; margin-top:25px;" class="button">
                    <a href="auth/logout">Kilépés</a>
                </div>
            <?php }else{ ?>
                <div style="float:right; margin-top:25px;" class="button">
                   <a href="auth/login">Belépés</a>
                </div>       
            <?php } ?>
            <h1 class="title">Tanulj német nyelvtant szórakozva!</h1>
        </div>
        <nav id="menu">
            <?php if($is_login){
                    $current_url = current_url();
                    $link_to = base_url() ."games/exercise";
                ?>                
                <a href="<?= $link_to ?>" class="button letter2 <?=($link_to==$current_url)?'active_button':'' ?>" ><p>Gyakorolj</p></a>
                <?php $link_to = base_url() ."games/evelove"; ?>
                <a href="<?= $link_to ?>" class="button letter5 <?=($link_to==$current_url)?'active_button':'' ?>" ><p>Fejlődj</p></a>
                <a class="button letter1 <?=($link_to==$current_url)?'active_button':'' ?>"><p>Gomb</p></a>
                <a class="button letter4 <?=($link_to==$current_url)?'active_button':'' ?>"><p>Társalogj</p></a>
                <a class="button letter3 <?=($link_to==$current_url)?'active_button':'' ?>"><p>Eredmények</p></a>
            <?php } ?>
        </nav>
      <!--   <div id="draggable-nonvalid" class="ui-widget-content">
  <p>I'm draggable but can't be dropped</p>
</div>
 
<div id="draggable" class="ui-widget-content">
  <p>Drag me to my target</p>
</div>
 
<div id="droppable" class="ui-widget-header">
  <p>accept: '#draggable'</p>
</div>-->
      