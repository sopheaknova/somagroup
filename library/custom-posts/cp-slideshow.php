<?php
/*
*****************************************************
* Slideshow custom post
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
		add_action( 'init', 'sp_slideshow_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_slideshow_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-slideshow_columns', 'sp_slideshow_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_slideshow_cp_init' ) ) {
		function sp_slideshow_cp_init() {
			global $cp_menu_position;

			$role     = 'post'; // page
			$slug     = 'slideshow';
			$supports = array('title', 'thumbnail', 'editor'); // 'title', 'editor', 'thumbnail'

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/

			$args = array(
				'query_var'           => 'slideshow',
				'capability_type'     => $role,
				'public'              => true,
				'show_ui'             => true,
				'show_in_nav_menus'	  => false,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $slug ),
				'menu_position'       => $cp_menu_position['slideshow'],
				'menu_icon'           => SP_ASSETS_ADMIN . 'images/icon-slider.png',
				'supports'            => $supports,
				'labels'              => array(
					'name'               => __( 'Slideshow', 'sptheme_admin' ),
					'singular_name'      => __( 'Slideshow', 'sptheme_admin' ),
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
			register_post_type( 'slideshow' , $args );
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
	if ( ! function_exists( 'sp_slideshow_cp_columns' ) ) {
		function sp_slideshow_cp_columns( $columns ) {
		
			$prefix = 'sp-slideshow';
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				$prefix.'thumbnail'		=> __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Name', 'sptheme_admin' ),
				'date' 					=> __( 'Date', 'sptheme_admin' ),
				'author' 				=> __( 'Created By', 'sptheme_admin' )
			);

			return $columns;
		}
	} // /slideshow_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_slideshow_cp_custom_column' ) ) {
		function sp_slideshow_cp_custom_column( $column ) {
			global $post;
			$prefix = 'sp-slideshow';
			
			switch ( $column ) {
				
				case $prefix."thumbnail":
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );
					echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) ) . '</a>';
				break;
				
				default:
				break;
			}
		}
	} // /sp_slideshow_cp_custom_column
	
	