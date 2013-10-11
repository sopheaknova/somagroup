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
		var shortcode;
		var column = jQuery('#column').val();
		var posts_per_page = jQuery('#posts_per_page').val();
		
		
		shortcode = '[sp_portfolio_grid';

		shortcode += ' column="' + column + '"';
		
		shortcode += ' posts_per_page="' + posts_per_page + '"';
		
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
	<form name="portfolio-grid" action="#" >
		<div class="tabs">
			<ul>
				<li id="portfolio-grid_tab" class="current"><span><a href="javascript:mcTabs.displayTab('portfolio-grid_tab','portfolio-grid_tab');" onMouseDown="return false;">Video</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Columns:</legend>
					<label for="column">How many columns should be displayed?:</label><br><br>
					<select name="column" id="column">
						<option value="col1" selected>1 Column</option>
						<option value="col2">2 Column</option>
						<option value="col3">3 Column</option>
						<option value="col4">4 Column</option>
					</select>
				</fieldset>
				
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Post Number:</legend>
					<label for="posts_per_page">How many items should be displayed per page?:</label><br><br>
					<select name="posts_per_page" id="posts_per_page">
						<option value="-1" selected>All</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
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