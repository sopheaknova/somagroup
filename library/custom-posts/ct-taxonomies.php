<?php
/*
*****************************************************
* Custom taxonomies for custom posts
*
* CONTENT:
* - 1) Actions and filters
* - 2) Taxonomies function
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering taxonomies
		add_action( 'init', 'sp_create_taxonomies', 0 );
		/*
		The init action occurs after the theme's functions file has been included, so if you're looking for terms directly in the functions file, you're doing so before they've actually been registered.
		*/





/*
*****************************************************
*      2) TAXONOMIES FUNCTION
*****************************************************
*/
	/*
	* Custom taxonomies registration
	*/
	if ( ! function_exists( 'sp_create_taxonomies' ) ) {
		function sp_create_taxonomies() {
			$slug_menu_category = 'portfolio/category';

				register_taxonomy( 'portfolio-category', 'portfolio', array(
					'hierarchical'      => true,
					'show_in_nav_menus' => false,
					'show_ui'           => true,
					'query_var'         => 'portfolio-category',
					'rewrite'           => array( 'slug' => $slug_menu_category ),
					'labels'            => array(
						'name'          => __( 'Portfolio categories', 'sptheme_admin' ),
						'singular_name' => __( 'Portfolio category', 'sptheme_admin' ),
						'search_items'  => __( 'Search categories', 'sptheme_admin' ),
						'all_items'     => __( 'All categories', 'sptheme_admin' ),
						'parent_item'   => __( 'Parent category', 'sptheme_admin' ),
						'edit_item'     => __( 'Edit category', 'sptheme_admin' ),
						'update_item'   => __( 'Update category', 'sptheme_admin' ),
						'add_new_item'  => __( 'Add new category', 'sptheme_admin' ),
						'new_item_name' => __( 'New category title', 'sptheme_admin' )
					)
				) );


		}
	} // /sp_create_taxonomies

?>