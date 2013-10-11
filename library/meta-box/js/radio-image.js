jQuery( document ).ready( function($) {

	var $labels = $('.rwmb-label-radio-image'),
	$pageLayout = $('.rwmb-label-radio-image input[name="sp_page_layout"]'),
	$selectSidebar = $('.rwmb-sidebar-wrapper').hide();

	// Highlight current selection
	$labels.click(function() {
		$labels.removeClass('selected');
		$(this).addClass('selected');
	});
	
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
			
		} else if( (val === '2cr') || (val === '2cl') ) {
			$selectSidebar.show();
		}
	}

});