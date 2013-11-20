<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit: 
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

$prefix = 'sp_';

global $meta_boxes, $sidebars;

$meta_boxes = array();
		
/* ---------------------------------------------------------------------- */
/*	General for Page and Post
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'layout-settings',
	'title'    => __('Layout Settings', 'sptheme_admin'),
	'pages'    => array('page', 'post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name'     => __('Page Layout', 'sptheme_admin'),
			'id'       => $prefix . 'page_layout',
			'type'     => 'radio_image',
			'options'  => array(
				//''     => '<img src="' . SP_ASSETS_ADMIN . 'images/layout/xcol.png" alt="' . __('Use theme default setting', 'sptheme_admin') . '" title="' . __('Use theme default setting', 'sptheme_admin') . '" />',
				'1col' => '<img src="' . SP_ASSETS_ADMIN . 'images/layout/1col.png" alt="' . __('Fullwidth - No sidebar', 'sptheme_admin') . '" title="' . __('Fullwidth - No sidebar"', 'sptheme_admin') . ' />',
				'2cl'  => '<img src="' . SP_ASSETS_ADMIN . 'images/layout/2cl.png" alt="' . __('Sidebar on the left', 'sptheme_admin') . '" title="' . __('Sidebar on the left', 'sptheme_admin') . '" />',
				'2cr'  => '<img src="' . SP_ASSETS_ADMIN . 'images/layout/2cr.png" alt="' . __('Sidebar on the right', 'sptheme_admin') . '" title="' . __('Sidebar on the right', 'sptheme_admin') . '" />',
				//'3col' => '<img src="' . SP_ASSETS_ADMIN . 'images/layout/3col.png" alt="' . __('Sidebar on left and right', 'sptheme_admin') . '" title="' . __('Sidebar on left and right', 'sptheme_admin') . '" />'
			),
			'std'  => '2cl',
			'desc' => __('select the layout structure for this page.', 'sptheme_admin')
		),
		array(
			'name' => __('Sidebar', 'sptheme_admin'),
			'id'   => $prefix . 'selected_sidebar',
			'type' => 'sidebar',
			'std'  => '',
			'desc' => 'Choose a sidebar to display'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	POST FORMAT: VIDEO
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-video-settings',
	'title'    => __('External Video Settings', 'sptheme_admin'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Video URL', 'sptheme_admin'),
			'id'   => $prefix . 'video_id',
			'type' => 'text',
			'std'  => '',
			'desc' => __('ex: http://www.youtube.com/watch?v=sdUUx5FdySs.', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	POST FORMAT: AUDIO
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-audio-settings',
	'title'    => __('External Audio Settings', 'sptheme_admin'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Audio/Sound URL', 'sptheme_admin'),
			'id'   => $prefix . 'audio_external',
			'type' => 'text',
			'std'  => '',
			'desc' => __('ex: https://soundcloud.com/loy9/loy9-radio-pro-81-all-my.', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Custom post: SLIDER
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slider-options',
	'title'    => __('Upload setting', 'sptheme_admin'),
	'pages'    => array('slider'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Upload images', 'sptheme_admin'),
			'id'   => $prefix . 'image_slide',
			'type' => 'image_advanced',
			'max_file_uploads' => 4,
			'desc' => __('Support image files .png, .jpg and .gif. Better upload image size max 1024px by 768px', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Custom post: SLIDESHOW
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slide-options',
	'title'    => __('Slide Options', 'sptheme_admin'),
	'pages'    => array('slideshow'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Slide URL/Link', 'sptheme_admin'),
			'id'   => $prefix . 'slide_link',
			'type' => 'text',
			'std'  => '',
			'desc' => __('ex: http://www.google.com.kh', 'sptheme_admin'),
		)
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function sp_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'sp_register_meta_boxes' );