<?php $this->load->view('header.php'); ?>
    <div id="container" class="col-lg-7 col-md-7 col-sm-7 <?= (($is_login==false)?' align-center':'') ?>">
        <h3>Kedves nyelvtanuló!</h3>
        <p class="paragraph">
            Ez az oldal azért jött létre, hogy megkönnyítse a német nyelv elsajátítását. Ebben játékos gyakorlatokkal igyekszünk segíteni neked. 
            A játékok során figyeljük fejlődésedet, így a szavak tanulása is hatékony és változatos lesz. A szavakat kategorizáltuk és gyakoriságuk szerint rendeztük, hogy fontossági sorrendbe tanulhasd meg. Fejlődésedet és eredményeidet te magad is nyomon követheted az eredmények menüpont alatt.
        </p>
        <p> Kellemes tanulást kívánunk!</p>
        <?php if($is_login){ ?>
            Ennyit fejlődtél az elmúlt időszakban <br>
            Eredményeid:<br>

            Tovább a napi feladatokhoz-><br>
             A Lorem Ipsum egy egyszerû szövegrészlete, szövegutánzata a betûszedõ és nyomdaiparnak. A Lorem Ipsum az 1500-as évek óta standard szövegrészletként szolgált az iparban; mikor egy ismeretlen nyomdász összeállította a betûkészletét és egy példa-könyvet vagy szöveget nyomott papírra, ezt használta. Nem csak 5 évszázadot élt túl, de az elektronikus betûkészleteknél is változatlanul megmaradt. Az 1960-as években népszerûsítették a Lorem Ipsum részleteket magukbafoglaló Letraset lapokkal, és legutóbb softwarekkel mint például az Aldus Pagemaker.

            Ez egy régóta elfogadott tény, miszerint egy olvasót zavarja az olvasható szöveg miközben a szöveg elrendezését nézi. A Lorem Ipsum használatának lényege, hogy többé-kevésbé rendezettebb betûket tartalmaz, ellentétben a Tartalom helye, Tartalom helye-féle megoldással. Sok desktop szerkesztõ és weboldal szerkesztõ használja a Lorem Ipsum-ot mint alapbeállítású szövegmodellt, és egy keresés a lorem ipsum-ra sok félkész weboldalt fog eredményezni.


            A hiedelemmel ellentétben a Lorem Ipsum nem véletlenszerû szöveg. Gyökerei egy Kr. E. 45-ös latin irodalmi klasszikushoz nyúlnak. Richarrd McClintock a virginiai Hampden-Sydney egyetem professzora kikereste az ismeretlenebb latin szavak közül az egyiket (consectetur) egy Lorem Ipsum részletbõl, és a klasszikus irodalmat átkutatva vitathatatlan forrást talált. A Lorem Ipsum az 1.10.32 és 1.10.33-as de Finibus Bonoruem et Malorum részleteibõl származik (A Jó és Rossz határai - Cicero), Kr. E. 45-bõl. A könyv az etika elméletét tanulmányozza, ami nagyon népszerû volt a reneszánsz korban. A Lorem Ipsum elsõ sora, Lorem ipsum dolor sit amet.. a 1.10.32-es bekezdésbõl származik.

        <?php } ?>
    </div>
    <?php if($is_login){ ?>
        <div class="col-lg-2 col-md-4 col-sm-5">
            <?php $this->load->view('toplist_box.html'); ?>
        </div>
    <?php } ?>
<?php $this->load->view('footer.php'); ?>
