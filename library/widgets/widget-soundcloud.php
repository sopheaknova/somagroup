<?php
class sp_widget_soundcloud extends WP_Widget {
	
	function __construct() {
		
		$id     = 'sp-widget-soundcloud';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'SoundCloud', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-soundcloud',
			'description' => __( 'Embeded audio/sound from Soundcloud.com','sptheme_widget' )
			);
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $id );

		parent::__construct( $id, $name, $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['text_html_title'] );
		$url = $instance['url'];
		$autoplay = $instance['autoplay'];
		
		$play = 'false';
		if( !empty( $autoplay )) $play = 'true';


		
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
			echo sp_soundcloud( $url , $play );
			echo $after_widget;
				
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['text_html_title'] = strip_tags( $new_instance['text_html_title'] );
		$instance['url'] = $new_instance['url'] ;
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'text_html_title' => 'SoundCloud'  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_html_title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'text_html_title' ); ?>" name="<?php echo $this->get_field_name( 'text_html_title' ); ?>" value="<?php echo $instance['text_html_title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>">URL :</label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" type="text" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Autoplay :</label>
			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>


	<?php
	}
}
?>