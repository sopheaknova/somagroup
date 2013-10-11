<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

    <div id="main" role="main">
        <div class="blog-classic">
        <header class="entry-header tagline clearfix">
			<?php $category_id = get_query_var('cat') ; ?>
			<?php if ( have_posts() ): ?>
				
				<h3 class="archive-title">
					<?php printf( __( 'Category Archives: %s', SP_TEXT_DOMAIN ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
				</h3>

				<?php rewind_posts(); ?>
				
			<?php else: ?>
			
				<h3 class="archive-title"><?php _e( 'Nothing Found', SP_TEXT_DOMAIN ); ?></h3>

			<?php endif; ?>
			
			<!-- RSS -->
			<a class="rss-cat-icon ttip" title="<?php _e( 'Feed Subscription', SP_TEXT_DOMAIN ); ?>" href="<?php echo get_category_feed_link($category_id) ?>"><?php _e( 'Feed Subscription', SP_TEXT_DOMAIN ); ?></a>
			<div class="clear"></div>
			
			<!-- Category description -->
			<?php $category_description = category_description();
				if ( ! empty( $category_description ) )
				echo '<div class="clear"></div><div class="archive-meta">' . $category_description . '</div>';
			?>

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
		</div> <!-- .blog-classic -->
        
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
