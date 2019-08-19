<?php
/**
* Shortcode Header Cart
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Cart extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_cart';
		$this->title       = esc_html__( 'Header Cart', 'ave-core' );
		$this->description = esc_html__( 'Mini cart', 'ave-core' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array_merge(
			array(
				array(
					'type'       => 'textarea',
					'param_name' => 'cart_text',
					'heading'    => esc_html__( 'Cart text', 'ave-core' ),
				),
			),
				
			liquid_get_icon_params( false, '', array( 'fontawesome', 'linea' ), array( 'align', 'size', 'margin-left','hcolor', 'margin-right' ) )

		);

		$this->add_extras();
	}

	public function generate_css() {}

}
new LD_Header_Cart;