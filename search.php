<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>

    <div id="main" role="main">
		<?php 
        if ( ! have_posts() ) : ?>
            <article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h2 class="entry-title"><?php _e( 'Nothing Found', SP_TEXT_DOMAIN ); ?></h2>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SP_TEXT_DOMAIN ); ?></p>
                <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->
        <?php endif;
        while ( have_posts() ) :
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
			<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
			<p><?php echo sp_excerpt_length(40); ?></p>
			</article><!-- #post-<?php the_ID(); ?> -->
        <?php endwhile; // End the loop ?>
        <?php // Pagination
			if(function_exists('wp_pagenavi'))
				wp_pagenavi();
			else 
				echo sp_pagination(); 
		?>
    </div><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>