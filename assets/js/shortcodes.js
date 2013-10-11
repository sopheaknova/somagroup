/*
 * SHORTCODE
 * Shortcode JS code required by the theme.
 */

// document.ready call
jQuery( document ).ready( function($) {

	
	/* ---------------------------------------------------------------------- */
	/*	Toggle Content
	/* ---------------------------------------------------------------------- */
	
	$(".toggle-container").hide(); 
		$("h3.trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("normal");
			return false;
		});
	
	/* ---------------------------------------------------------------------- */
	/*	Accordion Content
	/* ---------------------------------------------------------------------- */

	(function() {

		var $container = $('.acc-container'),
			$trigger   = $('.acc-trigger');

		$container.hide();
		$trigger.first().addClass('active').next().show();

		var fullWidth = $container.outerWidth(true);
		$trigger.css('width', fullWidth);
		$container.css('width', fullWidth);
		
		$trigger.on('click', function(e) {
			if( $(this).next().is(':hidden') ) {
				$trigger.removeClass('active').next().slideUp(300);
				$(this).toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});

		// Resize
		$(window).on('resize', function() {
			fullWidth = $container.outerWidth(true)
			$trigger.css('width', $trigger.parent().width() );
			$container.css('width', $container.parent().width() );
		});

	})();
	
	/* ---------------------------------------------------- */
	/*	Content Tabs
	/* ---------------------------------------------------- */

	(function() {

		var $tabsNav    = $('.tabs-nav'),
			$tabsNavLis = $tabsNav.children('li'),
			$tabContent = $('.tab-content');

		$tabsNav.each(function() {
			var $this = $(this);

			$this.next().children('.tab-content').hide()
												 .first().show()
												 .css('background-color','#ffffff');

			$this.children('li').first().addClass('active').show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
				 .addClass('active');
			
			$this.parent().next().children('.tab-content').hide()
														  .siblings( $this.find('a').attr('href') ).fadeIn()
														  .css('background-color','#ffffff');

			e.preventDefault();
		});

	})();
																																	  
} )