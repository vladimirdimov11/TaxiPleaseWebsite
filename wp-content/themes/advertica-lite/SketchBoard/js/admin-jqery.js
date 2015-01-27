/*-- Upload image jquery start 
--------------------------------------------*/
jQuery(document).ready( function() {
	var targetfield= '.upload_meta_image';
	var fwb_send_to_editor = window.send_to_editor;
	jQuery('.upload_image_button').click(function(){
		targetfield = jQuery(this).prev('.upload_meta_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery(targetfield).val(imgurl);
			tb_remove();
			window.send_to_editor = fwb_send_to_editor;
		}
		return false;
	});	
});
/*-------------------------------------------*/
