<?php
/**
 * The template for displaying all posts.
 */

get_header(); ?>

    <div id="main" role="main">
		<?php
        if ( have_posts() ) :
			while ( have_posts() ) :
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-head">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-meta"><?php sp_meta_mini(); ?></div>
				</div> <!-- .entry-head -->
				<?php 
				if( 'video' == get_post_format() )
                    get_template_part( 'formats/format', 'video' );
                elseif ( 'gallery' == get_post_format() )
                    get_template_part( 'formats/format', 'gallery' );
                elseif ( 'audio' == get_post_format() )
                    get_template_part( 'formats/format', 'audio' );    
                else {
					the_post_thumbnail( 'size_max' ); 
				}	
				?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', SP_TEXT_DOMAIN ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile;
        else : ?>
			<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', SP_TEXT_DOMAIN ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SP_TEXT_DOMAIN ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
			</article><!-- #post-0 -->
        <?php endif; ?>
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>