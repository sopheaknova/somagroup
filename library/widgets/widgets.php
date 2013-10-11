<?php

/* ---------------------------------------------------------------------- */
/*	Register sidebars
/* ---------------------------------------------------------------------- */
function sp_widgets_init() {
	
	// Media Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Media Sidebar', 'sptheme_admin' ),
		'id' 			=> 'media-sidebar',
		'description' 	=> __( 'Drag widgets to present into news/event pages', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	// Page Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Page Sidebar', 'sptheme_admin' ),
		'id' 			=> 'pape-sidebar',
		'description' 	=> __( 'Drag widgets to present on static pages', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	// Footer Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Footer Sidebar', 'sptheme_admin' ),
		'id' 			=> 'footer-sidebar',
		'description' 	=> __( 'Footer Sidebar', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	
	// Addon widgets		
	/*
require_once ( SP_BASE_DIR . 'library/widgets/widget-category-post.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-social.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-feedburner.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-video.php' );
*/
		
	// Register widgets
	/*
register_widget( 'sp_widget_category_post' );
	register_widget( 'sp_widget_social' );
	register_widget( 'sp_widget_feedburner' );
	register_widget( 'sp_widget_video' );
*/
	
	
}
add_action('widgets_init', 'sp_widgets_init');

/* ---------------------------------------------------------------------- */
/*	Sidebars Generator
/* ---------------------------------------------------------------------- */

// Class to generate sidebar on the fly
require_once( SP_BASE_DIR . 'library/widgets/sidebar-generator.php' );
/*adds support for the new avia sidebar manager*/
add_theme_support('avia_sidebar_manager');

if(get_theme_support( 'avia_sidebar_manager' )) new avia_sidebar();