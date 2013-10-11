<?php
/* Post Format - Video */
?>

<div class="post-video">
<?php
	$embed_url = get_post_meta( $post->ID, 'sp_video_id', true ); 
	echo sp_add_video($embed_url);
?>
</div>