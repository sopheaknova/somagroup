<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Tabs</title>
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
		var tabs_type = jQuery('#tabs_type').val();
		var tabs_title = jQuery('#tabs_title').val();
		var tabs_content = jQuery('#tabs_content').val();
		var tabs_single = jQuery('#tabs_single:checked').is(':checked');
				
		shortcode = ( !tabs_single ? '[tabgroup type="'+tabs_type+'"] <br>' : '' ); 
		if (tabs_content) {
			shortcode += '[tab title="'+tabs_title+'"]'+tabs_content+'[/tab]';
		} else {
			shortcode += '[tab title="'+tabs_title+'"]'+selectedContent+'[/tab]';
		}
		if( !tabs_single )
			shortcode += '<br>[/tabgroup]';
		
			
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
	<form name="tabs" action="#" >
		<div class="tabs">
			<ul>
				<li id="tabs_tab" class="current"><span><a href="javascript:mcTabs.displayTab('tabs_tab','tabs_panel');" onMouseDown="return false;">Tabs</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<label for="tabs_type">Type : </label><br>
					<select id="tabs_type" name="tabs_type">
						<option value="horizontal">Horizontal</option>
						<option value="vertical">Vertical</option>
					</select>
					<br><br>
                     
                    <label for="tabs_title">Tab title:</label><br>
                    <input type="text" name="tabs_title" id="tabs_title" style="width:250px" />
                    
                    <br><br>

					<label for="tabs_content">Tab content:</label><br>
                    <textarea name="tabs_content" id="tabs_content" cols="45" rows="5"></textarea> 	
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