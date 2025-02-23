jQuery(function(){

	var ajaxurl = owt_book.ajaxurl;

	if(jQuery('#tbl-list-book').length > 0) {
		jQuery('#tbl-list-book').DataTable();
	}

	if(jQuery('#tbl-list-book-shelf').length > 0) {
		jQuery('#tbl-list-book-shelf').DataTable();
	}

	// delete book shelf row from dataTable
	jQuery(document).on("click",".btn-delete-book-shelf", function(){

		// read data-id
		var shelf_id = jQuery(this).attr("data-id");

		var conf = confirm("Are you sure want to delete ?");

		if(conf){

			var postdata = "action=admin_ajax_request&param=delete_book_shelf&shelf_id=" + shelf_id;

		jQuery.post(ajaxurl, postdata, function(response){
			
			var data = jQuery.parseJSON(response);

			if(data.status == 1){
				alert(data.message);

				setTimeout(function(){
					location.reload();
				}, 1000);
			} else{
				alert(data.message);
			}
		});
		}

		
	});

	// create a book shelf code
	jQuery("#frm-add-book-shelf").validate({
		submitHandler: function(){
			var postdata = jQuery("#frm-add-book-shelf").serialize();

			postdata += "&action=admin_ajax_request&param=create_book_shelf";

			jQuery.post(ajaxurl,postdata,function(response){

				var data = jQuery.parseJSON(response);

				if(data.status == 1){
					alert(data.message);

					setTimeout(function(){
						location.reload();
					}, 1000);
				}
			});
			console.log(postdata);
			
		}
	});

	// Also add localisation function in enquescript
	// processing event on button click
	jQuery(document).on("click", "#btn-first-ajax", function(){

		var postdata = "action=admin_ajax_request&param=first_simple_ajax";

		jQuery.post(ajaxurl, postdata, function(response){
			console.log(response);
		});
	});

});
