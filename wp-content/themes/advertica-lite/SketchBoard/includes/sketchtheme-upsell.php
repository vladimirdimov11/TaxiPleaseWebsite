<?php
/**
 * Title: Theme Upsell.
 *
 * Description: Displays list of all Sketchtheme themes linking to it's pro and free versions.
 *
 *
 * @author   Sketchtheme
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.sketchthemes.com/
 */

// Add stylesheet and JS for sell page.
function advertica_sell_style() {

    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    wp_enqueue_style( 'upsell_style', get_template_directory_uri() . '/SketchBoard/includes/css/upsell.css' );
}

// Add upsell page to the menu.
function advertica_add_upsell() {
    $page = add_theme_page( __('Sketch Themes', 'advertica-lite'), __('Sketch Themes', 'advertica-lite'), 'administrator', 'sketch-themes', 'advertica_display_upsell' );
    add_action( 'admin_print_styles-' . $page, 'advertica_sell_style' );
}

add_action( 'admin_menu', 'advertica_add_upsell',12 );

// Define markup for the upsell page.
function advertica_display_upsell() {

    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    ?>

    <div class="wrap">
    <div class="container-fluid">
    <div id="upsell_container">
    <div class="clearfix row-fluid">
        <div id="upsell_header" class="span12">
            <h2>
                <a href="http://www.sketchthemes.com/" target="_blank">
                    <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/sketch-logo.png"/>
                </a>
            </h2>
        </div>
		<div class="sketch-social-container clearfix">
			<div class="sketch-social">
				<a href="https://twitter.com/sketchthemes" class="twitter-follow-button" data-show-count="false" data-size="small">Follow @sketchthemes</a>
				<script>
				!function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (!d.getElementById(id)) {
				js = d.createElement(s);
				js.id = id;
				js.src = "//platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js, fjs);
				}
				}(document, "script", "twitter-wjs");
				</script>
			</div>
			<div class="sketch-social">
				<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FSketchThemes&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=333709623346310" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
			</div>
		</div>
    </div>
    <div id="upsell_themes" class="clearfix row-fluid">
	
	<!-- -------------- Convac Pro ------------------- -->

	<div id="Convac" class="row-fluid">
		<div class="theme-container">
			<div class="theme-image span3">
				<a href="http://www.sketchthemes.com/themes/convac-responsive-multi-author-blogging-theme/?ref=advlite" target="_blank">
					<img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/convac.png" width="300px"/>
				</a>
			</div>
			<div class="theme-info span9">
				<a class="theme-name" href="http://www.sketchthemes.com/themes/convac-responsive-multi-author-blogging-theme/?ref=advlite" target="_blank"><h4><?php _e('Convac - Responsive Multi Author Blogging Theme','advertica-lite');?></h4></a>

				<div class="theme-description">
					<p><?php _e("Convac is elegant WordPress theme solely designed for web bloggers. The main aim of theme is to improve blog’s appearance for the end users and making blog posting a cakewalk task for bloggers. The theme has options and features which can customize blog as per your user and interest. Design for bloggers, theme is equipped with integrated features such as- post share, post like, subscription widget, supports to all post formats and many more.",'advertica-lite'); ?></p>
				</div>

				<a class="free btn btn-success" href="http://wordpress.org/themes/convac-lite/?ref=advlite" target="_blank"><?php _e( 'Try Convac Free', 'advertica-lite' ); ?></a>
				<a class="buy  btn btn-info" href="http://sketchthemes.com/samples/convac-multi-author-blogging-demo/?ref=advlite" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
				<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=67&product_id=67&paysys_id=twocheckout_r/?ref=advlite" target="_blank"><?php _e( 'Buy Convac Pro', 'advertica-lite' ); ?></a>
				
			</div>
		</div>
	</div>
	
	<!-- -------------- Foodeez Pro ------------------- -->

        <div id="Foodeez" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/foodeez-multi-cuisine-restaurant-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/Foodeez-Theme.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/" target="_blank"><h4><?php _e('Foodeez - Multi Cuisine Restaurant WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e("Foodeez Lite is the the classy theme created for Restaurants and hotel Industry. To provide a Classy, elegant theme for the hospitality industry and to fill in the void Foodeez was designed. Every restaurant or hotel desires to showcase it's cuisines and ambiance in a beautiful manner. This was not satiated by any prior theme. Hence, Foodeez was designed. Now you can enjoy a fully Responsive, and Full-width Header Background Image with floating navigation which gets converted into Persistent Navigation on scroll down.The Amazing Parallax section allows you to showcase your Super-Specialty Signature Dishes or your Dish of the Day. In short, if you're a chef, a cook, cuisine guru, food expert, food fanatic, blogger, nutrition expert, diet planner, dietitian, recipe sharer, Fine Dining Lover, or just a food enthusiast, who want to share the love of food. Then this theme is Perfect for you.Clean, Fresh Looks of this WordPress Theme will make you feel wow. The blog page is clean and designed to The Theme is Loaded with feature which you won't find on any other Lite Themes with this much precision and quality.",'advertica-lite'); ?></p>

                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/foodeez-lite" target="_blank"><?php _e( 'Try Foodeez Free', 'advertica-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="http://sketchthemes.com/samples/foodeez-multi-cuisine-restaurant-demo/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=63&product_id=63&paysys_id=twocheckout_r" target="_blank"><?php _e( 'Buy Foodeez Pro', 'advertica-lite' ); ?></a>
                    
                </div>
            </div>
        </div>
	
		<!-- -------------- Advertica Pro ------------------- -->

        <div id="Advertica" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/advertica-the-uber-clean-multipurpose-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/Advertica_screen_420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/" target="_blank"><h4><?php _e('Advertica - Creative MultiPurpose WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('A Clean, Multipurpose, Responsive Business WordPress Theme by SketchThemes. With easy customization options one can easily setup a perfect business theme in a few minutes. The striking features of INVERT are Easy Custom Admin Options, 3 Custom Page Templates, Parallax Section, Custom Logo, Custom favicon, Social links Setup, SEO Optimized, Call To Action, Featured Text.','advertica-lite'); ?></p>

                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/advertica-lite" target="_blank"><?php _e( 'Try Advertica Free', 'advertica-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="http://sketchthemes.com/samples/advertica-creative-demo/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=58&product_id=58&paysys_id=twocheckout_r" target="_blank"><?php _e( 'Buy Advertica Pro', 'advertica-lite' ); ?></a>
                    
                </div>
            </div>
        </div>
	
		<!-- -------------- Invert Pro ------------------- -->

        <div id="Invert" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/invert-responsive-multipurpose-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/Invert-mac-300px.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/invert-responsive-multipurpose-wordpress-theme/" target="_blank"><h4><?php _e('Invert - Responsive MultiPurpose WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('A Clean, Multipurpose, Responsive Business WordPress Theme by SketchThemes. With easy customization options one can easily setup a perfect business theme in a few minutes. The striking features of INVERT are Easy Custom Admin Options, 3 Custom Page Templates, Parallax Section, Custom Logo, Custom favicon, Social links Setup, SEO Optimized, Call To Action, Featured Text.','advertica-lite'); ?></p>

                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/invert-lite" target="_blank"><?php _e( 'Try Invert Free', 'advertica-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="http://sketchthemes.com/samples/invert-business-demo/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=44&product_id=44&paysys_id=twocheckout_r" target="_blank"><?php _e( 'Buy Invert Pro', 'advertica-lite' ); ?></a>
                    
                </div>
            </div>
        </div>

        <!-- -------------- BizNez Pro ------------------- -->

        <div id="biznez" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/biznez-multi-purpose-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/biznez-career-counseling-demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/biznez-multi-purpose-wordpress-theme/" target="_blank"><h4><?php _e('Biznez - Multi Purpose Wordpress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('BizNez is a powerful Responsive Multipurpose WordPress Theme with clean and crispy design. BizNez is modern and flexible enough. It allows you to create your website around any niche without the need of any complicated HTML code knowledge. Be it a Blog, Business, Portfolio, Corporate, Agency, an online store or any other kind of website BizNez will be a good pick for you. With our advanced admin panel, tons of customizations are possible and that&#39;ll help you redefine your website&#39;s brand value. You can also change site layout with only a single click. Also, this theme comes with retina ready feature. You can see great details on any devices screen. Woo Commerce and RTL languages are also supported with our BizNez theme.','advertica-lite'); ?></p>

                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/biznez-lite" target="_blank"><?php _e( 'Try Biznez Free', 'advertica-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="http://demo.sketchthemes.com/preview-images/biznez/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=19&product_id=19&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy Biznez Pro', 'advertica-lite' ); ?></a>
                    
                </div>
            </div>
        </div>

        <!-- -------------- Analytical Pro ------------------- -->

        <div id="analytical" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/analytical-full-width-responsive-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/Analytical_Interior_Demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/analytical-full-width-responsive-wordpress-theme/" target="_blank"><h4><?php _e('Analytical Full Width Responsive Wordpress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('Analytical is a full width WordPress theme built especially for photographers and others who want to feature more graphics on their website. This theme features a full width background slider which is highly customizable and totally responsive.','advertica-lite');?></p>
                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/analytical-lite" target="_blank"><?php _e( 'Try Analytical Free', 'advertica-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="http://demo.sketchthemes.com/preview-images/analytical/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=17&product_id=17&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy Analytical Pro', 'advertica-lite' ); ?></a>
                    
                </div>
            </div>
        </div>
		
        <!-- -------------- BizStudio Pro ------------------- -->

        <div id="bizstudio" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/bizstudio-full-width-responsive-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/bizstudio-default-demo.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/bizstudio-full-width-responsive-wordpress-theme/" target="_blank"><h4><?php _e('BizStudio Full Width Responsive Wordpress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('Bizstudio is a Simple, Minimal, Responsive, One Click Install, Beautiful and Elegent WordPress Theme. Along with the elegent design the theme is highly flexible and customizable with easy to use Admin Panel Options. From a wide range of options some key options are custom two different layout option(full width and with sidebar), 5 widget areas, custom follow us and contact widget, Logo, logo alt text, custom favicon, social links, rss feed button, custom copyright text and many more. Also it is compitable with various popular plugins like All in One SEO Pack, WP Super Cache, Contact Form 7 etc. It is translation ready as well.','advertica-lite')?></p>
                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/bizstudio-lite" target="_blank"><?php _e( 'Try BizStudio Lite', 'advertica-lite' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/bizstudio/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=14&product_id=14&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy BizStudio Pro', 'advertica-lite' ); ?></a>
                </div>
            </div>
        </div>
		
		
		<!-- -------------- Irex Pro ------------------- -->

        <div id="Irex" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/irex-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank"><h4><?php _e('Irex Full Width Portfolio Wordpress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('Irex is a simple, minimal, responsive, easy to use, one click install, beautiful and Elegent WordPress Theme with Easy Custom Admin Options Created by SketchThemes.com. Using Irex theme options any one can easily customize this theme according to their need. You can use your own Logo, logo alt text, custom favicon, you can add social links, rss feed to homepage, you can use own copyright text etc. And all this information can be entered using Irex Theme Options Panel. You have to just set the content from the Irex  Themes Options Panel and it will be up ready to use.','advertica-lite');?></p>
                    </div>

					<a class="free btn btn-success" href="http://wordpress.org/themes/irex-lite" target="_blank"><?php _e( 'Try Irex Lite', 'advertica-lite' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/irex/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=15&product_id=15&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy Irex Pro', 'advertica-lite' ); ?></a>
                </div>
            </div>
        </div>
		
		<!-- -------------- Sketchmini Pro ------------------- -->

        <div id="Sketchmini" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/sketchmini-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/" target="_blank"><h4><?php _e('SketchMini Free Responsive WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('SketchMini is a Responsive WordPress Theme Free to use with a GPL. SketchMini has got great features and awesome backend to make use of the available features in the theme. You dont need to be an expert to use this SketchMini theme. SketchMini can act as a great base theme to create any great website.','advertica-lite')?></p>

                    </div>
					<a class="free btn btn-success" href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/#FreeDownloadButton" target="_blank"><?php _e( 'Try Sketchmini Lite', 'advertica-lite' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/sketchmini/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
                </div>
            </div>
        </div>
		
	
	<!-- -------------- Fullscreen Pro ------------------- -->

        <div id="FullScreen" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/?ref=litetheme" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/fullscreen-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/?ref=litetheme" target="_blank"><h4><?php _e('FullScreen - OnePager Responsive WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('FullScreen is clean, multipurpose and elegant WordPress theme with fully responsive layout. Theme is suited for all photographers, creative, business and portfolio websites. Theme includes lots of features like full-screen slider, modular homepage, layout shortcodes and more. With our advanced admin panel, tons of customizations are possible and that will help you redefine your website brand value.','advertica-lite');?></p>
                    </div>

                    <a class="buy btn btn-info" href="http://sketchthemes.com/samples/fullscreen-default-demo/?ref=litetheme" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=27&product_id=27&hide_paysys=paypal_r/?ref=litetheme" target="_blank"><?php _e( 'Buy FullScreen Pro', 'advertica-lite' ); ?></a>
                </div>
            </div>
        </div>
		
		
	<!-- -------------- Timeliner Pro ------------------- -->

        <div id="Timeliner" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/timeliner-minimal-ultra-responsive-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/SketchBoard/includes/images/Timeliner_Modeling_Demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/timeliner-minimal-ultra-responsive-wordpress-theme/" target="_blank"><h4><?php _e('Timeliner - Minimal Ultra Responsive WordPress Theme','advertica-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e('Timeliner is a premier timeline theme for WordPress. Timeliner is a minimal, clean, modern and highly customizable theme. It allows you to create their website around any niche without the need of any complicated HTML code knowledge. Be it a Blog, Portfolio, Corporate, Agency, any other kind of website Timeliner will be a good pick for you. With our advanced admin panel, tons of customizations are possible and that will help you redefine your website&#39;s brand value. Also, this theme comes with retina ready feature. You can see great details on any devices screen.','advertica-lite');?></p>
                    </div>

                    <a class="buy  btn btn-info" href="http://sketchthemes.com/samples/timeliner-modeling-agency/" target="_blank"><?php _e( 'View Demo', 'advertica-lite' ); ?></a>
					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=30&product_id=30&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy Timeliner Pro', 'advertica-lite' ); ?></a>
 
                </div>
            </div>
        </div>

		
    </div>
    <!-- upsell themes -->
    </div>
    <!-- upsell container -->
    </div>
    <!-- container-fluid -->
    </div>
<?php
}

?>