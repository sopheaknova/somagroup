<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Toggle</title>
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
		var toggle_title = jQuery('#toggle_title').val();	
		var toggle_content = jQuery('#toggle_content').val();	;	
		if (jQuery('#toggle_active').is(':checked')) {
			toggle_active = 'active';
		}
		//shortcode = ' [toggle type="'+toggle_type+'" title="'+toggle_title+'" active="'+toggle_active+'"]'+selectedContent+'[/toggle] ';			
		
		shortcode = '[toggle_content';

		shortcode += ' title="' + toggle_title + '"';
		
		if (toggle_content) {
		shortcode += ']' + toggle_content + '[/toggle_content]';
		}
		else {
		shortcode += ']' + selectedContent + '[/toggle_content]';
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
	<form name="toggle" action="#" >
		<div class="tabs">
			<ul>
				<li id="toggle_tab" class="current"><span><a href="javascript:mcTabs.displayTab('toggle_tab','toggle_panel');" onMouseDown="return false;">Toggle</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					
<label for="toggle_title">Toggle title:</label><br><br>
                    <input type="text" name="toggle_title" id="toggle_title"   style="width:250px" />	
					
						<br>
<br><br>

<label for="toggle_content">Toggle content:</label><br><br>	
                    <textarea name="toggle_content" id="toggle_content" cols="45" rows="5"></textarea>
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