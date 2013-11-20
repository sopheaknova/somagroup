<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Select photo slide</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		
		tinyMCEPopup.resizeToInnerSize();
	}
	function submitData() {				
		var shortcode;
		var selectedContent = tinyMCE.activeEditor.selection.getContent();	
		if (!selectedContent) {selectedContent = "Tab 1 content goes here.";}		
		var photo_id = jQuery('#photo_id').val();
		
		shortcode = '[photo_slide';

		shortcode += ' id="' + photo_id + '"';
		
		shortcode += ']';
		
			
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	
	
	</script>

	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="photo-slide" action="#" >
		<div class="tabs">
			<ul>
				<li id="photo_slide_tab" class="current"><span><a href="javascript:mcTabs.displayTab('photo_slide_tab','tabs_panel');" onMouseDown="return false;">Photo Options</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<label for="photo_id">select slide: </label><br>
					<select id="photo_id" name="category">
					<?php
					//Access the WordPress Categories via an Array
					$photo_slides = get_posts(array('post_type' => 'slider', 'posts_per_page' => -1));
					foreach ($photo_slides as $photo) : setup_postdata( $post ); 
					?>
						<option value="<?php echo $photo->ID; ?>"><?php echo $photo->post_title; ?></option>
					<?php
					endforeach
					?>
					</select>
					<?php wp_reset_postdata(); ?>
                    
				</fieldset>	
		</div>
		<div class="mceActionPanel">
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="Insert" onClick="submitData();" />
			</div>
		</div>
	</form>
</body>
</html>