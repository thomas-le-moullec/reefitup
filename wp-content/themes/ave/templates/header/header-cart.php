<?php

// check
if( !liquid_helper()->is_woocommerce_active() || is_admin() ) {
	return;
}

$order_count = WC()->cart->get_cart_contents_count();
$is_empty    = WC()->cart->is_empty();
$sub_total   = WC()->cart->get_cart_subtotal();
$cart_id     = uniqid( 'cart-' );

$icon_opts = liquid_get_icon( $atts );
$icon      = !empty( $icon_opts['type'] ) && ! empty( $icon_opts['icon'] ) ? $icon_opts['icon'] : 'icon-ld-cart';
$style     = !empty( $icon_opts['color'] ) ? sprintf( ' style="color:%s;"', $icon_opts['color'] ) : '';
$cart_text =  $atts['cart_text'];

?>

<div class="ld-module-cart">
	
	<span class="ld-module-trigger collapsed" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $cart_id ); ?>" aria-controls="<?php echo esc_attr( $cart_id ) ?>" aria-expanded="false">
		<span class="ld-module-trigger-icon">
			<i class="<?php echo esc_attr( $icon ) ?>" <?php echo esc_attr( $style ) ?>></i>
		</span><!-- /.ld-module-trigger-icon --> 
		<?php printf( '<span class="ld-module-trigger-count header-cart-fragments">%s</span>', $order_count ); ?>
	</span><!-- /.ld-module-trigger -->
	
	<div class="ld-module-dropdown collapse" id="<?php echo esc_attr( $cart_id ) ?>" aria-expanded="false">
		<div class="ld-cart-contents">
			<div class="header-quickcart">
				<?php liquid_woocommerce_header_cart() ?>
			</div>
			
			<?php if( !$is_empty && !empty( $cart_text ) ) { ?>
			<div class="ld-cart-message">
				<?php echo wp_kses_post( $cart_text ); ?>
			</div><!-- /.ld-cart-message -->
			<?php } ?>
			
		</div><!-- /.ld-cart-contents -->
	</div><!-- /.ld-module-dropdown -->

</div><!-- /.module-cart -->