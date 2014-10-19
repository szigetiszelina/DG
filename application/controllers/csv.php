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

    private function tokenize() {
        $words = $this->read_file();
        $content = "";
        foreach ($words as $word) {
            $token = "";
            for ($i = 0; $i < count($word); $i++) {
                $word[$i] = trim($word[$i]);
            }
            if ($word[6] == "adjektive") {
                $token = $word[1] . ":" . $word[1] . "e[rmsn]+";
            }
            if ($word[6] == "nomen") {
                $token = $word[1];
                if ($word[2] != "" && $word[2] != "-") {
                    if (mb_strlen($word[2], "UTF8") < 4) {
                        $token .= ":" . $word[1] . $word[2];
                    } else {
                        $token .= ":" . $word[2];
                    }
                }
            }
            if ($word[6] == "verben") {
                $token = $word[1];
                if (!empty($word[5])) {
                    $word[5] = str_replace("|", ":", $word[5]);
                    if (strpos($word[5], " ")) { //azért kell mert vannak elváló igekötős igék
                        $temp = explode(":", $word[5]);
                        $str = "";
                        foreach ($temp as $t) {
                            $t = explode(" ", $t)[0];
                            $str.=":" . $t;
                        }
                        $token.=$str;
                    } else {
                        $token.=":" . $word[5];
                    }
                }
                if (!empty($word[3])) {
                    $word[3] = explode(" ", $word[3])[0];
                    $token.=":" . $word[3] . "[nt]+:" . $word[3] . "st";
                }
                if (!empty($word[4])) {
                    $token .=":" . str_replace("i. ", "", str_replace("h. ", "", $word[4]));
                }
            }
            $content .= $token . "\r\n";
        }
        $tokenize_file = fopen("public/files/szotovezo.txt", "w");
        fwrite($tokenize_file, $content);
        var_dump($content);
        fclose($tokenize_file);
    }

    private function save_word_categories() {
        $words = $this->read_file();
        $this->load->model('Word');
        $word_categories = array();
        foreach ($words as $word) {
            if($word!=null || $word!=""){
                $categories = explode("|", $word[8]);
                $word_id = (int) $this->Word->get_word_id(trim($word[0]), trim($word[1]), trim($word[2]));
                $word_categories[] = array("word_id" => $word_id, "categories" => $categories);
            }
        }
        $this->Word->save_word_categories($word_categories);
        echo "A kategóriák mentése befejeződött.";
    }
}
