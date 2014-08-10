<?php

class Csv extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function import() {
        $filename = "public/files/szavak.csv";
        if(file_exists($filename)){
            $csv=fopen($filename,"r");
            $lines=array();
            while(!feof($csv)){
                $lines[] = explode("\t",trim(fgets($csv),"\n"));
            }
            return $lines;
        } else {
            echo "nincs";
        }
    }
    
    public function calculation(){
        $filename = "http://de.wikipedia.org/wiki/Heirat";
        $file = fopen($filename,"r");
        $content = stream_get_contents($file);//echo $content;
        
        $s=preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
        $s=preg_replace('#<style(.*?)>(.*?)</style>#is', '', $s);
        $s=preg_replace('#<ul(.*?)>(.*?)</ul>#is', '', $s);//menük kiszűrése
        $s=preg_replace('#<nav(.*?)>(.*?)</nav>#is', '', $s);
        $s= preg_replace('/<[^<]+?>/', ' ', $s);
        echo $s;
        //var_dump(preg_match_all("/heirat/i", $s,$matches));
        //var_dump(count($matches[0])); //heirathoz el kell menteni a matches[0] elemszámát, annyiszor szerepelt
        var_dump(preg_match_all("/\b(aus[a-z]*)\b/i", $s,$matches));//aus-sal kezdődő szavak
        var_dump($matches);
    }
}