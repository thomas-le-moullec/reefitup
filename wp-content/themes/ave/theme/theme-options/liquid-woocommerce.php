<?php

$this->sections[] = array(
	'title'  => esc_html__( 'Woocommerce', 'ave' ),
	'icon'   => 'el-icon-shopping-cart',
	'fields' => array(

		array(
			'id'       => 'wc-archive-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Category Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show the woo category title bar', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'wc-archive-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Title', 'ave' ),
			'subtitle' => esc_html__( 'Controls the title text that displays in the woo category', 'ave' ),
		),
		array(
			'id'       => 'wc-archive-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Woo Category Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Controls the subtitle text that displays in the woo category', 'ave' )
		),
		array(
			'id'      => 'ld_woo_products_per_page',
			'type'    => 'text',	
			'title'   => esc_html__( 'Number of Products Displayed per Page', 'ave' ),
			'desc'    => esc_html__( 'This option works with predefined WooCommerce catalog page and category pages', 'ave' ),
			'default' => '9'
		),
		array(
			'id'      => 'ld_woo_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Products Per Row', 'ave' ),
			'desc'    => esc_html__( 'Define number of products per row to display on your predefined WooCommerce page and category pages', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 3
		),
		array(
			'id'       => 'wc-share-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Woo Single Product Share', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show the share links', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'      => 'ld_woo_related_columns',
			'type'    => 'slider',	
			'title'   => esc_html__( 'Number of Related Products', 'ave' ),
			'desc'    => esc_html__( 'Define number of related products.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
		array(
			'id'      => 'ld_woo_cross_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Cross-sells', 'ave' ),
			'desc'    => esc_html__( 'Define number of cross-sells display.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 2
		),	
		array(
			'id'      => 'ld_woo_up_sell_columns',
			'type'    => 'slider',
			'title'   => esc_html__( 'Number of Displayed Up-sells', 'ave' ),
			'desc'    => esc_html__( 'Define number of up-sells display.', 'ave' ),
			'min'     => 1,
			'max'     => 6,
			'default' => 4
		),
	) 
);
