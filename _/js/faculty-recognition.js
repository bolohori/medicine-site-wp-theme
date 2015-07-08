jQuery.fn.pixels = function(property) {
	return parseInt(this.css(property).slice(0,-2));
};
	
jQuery(document).ready(function() {
	jQuery("#year-list li").on("click", function(e) {
		// We'll pass this variable to the PHP function example_ajax_request
		jQuery(".selected-year").removeClass("selected-year");
		jQuery(this).addClass("selected-year");
		var y = jQuery(this).attr("data-post_id"),
		nonce = jQuery(this).attr("data-nonce");
		 
		// This does the ajax request
		jQuery.ajax({
			type : "post",
			url: '/wp-content/themes/medicine/_/php/wusm_ajax.php',
			data: {
				'action':'get_awards',
				'year' : y,
				'nonce' : nonce
			},
			success:function(data) {
				// This outputs the result of the ajax request
				jQuery('#award-years-right').html(data);
				// Call matchHeight again for new cards
				jQuery('.faculty-individual').matchHeight();
			},
			error: function(errorThrown){
				/*console.log(errorThrown);*/
			}
		});
	});
});