<?php
/**
 * The Header
 */

/* Fetch theme options variables required in this template */
global $smof_data;
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ($smof_data['theme_favicon']) : ?>
<link rel="icon" href="<?php echo SP_BASE_URL; ?>favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo SP_BASE_URL; ?>favicon.ico" type="image/x-icon" />
<?php endif; ?>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="wrapper">
		 
        <header id="header" class="site-header" role="banner">
		
		<div id="utility-top">
			<div class="container clearfix">
			<div id="search-bar" role="complementary">
				<?php get_search_form(); ?>
			</div>
			<?php
			if ($smof_data['topbar_social'])
                    sp_get_social( 'yes' , '24' , 'tooldown' , false );
            ?>
			</div><!-- end .container .clearfix -->
		</div><!-- #utility-top .clearfix -->
		
		<div class="container clearfix">
            <div class="brand" role="banner">
                <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
                
                <a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                    <?php if($smof_data['theme_logo']) : ?>
                    <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
                    <?php else: ?>
                    <span><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </a>
                
                <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
            </div><!-- end .brand -->
            
            <div class="slogan">
	            <h5><?php echo _e('The Future business of Cambodia', SP_TEXT_DOMAIN); ?></h5>
            </div> <!-- end .slogan -->
            
		</div><!-- end .container .clearfix -->
        </header><!-- end #header -->
        
        <nav id="main-nav" class="primary-nav" role="navigation">
            <div class="container clearfix">
                <?php echo sp_main_navigation(); ?>
            </div><!-- .primary-nav .wrap -->
		</nav><!-- #main-nav -->
		
		<?php if (is_home() || is_page_template('template-home.php')){ ?>
		<!-- slideshow -->
	    <div id="home-slideshow">
	    <ul class="home-bxslider">
	    <?php 
	    $args = array (
	                'post_type'		=> 'slideshow',
	                'posts_per_page'	=> 5
	            );
	    $slide_query = new WP_Query($args);
	    if ($slide_query->have_posts()) :
			while ( $slide_query->have_posts() ) : $slide_query->the_post();		  
		?>
			<li style="background:url(<?php echo sp_post_thumbnail('slideshow');?>) center top no-repeat;">
			<div class="container">
				<div class="headline">
					<span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><br />
					<span class="desc"><?php the_content(); ?></span>
				</div>	
			</div>
			</li>
		<?php
			endwhile;
	    else: 
			echo "<li>" . __( 'Sorry, There are no slide, It is coming shortly.', SP_TEXT_DOMAIN ) . "</li>";
	    endif;
	    wp_reset_postdata();
	    ?>  
	    </ul>
	    </div><!--/#headline-->
	    <?php } ?>
	    
	    <?php if (is_page_template('template-contact.php')){ ?>
	    <!--Map of casaankorhotel-->
		<div id="map-wide">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3.13"></script>
		<script type="text/javascript">					
		  jQuery(document).ready(function ($){
		  
		  		var latitude = <?php echo $smof_data['map_lat'];?>;
		        var longitude = <?php echo $smof_data['map_long'];?>;
		        var myLatlng = new google.maps.LatLng(latitude, longitude);
		        var myOptions = {        
		         scrollwheel: false,                                                 
		         zoom: 16,
		         center: myLatlng,
		         mapTypeId: google.maps.MapTypeId.ROADMAP
		        }
		        var map = new google.maps.Map(document.getElementById("c-map"), myOptions);
		        
		        var image = new google.maps.MarkerImage("<?php echo SP_ASSETS_THEME;?>images/soma-marker.png",
			        new google.maps.Size(133.0, 120.0),
			        new google.maps.Point(0, 0),
			        new google.maps.Point(66.0, 118.0)
			    );
			    var marker_shadow = new google.maps.MarkerImage("<?php echo SP_ASSETS_THEME;?>images/marker-shadow.png",
			        new google.maps.Size(194.0, 120.0),
			        new google.maps.Point(0, 0),
			        new google.maps.Point(66.0, 118.0)
			    );
		        
		        var marker = new google.maps.Marker({
		                position: myLatlng,
		                map: map,
		                icon: image,
		                shadow: marker_shadow,
		                animation: google.maps.Animation.DROP,
		                title:"<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>"
		        });
		        		        
		  });
		</script>
		<div id="c-map"></div>
		</div><!--/#map-wide-->
	    <?php } ?>
        
        <div id="content" class="container clearfix">