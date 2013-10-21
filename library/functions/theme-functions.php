<?php

/* ---------------------------------------------------------------------- */
/*	Add rel=wp-prettyPhoto on each image of page and post
/* ---------------------------------------------------------------------- */

// Determine whether WP-prettyPhoto plugin is acivated and assign the result to a constant
defined('WP_PRETTY_PHOTO_PLUGIN_ACTIVE')
        || define('WP_PRETTY_PHOTO_PLUGIN_ACTIVE', class_exists( 'WP_prettyPhoto' ) );


// if the WP-prettyPhoto plugin is not active handle rel="wp-prettyPhoto" in links for the prettyPhoto integrated script (if enabled)
if ( !WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) {
    /**
     * Insert rel="wp-prettyPhoto" to all links for images, movie, YouTube and iFrame. 
     * This function will ignore links where you have manually entered your own rel reference.
     * @param string $content Post/page contents
     * @return string Prettified post/page contents
     * @link http://0xtc.com/2008/05/27/auto-lightbox-function.xhtml
     * @access public
      */
    function autoinsert_rel_prettyPhoto ($content) {
        global $post;
        $rel = 'wp-prettyPhoto';
        $image_match = '\.bmp|\.gif|\.jpg|\.jpeg|\.png';
        $movie_match = '\.mov.*?';
        $swf_match = '\.swf.*?';
        $youtube_match = 'http:\/\/www\.youtube\.com\/watch\?v=[A-Za-z0-9]*';
        $iframe_match = '.*iframe=true.*';
        $pattern[0] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")([^\>]*?)>/i";
        $pattern[1] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")(.*?)(rel=('|\")".$rel."(.*?)('|\"))([ \t\r\n\v\f]*?)((rel=('|\")".$rel."(.*?)('|\"))?)([ \t\r\n\v\f]?)([^\>]*?)>/i";
        $replacement[0] = '<a$1href=$2$3$4$5$6 rel="'.$rel.'['.$post->ID.']">';
        $replacement[1] = '<a$1href=$2$3$4$5$6$7>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }
    add_filter('the_content', 'autoinsert_rel_prettyPhoto');
    add_filter('the_excerpt', 'autoinsert_rel_prettyPhoto');


    // Add the 'wp-prettyPhoto' rel attribute to the default WP gallery links
    function gallery_prettyPhoto ($content) {
            // add checks if you want to add prettyPhoto on certain places (archives etc).
            return str_replace("<a", "<a rel='wp-prettyPhoto[gallery]'", $content);
    }
    add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto');
}


/* ---------------------------------------------------------------------- */
/*	Show main and footer navigation
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_main_navigation')) {

	function sp_main_navigation() {
		
		// set default main menu if wp_nav_menu not active
		if ( function_exists ( 'wp_nav_menu' ) )
			wp_nav_menu( array(
				'container'      => false,
				'menu_class'	 => 'nav-menu clear',
				'theme_location' => 'primary',
				'fallback_cb' => 'sp_main_nav_fallback'
				) );
		else
			sp_main_nav_fallback();	
	}
}

if (!function_exists('sp_main_nav_fallback')) {
	
	function sp_main_nav_fallback() {
    	
		$menu_html = '<ul class="nav-menu clear">';
		$menu_html .= '<li><a href="'.admin_url('nav-menus.php').'">'.esc_html__('Add Main menu', SP_TEXT_DOMAIN).'</a></li>';
		$menu_html .= '</ul>';
		echo $menu_html;
		
	}
	
}

if (!function_exists('sp_footer_navigation')){
	
	function sp_footer_navigation() {
		
		// set default main menu if wp_nav_menu not active
		if ( function_exists ( 'wp_nav_menu' ) )
			wp_nav_menu( array(
				'container'      => false,
				'menu_class'	 => 'footer-nav',
				'after'		 	 => ' &nbsp;',
				'theme_location' => 'footer',
				'fallback_cb'	 => 'sp_footer_nav_fallback'
				));	
		else
			sp_footer_nav_fallback();	
	}
}

if (!function_exists('sp_footer_nav_fallback')) {
	
	function sp_footer_nav_fallback() {
    	
		$menu_html = '<ul class="footer-nav">';
		$menu_html .= '<li><a href="'.admin_url('nav-menus.php').'">'.esc_html__('Add Footer menu', SP_TEXT_DOMAIN).'</a></li>';
		$menu_html .= '</ul>';
		echo $menu_html;
		
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Full Meta post entry
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_post_meta' ) ) {
	function sp_post_meta() {
		printf( __( '<span class="posted-on">Posted on </span><a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> by </span><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span><span class="posted-in"> in </span>%8$s ', SP_TEXT_DOMAIN ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', SP_TEXT_DOMAIN ), get_the_author() ) ),
			get_the_author(),
			get_the_category_list( ', ' )
		);
		if ( comments_open() ) : ?>
				<span class="with-comments"><?php _e( ' with ', SP_TEXT_DOMAIN ); ?></span>
				<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( '0 Comments', SP_TEXT_DOMAIN ) . '</span>', __( '1 Comment', SP_TEXT_DOMAIN ), __( '% Comments', SP_TEXT_DOMAIN ) ); ?></span>
		<?php endif; // End if comments_open() ?>
		<?php edit_post_link( __( 'Edit', SP_TEXT_DOMAIN ), '<span class="sep"> | </span><span class="edit-link">', '</span>' );
	}
};

/* ---------------------------------------------------------------------- */
/*	Mini Meta post entry
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_meta_mini' ) ) :
	function sp_meta_mini() {
		printf( __( '<a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="sep"> |  </span>', SP_TEXT_DOMAIN ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
			//get_the_category_list( ', ' )
		);
		if ( comments_open() ) : ?>
				<span class="sep"><?php _e( ' | ', SP_TEXT_DOMAIN ); ?></span>
				<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( '0 Comments', SP_TEXT_DOMAIN ) . '</span>', __( '1 Comment', SP_TEXT_DOMAIN ), __( '% Comments', SP_TEXT_DOMAIN ) ); ?></span>
		<?php endif; // End if comments_open()
	}
endif;

/* ---------------------------------------------------------------------- */
/*	Embeded add video from youtube, vimeo and dailymotion
/* ---------------------------------------------------------------------- */
function sp_get_video_img($url) {
	
	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_id =  $my_array_of_vars['v'] ;
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video_id = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video_id = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
		$output .=$hash[0]['thumbnail_large'];
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='http://www.dailymotion.com/thumbnail/video/'.$video_id;
	}

	return $output;
	
}

