<?php
/* Post Format - Gallery */
?>

<div class="flexslider post-thumbnail" id="flexslider-post">
	<ul class="slides">
<?php
	$args = array(
   'post_type' => 'attachment',
   'numberposts' => -1,
   'post_status' => null,
   'post_parent' => $post->ID,
   'order' 		 => 'ASC',
   'orderby' 	 => 'menu_order',
  );

  $attachments = get_posts( $args );
     if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
           echo '<li>';
           echo wp_get_attachment_image( $attachment->ID, 'full' );
           echo '<p>';
           echo apply_filters( 'the_title', $attachment->post_title );
           echo '</p></li>';
          }
     }

?>
	</ul>
</div>