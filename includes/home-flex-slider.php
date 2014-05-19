<div id="flex-fullwidth" class="flexslider">
<ul class="slides">
  <?php 
  $args = array (
              'post_type'   => 'slideshow',
              'posts_per_page'  => 5
          );
  $slide_query = new WP_Query($args);
  if ($slide_query->have_posts()) :
  while ( $slide_query->have_posts() ) : $slide_query->the_post();      
  ?>
  <li>
    <img src="<?php echo sp_post_thumbnail('slideshow');?>">
    <div class="container">
    <div class="flex-caption">
      <h5>
      <?php 
      $slide_link = get_post_meta( get_the_ID(), 'sp_slide_link', true );
      if ( !$slide_link || $slide_link == '' ){
        the_title();
      } else {
      ?>
      <a href="<?php echo $slide_link; ?>"><?php the_title(); ?></a>
      <?php 
      }
      ?>
      </h5>
      <?php the_content(); ?>
    </div>
    </div>
  </li>
  <?php
  endwhile;
  else: 
  echo "<li>" . __( 'Sorry, There are no slide, It is coming shortly.', SP_TEXT_DOMAIN ) . "</li>";
  endif;
  wp_reset_postdata();
  ?>  
</ul>
</div>