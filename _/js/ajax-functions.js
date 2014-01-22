jQuery(document).ready(function($) {
	$("#year-list li").on("click", function(e) {
		// We'll pass this variable to the PHP function example_ajax_request
		$(".selected-year").removeClass("selected-year");
		$(this).addClass("selected-year");
		var y = $(this).attr("data-post_id"),
		nonce = $(this).attr("data-nonce");
		 
		// This does the ajax request
		$.ajax({
			type : "post",
			url: SOMAJAX.ajaxurl,
			data: {
				'action':'get_awards',
				'year' : y,
				'nonce' : nonce
			},
			success:function(data) {
				// This outputs the result of the ajax request
				$('#award-years-right').html(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});
});