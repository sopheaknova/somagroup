<?php global $smof_data; ?>       
    	</div> <!-- #content -->
    </div><!-- .container clearfix -->
    
    <footer id="footer" role="contentinfo">
        <div class="container clearfix">
        	
        	<aside id="footer-sidebar" class="widget-area clearfix" role="complementary">
	
			<?php
				if ( is_active_sidebar( 'Footer Sidebar' ) ) :
					dynamic_sidebar('Footer Sidebar');
				else:
				?>	
					<div class="non-widget widget">
				    <h3><?php _e('About Footer Sidebar'); ?></h3>
				    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>Footer Sidebar</em></strong> Area', SP_TEXT_DOMAIN); ?></p>
				    </div>
				<?php endif; ?>
			</aside>
        	
        	<nav id="footer-nav" role="navigation">
	        	<?php echo sp_footer_navigation(); ?>
        	<nav>
            <div class="copyright">
	        <?php if($smof_data['footer_text']) : 
	       		echo '<p>' . $smof_data['footer_text'] . '</p>';
	        endif; ?>
	        </div>
        </div><!-- .container .clearfix -->
    </footer><!-- #footer -->
</div> <!-- #wrapper -->
<div class="scroll-to-top"><a href="#" title="<?php _e( 'Scroll to top', SP_TEXT_DOMAIN ); ?>"></a></div><!-- .scroll-to-top -->
<?php wp_footer(); ?>
</body>
</html>