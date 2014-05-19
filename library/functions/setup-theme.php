<?php

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 620;
		
		
		//ACTION & FILTER
		add_action( 'after_setup_theme', 'sp_theme_setup' );
		add_action('wp_enqueue_scripts', 'sp_print_scripts_styles'); //print Script and CSS
		add_action( 'wp_head', 'sp_print_custom_css_js' );//Custom CSS and JS when page load
		
		add_filter('wp_title', 'sp_filter_wp_title', 10, 2);
		add_filter( 'body_class', 'sp_body_class' );
		//TinyMCE customization
		if ( is_admin() ) {
			add_filter( 'mce_buttons', 'sp_add_buttons_row1' );
			add_filter( 'mce_buttons_2', 'sp_add_buttons_row2' );
		}
		
		add_filter( 'the_excerpt_rss', 'sp_rss_post_thumbnail' );//Display thumbnails in RSS
		add_filter( 'the_content_feed', 'sp_rss_post_thumbnail' );//Display thumbnails in RSS
		
		//BRANDING
		add_action( 'admin_head', 'sp_adminfavicon' );//Set favicons for backend code
		add_action('login_head', 'sp_custom_login_logo');// Custom logo login
		add_action( 'wp_before_admin_bar_render', 'sp_remove_admin_bar_links' );//	Remove logo and other items in Admin menu bar
		add_filter('the_generator', 'sp_remove_version_info'); // remover wordpress version
		add_filter('login_headerurl', 'sp_remove_link_on_admin_login_info');//  Remove wordpress link on admin login logo
		add_filter('login_headertitle', 'sp_change_loging_logo_title');// Change login logo title
		add_filter('admin_footer_text', 'sp_modify_footer_admin'); // Customising footer text

/*-----------------------------------------------------------------------------------*/
/*	theme set up
/*-----------------------------------------------------------------------------------*/ 
function sp_theme_setup() {

	// Makes theme available for translation.
	load_theme_textdomain( SP_TEXT_DOMAIN, get_template_directory() . '/languages' );

	// Add visual editor stylesheet support
	add_editor_style( SP_ASSETS_THEME . 'css/editor-style.css');

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Add post formats
	//add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

	// Add navigation menus
	register_nav_menus( array(
		'top'	=> __( 'Top Navigation', SP_TEXT_DOMAIN ),
		'primary'	=> __( 'Main Navigation', SP_TEXT_DOMAIN ),
		'footer'  => __( 'Footer Navigation', SP_TEXT_DOMAIN )
	) );

	// Add suport for post thumbnails and set default sizes
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 9999 ); //Set the default Featured Image

	// Add custom image sizes
	add_image_size( 'slideshow', 9999, 750, true );
	add_image_size( 'widget', 60, 60, true );


}

/* ---------------------------------------------------------------------- */
/*	Register CSS and JS
/* ---------------------------------------------------------------------- */

function sp_print_scripts_styles() {
	
	global $wp_styles, $smof_data, $is_IE;
	
	if(!is_admin()){
		//CSS
		wp_enqueue_style('rokkitt', 'http://fonts.googleapis.com/css?family=Montserrat:400', false, null);
		wp_enqueue_style('droid-sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700', false, null);
		wp_enqueue_style('sp-theme-styles', SP_BASE_URL . 'style.css', false, null);
		wp_enqueue_style('flexslider', SP_ASSETS_THEME . 'css/flexslider.css', false, null);
		wp_enqueue_style('fontello', SP_ASSETS_THEME . 'css/fontello.css', false, null);
		wp_enqueue_style('sp-base', SP_ASSETS_THEME . 'css/base.css', false, null);
		wp_enqueue_style('sp-layout', SP_ASSETS_THEME . 'css/layout.css', false, null, 'screen');
		wp_enqueue_style('bxslider', SP_ASSETS_THEME . 'css/jquery.bxslider.css', false, null);
		wp_enqueue_style('pretty-photo', SP_ASSETS_THEME . 'css/pretty-photo.css', false, null);
		wp_enqueue_style('sp-shortcodes', SP_ASSETS_THEME . 'css/shortcodes.css', false, null);
		
		// Internet Explorer specific stylesheet
		wp_enqueue_style('ie8-style',SP_ASSETS_THEME . 'css/ie8.min.css', array(), null);
		$wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8');
		
		wp_enqueue_style('ie9-style',SP_ASSETS_THEME . 'css/ie9.min.css');
		$wp_styles->add_data( 'ie9-style', 'conditional', 'IE 9', array(), null);
		
		//JS
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script("plugins", SP_ASSETS_THEME."js/plugins.js",array(),false,true);
		wp_enqueue_script("modernizr", SP_ASSETS_THEME."/js/modernizr-2.6.2.min.js",array(),false,true);
		wp_enqueue_script("prettyphoto-custom-param", SP_ASSETS_THEME."/js/custom_params.js",array(),false,true);
		if ( $is_IE ) {
			wp_enqueue_script("html5", SP_ASSETS_THEME."js/html5.js",array(),false,false);
		}
		wp_enqueue_script( 'shortcodes',    SP_ASSETS_THEME . 'js/shortcodes.js', array(), null, true );
		wp_enqueue_script( 'custom-scripts',    SP_ASSETS_THEME . 'js/custom.js', array(), null, true );
		
		if ( is_singular() ) wp_enqueue_script( "comment-reply");
		
		// BxSlider Options
		$config_array = array(	 
	        'speed' => $smof_data['slider_speed'],
	        'delay' => $smof_data['slider_delay'],
	        'mode'	=> $smof_data['slider_mode']
	    );
	 
	    wp_localize_script( 'custom-scripts', 'slider_opt', $config_array );
		
	}

}

