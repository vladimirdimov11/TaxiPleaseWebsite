<?php

// status: todo
include_once(dirname(__FILE__) . "/TranslationApi.php");

class myMemory extends TranslationApi {
    public function __construct() {
    }
    
    public function translate($text, $from, $to) {
        
        $text = $this->preserveHtmlTagsShortcodes($text);
        
        $this->url = "http://mymemory.translated.net/api/get";
    
        $output = '';
        
        if(strlen(trim($text)) > 0) {

            $this->postfields = array(
                'q'=>"{$text}",
                //'q' => "Salut le monde !",
                'langpair'=>"{$from}|{$to}"
            );

            $response = $this->getResponse();

            if($response !== false) {

                $json = json_decode($response, true);
                if(isset($json["responseData"]["translatedText"])) {
                    $output = $json["responseData"]["translatedText"] . "
";
                }
            }
        }
        
        $output = $this->replaceHTMLTagsShortcodes($output);   
        return $output;
    }
    
    
    function getResponse() {
        
 
        
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_POST      ,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS    ,$this->postfields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
        curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
        
    }
}
/*
$translation = new myMemory();
echo $translation->translate('Nokia peine à redevenir crédible après avoir perdu sa place de leader des téléphones portables au profit d\'Apple et Samsung comme discuté ce matin à la <a title="RTS - le journal du matin" href="http://www.rts.ch/la-1ere/programmes/le-journal-du-matin/4233286-le-journal-du-matin-du-06-09-2012.html" target="_blank">RTS</a>. Tous les espoirs sont donc placés sur ce téléphone. Malheureusement Nokia c\'est fait coupé l\'herbe sous le pied par Samsung qui a sorti le <a href="http://www.samsung.com/global/ativ/ativ_s.html" target="_blank">Ativ S</a>.', "fr", "en");*/
?>