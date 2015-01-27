<?php

class TranslationApi {
    protected $url;
    protected $postfields = array();
    protected $shortcodes = array();
    protected $htmltags = array();
    
    public function __construct() {}
    
    public function getResponse() {}
    
    public function translate($string, $from, $to) {}
    
    public function preserveHtmlTagsShortcodes($string) {
        //preserve shortcodes
        if (preg_match_all("/\[.*\]/", $string , $shortcodes)) {
            $this->shortcodes = $shortcodes[0];
            foreach($this->shortcodes as $num => $tag) {
                $string = str_replace($tag, "[3x" . (10000+ $num) . "]", $string);
            }
        }
        
        // and html tags
        if(preg_match_all('@<[\/\!]*?[^<>]*?>@si', $string, $htmltags)) {
            $this->htmltags = $htmltags[0];
            foreach($this->htmltags as $num => $tag) {
                $string = str_replace($tag, "[3x" . (1000+ $num) . "]", $string);
            }
        }
        return $string;
    }
    
    public function replaceHTMLTagsShortcodes($string) {
         // replace the preserved html tags
        foreach($this->htmltags as $num => $tag) {
            $string = str_replace("[3x" . (1000+ $num) . "]", $tag, $string);
        }
        // and shortcodes
        foreach($this->shortcodes as $num => $tag) {
            $string = str_replace("[3x" . (10000+ $num) . "]", $tag, $string);
        }
        return $string;
    }
}
?>
