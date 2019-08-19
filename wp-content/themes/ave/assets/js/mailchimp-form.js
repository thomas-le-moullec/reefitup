jQuery(document).ready(function($) {

	var subscribeForm = $('#ld_subscribe_form');

	subscribeForm.each(function() {

		var sf = $(this);
	
		sf.on( 'submit', function(e) {
			
			var email = jQuery("#email", sf).val();
			var spinner = $('span.ld-sf-spinner', sf);

			if ( email == "" ) {
				jQuery('#email', sf).focus();
				return false;
			} 

			sf.addClass('form-submitting');

			$.ajax({
				type: 'POST',
				url: ajax_liquid_mailchimp_form_object.ajaxurl,
				data: { 
					'action': 'add_mailchimp_user',
					'list_id': $('#list_id', sf).val(),
					'email': $('#email', sf).val(),
					'fname': $('#lname', sf).val(), 
					'lname': $('#fname', sf).val() },
				success: function(data){
					sf.removeClass('form-submitting');
					$('#ld_sf_response').html(data);
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					console.log(jqXHR.status); // I would like to get what the error is
				}
			} );

			e.preventDefault();

		});

	});
	
});