    <div id="container" class="col-md-7">
        <div ng-app="dg" ng-controller="GameSelectController">
            <?php foreach($categories as $category){ ?>
                <div ng-click="setCategory(<?= $category["id"] ?>)" class="category_type">
                    <?= $category["category"]." (".$category["word_count"].")" ?>
                </div>
            <?php } ?>
            <br style="clear:both">
            <hr>
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
    <div class="col-md-2">
        Toplisták
    </div>
</div>