<?php global $smof_data; ?>       
    </div><!-- #content -->
    
    <footer id="footer" role="contentinfo">
        <div class="container clearfix">
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