<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Accordion</title>
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
		var accordion_title = jQuery('#accordion_title').val();	
		var accordion_content = jQuery('#accordion_content').val();	
		
		shortcode = '[accordion';

		shortcode += ' title="' + accordion_title + '"';
		
		if (accordion_content) {
		shortcode += ']' + accordion_content + '[/accordion]';
		}
		else {
		shortcode += ']' + selectedContent + '[/accordion]';
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
	<form name="accordion" action="#" >
		<div class="tabs">
			<ul>
				<li id="accordion_tab" class="current"><span><a href="javascript:mcTabs.displayTab('accordion_tab','accordion_panel');" onMouseDown="return false;">accordion</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					
<label for="toggle_title">Accordion title:</label><br><br>
                    <input type="text" name="accordion_title" id="accordion_title"   style="width:250px" />	
					
						<br>
<br><br>

<label for="toggle_content">Accordion content:</label><br><br>
                    <textarea name="accordion_content" id="accordion_content" cols="45" rows="5"></textarea>
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