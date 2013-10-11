<?php
/*
*****************************************************
* Partner custom post
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
		add_action( 'init', 'sp_partner_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_partner_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-partner_columns', 'sp_partner_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_partner_cp_init' ) ) {
		function sp_partner_cp_init() {
			global $cp_menu_position;

			$role     = 'post'; // page
			$slug     = 'partner';
			$supports = array('title', 'thumbnail'); // 'title', 'editor', 'thumbnail'

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/

			$args = array(
				'query_var'           => 'partner',
				'capability_type'     => $role,
				'public'              => true,
				'show_ui'             => true,
				'show_in_nav_menus'	  => false,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => array( 'slug' => $slug ),
				'menu_position'       => $cp_menu_position['partner'],
				'menu_icon'           => SP_ASSETS_ADMIN . 'images/icon-partner.png',
				'supports'            => $supports,
				'labels'              => array(
					'name'               => __( 'Partner', 'sptheme_admin' ),
					'singular_name'      => __( 'Partner', 'sptheme_admin' ),
					'add_new'            => __( 'Add new partner', 'sptheme_admin' ),
					'add_new_item'       => __( 'Add new partner', 'sptheme_admin' ),
					'new_item'           => __( 'Add new partner', 'sptheme_admin' ),
					'edit_item'          => __( 'Edit partner', 'sptheme_admin' ),
					'view_item'          => __( 'View partner', 'sptheme_admin' ),
					'search_items'       => __( 'Search partner', 'sptheme_admin' ),
					'not_found'          => __( 'No partner found', 'sptheme_admin' ),
					'not_found_in_trash' => __( 'No partner found in trash', 'sptheme_admin' ),
					'parent_item_colon'  => ''
				)
			);
			register_post_type( 'partner' , $args );
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
	if ( ! function_exists( 'sp_partner_cp_columns' ) ) {
		function sp_partner_cp_columns( $columns ) {
		
			$prefix = 'sp-partner';
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				$prefix.'thumbnail'		=> __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Name', 'sptheme_admin' ),
				'date' 					=> __( 'Date', 'sptheme_admin' ),
				'author' 				=> __( 'Created By', 'sptheme_admin' )
			);

			return $columns;
		}
	} // /partner_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_partner_cp_custom_column' ) ) {
		function sp_partner_cp_custom_column( $column ) {
			global $post;
			$prefix = 'sp-partner';
			
			switch ( $column ) {
				
				case $prefix."thumbnail":
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );
					echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) ) . '</a>';
				break;
				
				default:
				break;
			}
		}
	} // /sp_partner_cp_custom_column
	
	