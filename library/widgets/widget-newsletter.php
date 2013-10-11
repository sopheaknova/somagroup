<?php

add_action( 'widgets_init', 'pt_newsletter_widget' );

// Register widget
function pt_newsletter_widget() {
	register_widget( 'pt_Newsletter_Widget' );
}

class pt_Newsletter_Widget extends WP_Widget {

	function pt_Newsletter_Widget() {

	$widget_ops = array(
		'classname' => 'pt_newsletter_widget',
		'description' => __('Pixelthrone Newsletter Widget', 'pt_framework')
	);
	
	$control_ops = array();

	$this->WP_Widget( 'pt_newsletter_widget', __('Pixelthrone Newsletter Widget', 'pt_framework'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	
	extract( $args );

	echo '<section class="newsletter container">
                <h5 class="light">' . $instance['title'] . '</h5>

                <form class="newsletter-form" action="#" method="post">

                    <div class="row newsletter-fields">
                        <fieldset class="span4 offset4">
                            <input name="email" type="email" required placeholder="' . $instance['placeholder'] . '">
                            <button type="submit" class="entypo">&#10150;</button>
                        </fieldset>
                    </div>

                    <div class="newsletter-info">' . $instance['success_msg'] . '</div>
                    <div class="newsletter-validate">' . $instance['error_msg'] . '</div>

                </form>

    </section>';
	
}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	
	$instance = $old_instance;
	
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['placeholder'] = strip_tags( $new_instance['placeholder'] );
	$instance['success_msg'] = strip_tags( $new_instance['success_msg'] );
	$instance['error_msg'] = strip_tags( $new_instance['error_msg'] );

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'placeholder' => 'your e-mail',
		'title' => 'subscribe to our newsletter',
		'success_msg' => 'Thanks for subscribing',
		'error_msg' => 'Please enter a valid e-mail',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>The e-mail's registered in the newsletter are available in Appearance &gt; Site Options &gt; Newsletter</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __('Title:', 'pt_framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>"><?php echo __('E-mail Placeholder:', 'pt_framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" value="<?php echo $instance['placeholder']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'success_msg' ); ?>"><?php echo __('Success message:', 'pt_framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'success_msg' ); ?>" name="<?php echo $this->get_field_name( 'success_msg' ); ?>" value="<?php echo $instance['success_msg']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'error_msg' ); ?>"><?php echo __('Success message:', 'pt_framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'error_msg' ); ?>" name="<?php echo $this->get_field_name( 'error_msg' ); ?>" value="<?php echo $instance['error_msg']; ?>" />
	</p>

		
	<?php
	}
}
?>