<?php
## widget_tabs

class sp_widget_tabs extends WP_Widget {
	function __construct() {
		
		$id     = 'sp-widget-tabbed';
		$prefix = THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Most Popular, Recent, Comments, Tags', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-tabbed',
			'description' => __( 'A widget show most popular, recent acomment in tabs','sptheme_widget' )
			);
		$control_ops = array();

		parent::__construct( $id, $name, $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		?>
	<div class="widget" id="tabbed-widget">
		<div class="widget-container">
			<div class="widget-top">
				<ul class="tabs posts-taps">
					<li class="tabs"><a href="#tab1"><?php _e( 'Popular' , 'tie' ) ?></a></li>
					<li class="tabs"><a href="#tab2"><?php _e( 'Recent' , 'tie' ) ?></a></li>
					<li class="tabs" style="margin-left:0; "><a href="#tab3"><?php _e( 'Comments' , 'tie' ) ?></a></li>
				</ul>
			</div>
			<div id="tab1" class="tabs-wrap">
				<ul>
					<?php sp_popular_posts() ?>	
				</ul>
			</div>
			<div id="tab2" class="tabs-wrap">
				<ul>
					<?php sp_last_posts()?>	
				</ul>
			</div>
			<div id="tab3" class="tabs-wrap">
				<ul>
					<?php sp_most_commented();?>
				</ul>
			</div>
		</div>
	</div><!-- .widget /-->
<?php
	}
}
?>