/* ---------------------------------------------------------------------- */
/*	Embeded add video from youtube, vimeo and dailymotion
/* ---------------------------------------------------------------------- */
function sp_add_video ($url, $width = 620, $height = 349) {

	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video =  $my_array_of_vars['v'] ;
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe src="http://player.vimeo.com/video/'.$video.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
	}

	return $output;
}

/* ---------------------------------------------------------------------- */
/*	Embeded soundcloud
/* ---------------------------------------------------------------------- */

function sp_soundcloud($url , $autoplay = 'false' ) {
	return '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$url.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true"></iframe>';
}

function sp_portfolio_grid( $col = 'list', $posts_per_page = 5 ) {
	
	$temp ='';
	$output = '';
	
	$args = array(
			'posts_per_page' => (int) $posts_per_page,
			'post_type' => 'portfolio',
			);
			
	$post_list = new WP_Query($args);
		
	ob_start();
	if ($post_list && $post_list->have_posts()) {
		
		$output .= '<ul class="portfolio ' . $col . '">';
		
		while ($post_list->have_posts()) : $post_list->the_post();
		
		$output .= '<li>';
		$output .= '<div class="two-fourth"><div class="post-thumbnail">';
		$output .= '<a href="'.get_permalink().'"><img src="' . sp_post_thumbnail('portfolio-2col') . '" /></a>';
		$output .= '</div></div>';
		
		$output .= '<div class="two-fourth last">';
		$output .= '<a href="'.get_permalink().'" class="port-'. $col .'-title">' . get_the_title() .'</a>';
		$output .= '</div>';	
		
		$output .= '</li>';	
		endwhile;
		
		$output .= '</ul>';
		
	}
	$temp = ob_get_clean();
	$output .= $temp;
	
	wp_reset_postdata();
	
	return $output;
	
}

