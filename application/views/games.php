    <div id="container" class="col-lg-7 col-md-7 col-sm-7">
        <div ng-app="dg" ng-controller="GameSelectController">
            <div class="row" >
                <?php foreach($categories as $category){ ?>
                    <div class="col-lg-4 col-md-4">
                        <div ng-click="setCategory(<?= $category["id"] ?>)" ng-class="{active: selected_category === <?= $category["id"] ?>}"class="category_type">
                            <?= $category["category"]." (".$category["word_count"].")" ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <hr>
            <div class="row">    
                <?php foreach($game_types as $type){ ?>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div ng-click="showGrammars('<?= $type["name"] ?>')" ng-class="{active: selected_game === '<?= $type["name"] ?>' }" class="game_type">
                        <?= $type["hu_name"] ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?= $grammars ?>
        </div>
        <script src="<?=base_url()?>public/js/angular/GameSelectController.js" type="text/javascript" ></script>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-5">
        Toplisták
    </div>
</div>