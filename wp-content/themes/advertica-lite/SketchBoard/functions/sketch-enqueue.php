<?php
global $advertica_themename;
global $advertica_shortname;

/***********************************************
*  ENQUQUE CSS AND JAVASCRIPT
************************************************/
//ENQUEUE JQUERY 
function advertica_script_enqueqe() {
	global $advertica_shortname;
	if(!is_admin()) {
		wp_enqueue_script('advertica_componentssimple_slide', get_template_directory_uri() .'/js/custom.js',array('jquery'),'1.0',1 );
		wp_enqueue_script("comment-reply");
	}

}
add_action('init', 'advertica_script_enqueqe');


//ENQUEUE STYLE FOR IE BROWSER
function advertica_IE_enqueue_scripts() {
	global $is_IE;
	if($is_IE ) {
		if ( !is_admin() ) {
			wp_register_style( 'ie-style', get_template_directory_uri().'/css/ie-style.css', false, $theme->Version );
			wp_enqueue_style( 'ie-style' );
			wp_register_style( 'awesome-theme-stylesheet', get_template_directory_uri().'/css/font-awesome-ie7.css', false, $theme->Version );
			wp_enqueue_style( 'awesome-theme-stylesheet' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'advertica_IE_enqueue_scripts' );

//ENQUEUE FRONT SCRIPTS
function advertica_theme_stylesheet()
{
	global $advertica_themename;
	global $advertica_shortname;
	if ( !is_admin() ) 
	{
		$theme = wp_get_theme();
		wp_enqueue_script('hoverIntent');
		wp_enqueue_script('advertica_superfish', get_template_directory_uri().'/js/superfish.js',array('jquery'),true,'1.0');
		wp_enqueue_script('advertica_AnimatedHeader', get_template_directory_uri().'/js/cbpAnimatedHeader.js',array('jquery'),true,'1.0');
		wp_enqueue_script('advertica_easing_slide',get_template_directory_uri().'/js/jquery.easing.1.3.js',array('jquery'),'1.0',true);
		wp_enqueue_script('adverticat_waypoints',get_template_directory_uri().'/js/waypoints.min.js',array('jquery'),'1.0',true );
		
		wp_enqueue_style('advertica-style', get_stylesheet_uri());
		wp_enqueue_style('advertica-animation-stylesheet', get_template_directory_uri().'/css/skt-animation.css', false, $theme->Version);
		wp_enqueue_style('sktawesome-theme-stylesheet', get_template_directory_uri().'/css/font-awesome.css', false, $theme->Version);
		
		/*SUPERFISH*/
		wp_enqueue_style( 'sktddsmoothmenu-superfish-stylesheet', get_template_directory_uri().'/css/superfish.css', false, $theme->Version);
		wp_enqueue_style( 'bootstrap-responsive-theme-stylesheet', get_template_directory_uri().'/css/bootstrap-responsive.css', false, $theme->Version);
		
		/*GOOGLE FONTS*/
		wp_enqueue_style( 'googleFontsRoboto','//fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,300italic,300', false, $theme->Version);
		wp_enqueue_style( 'googleFontsLato','//fonts.googleapis.com/css?family=Lato:400,700', false, $theme->Version);
	}
}
add_action('wp_enqueue_scripts', 'advertica_theme_stylesheet');

function advertica_head() {
	global $advertica_shortname;
	$advertica_favicon = "";
	$advertica_meta = '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">'."\n";

	if(sketch_get_option($advertica_shortname.'_favicon')) {
		$advertica_favicon = sketch_get_option($advertica_shortname.'_favicon','bizstudio');
		$advertica_meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"$advertica_favicon\"/>\n";
	}
	echo $advertica_meta;

	if(!is_admin()) {
		require_once(get_template_directory().'/includes/advertica-custom-css.php');
	}
 
}
add_action('wp_head', 'advertica_head');

//ENQUEUE FOOTER SCRIPT 
function advertica_footer_script() {
	global $advertica_shortname;	
	if(advertica_bg_style($advertica_shortname."_bg_style") != Null){
	?>
    <style type="text/css">
		#main{background:none;}
		#wrapper {
		<?php echo advertica_bg_style($advertica_shortname."_bg_style"); ?>
		}
	</style>
    <?php
	}
}
add_action('wp_footer', 'advertica_footer_script');