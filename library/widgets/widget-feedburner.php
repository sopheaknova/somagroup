<?php
class sp_widget_feedburner extends WP_Widget {

	function __construct() {
		
		$id     = 'sp-widget-feedburner';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Feedburner Widget', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-feedburner',
			'description' => __( 'Subscribe to feedburner via email','sptheme_widget' )
			);
		$control_ops = array();

		parent::__construct( $id, $name, $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$text_code = $instance['text_code'];
		$feedburner = $instance['feedburner'];
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		echo '<div class="widget-feedburner-counter">
		<p>'.do_shortcode( $text_code ).'</p>' ; ?>
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="feedburner-email" type="text" name="email" value="<?php _e( 'Enter your e-mail address' , 'sptheme_widget') ; ?>" onfocus="if (this.value == '<?php _e( 'Enter your e-mail address' , 'sptheme_widget') ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Enter your e-mail address' , 'sptheme_widget') ; ?>';}">
			<input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
			<input type="hidden" name="loc" value="en_US">			
			<input class="feedburner-subscribe" type="submit" name="submit" value="<?php _e( 'Subscribe' , 'sptheme_widget') ; ?>"> 
		</form>
		</div>
		<?php
		echo $after_widget;			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'FeedBurner Widget' , 'sptheme_widget') , 'text_code' => __( 'Subscribe to our email newsletter.' , 'sptheme_widget') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">Text above Email Input Field : <small>( support : Html & Shortcodes )</small> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>">Feedburner ID : </label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}
?>