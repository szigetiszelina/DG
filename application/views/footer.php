            <div class="row">
                <div class="footer col-md-12">
                    <hr>
                    <?php if($is_login){ ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <h2>Nyelvtan</h2>
                            <p>Amennyiben kezdő vagy vagy szeretnéd felfrissíteni ismereteidet javasolt először elolvasnod a <a href="<?= base_url() ?>grammars/index">nyelvtanok</a> menüpontban található nyelvtani ismertetőket.
                                Itt megtalálod az összes olyan szabályt, amire szükséged van a játékok során.</p>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <h2>Játék</h2>
                            <p>A <a href="<?= base_url() ?>games/evelove">fejlődj</a> és a <a href="<?= base_url() ?>games/exercise">gyakorolj</a> menüpontban bővítheted, mélyítheted tudásod. A fejlődj menüpontban új szavakat sajátíthatsz el játék közben (Végigjátszott memóriajáték esetén minden szóra helyes lenne az eredmény, ezért ez nem vehető figyelembe, mondatok szórendjénél nem igazán mérhető). Elsősorban a leggyakrabban használt szavakat tanulhatod meg.</p>
                            <p>A gyakorolj menüben a megtanult (legalább 50%-os arányban helyesen használt) szavakat ismételheted át.</p>
                            <p>Mindkét menüpontban lehetőséged van kategóriát és nyelvtant választani, hogy fókuszálni tudj a gyengébb területekre. Sorbarendezés játék esetén nincs figyelembe véve kategória (később továbbfejlesztendő).</p>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <h2>Eredmények/Toplisták</h2>
                            <p>Játék végeztével az <a href="<?= base_url() ?>achievements/index">eredményeid</a> mentésre kerülnek, így később nyomon követheted a fejlődésedet.</p>
                            <p><a href="<?= base_url() ?>toplist/index">Toplisták</a> menüben láthatod a többi játékoshoz képest hol tartasz, de ha barátaid is játszanak velük is összemérheted tudásod. Ezt akár meg is oszthatod ismerőseiddel.</p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="copyright">Copyright &copy; 2015</div>
                </div>
            </div>
        </div><!--container fluid -->
    </body>
</html>