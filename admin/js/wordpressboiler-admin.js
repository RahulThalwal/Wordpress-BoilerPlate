jQuery(function(){

	var ajaxurl = owt_book.ajaxurl;

	if(jQuery('#tbl-list-book').length > 0) {
		jQuery('#tbl-list-book').DataTable();
	}

	if(jQuery('#tbl-list-book-shelf').length > 0) {
		jQuery('#tbl-list-book-shelf').DataTable();
	}

	// Also add localisation function in enquescript
	// processing event on button click
	jQuery(document).on("click", "#btn-first-ajax", function(){

		var postdata = "action=admin_ajax_request&param=first_simple_ajax";

		jQuery.post(ajaxurl, postdata, function(response){
			console.log(response)
			
		});
	} );

});