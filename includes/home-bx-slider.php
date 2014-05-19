<div id="home-slideshow">
<ul class="home-bxslider">
  <?php 
  $args = array (
              'post_type'   => 'slideshow',
              'posts_per_page'  => 5
          );
  $slide_query = new WP_Query($args);
  if ($slide_query->have_posts()) :
  while ( $slide_query->have_posts() ) : $slide_query->the_post();      
  ?>
  <li style="background:url(<?php echo sp_post_thumbnail('slideshow');?>) center top no-repeat;">
  <div class="container">
    <div class="headline">
      <span class="title">
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
      </span><br />
      <span class="desc"><?php the_content(); ?></span>
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
</div><!--/#home-slideshow-->