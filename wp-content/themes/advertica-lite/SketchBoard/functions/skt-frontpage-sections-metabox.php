<?php

$prefix = 'advertica_';

/*-----------------------------------------------------------------------------------*/
/*	ADD FRONTPAGE SECTION METABOXES
/*-----------------------------------------------------------------------------------*/
// ADD METABOX

add_action('admin_init', 'skt_frontpagesection_metabox');
function skt_frontpagesection_metabox(){
	add_meta_box('frontpagesection-metabox', 'Home Page Template Sections', 'skt_frontpagesection_metabox_callback', 'page', 'normal', 'high');
}

// METABOX CALLBACK
function skt_frontpagesection_metabox_callback() { 
	global  $meta_box_page_revolution,$post;
	$fraturedbox          = get_post_meta( $post->ID,'_skt_freaturedboxsection_metabox',true );
	$latestprojectmeta    = get_post_meta( $post->ID,'_skt_latestproject_metabox',true );
	$parallaxeffectmeta   = get_post_meta( $post->ID,'_skt_parallaxeffect_metabox',true );
	$teammembermeta       = get_post_meta( $post->ID,'_skt_teammember_metabox',true );
	$teammembermetacall   = get_post_meta( $post->ID,'_skt_teammember_call',true );
	$teammembersel1       = get_post_meta( $post->ID,'_skt_teammember_sel1',true );
	$teammembersel2       = get_post_meta( $post->ID,'_skt_teammember_sel2',true );
	$teammembersel3       = get_post_meta( $post->ID,'_skt_teammember_sel3',true );
	$clientlogometa       = get_post_meta( $post->ID,'_skt_clientlogo_metabox',true );
	$tweetfeedmeta        = get_post_meta( $post->ID,'_skt_twfeed_metabox',true );
	$frontslider_set_meta = get_post_meta( $post->ID,'_skt_allslider_metabox',true );
	$skt_teammember_call_meta = get_post_meta( $post->ID,'_skt_teammember_call',true );
	$skt_statics_meta = get_post_meta( $post->ID,'_skt_statics_metabox',true );
	$skt_statics_meta_value = get_post_meta( $post->ID,'_skt_staticsarea_section',true );
	if(empty($skt_statics_meta)){add_post_meta($post->ID, '_skt_statics_metabox', '1'); }
	if(empty($frontslider_set_meta)){add_post_meta($post->ID, '_skt_allslider_metabox', 'video'); }
	if(empty($skt_statics_meta_value)){add_post_meta($post->ID, '_skt_staticsarea_section', '[skt_counter count="100" color="#fff" suffix="K" title="Facebook Likes"][/skt_counter][skt_counter count="55" color="#fff" title="Price" suffix="" prefix="$"][/skt_counter][skt_counter count="90" color="#fff" title="Projects completed"][/skt_counter][skt_counter count="90" color="#fff" title="Positive feedback" suffix="%"][/skt_counter]'); }
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>

<table>
  <tr>

    <td>
		<h4><?php _e('Featured Box Section','advertica-lite');?></h4>
	</td>
	<td>
		<div class="inputbox">
			 <label for="skt_freaturedboxsection_metabox1"><input type="radio" name="_skt_freaturedboxsection_metabox" id="skt_freaturedboxsection_metabox1" value="1" checked="checked"  <?php checked(1, $fraturedbox); ?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','advertica-lite') ?></label>
			 <label for="skt_freaturedboxsection_metabox2"><input type="radio" name="_skt_freaturedboxsection_metabox" id="skt_freaturedboxsection_metabox2" value="0" <?php checked(0, $fraturedbox); ?> /><?php _e('Disable','advertica-lite') ?></label>
		</div>
	</td>
   </tr>
  <tr>
    <td>
		<h4><?php _e('Content Box with Parallax Effect Section','advertica-lite');?></h4>
	</td>

	<td>
		<div class="inputbox">
			<label for="skt_parallaxeffect_metabox1"><input type="radio" name="_skt_parallaxeffect_metabox" id="skt_parallaxeffect_metabox1" value="1" checked="checked"  <?php checked(1, $parallaxeffectmeta);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','advertica-lite') ?></label>
			<label for="skt_parallaxeffect_metabox2"><input type="radio" name="_skt_parallaxeffect_metabox" id="skt_parallaxeffect_metabox2" value="0" <?php checked(0, $parallaxeffectmeta);?> /><?php _e('Disable','advertica-lite') ?></label>
		</div>
	</td>
   </tr>

   <tr>
    <td>
		<h4><?php _e('Client Logo Section','advertica-lite');?></h4>
	</td>

	<td>
		<div class="inputbox">
			<label for="skt_clientlogo_metabox1"><input type="radio" name="_skt_clientlogo_metabox" id="skt_clientlogo_metabox1" value="1" checked="checked"  <?php checked(1, $clientlogometa);?> /><?php _e('Enable &nbsp;&nbsp;&nbsp;&nbsp;','advertica-lite') ?></label>
			<label for="skt_clientlogo_metabox2"><input type="radio" name="_skt_clientlogo_metabox" id="skt_clientlogo_metabox2" value="0" <?php checked(0, $clientlogometa);?> /><?php _e('Disable','advertica-lite') ?></label>
		</div>
	</td>
   </tr>
   
</table>	
<?php 
} 

// Action when save post
add_action('save_post', 'skt_admin_save_frontpagesection');

/* When the post is saved, saves our custom data */
function skt_admin_save_frontpagesection( $post_id ) {

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	// Check permissions
	if(isset($_POST['post_type'])){
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}
	}
	else {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

    // OK, we're authenticated: we need to find and save the data
	if(isset($_POST['_skt_freaturedboxsection_metabox'])){ $skt_freaturedboxsection_metabox = $_POST['_skt_freaturedboxsection_metabox']; }
	if(isset($_POST['_skt_parallaxeffect_metabox'])){ $skt_parallaxeffect_metabox = $_POST['_skt_parallaxeffect_metabox']; }
	if(isset($_POST['_skt_clientlogo_metabox'])){ $skt_clientlogo_metabox = $_POST['_skt_clientlogo_metabox']; }
	
	global $meta_box_page_revolution,$post;
	if(isset($skt_freaturedboxsection_metabox)){ update_post_meta($post->ID, '_skt_freaturedboxsection_metabox', $skt_freaturedboxsection_metabox); }
	if(isset($skt_parallaxeffect_metabox)){ update_post_meta($post->ID, '_skt_parallaxeffect_metabox', $skt_parallaxeffect_metabox); }
	if(isset($skt_clientlogo_metabox)){ update_post_meta($post->ID, '_skt_clientlogo_metabox', $skt_clientlogo_metabox); }
	
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
?>