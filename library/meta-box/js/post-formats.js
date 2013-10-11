jQuery( document ).ready( function($) {

	var	$videoSettings = $('#post-video-settings').hide(),
		$audioSettings = $('#post-audio-settings').hide(),
		$postdivrich   = $('#postdivrich'),
		$generalSettings  = $('#general-settings'), 
		$postFormat    = $('#post-formats-select input[name="post_format"]'),
		
		//var for change template
		$pageTempalte = $('#page_template'),
		$pageLayout = $('.rwmb-label-radio-image input[name="sp_page_layout"]'),
		$selectSidebar = $('.rwmb-sidebar-wrapper').hide();
	
	$postFormat.each(function() {
		
		var $this = $(this);

		if( $this.is(':checked') )
			changePostFormat( $this.val() );

	});

	$postFormat.change(function() {

		changePostFormat( $(this).val() );

	});

	function changePostFormat( val ) {
		
		$videoSettings.hide();
		$audioSettings.hide();
		$postdivrich.show();
		$generalSettings.show();

		if( val === 'video' ) {

			$videoSettings.show();
			
		} else if( val === 'audio' ) {

			$audioSettings.show();
		}

	}
	
	/*
$('#page_template').change(function() {
		changePageTemplate( $(this).val() );
	});
	
	function changePageTemplate( val ) {
		
		$generalSettings.show();
		
		if( val === 'page-contact.php' || val === 'page-teams.php' ) {

			$generalSettings.hide();
			
		}
	}
*/	
	
	$pageLayout.each(function() {
		
		var $this = $(this);

		if( $this.is(':checked') )
			changePageLayout( $this.val() );

	});
	
	$pageLayout.change(function() {
		changePageLayout( $(this).val() );
	})
	
	function changePageLayout( val ) {
		
		$selectSidebar.show();
		
		if( val === '1col' ) {

			$selectSidebar.hide();
			
		} else if( val === '2cr' || val === '3col' ) {
			$selectSidebar.show();
		}
	}
	

});