/* ---------------------------------------------------------------------- */
/*	Get Most Racent posts from Category
/* ---------------------------------------------------------------------- */
function sp_last_posts_cat($numberOfPosts = 5 , $thumb = true , $cats = 1){
	global $post;
	$orig_post = $post;
	
	( is_single() ) ? $exclude = $post->ID : $exclude = false;
		
	if ($exclude)
		$lastPosts = get_posts('category='.$cats.'&numberposts='.$numberOfPosts.'&exclude='.$exclude);
	else
		$lastPosts = get_posts('category='.$cats.'&numberposts='.$numberOfPosts);	
		
?>
	<ul>
	<?php 
	  foreach($lastPosts as $post): setup_postdata($post); 
		$img_url = sp_post_image('widget');
		$image = aq_resize($img_url, 60, 60, true);	
		if (empty($image)) $image = $img_url;		
	?>
		<li>
			<?php if ($image) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<img src="<?php echo $image; ?>" width="60" height="60" />
	            </a>
			</div><!-- post-thumbnail /-->
			<?php } ?>
			<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
			<div class="entry-meta"><?php echo sp_meta_mini(); ?></div>
		</li>
<?php endforeach; ?>	
	</ul>
	<div class="clear"></div>
<?php
	$post = $orig_post;
	wp_reset_postdata();
}

/* ---------------------------------------------------------------------- */
/*	Get Post image
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_post_image')) {

	function sp_post_image($size = 'thumbnail'){
		global $post;
		$image = '';
		
		//get the post thumbnail;
		$image = sp_post_thumbnail($size);
		if ($image) return $image;
		
		//if the post is video post and haven't a feutre image
		$post_type = get_post_format($post->ID);
		//$vId = get_post_meta($post->ID, 'sp_video_id', true);
		$video_url = get_post_meta($post->ID, 'sp_video_id', true);
		
		if($post_type == 'video')
			$image = sp_get_video_img($video_url);
		
		if($post_type == 'audio') 
			$image = SP_ASSETS_THEME . 'images/sound-post-thumb.gif'; // use placeholder image or sound icon
						
		if ($image) return $image;
		
		//If there is still no image, get the first image from the post
		return sp_get_first_image();
	}
		

}

/* ---------------------------------------------------------------------- */
/*	Get Post Thumbnail
/* ---------------------------------------------------------------------- */
if( !function_exists('sp_post_thumbnail')) {

	function sp_post_thumbnail($size = 'thumbnail'){
		global $post;
		$thumb = '';
		
		//get the post thumbnail;
		$thumb_id = get_post_thumbnail_id($post->ID);
		$thumb_url = wp_get_attachment_image_src($thumb_id, $size);
		$thumb = $thumb_url[0];
		if ($thumb) return $thumb;
	}
		

}

/* ---------------------------------------------------------------------- */
/*	Get first image in post
/* ---------------------------------------------------------------------- */
if( !function_exists('sp_get_first_image')) {
	
	function sp_get_first_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches[1][0];
		
		return $first_img;
	}
}

