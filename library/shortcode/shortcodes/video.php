<?php
require_once('../../../../../../wp-load.php');
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Video</title>
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
		var selectedContent = tinyMCE.activeEditor.selection.getContent();
		var shortcode = '[spvideo';
		var video_url = jQuery('#video_url').val();
		var videoWidth = jQuery('#video_width').val();
		var videoHeight = jQuery('#video_height').val();
		
		/*if(videoWidth.length)
		{
			shortcode += ' width="'+ videoWidth +'"';
		}
		if(videoHeight.length)
		{
			shortcode += ' height="'+ videoHeight +'"';
		}*/
		shortcode += ']';
		if(video_url.length)
		{
			shortcode += video_url;
		}
		
		shortcode += '[/spvideo]';
			
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
	<form name="video" action="#" >
		<div class="tabs">
			<ul>
				<li id="video_tab" class="current"><span><a href="javascript:mcTabs.displayTab('video_tab','video_panel');" onMouseDown="return false;">Video</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Video URL:</legend>
					<label for="video_url">YouTube, Daily or Vimeo URL:</label><br><br>
					<input type="text" name="video_url" id="video_url" style="width:250px" />
				</fieldset>

				<!--<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Size:</legend>
					<label for="video_width">Width:</label>
					&nbsp;<input type="text" name="video_width" id="video_width" style="width:60px"/>
					<br><br>
					<label for="height">Height:</label>
					<input type="text" name="video_height" id="video_height" style="width:60px" />
				</fieldset>-->
		</div>
		<div class="mceActionPanel">
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="Insert" onClick="submitData();" />
			</div>
		</div>
	</form>
</body>
</html>