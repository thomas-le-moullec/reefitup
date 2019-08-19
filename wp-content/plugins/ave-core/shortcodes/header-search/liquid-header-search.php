<?php
/**
* Shortcode Header Search
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Search extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_search';
		$this->title       = esc_html__( 'Header Search', 'ave-core' );
		$this->description = esc_html__( 'Header search form', 'ave-core' );
		$this->icon        = 'fa fa-search';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/header-search/';

		$this->params = array(

			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'fs',
				'heading'     => esc_html__( 'Icon Size', 'ave-core' ),
				'description' => esc_html__( 'Example: 20px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
		);

		$this->add_extras();
	}

	public function generate_css() {

		extract($this->atts);

		$elements = array();
		$id = '.' . $this->get_id();
		$out = '';
		
		if( !empty( $primary_color ) ) {
			$elements['.ld-module-search .ld-module-trigger']['color'] = $primary_color;	
		}
		if( !empty( $fs ) ) {
			$elements['.ld-module-search .ld-module-trigger-icon']['font-size'] = $fs;
		}
		
		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Header_Search;