/* ---------------------------------------------------------------------- */
/*	Display excerpt more
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_auto_excerpt_more' ) ) {
	function sp_auto_excerpt_more( $more ) {
		return '&hellip;';
	}
} 
add_filter('excerpt_more', 'sp_auto_excerpt_more');

/* ---------------------------------------------------------------------- */
/*	Sets the post excerpt length by word
/* ---------------------------------------------------------------------- */
function sp_excerpt_length( $length ) {
	global $post;
	
	$content = $post->post_content;
	$words = explode(' ', $content, $length + 1);
	if(count($words) > $length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
  
	$content = strip_tags(strip_shortcodes($content));
  
	return $content;

}
add_filter('excerpt_length', 'sp_excerpt_length');

/* ---------------------------------------------------------------------- */
/*	Sets the post excerpt length by string length
/* ---------------------------------------------------------------------- */
function sp_excerpt_string_length( $str_length = 130 ) {
	global $post;
		//$excerpt = ( $str_decode ) ? utf8_decode($post->post_excerpt) : $post->post_excerpt;
		$excerpt = $post->post_excerpt;
		if($excerpt==''){
		$excerpt = get_the_content();
		}
		
		return wp_html_excerpt($excerpt,$str_length) . '...';
}

/* ---------------------------------------------------------------------- */
/*	Blog navigation
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_pagination') ) {

	function sp_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'sptheme_admin') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Previous', SP_TEXT_DOMAIN) . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Next', SP_TEXT_DOMAIN) . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'sptheme_admin') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}

/*-----------------------------------------------------------------------------------*/
/* Social 
/*-----------------------------------------------------------------------------------*/
function sp_get_social($newtab='yes', $icon_size='32', $tooltip='ttip' , $flat = false){
	
	global $smof_data;
		
	if ($newtab == 'yes') $newtab = "target=\"_blank\"";
	else $newtab = '';
		
	$icons_path =  SP_ASSETS_THEME . 'images/socialicons';
		
		?>
		<div class="social-icons icon_<?php echo $icon_size; ?>">
		<?php
		// RSS
		if ( !$smof_data['rss_icon'] ){
		if ( $smof_data['rss_url'] != '' && $smof_data['rss_url'] != ' ' ) $rss = $smof_data['rss_url'] ;
		else $rss = get_bloginfo('rss2_url'); 
			?><a class="<?php echo $tooltip; ?> rss-tieicon" title="Rss" href="<?php echo $rss ; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img src="<?php echo $icons_path; ?>/rss.png" alt="RSS"  /><?php endif; ?></a><?php 
		}
		// Google+
		if ( !empty($smof_data['social_google_plus']) && $smof_data['social_google_plus'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> google-tieicon" title="Google+" href="<?php echo $smof_data['social_google_plus']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img src="<?php echo $icons_path; ?>/google_plus.png" alt="Google+"  /><?php endif; ?></a><?php 
		}
		// Facebook
		if ( !empty($smof_data['social_facebook']) && $smof_data['social_facebook'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> facebook-tieicon" title="Facebook" href="<?php echo $smof_data['social_facebook']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img src="<?php echo $icons_path; ?>/facebook.png" alt="Facebook"  /><?php endif; ?></a><?php 
		}
		// Twitter
		if ( !empty($smof_data['social_twitter']) && $smof_data['social_twitter'] != ' ') {
			?><a class="<?php echo $tooltip; ?> twitter-tieicon" title="Twitter" href="<?php echo $smof_data['social_twitter']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img src="<?php echo $icons_path; ?>/twitter.png" alt="Twitter"  /><?php endif; ?></a><?php
		}		
		// Pinterest
		if ( !empty($smof_data['social_pinterest']) && $smof_data['social_pinterest'] != ' ') {
			?><a class="<?php echo $tooltip; ?> pinterest-tieicon" title="Pinterest" href="<?php echo $smof_data['social_pinterest']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img src="<?php echo $icons_path; ?>/pinterest.png" alt="MySpace"  /><?php endif; ?></a><?php
		}
		// LinkedIN
		if ( !empty($smof_data['social_linkedin']) && $smof_data['social_linkedin'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> linkedin-tieicon" title="LinkedIn" href="<?php echo $smof_data['social_linkedin']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/linkedin.png" alt="LinkedIn"  /><?php endif; ?></a><?php
		}
		// YouTube
		if ( !empty($smof_data['social_youtube']) && $smof_data['social_youtube'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> youtube-tieicon" title="Youtube" href="<?php echo $smof_data['social_youtube']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/youtube.png" alt="YouTube"  /><?php endif; ?></a><?php
		}
		// Skype
		if ( !empty($smof_data['social_skype']) && $smof_data['social_skype'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> skype-tieicon" title="Skype" href="<?php echo $smof_data['social_skype']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/skype.png" alt="Skype"  /><?php endif; ?></a><?php
		}
		// Delicious 
		if ( !empty($smof_data['social_delicious']) && $smof_data['social_delicious'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> delicious-tieicon" title="Delicious" href="<?php echo $smof_data['social_delicious']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/delicious.png" alt="Delicious"  /><?php endif; ?></a><?php
		}
		// Vimeo
		if ( !empty($smof_data['social_vimeo']) && $smof_data['social_vimeo'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> vimeo-tieicon" title="Vimeo" href="<?php echo $smof_data['social_vimeo']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/vimeo.png" alt="Vimeo"  /><?php endif; ?></a><?php
		}
		// instagram
		if ( !empty( $smof_data['social_instagram'] ) && $smof_data['social_instagram'] != ' ' ) {
			?><a class="<?php echo $tooltip; ?> instagram-tieicon" title="instagram" href="<?php echo $smof_data['social_instagram']; ?>" <?php echo $newtab; ?>><?php if( !$flat) : ?><img  src="<?php echo $icons_path; ?>/instagram.png" alt="instagram"  /><?php endif; ?></a><?php
		}
?>
	</div>

<?php
}