<?php

class Csv extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    private function read_file() {
        $filename = "public/files/words.csv";
        if (file_exists($filename)) {
            $csv = fopen($filename, "r");
            $lines = array();
            while (!feof($csv)) {
                $lines[] = explode("\t", trim(fgets($csv), "\n"));
            }
            fclose($csv);
            $fields = array();
            foreach ($lines as $line) {
                $fields[] = explode(";", $line[0]);
            }
            return $fields;
        } else {
            echo "a forrás fájl nem létezik";
        }
    }
    
    public function tokenize(){
        $words = $this->read_file();
        $content = "";
        foreach($words as $word){
            $token = "";
            for($i = 0; $i<count($word); $i++){
                $word[$i] = trim($word[$i]);
            }
            if($word[6] == "adjektive"){
                $token = $word[1].":".$word[1]."e[rmsn]+";
            }
            if($word[6] == "nomen"){
                $token = $word[1];
                if($word[2]!="" && $word[2]!="-"){
                    if(mb_strlen($word[2],"UTF8")<4){
                        $token .= ":".$word[1].$word[2];
                    }else{
                        $token .= ":".$word[2];
                    }
                }
            }
            if($word[6]  == "verben"){            
                $token = $word[1];
                if(!empty($word[5])){
                    $word[5]=str_replace("|",":",$word[5]);
                    if(strpos($word[5]," ")){
                        $temp = explode(":",$word[5]);
                        $str = "";
                        foreach($temp as $t){
                            $t = explode(" ",$t)[0];
                            $str.=":".$t;
                        }
                        $token.=$str;
                    }else{
                        $token.=":".$word[5];
                    }
                }
                if(!empty($word[3])){
                    $word[3] = explode(" ",$word[3])[0];
                    $token.=":".$word[3]."[nt]+:".$word[3]."st";
                }
                if(!empty($word[4])){
                    $token .=":".str_replace("i. ","",str_replace("h. ","",$word[4]));
                }
            }
            $content .= $token."\r\n";
        }
        $tokenize_file = fopen("public/files/szotovezo.txt", "w");
        fwrite($tokenize_file, $content); var_dump($content);
        fclose($tokenize_file);
    }

   /* public function calculation() {
        $filename = "http://de.wikipedia.org/wiki/Heirat";
        $file = fopen($filename, "r");
        $content = stream_get_contents($file); //echo $content;

        $s = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
        $s = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $s);
        $s = preg_replace('#<ul(.*?)>(.*?)</ul>#is', '', $s); //menük kiszűrése
        $s = preg_replace('#<nav(.*?)>(.*?)</nav>#is', '', $s);
        $s = preg_replace('/<[^<]+?>/', ' ', $s);
        echo $s;
        //var_dump(preg_match_all("/heirat/i", $s,$matches));
        //var_dump(count($matches[0])); //heirathoz el kell menteni a matches[0] elemszámát, annyiszor szerepelt
        var_dump(preg_match_all("/\b(aus[a-z]*)\b/i", $s, $matches)); //aus-sal kezdődő szavak
        var_dump($matches);
    }*/

}
