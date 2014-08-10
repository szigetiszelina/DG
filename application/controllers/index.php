<?php

class Index extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $data["message"]="Az oldal tartalma 
            A Lorem Ipsum egy egyszerû szövegrészlete, szövegutánzata a betûszedõ és nyomdaiparnak. A Lorem Ipsum az 1500-as évek óta standard szövegrészletként szolgált az iparban; mikor egy ismeretlen nyomdász összeállította a betûkészletét és egy példa-könyvet vagy szöveget nyomott papírra, ezt használta. Nem csak 5 évszázadot élt túl, de az elektronikus betûkészleteknél is változatlanul megmaradt. Az 1960-as években népszerûsítették a Lorem Ipsum részleteket magukbafoglaló Letraset lapokkal, és legutóbb softwarekkel mint például az Aldus Pagemaker.
            Ez egy régóta elfogadott tény, miszerint egy olvasót zavarja az olvasható szöveg miközben a szöveg elrendezését nézi. A Lorem Ipsum használatának lényege, hogy többé-kevésbé rendezettebb betûket tartalmaz, ellentétben a Tartalom helye, Tartalom helye-féle megoldással. Sok desktop szerkesztõ és weboldal szerkesztõ használja a Lorem Ipsum-ot mint alapbeállítású szövegmodellt, és egy keresés a lorem ipsum-ra sok félkész weboldalt fog eredményezni.
            A hiedelemmel ellentétben a Lorem Ipsum nem véletlenszerû szöveg. Gyökerei egy Kr. E. 45-ös latin irodalmi klasszikushoz nyúlnak. Richarrd McClintock a virginiai Hampden-Sydney egyetem professzora kikereste az ismeretlenebb latin szavak közül az egyiket (consectetur) egy Lorem Ipsum részletbõl, és a klasszikus irodalmat átkutatva vitathatatlan forrást talált. A Lorem Ipsum az 1.10.32 és 1.10.33-as de Finibus Bonoruem et Malorum részleteibõl származik (A Jó és Rossz határai - Cicero), Kr. E. 45-bõl. A könyv az etika elméletét tanulmányozza, ami nagyon népszerû volt a reneszánsz korban. A Lorem Ipsum elsõ sora, Lorem ipsum dolor sit amet.. a 1.10.32-es bekezdésbõl származik.
            A Lorem Ipsum alaprészlete, amit az 1500-as évek óta használtak, az érdeklõdõk kedvéért lent újra megtekinthetõ. Az 1.10.32 és 1.10.33-as bekezdéseket szintén eredeti formájukban reprodukálták a hozzá tartozó angol változattal az 1914-es fordításból H. Rackhamtól.";
        $data['is_login'] = $this->session->userdata('login_status');
        $this->load->view('homepage',$data);
    }
   
   /* public function get_words(){
       $this->load->model('Word');
       $word = new Word();
       $level = 1;
       $words = $word->get_word($level); 
       var_dump($words);
        
    }
    
    private function import($limit = null) {
        $filename = "public/files/test_words.csv";
        $this->load->model('Word');
        $word = new Word();
        if((int) $limit > 0){ 
            return $word->get_words($limit);//$words->set_words($filename);
        } else {
            return $word->get_words();
        }
    }*/
    
   /* public function elso(){
        
        $words = $this->import();
        $length = count($words);
        $rand = rand(0,$length);
        $deutsch=$words[$rand][0];
        $hungarian=$words[$rand][1];
       // var_dump($deutsch,$hungarian);
        
        //$rand+(rand(0,1)*rand(1,10);
        $alternativak=array();
        for($i=0;$i<5;$i++){
           $newrand=$rand+rand(1,10);
           $alternativak[]=$words[$newrand][0];
        }
        //var_dump($alternativak);
        $data["alternativak"]=$alternativak;
        $data["deutsch"]=$deutsch;
        $data["hungarian"]=$hungarian;
        $this->load->view('hompage',$data);
        
    }*/
    
    
    /*public function memory_game(){
        if(!$this->session->userdata('words')){
           $words = $this->import(18);
           for($i=0;$i<count($words);$i++){               
               $ger=array('word'=>$words[$i]['word'],'id'=>$i);
               $hun=array('word'=>$words[$i]['meaning'],'id'=>$i);
               $memorywords[]=$ger;
               $memorywords[]=$hun;
            }
            shuffle($memorywords);
            $this->session->set_userdata('words', $memorywords);
        }
        $data['words'] = $this->session->userdata('words');
        $data['is_login'] = true;//$this->session->userdata('login_status');
        $this->load->view('memory_game', $data);
    }*/

    /*public function finish_game(){
        json_encode(var_dump($_POST));
        $this->load->model('Word');
        $word = new Word();
        $this->session->unset_userdata('words');
        json_encode('OK');
    }*/
    
   /* public function quiz(){
        $results = $this->import(18);
        $questions = array();
        foreach($results as $word){
            if(mb_strlen($word['plural'])<3){
                $item = $word['word'].','.($word['plural']=='-'?'':'-').$word['plural'];
            }else{
                $item = $word['word'].',('.$word['plural'].')';
            }
            $alternatives = array('der', 'die', 'das');
            $questions[] = array('solution' => $word['article'], 'word' => $item, 'alternatives' => $alternatives, 'meaning' => $word['meaning']);
        }
        $this->session->set_userdata('questions', $questions);   
        $this->load->view('homepage');
    }*/
    
}