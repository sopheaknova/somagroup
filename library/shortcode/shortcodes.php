<?php

add_action( 'init', 'add_shortcodes_button' );
/* ---------------------------------------------------------------------- */
/*	TinyMCE Buttons or Add Editor Buttons
/* ---------------------------------------------------------------------- */
function add_shortcodes_button() {
	
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
		return;
		
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter('mce_external_plugins', 'add_shortcodes_tinymce_plugin');
		add_filter('mce_buttons_3', 'register_shortcodes_button');
	}
	
}

function add_shortcodes_tinymce_plugin( $plugin_array ) {
    $plugin_array['sp_buttons'] = SP_BASE_URL.'library/shortcode/js/shortcodes.js';
    return $plugin_array;
}

function register_shortcodes_button( $buttons ) {
	
	//array_push( $buttons, "highlight", "notifications", "buttons", "divider", "toggle", "tabs", "accordian", "dropcaps", "video", "soundcloud", "columns" );
	if ( (get_post_type() == 'page') || (get_post_type() == 'post') )
	{
		array_push( $buttons, "highlight", "notifications", "buttons", "divider", "toggle", "tabs", "accordian", "dropcaps", "video", "soundcloud", "portfolio-grid", "columns" );	
	}
    return $buttons;
}


//raw

function sp_sc_formatter($content)
{
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece)
	{
		if (preg_match($pattern_contents, $piece, $matches))
		{
			$new_content .= $matches[1];
		}
		else
		{
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

/*
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
*/

add_filter('the_content', 'sp_sc_formatter', 99);

/* ---------------------------------------------------------------------- */
/*	Backend Scripts and style
/* ---------------------------------------------------------------------- */
function sp_admin_scripts_style_sc ($hook) {
	if( $hook == 'post.php' || $hook == 'post-new.php' ) {
	wp_register_style( 'shortcode-style', esc_url( get_template_directory_uri() . '/library/shortcode/css/sc-style.css' ) );
	wp_enqueue_style( 'shortcode-style' );
	}
}
add_action( 'admin_enqueue_scripts', 'sp_admin_scripts_style_sc');
	
/* ---------------------------------------------------------------------- */
/*	Make shortcode buttons work with wpml
/* ---------------------------------------------------------------------- */
add_action('admin_head', 'wpml_lang_init');

function wpml_lang_init()
{
	if(defined('ICL_LANGUAGE_CODE'))
	{?>
		<script>
			var sp_wpml_lang = '?lang=<?php echo ICL_LANGUAGE_CODE?>';
		</script>
	<?php
	}
	else
	{?>
		<script>
			var sp_wpml_lang = '';
		</script>
	<?php
	}
}

///Highlight
function highlight($atts, $content = null)
{
	extract(shortcode_atts(array(
					), $atts));

	$output = "<span class='hdark' >" . do_shortcode($content) . "</span>";

	return $output;
}

///Notifications
function notification($atts, $content = null)
{
	extract(shortcode_atts(array(
				'type' => '',
					), $atts));

	$output = "<div class='sp_notification " . $type . "' >" . do_shortcode($content) . "</div>";

	return $output;
}

add_shortcode('notification', 'notification');

add_shortcode('highlight', 'highlight');

//Color Buttons
function button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'default',
	  'url' => '',
	  'text' => '',
	  'target' => 'self'
      ), $atts ) );
	  if($url) {
		return '<a href="' . $url . '" class="button ' . $color . '" target="_'.$target.'"><span>' . $text . $content . '</span></a>';
	  } else {
		return '<div class="button ' . $color . '"><span>' . $text . $content . '</span></div>';
	}
}
add_shortcode('button', 'button_shortcode');

//Toggles
function toggle_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'      => '',
			'toggle_content' => ''
		), $atts ) );
		
		$output = '<div class="toggle-wrap">';
		$output .= '<h3 class="trigger"><a href="#">'  . esc_attr( $title ) .  '</a></h3><div class="toggle-container">';
		$output .= $toggle_content . $content;  
		$output .= '</div></div>';

		return $output;
	
	}
	add_shortcode('toggle_content', 'toggle_shortcode');
	
// Tabs container
function content_tabgroup_sc( $atts, $content = null ) {

	if( !$GLOBALS['tabs_groups'] )
		$GLOBALS['tabs_groups'] = 0;
		
	$GLOBALS['tabs_groups']++;

	$GLOBALS['tab_count'] = 0;

	$tabs_count = 1;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ) {

		foreach( $GLOBALS['tabs'] as $tab ) {

			$tabs[] = '<li><a href="#tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count . '">' . $tab['title'] . '</a></li>';
			$panes[] = '<div id="tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count++ . '" class="tab-content">' . do_shortcode( $tab['content'] ) . '</div>';

		}

		$return = "\n". '<ul class="tabs-nav">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div class="tabs-container">' . implode( "\n", $panes ) . '</div>' . "\n";
	}

	return $return;

}
add_shortcode('tabgroup', 'content_tabgroup_sc');

