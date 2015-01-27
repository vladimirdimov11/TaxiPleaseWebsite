<?php
include_once(dirname(__FILE__) . "/TranslationApi.php");

class GoogleTranslation extends TranslationApi {
    public function __construct() {
    }
    
    public function translate($string, $from, $to) {
        
        $this->url = "http://translate.google.com/translate_a/t";
        
        
        $this->postfields = array(
            "client"=>"p",
            "hl"=>$to,
            "ie"=>"UTF-8",
            "it"=> "sel.5647",
            "multires"=>1,
            "oe"=>"UTF-8",
            "otf"=>1,
            "prev" => "conf",
            "psl" => $from,
            "ptl" => $from,
            "sl" => $from,
            "ssel"=>3,
            "text"=>urlencode($this->preserveHtmlTagsShortcodes($string)),
            "tl"=>$to,
            "tsel"=>6
        );
        
        
        $response = get_object_vars ( json_decode($this->getResponse()));

        $output = '';
        foreach($response["sentences"] as $sentence) {
            $output .= $sentence->trans;
        }

        $output = $this->replaceHTMLTagsShortcodes($output);
        
        return $output;
    }
    
    function getResponse() {

        
        $ch = curl_init ('http://translate.google.com/');    
            
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $output = curl_exec ($ch);
        curl_close($ch);
        
        preg_match_all('/^Set-Cookie: (.*?);/m', $output, $m);
        

        
        $cookie_string = implode(";",$m[1]);
        
        
        $params = array();
        foreach($this->postfields as $k => $v) {
            $params[] = $k . "=" . $v;
        }

        
        $url = $this->url . "?" . implode("&", $params);

        $ch = curl_init ($url);
        curl_setopt($ch,CURLOPT_COOKIE, $cookie_string);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_REFERER, 'http://translate.google.com/');
        $response = curl_exec ($ch);
        return $response;
        
        
    }
}
/*
$translation = new GoogleTranslation();
echo $translation->translate('La mauvais temps se lève dans cette vidéo: [youtube_sc url="http://youtu.be/cimDfEIEiu0" title="Pureview" width="560" height="340"] et balaie la côte ouest des États-Unis.', "fr", "en");*/
//echo $translation->translate('Nokia peine à redevenir crédible après avoir perdu sa place de leader des téléphones portables au profit d\'Apple et Samsung comme discuté ce matin à la [1]RTS[2]. Tous les espoirs sont donc placés sur ce téléphone. Malheureusement Nokia c\'est fait coupé l\'herbe sous le pied par Samsung qui a sorti le [3]Ativ S[4].', "fr", "en");

?>