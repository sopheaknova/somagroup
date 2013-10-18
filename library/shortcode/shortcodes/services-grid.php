<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Services</title>
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
		var services_title = jQuery('#services_title').val();	
		var services_content = jQuery('#services_content').val();	
		var icon_url = jQuery('#icon_url').val();	
		var link_to_page = jQuery('#link_to_page').val();	
		
		shortcode = '[services';

		shortcode += ' title="' + services_title + '"';
		
		shortcode += ' icon_url="' + icon_url + '"';
		
		shortcode += ' link_to_page="' + link_to_page + '"';
		
		if (services_content) {
		shortcode += ']' + services_content + '[/services]';
		}
		else {
		shortcode += ']' + selectedContent + '[/services]';
		}
			
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
	<form name="services" action="#" >
		<div class="tabs">
			<ul>
				<li id="services_tab" class="current"><span><a href="javascript:mcTabs.displayTab('services_tab','services_panel');" onMouseDown="return false;">services</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<label for="services_title">services title:</label><br>
                    <input type="text" name="services_title" id="services_title" style="width:250px" />	
					<br><br>
					
					<label for="icon_url">icon url:</label><br>
                    <input type="text" name="icon_url" id="icon_url" style="width:250px" />	
					<br><br>

					<label for="services_content">services content:</label><br>
                    <textarea name="services_content" id="services_content" cols="45" rows="5"></textarea>
                    <br><br>
                    
                    <label for="link_to_page">link to page:</label><br>
                    <input type="text" name="link_to_page" id="link_to_page" style="width:250px" />	
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