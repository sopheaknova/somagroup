<?php
/*
*****************************************************
* Slider custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
* - 3) Custom post list in admin
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_slider_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_slider_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-slider_columns', 'sp_slider_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_slider_cp_init' ) ) {
		function sp_slider_cp_init() {
			global $cp_menu_position;

			$role     = 'post'; // page
			$slug     = 'slider';
			$supports = array('title'); // 'title', 'editor', 'thumbnail'

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/

			$args = array(
				'query_var'           => 'slider',
				'capability_type'     => $role,
				'public'              => true,
				'show_ui'             => true,
				'show_in_nav_menus'	  => false,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $slug ),
				'menu_position'       => $cp_menu_position['slider'],
				'menu_icon'           => SP_ASSETS_ADMIN . 'images/icon-slider.png',
				'supports'            => $supports,
				'labels'              => array(
					'name'               => __( 'Slider', 'sptheme_admin' ),
					'singular_name'      => __( 'Slider', 'sptheme_admin' ),
					'all_items'      	 => __( 'All slides', 'sptheme_admin' ),
					'add_new'            => __( 'Add new slide', 'sptheme_admin' ),
					'add_new_item'       => __( 'Add new slide', 'sptheme_admin' ),
					'new_item'           => __( 'Add new slide', 'sptheme_admin' ),
					'edit_item'          => __( 'Edit slide', 'sptheme_admin' ),
					'view_item'          => __( 'View slide', 'sptheme_admin' ),
					'search_items'       => __( 'Search slide', 'sptheme_admin' ),
					'not_found'          => __( 'No slide found', 'sptheme_admin' ),
					'not_found_in_trash' => __( 'No slide found in trash', 'sptheme_admin' ),
					'parent_item_colon'  => ''
				)
			);
			register_post_type( 'slider' , $args );
		}
	} 


/*
*****************************************************
*      3) CUSTOM POST LIST IN ADMIN
*****************************************************
*/
	/*
	* Registration of the table columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	if ( ! function_exists( 'sp_slider_cp_columns' ) ) {
		function sp_slider_cp_columns( $columns ) {
		
			$prefix = 'sp-slider';
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				$prefix.'thumbnail'		=> __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Name', 'sptheme_admin' ),
				$prefix.'shortcode' 	=> __( 'Shortcode', 'sptheme_admin' ),
				'date' 					=> __( 'Date', 'sptheme_admin' )
			);

			return $columns;
		}
	} // /slider_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_slider_cp_custom_column' ) ) {
		function sp_slider_cp_custom_column( $column ) {
			global $post;
			$prefix = 'sp-slider';
			
			switch ( $column ) {
				
				case $prefix."shortcode":
				echo '[photo_slides id=' . $post->ID .']';
				break;
				
				case $prefix."thumbnail":
				$slides = rwmb_meta('sp_image_slide', array('type' => 'plupload_image', 'size' => 'thumbnail'));
                $slide_index = 1;
                foreach ( $slides as $image ){
                        if ($slide_index == 1)
                                echo '<a href="' . get_edit_post_link( $post->ID ) . '"><img src="' . $image['url'] . '" width="60" height="60" /></a>';
                        $slide_index++;
                }
				break;
				
				default:
				break;
			}
		}
	} // /sp_slider_cp_custom_column
	
	