//custom scripts and styles
function sp_print_custom_css_js() { 
	
}
	
/*-----------------------------------------------------------------------------------*/
/* Makes some changes to the <title> tag, by filtering the output of wp_title()
/*-----------------------------------------------------------------------------------*/
function sp_filter_wp_title( $title, $separator ) {

	if ( is_feed() ) return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf(__('Search results for %s', 'sptheme_admin'), '"' . get_search_query() . '"');

		if ( $paged >= 2 )
			$title .= " $separator " . sprintf(__('Page %s', 'sptheme_admin'), $paged);

		$title .= " $separator " . get_bloginfo('name', 'display');

		return $title;
	}

	$title .= get_bloginfo('name', 'display');
	$site_description = get_bloginfo('description', 'display');

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2)
		$title .= " $separator " . sprintf(__('Page %s', 'sptheme_admin'), max($paged, $page) );

	return $title;

}

/*-----------------------------------------------------------------------------------*/
/* Add body class to the theme depending upon options and templates
/*-----------------------------------------------------------------------------------*/ 
function sp_body_class( $classes ) {
	global $post, $smof_data;
	
	if ( is_single() || is_page() || is_singular('portfolio') ) {
		$has_sidebar = get_post_meta($post->ID, 'sp_page_layout', true);
		
		if ( '2cl' == $has_sidebar ) {
			$classes[] = 'sidebar-left';
		} elseif ( ('2cr' == $has_sidebar) ) {
			$classes[] = 'sidebar-right';
		} else {
			$classes[] = 'full-width';
		}
	}
	
	if ( is_category() || is_archive() || is_search() )
		$classes[] = 'sidebar-right';

	if ( 'stretched' == $smof_data['layout_style'] ) {
		$classes[] = 'is-stretched';
	}

	return $classes;
}

/* ---------------------------------------------------------------------- */
/*	Visual editor improvment
/* ---------------------------------------------------------------------- */
	
/*
* Add buttons to visual editor first row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row1' ) ) {
	function sp_add_buttons_row1( $buttons ) {
		//inserting buttons after "italic" button
		$pos = array_search( 'italic', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'underline';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//inserting buttons after "justifyright" button
		$pos = array_search( 'justifyright', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'justifyfull';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}
		
		return $buttons;
	}
} // /sp_add_buttons_row1

/*
* Add buttons to visual editor second row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row2' ) ) {
	function sp_add_buttons_row2( $buttons ) {
		//inserting buttons before "underline" button
		$pos = array_search( 'underline', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos );
			$add[] = 'removeformat';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//remove "justify full" button from second row
		$pos = array_search( 'justifyfull', $buttons, true );
		if ( $pos != false ) {
			unset( $buttons[$pos] );
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = '|';
			$add[] = 'sub';
			$add[] = 'sup';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		return $buttons;
	}
} // sp_add_buttons_row2

//Display thumbnails in RSS
if ( ! function_exists( 'sp_rss_post_thumbnail' ) ) {
	function sp_rss_post_thumbnail( $content ) {
		global $post;

		if ( has_post_thumbnail( $post->ID ) )
			$content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . get_the_content();

		return $content;
	}
} // /sp_rss_post_thumbnail

/* ---------------------------------------------------------------------- */
/*	Customizable login screen and WordPress admin area
/* ---------------------------------------------------------------------- */
// Custom logo login
function sp_custom_login_logo() {
    echo '<style type="text/css">
		body.login{ background-color:#ffffff; }
        .login h1 a { background-image:url('.SP_ASSETS_THEME.'images/logo.png) !important; height:87px !important; width:395px !important; background-size: auto auto !important; margin-left:-35px;}
    </style>';
}

// Remove wordpress link on admin login logo
function sp_remove_link_on_admin_login_info() {
     return  get_bloginfo('url');
}

// Change login logo title
function sp_change_loging_logo_title(){
	return 'Go to '.get_bloginfo('name').' Homepage';
}

//	Remove logo and other items in Admin menu bar
function sp_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wp-logo');
}

//  Remove wordpress version generation
function sp_remove_version_info() {
     return '';
}


// Customising footer text
function sp_modify_footer_admin () {  
  echo 'Created by <a href="http://www.novacambodia.com" target="_blank">novadesign</a>. Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';  
} 

//  Set favicons for backend code
function sp_adminfavicon() {
echo '<link rel="icon" type="image/x-icon" href="'.SP_BASE_URL.'favicon.ico" />';
}
