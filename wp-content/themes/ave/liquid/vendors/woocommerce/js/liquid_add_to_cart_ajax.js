jQuery(document).ready(function(){
	jQuery( '.single_add_to_cart_button' ).click(function(e) {
		e.preventDefault();
		jQuery(this).addClass('adding-cart');
		var product_id = jQuery(this).val();
		var variation_id = jQuery('input[name="variation_id"]').val();
		var quantity = jQuery('input[name="quantity"]').val();
		console.log( quantity );
		jQuery( 'div.header-quickcart' ).empty();
	
		if (variation_id != '') {
			jQuery.ajax ({
				url: liquid_ajax_object.ajax_url,
				type:'POST',
				data:'action=liquid_add_cart_single&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,
	
				success:function(results) {
					jQuery('.woocommerce-message').show();
					jQuery('div.header-quickcart').append( results );
					var cartcount = jQuery('.item-count').html();
					jQuery('.header-cart-fragments').html(cartcount);
					jQuery('.single_add_to_cart_button').removeClass('adding-cart');
	                setTimeout(function () { 
	                    jQuery('.woocommerce-message').hide();
	                }, 6000);
				}
			});
		} else {
			jQuery.ajax ({
				url: liquid_ajax_object.ajax_url,  
				type:'POST',
				data:'action=liquid_add_cart_single&product_id=' + product_id + '&quantity=' + quantity,
	
				success:function(data) {
					jQuery('.woocommerce-message').show();
					jQuery('div.header-quickcart').append( results );
					var cartcount = jQuery('.item-count').html();
					jQuery('.header-cart-fragments').html(cartcount);				
					jQuery('.single_add_to_cart_button').removeClass('adding-cart');
	                setTimeout(function () { 
	                    jQuery('.woocommerce-message').hide();
	                }, 6000);

				}
			});
		}
	});
	
});

jQuery(document).ajaxComplete(function(e) {
	if (jQuery(e.target.activeElement).is('a.button.yith-wcqv-button')) {

		jQuery( '.single_add_to_cart_button' ).click(function(e) {
		e.preventDefault();
		jQuery(this).addClass('adding-cart');
		var product_id = jQuery(this).val();
		var variation_id = jQuery('input[name="variation_id"]').val();
		var quantity = jQuery('input[name="quantity"]').val();
		console.log( quantity );
		jQuery( 'div.header-quickcart' ).empty();
	
		if (variation_id != '') {
			jQuery.ajax ({
				url: liquid_ajax_object.ajax_url,
				type:'POST',
				data:'action=liquid_add_cart_single&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,
	
				success:function(results) {
					jQuery('div.header-quickcart').append( results );
					var cartcount = jQuery('.item-count').html();
					jQuery('.header-cart-fragments').html(cartcount);
					jQuery('.single_add_to_cart_button').removeClass('adding-cart');
					jQuery('.woocommerce-message').show();
	                setTimeout(function () { 
	                    jQuery('#yith-quick-view-modal').removeClass('open');
	                }, 3000);
				}
			});
		} else {
			jQuery.ajax ({
				url: liquid_ajax_object.ajax_url,  
				type:'POST',
				data:'action=liquid_add_cart_single&product_id=' + product_id + '&quantity=' + quantity,
	
				success:function(data) {
					jQuery('div.header-quickcart').append( results );
					var cartcount = jQuery('.item-count').html();
					jQuery('.header-cart-fragments').html(cartcount);				
					jQuery('.single_add_to_cart_button').removeClass('adding-cart');
					jQuery('.woocommerce-message').show();
	                setTimeout(function () { 
	                    jQuery('#yith-quick-view-modal').removeClass('open');
	                }, 3000);
	
				}
			});
		}
	});
	}
	
});