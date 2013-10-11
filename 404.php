<?php
/**
 * 404 pages.
 */

get_header(); ?>

    <div id="main" role="main">
			<center>
			<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Uh oh, we’ve lost that page!', SP_TEXT_DOMAIN ); ?></h1>
			</header>
			<div class="entry-content">
				
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SP_TEXT_DOMAIN ); ?></p>
				<?php get_search_form(); ?>
				
			</div><!-- .entry-content -->
			</article><!-- #post-0 -->
			</center>
			
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
