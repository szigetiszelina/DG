<div class="clear_fix">
    <div id="container" >
        <div ng-app="dg" ng-controller="GameSelectController">
            <?php foreach($game_types as $type){ ?>
                <div ng-click="showGrammars('<?= $type["name"] ?>')" class="game_type">
                    <?= $type["name"] ?>
                </div>
            <?php } ?>
            <ul>
                <?= $grammars ?>
            </ul>
        </div>
        <script src="<?=base_url()?>public/js/angular/GameSelectController.js" type="text/javascript" ></script>
    </div>
</div>