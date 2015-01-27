<?php
/*
Plugin Name: Polylang Auto Translation
Plugin URI: http://moutons.ch
Description: Add auto-translation functionality to the Polylang plugin.
Text Domain: polylangat
Version: 0.2.1
Author: El Khalifa Karim
Author URI: http://moutons.ch
License: GPL2
Tags: translation
*/

/*  Copyright 2011-2012 K. El Khalifa

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, published by
    the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class PolylangAT {
    // used to cache results
    private $languages_list = array();
    
    
    public function __construct() {
        load_default_textdomain();
        load_plugin_textdomain('polylang', false, basename( dirname( __FILE__ ) ) . '/../polylang/languages' );
        load_plugin_textdomain('polylangat', false, basename( dirname( __FILE__ ) ) . '/languages' );
        if(is_admin()) {
            add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));

            add_action('wp_ajax_do_autotranslation', array(&$this, 'do_autotranslation_callback'));
            
            add_action('wp_ajax_do_autotranslationform', array(&$this, 'do_autotranslationform_callback'));
            
            add_action("plugins_loaded", array(&$this, 'load_scripts'));
            
            
            
            
        }       
    }
    
    public function load_scripts() {
        
        wp_enqueue_script('polylangAtScript', plugins_url('/js/polylangat.js', __FILE__), array('jquery'));
        
        $translation_array = array( 'title' =>__("Title"), 'text' => __("Content"), "attachment_caption" => __('Caption'), "attachment_alt" => __( 'Alternative Text' ), "attachment_content" => __( 'Description' ), "loading_image_url" => admin_url( 'images/loading.gif'), "traduction" => __("Translation", "polylang") );
        wp_localize_script( 'polylangAtScript', 'plautotranslate', $translation_array );
        
        
        
    }
    
    // adds the Language box in the 'Edit Post' and 'Edit Page' panels (as well as in custom post types panels)
    public function add_meta_boxes($post_type) {
        /* translators: Plugin main name */
        add_meta_box('plat_box', __("Auto-translate", "polylangat"), array(&$this,'getForm'), $post_type, 'side', 'high');
    }
    
    public function getForm() {
        global $post_ID;
        global $polylang;
        
        $post_type = get_post_type($post_ID);

        $lang = ($lg = $this->get_post_language($post_ID)) ? $lg : (isset($_GET['new_lang']) ? $this->get_language($_GET['new_lang']) : $this->get_default_language());

        /* translators: %1$s is the auto-transaltion button and %2$s is the language select box  */
        echo '<p><em>' . sprintf(__('%1$s from the article in %2$s.', 'polylangat'),
                
        /* translators: The label of the Translate button  */
            '<input type="submit" id="auto-translate" name="auto-translate" value="' . __('Translate', 'polylangat') . '" />',
            $this->dropdown_languages(array('name' => 'post_autotranslate_lang_choice', 'class' => '', 'selected' => $lang ? $lang->slug : ''))
        ) . '</em></p>' .
                
            /* translators: label before the field list to translate */
            '<p><em>' . __("Automatically translate:", "polylangat") . '</em></p>
                <div id="checkboxescontenttotranslate"></div>
                
<input type="hidden" name="to" id="auto-translate-to" value="' . $polylang->get_post_language($post_ID)->slug . '" />
<input type="hidden" name="post_id" id="auto-translate-post_id" value="' . $post_ID . '" />


<div id="polylang-auto-translation-accordion">' .
                
/* translators: Title of the translation services section */
'<h3>' . __("Translation Services", "polylangat") . '</h3>
<div>
    <ul>
        <li style="font-size: 22px;"><input type="radio" name="service" checked="checked" value="myMemory" /> <img src="' . plugins_url( 'images/mymemory.png' , __FILE__ ). '" alt="myMemory" /></li>
        <li style="font-size: 22px;"><input type="radio" name="service" value="GoogleTranslation" /> <img src="' . plugins_url( 'images/google.png' , __FILE__ ). '" alt="Google Translate" /></li>
    </ul>
</div>
</div>


';
    }
    
    
    
    // retrieves the dropdown list of the languages
    function dropdown_languages($args = array()) {
        global $post_ID;
        $args = apply_filters('pll_dropdown_language_args', $args);
        $defaults = array('name' => 'lang_choice', 'class' => '', 'add_options' => array(), 'hide_empty' => false, 'value' => 'slug', 'selected' => '');
        extract(wp_parse_args($args, $defaults));


        $out = sprintf('<select name="%1$s" id="%1$s"%2$s>'."\n", esc_attr($name), $class ? ' class="'.esc_attr($class).'"' : '');

        foreach ($this->get_languages_list($args) as $language) {
            
            $value = $this->get_translation('post', $post_ID, $language);
        
            if (!$value || $value == $post_ID) // $value == $post_ID happens if the post has been (auto)saved before changing the language
                $value = '';
            if (isset($_GET['from_post']))
                $value = $this->get_post($_GET['from_post'], $language);

            if($language->slug != $selected) {
                $out .= sprintf("<option value=\"%s\" title=\"%s\">%s</option>\n",
                        esc_attr($value),
                        esc_attr($language->slug),
                        esc_html($language->name)
                );
            }
        }
        $out .= "</select>\n";
        return $out;
    }
    
    // returns the id of the translation of a post or term
    // $type: either 'post' or 'term'
    // $id: post id or term id
    // $lang: object or slug (in the order of preference latest to avoid)
    function get_translation($type, $id, $lang) {
            $translations = $this->get_translations($type, $id);
            $slug = $this->get_language($lang)->slug;
            return isset($translations[$slug]) ? (int) $translations[$slug] : false;
    }

    // returns an array of translations of a post or term
    function get_translations($type, $id) {
            // maybe_unserialize due to useless serialization in versions < 0.9
            return maybe_unserialize(get_metadata($type, $id, '_translations', true)); 
    }

    // returns the language of a post
    public function get_post_language($post_id) {
        $lang = get_the_terms($post_id, 'language' );
        return ($lang) ? reset($lang) : false; // there's only one language per post : first element of the array returned
    }
    
    function get_languages_list($args = array()) {
        // although get_terms is cached, it is efficient to add our own cache
        if (isset($this->languages_list[$cache_key = md5(serialize($args))]))
            return $this->languages_list[$cache_key];

        $defaults = array('hide_empty' => false, 'orderby'=> 'term_group');
        $args = wp_parse_args($args, $defaults);		
        return $this->languages_list[$cache_key] = get_terms('language', $args);
    }
    // returns either the user preferred language or the default language
    function get_default_language() {
        $default_language = $this->get_language(($lg = get_user_meta(get_current_user_id(), 'pll_filter_content', true)) ? $lg : $this->options['default_lang']);
        return apply_filters('pll_get_default_language', $default_language);
    }
    
    // returns the language by its id or its slug
    // Note: it seems that a numeric value is better for performance (3.2.1)
    function get_language($value) {
        $lang = is_object($value) ? $value :
            ((is_numeric($value) || (int) $value) ? get_term((int) $value, 'language') :
            (is_string($value) ? get_term_by('slug', $value , 'language') : // seems it is not cached in 3.2.1
        false));
        return isset($lang) && $lang && !is_wp_error($lang) ? $lang : false;
    }
    // among the post and its translations, returns the id of the post which is in $lang
    function get_post($post_id, $lang) {
        $post_lang = $this->get_post_language($post_id);
        if (!$lang || !$post_lang)
                return false;

        $lang = $this->get_language($lang);
        return $post_lang->term_id == $lang->term_id ? $post_id : $this->get_translation('post', $post_id, $lang);
    }  
        
        

    public function do_autotranslation_callback() {
        
        if(session_id() == '') {
            session_start();
        }
        
        

        if(!isset($_REQUEST["engine"])) {
            $_REQUEST["engine"] = "myMemory";
        }
        $engine = $_REQUEST["engine"];
        
        
        preg_match("/polylangat_can_change\[(.*)\]/", $_REQUEST["what"], $match);
        
        $what = $match[1];
        
        if(!isset($_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what])) {
            if(!isset($_REQUEST["text"])) {
                $post = get_post(pll_get_post($_REQUEST["post_id"], $_REQUEST["from_lang"]), ARRAY_A);
            } else {
                $w_hat = $what;
                $what = "free";
            }
            $totranslate = '';

            switch($what) {
                case "title":
                    $totranslate = $post["post_title"];
                    break;
                case "attachment_caption":
                    $totranslate = $post["post_excerpt"];
                    break;
                case "attachment_alt":
                    $totranslate = get_post_meta($_REQUEST["post_id"], '_wp_attachment_image_alt', true);
                    break;
                case "attachment_content":
                    $totranslate = $post["post_content"];
                    break;
                case "content":
                    $totranslate = $post["post_content"];
                    break;
                case "free":
                    $totranslate  = $_REQUEST["text"];
                    $what = $w_hat;
                    break;
            }

            $texts = array_reverse(explode("\n", $totranslate));

            $_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what] = array("texts" => $texts, "size"=>sizeof($texts));//$to_translate;
        }
        $totranslate = array_pop($_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what]["texts"]);

        if(trim($totranslate) != '') {

            include_once(dirname(__FILE__) . "/class/" . $engine . ".php");
            $translator = new $engine();
            $translated = $translator->translate($totranslate, $_REQUEST["from_lang"], $_REQUEST["to_lang"]);

        } else {
            $translated = '';
        }
        
        
        echo json_encode(array("engine" => $engine,"target" => $what, 'translation' => trim($translated), 'total' => $_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what]["size"] , 'remaining' => sizeof($_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what]["texts"])));
        
        if(sizeof($_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what]["texts"]) == 0) {
            unset($_SESSION["polylang-auto-translate_remaining"][$_REQUEST["post_id"]][$what]);
        }
	die(); // this is required to return a proper result
    }
    
    function do_autotranslationform_callback() {
        global $polylang;
        
        $post_type = get_post_type($post_ID);

        $lang = ($lg = $this->get_post_language($post_ID)) ? $lg : (isset($_GET['new_lang']) ? $this->get_language($_GET['new_lang']) : $this->get_default_language());

        echo '<hr /><div id="icon-tools" class="icon32"></div><h1>' . __("Auto-translate", "polylangat") . '</h1><p><em>' . 
            sprintf(
                    
        /* translators: %1$s is the translate button, %2$s is the list of fields to transalte, %3$s is the radio button String , %4$s is the radio button  translations, %5$s is the language select box, %6$s are the translation services checkboxes*/
                __('%1$s %2$s from the %3$s or %4$s in %5$s using: %6$s', 'polylangat'),
                    '<input type="submit" class="button" id="auto-translate" name="auto-translate" value="' . __('Translate', 'polylangat') . '" />',
                    '<div id="checkboxescontentwhattotranslate"></div>',
                    
                    '<input type="radio" name="original-string-from" value="column-string" checked="checked" /> ' . __('String', 'polylang'),
                    '<input type="radio" name="original-string-from" value="column-translations" /> ' . __('Translations', 'polylang'),
                    
                    
                    $this->dropdown_languages(array('name' => 'post_autotranslate_lang_choice','value' => 'slug', 'class' => '', 'selected' => $lang ? $lang->slug : '')),
                    '<input type="radio" name="service" checked="checked" value="myMemory" /> <img src="' . plugins_url( 'images/mymemory.png' , __FILE__ ). '" alt="myMemory" />
                    <input type="radio" name="service" value="GoogleTranslation" /> <img src="' . plugins_url( 'images/google.png' , __FILE__ ). '" alt="Google Translate" />'
                ) .
                '</em>' .     '
            </p>';
        die();
    }
    
}

new PolylangAT();
?>
