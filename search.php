<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>

    <div id="main" role="main">
		<header class="entry-header">
            <?php if ( have_posts() ): ?>
                <h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'sptheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <?php else: ?>
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'sptheme' ); ?></h1>
            <?php endif; ?>
        </header><!-- end .entry-header -->
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
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
        <?php else: ?>
            <article id="post-0" class="hentry post no-results not-found">
                <h3><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sptheme' ); ?></h3>
            </article><!-- end .hentry -->

        <?php endif; ?>
    </div><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>