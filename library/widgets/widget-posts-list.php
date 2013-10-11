<?php

class sp_widget_posts_list extends WP_Widget {
	
	function __construct() {
		
		$id     = 'sp-widget-posts-list';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Posts list', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-posts-list',
			'description' => __( 'Show popular, Most recent or Random posts','sptheme_widget' )
			);
		$control_ops = array();

		parent::__construct( $id, $name, $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['posts_list_title'] );
		$no_posts = $instance['no_posts'];
		$posts_order = $instance['posts_order'];
		$thumb = $instance['thumb'];

		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
				<ul>
					<?php
					if( $posts_order == 'popular' )
						sp_popular_posts($no_posts , $thumb);
						
					elseif( $posts_order == 'random' )
						sp_random_posts($no_posts , $thumb);
						
					else
						sp_last_posts($no_posts , $thumb)?>	
				</ul>
		<div class="clear"></div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['posts_list_title'] = strip_tags( $new_instance['posts_list_title'] );
		$instance['no_posts'] = strip_tags( $new_instance['no_posts'] );
		$instance['posts_order'] = strip_tags( $new_instance['posts_order'] );
		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'posts_list_title' =>__('Recent Posts' , 'sptheme_widget') , 'no_posts' => '5' , 'posts_order' => 'latest', 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_list_title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'posts_list_title' ); ?>" name="<?php echo $this->get_field_name( 'posts_list_title' ); ?>" value="<?php echo $instance['posts_list_title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_posts' ); ?>">Number of posts to show: </label>
			<input id="<?php echo $this->get_field_id( 'no_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_posts' ); ?>" value="<?php echo $instance['no_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_order' ); ?>">Posts order : </label>
			<select id="<?php echo $this->get_field_id( 'posts_order' ); ?>" name="<?php echo $this->get_field_name( 'posts_order' ); ?>" >
				<option value="latest" <?php if( $instance['posts_order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>>Most recent</option>
				<option value="random" <?php if( $instance['posts_order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
				<option value="popular" <?php if( $instance['posts_order'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Display Thumbinals : </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>