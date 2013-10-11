<?php	
require_once('../../../../../../wp-load.php');
$customcolor = "#c62b02";
?>
<!doctype html>
<html lang="en">
	<head>
	<title>Insert Button</title>
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
		var button_type = jQuery('#button_type').val();		
		var button_url = jQuery('#button_url').val();
		var text = jQuery('#button_txt').val();	
		if (jQuery('#button_target').is(':checked')) {
		var button_target = jQuery('#button_target:checked').val();} else {var button_target = '';}	
		
		shortcode = '&nbsp;';
		shortcode = '[button ';
		shortcode += 'color="' + button_type + '" ';		
		
		// only insert if the url field is not blank
		if(button_url) {
			shortcode += ' url="' + button_url + '" ';
		}
		
		if(button_target){
			shortcode += ' target="_self"';
		}
		
		//insert text
		if(text) {	
			shortcode += ']'+ text + '[/button]';
		}
		else {
			
		// if it is blank, use selected content
			shortcode += ']' + selectedContent + '[/button]';
		}		
			
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	
	jQuery(document).ready(function() {
    jQuery("#button_type").change(function() {
        var type = jQuery(this).val();
        jQuery("#preview").html(type ? "<a class='button "+type+"' style='cursor:pointer'><span>Test button</span></a>"  : "");
    });	
	});
	
	</script>

	<style type="text/css">
a {transition: color, background 200ms ease-in-out;
											  -webkit-transition: color, background 200ms ease-in-out;
											  -moz-transition: color, background 200ms ease-in-out;
											  -o-transition: color, background 200ms ease-in-out;}
a:hover {transition: color, background 200ms ease-in-out;
											  -webkit-transition: color, background 200ms ease-in-out;
											  -moz-transition: color, background 200ms ease-in-out;

											  -o-transition: color, background 200ms ease-in-out;}

.button,
.button span {
    display: inline-block;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
											  
.button {
    white-space: nowrap;
	nowhitespace: afterproperty;
	line-height: 34px;
	position: relative;
	outline: none;
	overflow: visible;
	/* removes extra side padding in IE */
	cursor: pointer;
	nowhitespace: afterproperty;
	border:1px solid #999; /* IE */
	border:rgba(0,0,0,.1) 1px solid;
	/* Saf4+,Chrome,FF3.6 */
	border-bottom:rgba(0,0,0,.3) 1px solid;
	nowhitespace: afterproperty;
	background:-moz-linear-gradient(center top,rgba(255,255,255,.1) 0%,rgba(0,0,0,.1) 100%);/* FF3.6 */
	background:-webkit-gradient(linear,center bottom,center top,from(rgba(0,0,0,.1)),to(rgba(255,255,255,.1)));/* Saf4+,Chrome */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#19FFFFFF',EndColorStr='#19000000'); /* IE6,IE7 */
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorStr='#19FFFFFF',EndColorStr='#19000000')"; /* IE8 */
	-moz-user-select:none;
	-webkit-user-select:none;
	-khtml-user-select:none;
	user-select:none;
	margin-bottom:10px;
	min-height:34px;
	text-decoration: none;
}
.button:hover,
.button.hover { opacity: 0.8 }
.button:active,
.button.active { top: 1px }
.button span {
    position: relative;
    color: #fff;
    font-weight: bold;
    text-shadow: 0 1px 1px rgba(0,0,0,0.25);
    border-top: rgba(255,255,255,.2) 1px solid;
    padding: 0.8em 1.3em;
    line-height: 1.3em;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
}
.button.black { background-color: #333 }
.button.gray { background-color: #666 }
.button.light-gray {
    background-color: #D5D2D2;
    text-shadow: 1px 1px 0px #FFF;
}
.button.light-gray span {
    color: #444;
    text-shadow: 1px 1px 0px #e7e7e7;
    border-top: rgba(255,255,255,.6) 1px solid;
}
.button.red { background-color: #D4363A }
.button.orange { background-color: #fc6440 }
.button.blue { background-color: #025D8C }
.button.pink { background-color: #e22092 }
.button.green { background-color: #86b662 }
.button.rosy { background-color: #FE4365 }
.button.brown { background-color: #7B5C5D }
.button.purple { background-color: #66435F }
.button.gold { background-color: #febd4c }
	</style>
	<base target="_self" />
	</head>
	<body  onload="init();">
	<form name="buttons" action="#" >
		<div class="tabs">
			<ul>
				<li id="buttons_tab" class="current"><span><a href="javascript:mcTabs.displayTab('buttons_tab','buttons_panel');" onMouseDown="return false;">Buttons</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Type of button:</legend>
					<label for="button_type">Choose a color:</label><br><br>
					<select name="button_type" id="button_type"  style="width:250px">
						<option value="black" selected="selected">Black</option>
                        <option value="blue">Blue</option>
                        <option value="brown">Brown</option>
                        <option value="light-gray">Light Gray</option>
                        <option value="gold">Gold</option>
                        <option value="gray">Gray</option>
                        <option value="green">Green</option>
                        <option value="orange">Orange</option>
                        <option value="pink">Pink</option>
                        <option value="purple">Purple</option>
                        <option value="red">Red</option>                        
					</select>					
				</fieldset>
			
				<fieldset style="margin-bottom:10px;padding:10px">
				<legend>URL for button:</legend>
					<label for="button_url">Type your URL here:</label><br><br>
					<input name="button_url" type="text" id="button_url" style="width:250px">
				</fieldset>
                <fieldset style="margin-bottom:10px;padding:10px">
                <legend>Text for button:</legend>
					<label for="button_txt">Type your Text here:</label><br><br>
					<input name="button_txt" type="text" id="button_txt" style="width:250px">
				</fieldset>
                <fieldset style="margin-bottom:10px;padding:10px">
				<legend>Link target:</legend>
					<label for="button_target">Check if you want open in new window:</label><br><br>
					<input name="button_target" type="checkbox" id="button_target">
				</fieldset>
				<fieldset style="margin-bottom:10px;padding:10px">
					<legend>Preview:</legend>
					<div id="preview" style="height:70px"></div>
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