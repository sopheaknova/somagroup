<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert soundcloud</title>
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
		var autoplay = jQuery('#soundcloud_autoplay:checked').is(':checked');	
		var soundcloud_url = jQuery('#soundcloud_url').val();	;	
		
		shortcode = '[spsoundcloud';

		shortcode += ' autoplay="' + autoplay + '"';
		
		if (soundcloud_url) {
		shortcode += ']' + soundcloud_url + '[/spsoundcloud]';
		}
		else {
		shortcode += ']' + selectedContent + '[/spsoundcloud]';
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
	<form name="soundcloud" action="#" >
		<div class="tabs">
			<ul>
				<li id="soundcloud_tab" class="current"><span><a href="javascript:mcTabs.displayTab('soundcloud_tab','soundcloud_panel');" onMouseDown="return false;">Toggle</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					
					<label for="soundcloud_autoplay">Set autoplay:</label><br><br>	
					<input name="soundcloud_autoplay" type="checkbox" id="soundcloud_autoplay">
						<br>
<br><br>

<label for="soundcloud_url">URL:</label><br><br>	
                    <input type="text" name="soundcloud_url" id="soundcloud_url"   style="width:250px" />
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