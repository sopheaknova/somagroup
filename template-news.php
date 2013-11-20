<?php
/*
Template Name: News
*/
get_header(); ?>

    <div id="main" role="main">
		<?php
		
		$args = array(
			'posts_per_page' => 1,
			);
			
		$query = new WP_Query( $args );	
		
        if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-meta"><?php sp_meta_mini(); ?></div>
			</header>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', SP_TEXT_DOMAIN ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile;
        else : ?>
			<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Sorry', SP_TEXT_DOMAIN ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'There is no news or event. We will update shortly', SP_TEXT_DOMAIN ); ?></p>
			</div><!-- .entry-content -->
			</article><!-- #post-0 -->
        <?php endif; ?>
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>