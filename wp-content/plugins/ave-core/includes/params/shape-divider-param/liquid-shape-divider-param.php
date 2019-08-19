<?php
/**
* Liquid Shape Divider Options
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * [liquid_param_select_preview description]
 * @method liquid_param_select_preview
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
/*
vc_add_shortcode_param( 'css_responsive_editor', 'liquid_param_responsive_options' );
function liquid_param_responsive_options( $settings, $value ) {

	return 'Hi';

}
*/
if( ! class_exists( 'Liquid_Shape_Divider_Options' ) ) {

	class Liquid_Shape_Divider_Options  {

		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'bottom' );

		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'liquid_shape_divider', array( $this, 'shape_divider_param' ) );
			}
		}

		function shape_divider_param( $settings, $value ) {

			$label  = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Shape Divider Options', 'ave-core' );
			$values = $this->get_shape_divider_values( $value );

			$positions = $this->positions;
			$i = 0;

			$output = '<div class="vc_css-editor vc_row vc_ui-flex-row">';
			$output .= '	<div class="vc_col-xs-12 liquid-shape-divider-tabs">';
			$output .= '		<h3 class="liquid-shape-divider-heading top active" data-target="top">' .  esc_html__( 'Top Divider', 'ave-core' )  . '</h3>';
			$output .= '		<h3 class="liquid-shape-divider-heading bottom" data-target="bottom">' .  esc_html__( 'Bottom Divider', 'ave-core' )  . '</h3>';
			$output .= '	</div>';
			
			foreach( $positions as $position ) {

				$hidden = ( $i != 0 ) ? 'hidden' : '';

				$output .= '	<div class="vc_col-xs-12 liquid_shape_divider_settings ' . $hidden . '" data-position="' . $position . '">';
				$output .= '		<div class="vc_row">';
				$output .= '			<div class="liquid_shape_divider_preview vc_col-xs-6"><div class="liquid_shape"></div></div>';
				$output .= '			<div class="vc_col-xs-6">';

				$output .= '<div class="liquid-main-responsive-wrapper ">';
				$output .= '	<div class="liquid-inner-wrap">';

				// Shape type select
				$output .= '	<label>' . esc_html__( 'Shape Type', 'ave-core' ) . '</label>'
						. '	 	<div class="liquid_shape_divider-type">'
						. '			<select data-name="' . $position . '-shape-type" data-preview-target=".liquid_shape" name="' . $position . '_shape_type" class="liquid_shape_divider-type">'
						.				$this->getShapeTypeOptions( $position,  $values )
						. '			</select>'
						. '		</div>';

				// Shape divider height
				$output .= '	<label>' . esc_html__( 'Height', 'ave-core' ) . '</label>'
						. '	 	<div class="liquid_shape_divider-height">'
						.			$this->getShapeHeight( $position,  $values )
						. '		</div>';

				// Shape divider backround color
				$output .= '	<label>' . esc_html__( 'Color', 'ave-core' ) . '</label>'
						. '	 	<div class="liquid_shape_divider-color">'
						.			$this->getShapeColor( $position,  $values )
						. '		</div>';

				$output .= '	</div>'; //.liquid-inner-wrap
				$output .= '</div>'; // .liquid-main-shape_divider-wrapper

				$i++;

				$output .= '			</div>'; //.vc_col-xs-6
				$output .= '		</div>'; //.row
				$output .= '	</div>'; //.vc_col-xs-12
				
			}
			$output .= '	<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			$output .= '</div>'; // .liquid-shape-divider-container

			return $output;

		}

		public static function get_shape_divider_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'top_shape_type' => '', 'top_shape_color' => '', 'top_shape_height' => '', 'top_shape_width' => '', 'top_shape_flip' => '', 'top_shape_inverse' => '', 'bottom_shape_type' => '', 'bottom_shape_color' => '', 'bottom_shape_height' => '', 'bottom_shape_width' => '', 'bottom_shape_flip' => '', 'bottom_shape_inverse' => '' ) );
		}

		/**
		 * @return string
		 */
		function getShapeTypeOptions( $position, $values = array() ) {
			$output = '<option data-svg-path="" value="">' . esc_html__( 'None', 'ave-core' ) . '</option>';
			$styles = apply_filters( 'liquid_shape_divider_type_options_data', array(
				'1',
				'2',
				'3',
				'4',
				'5',
				'6',
			) );
			foreach ( $styles as $key => $style ) {
				$output .= '<option '. selected( $style, $values[ $position . '_shape_type'] ) .' data-svg-path="' . get_template_directory_uri() . '/assets/img/svg-divider/' . $style . '.svg' . '" value="' . $style . '">' . $style  . '</option>';
			}

			return $output;
		}


		function getShapeColor( $position, $values = array() ) {

			$output = '<input type="text" data-name="' . $position . '-shape-color" name="' . $position . '_shape_color" value="' . $values[ $position . '_shape_color' ] . '" class="liquid_color-control">';

			return $output;

		}

		function getShapeHeight( $position, $values = array() ) {

			return '<div class="liquid-slider"><div class="liquid-handle ui-slider-handle"></div></div><input type="hidden" data-name="' . $position . '-shape-height" name="' . $position . '_shape_height" value="' . $values[ $position . '_shape_height' ] . '" class="liquid_shape_height-control liquid-sliderinput" >';

		}

		function getShapeWidth( $position, $values = array() ) {

			return '<div class="liquid-slider"><div class="liquid-handle ui-slider-handle"></div></div><input type="hidden" data-name="' . $position . '-shape-width" name="' . $position . '_shape_weight" value="' . $values[ $position . '_shape_weight' ] . '" class="liquid_shape_weight-control liquid-sliderinput">';

		}

		function getTopShape( $values = array() ) {
			return file_get_contents( get_template_directory() . '/assets/img/svg-divider/' . $values[ 'top_shape_type' ] . '.svg' );
		}

		function getBottomShape( $values = array() ) {
			return file_get_contents( get_template_directory() . '/assets/img/svg-divider/' . $values[ 'bottom_shape_type' ] . '.svg' );
		}


		public static function getShape( $value, $pos = 'top' ) {

			if( empty( $value ) ){
				return;
			}

			$values = Liquid_Shape_Divider_Options::get_shape_divider_values( $value );
			if( ! isset( $values[ $pos . '_shape_type' ] ) || empty( $values[ $pos . '_shape_type' ] ) ) {
				return;
			}

			$shape = $values[ $pos . '_shape_type' ];
			$svg = '';

			switch( $shape ) {

				case '1':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" width="100%" height="102"  viewBox="0 0 100 102" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
						<path transform="rotate(180 50,51.930503845214844) " d="m0,1.9305l50,100l50,-100l-100,0z"/>
					</svg>';
					break;
					
				case '2':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
								<path d="M0 100 C40 0 60 0 100 100 Z"/>
							</svg>';
					break;
					
				case '3':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" width="100%" height="119px" viewBox="0 0 1000 119" version="1.1" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1000 0.5 1000 118.33 0 118.33 719.760966 33.5145112z"></path>
					</svg>';
					break;
					
				case '4':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" xmlns="http://www.w3.org/2000/svg" width="100%" height="182" viewBox="0 0 1920 182" preserveAspectRatio="none">
						<path d="M1921.91,916.348c0.33,39.216-.34,79.431,0,118.642Q957.95,1035.5-6,1035V853c40.431,10.8,81,19.794,122.5,27.149,62.957,11.157,117.371,15.375,180.742,21.116,79.864,7.236,165.843,26.989,255.045,42.232,109.142,18.65,243.949,40.091,308.265,44.243,137.637,8.886,313.056-2.783,504.066-36.2,127.4-22.286,223.4-43.261,354.45-45.248A1569.414,1569.414,0,0,1,1921.91,916.348Z" transform="translate(0 -853)"/>
					</svg>';
					break;
					
				case '5':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" xmlns="http://www.w3.org/2000/svg" width="155" height="108" viewBox="0 0 155 108">
								<polygon points="1274.5 3682 1352 3790 1197 3790" transform="matrix(1 0 0 -1 -1197 3790)"/>
							</svg>';				
				break;
					
				case '6':
					$color  = isset( $values[ $pos . '_shape_color' ] ) ? $values[ $pos . '_shape_color' ] : '#000';
					$height = isset( $values[ $pos . '_shape_height' ] ) ? $values[ $pos . '_shape_height' ] : '90';
					$svg = '<svg fill="' . $color . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 68" preserveAspectRatio="none">
									<path d="m1622.3 1937.7c0 0-410.7 169.1-913.4 75.5-502.7-93.6-977.7 56.3-977.7 56.3v440h1891.1v-571.8" transform="translate(0-1977)"></path>
								</svg>';
				break;

			}

			return '<div class="one-row_' . $pos . '_divider" style="height:' . $height . 'px;">' . $svg . '</div>';

		}

	}

	new Liquid_Shape_Divider_Options;

}