// Single tab
function content_tab_sc( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title' => ''
	), $atts) );

	$i = $GLOBALS['tab_count'];

	$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

	$GLOBALS['tab_count']++;

}
add_shortcode('tab', 'content_tab_sc');	

// Accordian
function accordion_content_sc( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'      => '',
			'accordian_content' => ''
		), $atts ) );

		return '<div class="accordion"><h4 class="acc-trigger"><a href="#">' . esc_attr( $title ) . '</a></h4><div class="acc-container"><div class="content">' . $accordian_content . do_shortcode( $content ) . '</div></div></div>';
	
	}
	add_shortcode('accordion', 'accordion_content_sc');

///Dropcaps
function dropcaps($atts, $content = null)
{
	extract(shortcode_atts(array(
					), $atts));

	$output = "<span class='dropcaps' >" . do_shortcode($content) . "</span>";

	return $output;
}

add_shortcode('dropcaps', 'dropcaps');

//Video
function video_sc( $atts, $content = null ) {
    
	extract( shortcode_atts( array(
			'width' => '620',
			'height' => '349'
		), $atts ) );	
		
	$output = sp_add_video($content, $width, $height);
	
	return $output;
}
add_shortcode('spvideo', 'video_sc');

//Soundcloud
function soundcloud_sc( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'url' => '',
			'autoplay' => false
		), $atts ) );
	
	$output = sp_soundcloud($content , $autoplay );
	
	return $output;
}
add_shortcode('spsoundcloud', 'soundcloud_sc');

//Portfolio Grid
function portfolio_grid_sc( $atts, $content = null ) {
	
	extract( shortcode_atts ( array(
				'column' 			=> '',
				'posts_per_page'	=> ''
			), $atts ) );
			
	$output = sp_portfolio_grid($column, $posts_per_page);	
	
	return $output;
		
}
add_shortcode('sp_portfolio_grid', 'portfolio_grid_sc');


/* ---------------------------------------------------------------------- */
/*	Columns
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	One half
	/* -------------------------------------------------- */

	function sp_two_half_sc( $atts, $content = null ) {

		return '<div class="two-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('two_fourth', 'sp_two_half_sc');

	/* -------------------------------------------------- */
	/*	One half last
	/* -------------------------------------------------- */

	function sp_two_half_last_sc( $atts, $content = null ) {

		return '<div class="two-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('two_fourth_last', 'sp_two_half_last_sc');

	/* -------------------------------------------------- */
	/*	One third
	/* -------------------------------------------------- */

	function sp_one_third_sc( $atts, $content = null ) {

		return '<div class="one-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_third', 'sp_one_third_sc');

	/* -------------------------------------------------- */
	/*	One third last
	/* -------------------------------------------------- */

	function sp_one_third_last_sc( $atts, $content = null ) {

		return '<div class="one-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_third_last', 'sp_one_third_last_sc');

	/* -------------------------------------------------- */
	/*	One fourth
	/* -------------------------------------------------- */

	function sp_one_fourth_sc( $atts, $content = null ) {

		return '<div class="one-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('one_fourth', 'sp_one_fourth_sc');

	/* -------------------------------------------------- */
	/*	One fourth last
	/* -------------------------------------------------- */

	function sp_one_fourth_last_sc( $atts, $content = null ) {

		return '<div class="one-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('one_fourth_last', 'sp_one_fourth_last_sc');

	/* -------------------------------------------------- */
	/*	Two third
	/* -------------------------------------------------- */

	function sp_two_third_sc( $atts, $content = null ) {

		return '<div class="two-third">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('two_third', 'sp_two_third_sc');

	/* -------------------------------------------------- */
	/*	Two third last
	/* -------------------------------------------------- */

	function sp_two_third_last_sc( $atts, $content = null ) {

		return '<div class="two-third last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('two_third_last', 'sp_two_third_last_sc');

	/* -------------------------------------------------- */
	/*	Three fourth
	/* -------------------------------------------------- */

	function sp_three_four_sc( $atts, $content = null ) {

		return '<div class="three-fourth">' . do_shortcode( $content ) . '</div>';

	}
	add_shortcode('three_fourth', 'sp_three_four_sc');

	/* -------------------------------------------------- */
	/*	Three fourth last
	/* -------------------------------------------------- */

	function sp_three_fourth_last_sc( $atts, $content = null ) {

		return '<div class="three-fourth last">' . do_shortcode( $content ) . '</div><div class="clear"></div>';

	}
	add_shortcode('three_fourth_last', 'sp_three_fourth_last_sc');

?>