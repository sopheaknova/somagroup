<?php
/**
 * The sidebar containing the main widget area.
 */

global $post;
?>


	<?php 
	if ( is_single() || is_page() || is_singular('portfolio') ) {
		$layout_type = get_post_meta($post->ID, 'sp_page_layout', true);
		$sidebar_choice = get_post_meta($post->ID, 'sp_selected_sidebar', true);

		if( ($sidebar_choice != "" ) && ( $layout_type !="1col") ) { 
	?>
	
	<aside id="sidebar" class="widget-area" role="complementary">
	
	<?php		
			if ( function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_choice) ) :	
			else :
		?>	
			<div class="non-widget widget">
		    <h3><?php _e('About This '.$sidebar_choice, SP_TEXT_DOMAIN); ?></h3>
		    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>'.$sidebar_choice.'</em></strong> Area', SP_TEXT_DOMAIN); ?></p>
		    </div>
		    
	</aside> <!--End #Sidebar-->	    
		    
		<?php	
			endif;
		} 
	} else {
	?>
	
	<aside id="sidebar" class="widget-area" role="complementary">
	
	<?php
		if ( is_active_sidebar( 'Media Sidebar' ) ) :
			dynamic_sidebar('Media Sidebar');
		else:
		?>	
			<div class="non-widget widget">
		    <h3><?php _e('About Default Sidebar'); ?></h3>
		    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>Default Sidebar</em></strong> Area', SP_TEXT_DOMAIN); ?></p>
		    </div>
		    
	</aside> <!--End #Sidebar-->
		    
		<?php
		endif;	
	}
?>
