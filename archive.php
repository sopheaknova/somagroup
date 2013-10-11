<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

    <div id="main" role="main">
        <div class="blog-classic">
        <header class="entry-header tagline clearfix">

			<?php if ( have_posts() ): ?>
				
				<h3 class="archive-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', SP_TEXT_DOMAIN ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', SP_TEXT_DOMAIN ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', SP_TEXT_DOMAIN ), '<span>' . get_the_date( 'Y' ) . '</span>' );
						else :
							_e( 'Archives', SP_TEXT_DOMAIN );
						endif;
					?>
				</h3>

				<?php rewind_posts(); ?>
				
			<?php else: ?>
			
					<h3 class="archive-title"><?php _e( 'Nothing Found', SP_TEXT_DOMAIN ); ?></h3>

			<?php endif; ?>

        </header><!-- end .page-header -->


		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix item-list'); ?>>
					<?php get_template_part( 'formats/archive', 'classic' ); ?>
				</div>

			<?php endwhile; ?>

			<?php // Pagination
				if(function_exists('wp_pagenavi'))
					wp_pagenavi();
				else 
					echo sp_pagination(); 
			?>
		
		<?php else: ?>
		
			<article id="post-0" class="post no-results not-found">
		
				<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for...', SP_TEXT_DOMAIN ); ?></h3>

			</article><!-- end .hentry -->

		<?php endif; ?>
		</div> <!-- .classic-blog -->		
        
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
