<?php
/* Post Format - Gallery */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix item-list'); ?>>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-meta"><?php sp_meta_mini(); ?></div>
	
	<?php 
		if( 'video' == get_post_format() )
	        get_template_part( 'formats/format', 'video' );
	    elseif ( 'gallery' == get_post_format() )
	        get_template_part( 'formats/format', 'gallery' );
	    elseif ( 'audio' == get_post_format() )
	        get_template_part( 'formats/format', 'audio' );    
	    else {
	    	echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'size_max' );
			echo '</div>'; 
		}	
	?>
	
	<div class="entry-content">
		<p><?php echo sp_excerpt_length(20); ?></p>
	</div> <!-- .entry-content -->
</article> <!-- .clearfix .item-list -->