<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Posts</title>
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
		var category = jQuery('#category').val();
		var thumbnail = jQuery('#thumbnail:checked').is(':checked');
		var description = jQuery('#description:checked').is(':checked');
		var post_number = jQuery('#post_number').val();
				
		shortcode = '[latest_blog';

		shortcode += ' category="' + category + '"';
		
		shortcode += ' thumbnail="' + thumbnail + '"';
		
		shortcode += ' post_number="' + post_number + '"';
		
		shortcode += ' description="' + description + '"';
		
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
	<form name="latest-blog" action="#" >
		<div class="tabs">
			<ul>
				<li id="blog_tab" class="current"><span><a href="javascript:mcTabs.displayTab('blog_tab','tabs_panel');" onMouseDown="return false;">Post Options</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<label for="category">select category: </label><br>
					<select id="category" name="category">
					<?php
					//Access the WordPress Categories via an Array
					$of_categories_obj 	= get_categories('hide_empty=0');
					foreach ($of_categories_obj as $of_cat) { 
					?>
						<option value="<?php echo $of_cat->cat_ID; ?>"><?php echo $of_cat->cat_name; ?></option>
					<?php
					}
					?>
					</select>
					<br><br>
					
					<label for="post_number">number of post:</label>
                    <input type="text" name="post_number" id="post_number" value="1" style="width:30px;" />
                    <br><br>
					 
                    <label for="thumbnail">thumbnail:</label>
                    <input type="checkbox" name="thumbnail" id="thumbnail" checked="checked" />
                    <br><br>
                    
                    <label for="description">short description:</label>
                    <input type="checkbox" name="description" id="description" checked="checked" />
                    
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