<?php
/* Post Format - Audio */
?>

<div class="post-audio">
<?php
	$embed_url = get_post_meta( $post->ID, 'sp_audio_external', true ); 
	echo sp_soundcloud($embed_url);
?>
</div>