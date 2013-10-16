<?php 


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_quick_contact extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-quick-contact';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Quick Contact', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-quick-contact',
			'description' => __( 'Display quick contact information','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$address = $instance['address'];
		$tel = $instance['tel'];
		$fax = $instance['fax'];
		$email = $instance['email'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
			$widget_body = '';
			$widget_body .= '<ul>';
			if ($tel != '')
				$widget_body .= '<li><span class="address"></span>' . $address . '</li>';
			if ($tel != '')
				$widget_body .= '<li><span class="tel"></span>' . $tel . '</li>';
			if ($fax !='')
				$widget_body .= '<li><span class="fax"></span>' . $fax . '</li>';
			if ($email !='')
				$widget_body .= '<li><span class="email"></span><a href="mailto:'. antispambot($email) .'">' . antispambot($email) . '</a></li>';
			$widget_body .= '</ul>'; 
			echo apply_filters( 'widget_text', $widget_body );
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = $new_instance['address'];
		$instance['tel'] = $new_instance['tel'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Office','sptheme_widget'),
			'address' => '',
			'tel' => '',
			'fax' => '',
			'email' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
        <textarea id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" class="widefat" cols="10" rows="5"><?php echo $instance['address']; ?></textarea>
        </p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'tel' ); ?>"><?php _e('Tel:', 'sptheme_widget') ?></label>
		<input id="<?php echo $this->get_field_id( 'tel' ); ?>" name="<?php echo $this->get_field_name( 'tel' ); ?>" value="<?php echo $instance['tel']; ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e('Fax:', 'sptheme_widget') ?></label>
		<input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('E-mail:', 'sptheme_widget') ?></label>
		<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>"  class="widefat" />
		</p>
   <?php 
}
} //end class