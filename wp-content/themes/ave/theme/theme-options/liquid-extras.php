<?php
/*
 * Extras Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Extras', 'ave'),
	'icon'   => 'el el-plus-sign'
);

// Miscelanios Fields
$this->sections[] = array(
	'title'  => esc_html__( 'Miscellaneous', 'ave' ),
	'subsection' => true,
	'fields' => array(
		
		array(
			'id'       => 'header-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Header', 'ave' ),
			'subtitle' => esc_html__( 'Switch off to hide the header on your website.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),		
		array(
			'id' => 'footer-enable-switch',
			'type'	 => 'button_set',
			'title' => esc_html__('Footer', 'ave'),
			'subtitle' => esc_html__('Switch off to hide the footer on your website.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),
		array(
			'id' => 'enable-ave-collection',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Ave Collection', 'ave' ),
			'subtitle' => esc_html__( 'Switch off to disabled the ave collection', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),
		array(
			'id'       => 'footer-back-to-top',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Back To Top', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display the back to top link', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'       => 'enable-lazy-load',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Lazy Load', 'ave' ),
			'subtitle' => esc_html__( 'Lazy load enables images to load only when they are in the viewport. Therefore, lazy load boosts the performance.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'on'
		),
		array(
			'type'  => 'text',
			'id'    => 'portfolio-single-slug',
			'title' => esc_html__( 'Portfolio Slug', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
		),
		
		array(
			'type'  => 'text',
			'id'    => 'portfolio-category-slug',
			'title' => esc_html__( 'Portfolio Category Slug', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
		),
		
	)
);

// Theme Features
$this->sections[] = array(
	'title'      => esc_html__( 'Custom Icons', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'    => 'sh_theme_features',
			'type'  => 'raw',
			'class' => 'redux-sub-heading',
			'desc'  => '<h2>' . esc_html__( 'Manage Icons', 'ave' ) . '</h2>'
		),
		array(
			'id'       => 'font-icons',
			'type'     => 'select',
			'multi'    => true,
			'title'    => esc_html__( 'Custom Icon Fonts', 'ave' ),
			'subtitle' => esc_html__( 'Choose the icon Fonts', 'ave' ),
			'options'  => array(
				'liquid-icons' => esc_html__( 'Liquid Icons', 'ave' )
			),
			'default' => array( 'liquid-icons' ),
		),
		array(
			'id' => 'custom-icons-fonts',
			'type' => 'repeater',
			'title'    => esc_html__( 'Add Custom Icons', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
			'desc' => esc_html__( 'NOTE: All icons files should be uploaded via FTP on your server', 'ave' ),
			'sortable' => false,
			'group_values' => false,
						'fields' => array(
				
				array(
					'id' => 'custom_icon_font_title',
					'type' => 'text',
					'title'    => esc_html__( 'Title', 'ave' ),
					'placeholder' => esc_html__( 'Awesome Font', 'ave' ),
					'subtitle' => esc_html__( '', 'ave' ),
				),
				array(
					'id'    => 'custom_icon_font_css',
					'type'  => 'text',	
					'title' => esc_html__( 'Icon Css file', 'ave' ),
					'placeholder' => esc_html__( '', 'ave' ),
				),
				array(
					'id'    => 'custom_icons_classnames',
					'type'  => 'textarea',	
					'title' => esc_html__( 'Icons classnames', 'ave' ),
					'desc'  => esc_html__( 'Icon classnames should be separated by comma', 'ave' ),
				),
			)
		),		

	)
);
include_once( get_template_directory() . '/theme/theme-options/liquid-page-404.php' );

