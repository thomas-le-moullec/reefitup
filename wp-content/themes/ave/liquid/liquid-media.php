<?php
/** The Media
 * Contains all the Media functions
 *
 * Table of Content
 *
 */

/**
 * [liquid_get_the_small_image]
 * @function liquid_get_the_small_image
 * @param  string $src [description]
 * @param  string $width [description]
 * @param  string $height [description]
 * @return string $small_image [description]
 */
function liquid_get_the_small_image( $src ) {
	
	if( empty( $src )  ){
		return;
	}
	
	@list( $width, $height ) = getimagesize( $src );
	
	if( ! $width ) {
		return $src;
	}
	elseif( $width > $height ) {
		$image_ratio = $height / $width;
		$width = 30;
		$height = 30 * $image_ratio;
	}
	elseif( $width < $height ) {
		$image_ratio = $width / $height;
		$height = 30;
		$width = 30 * $image_ratio;
	}
	elseif( $width == $height ) {
		$width  = 30;
		$height = 30;
	}

	$small_image = aq_resize( $src, $width, $height, false );

	return $small_image;	

}

function liquid_get_retina_image( $image, $size = null ) {

	if( empty( $image ) ) {
		return;
	}

	if( $size ) {
		//Get image sizes
		$aq_size = liquid_image_sizes( $size );
		$width  = $aq_size['width'];
		$height = $aq_size['height'];	
	}
	else {
		@list( $width, $height ) = getimagesize( $image );

	}
	
	//Double the size for the retina display
	$retina_width   = $width * 2;
	$retina_height  = $height * 2;

	$retina_src = aq_resize( $image, (int) $retina_width, (int) $retina_height, true, true, true );
	
	return $retina_src;
	
}

function liquid_the_post_thumbnail( $size = 'full', $attr = '', $retina = true ) {

	$attachment_id = get_post_thumbnail_id();
	$image         = wp_get_attachment_image_src( $attachment_id, $size, false );
	
	if ( $image ) {
		
		list( $src, $width, $height ) = $image;
		
		//Get image sizes
		$aq_size = liquid_image_sizes( $size );

        if( is_array( $aq_size ) && ! empty( $aq_size['height'] ) ) {

			$resize_width  = $aq_size['width'];
			$resize_height = $aq_size['height'];
			$resize_crop   = $aq_size['crop'];
			
			if( $resize_width >= $width ) {
				$resize_width = $width;
			}
			if( $resize_height >= $height && ! empty( $resize_height ) ) {
				$resize_height = $height;
			}
			
			//Double the size for the retina display
			$retina_width   = $resize_width * 2;
			$retina_height  = $resize_height * 2;
			if( $retina_width >= $width ) {
				$retina_width = $width;
			}
			if( $retina_height >= $height ) {
				$retina_height = $height;
			}
			
			//Get resized images
			$retina_src  = aq_resize( $src, $retina_width, $retina_height, true );
			$resized_src = aq_resize( $src, $resize_width, $resize_height, $resize_crop );
			if( ! empty( $resized_src ) ) {
				$src = 	$resized_src;		
			}
			
			$hwstring = image_hwstring( $resize_width, $resize_height );
			$srcset = wp_get_attachment_image_srcset( $attachment_id, array( $resize_width, $resize_height ) );
			
			if( ! $retina ) {
				$retina_src = $src;
			}

        } else {
	        $retina_src = $src;
			$hwstring = image_hwstring( $width, $height );
			$srcset = wp_get_attachment_image_srcset( $attachment_id, array( $width, $height ) );
        }

        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }
        
        $attachment = get_post( $attachment_id );
        
		$img_url = wp_get_attachment_url( $attachment_id );
		$img_url_basename = wp_basename( $src );
        
		$image_meta = wp_get_attachment_metadata( $attachment_id );

        if ( is_array( $image_meta ) ) {
			$size_array = array( absint( $width ), absint( $height ) );
			$sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );
        }

        $default_attr = array(
            'src'   => $src,
            'class' => "attachment-$size_class size-$size_class",
            'alt'   => get_the_title(),
			'srcset' => $srcset,
            'sizes' => $sizes,
        );
 
        $attr = wp_parse_args( $attr, $default_attr );
		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment  );
		$attr = array_map( 'esc_attr', $attr );
		
		$image = rtrim("<img $hwstring");
        foreach ( $attr as $name => $value ) {
            $image .= " $name=" . '"' . $value . '"';
        }
		$image .= ' />';        
        
    }

	echo apply_filters( 'liquid_the_post_thumbnail', $image );
}

function liquid_get_resized_image_src( $original_src, $size = 'liquid-thumbnail' ) {
	
	if( empty( $original_src) ) {
		return;
	}

	@list( $src, $width, $height ) = $original_src;
	//Get image sizes
	$aq_size = liquid_image_sizes( $size );

	if( ! empty( $aq_size ) ) {

		$resize_width  = $aq_size['width'];
		$resize_height = $aq_size['height'];
		$resize_crop   = $aq_size['crop'];
		
		if( $resize_width >= $width ) {
			$resize_width = $width;
		}
		if( $resize_height >= $height && ! empty( $resize_height ) ) {
			$resize_height = $height;
		}

		//Get resized images
		$resized_src = aq_resize( $src, $resize_width, $resize_height, $resize_crop );
	}
	else {
		return $src;
	}
	return $resized_src;
	
}

/**
 * [liquid_image_sizes description]
 * @method liquid_image_sizes
 * @param  array $image_sizes [description]
 * @return array $image_sizes [description]
 */
function liquid_image_sizes( $size ) {
	
	$sizes = array(
		'liquid-default-blog'  => array( 'width'  => '370',  'height' => '230', 'crop' => true ),
		'liquid-standard-blog' => array( 'width'  => '370',  'height' => '400', 'crop' => true ),
		'liquid-featured-blog' => array( 'width'  => '570',  'height' => '300', 'crop' => true ),
		'liquid-rounded-blog'  => array( 'width'  => '370',  'height' => '250', 'crop' => true ),
		'liquid-classic-meta-blog' => array( 'width'  => '370',  'height' => '300', 'crop' => true ),
		'liquid-classic-2-blog' => array( 'width'  => '550',  'height' => '350', 'crop' => true ),
		'liquid-grid' => array( 'width'  => '330',  'height' => '250', 'crop' => true ),
		'liquid-split-blog'    => array( 'width'  => '570',  'height' => '350', 'crop' => true ),
		'liquid-classic-full-blog'    => array( 'width'  => '770',  'height' => '400', 'crop' => true ),
		'liquid-metro-blog'    => array( 'width'  => '285',  'height' => '350', 'crop' => true ),
		'liquid-timeline-blog' => array( 'width'  => '490',  'height' => '300', 'crop' => true ),
		'liquid-carousel-blog' => array( 'width'  => '670',  'height' => '400', 'crop' => true ),
		'liquid-square-blog' => array( 'width'  => '560',  'height' => '555', 'crop' => true ),
		'liquid-candy-blog' => array( 'width'  => '470',  'height' => '470', 'crop' => true ),
		
		//Masonry blog images sizes		
		'liquid-masonry-shortest' => array( 'width' => '450', 'height' => '300', 'crop'  => true ),
		'liquid-masonry-short'    => array( 'width' => '450', 'height' => '400', 'crop'  => true ),
		'liquid-masonry-tall'     => array( 'width' => '450', 'height' => '500', 'crop'  => true ),
		'liquid-masonry-taller'   => array( 'width' => '450', 'height' => '600', 'crop'  => true ),
		
		'liquid-medium'               => array( 'width'  => '300', 'height' => '300',  'crop' => true ),
		'liquid-large'                => array( 'width'  => '1024', 'height' => '',    'crop' => false ),
		'liquid-thumbnail'            => array( 'width'  => '150',  'height' => '150', 'crop' => true ),
		'liquid-masonry-header-small' => array( 'width'  => '295',  'height' => '220', 'crop' => true ),
		'liquid-masonry-header-big'   => array( 'width'  => '295',  'height' => '440', 'crop' => true ),
		'liquid-thumbnail-post'       => array( 'width'  => '765', 'height' => '400', 'crop' => true ),
		'liquid-small-blog'  	     => array( 'width'  => '388', 'height' => '240', 'crop' => true ),
		'liquid-related-post'         => array( 'width'  => '270',  'height' => '170', 'crop' => true ),

		//Portfolio sizes
		'liquid-portfolio'          => array( 'width'  => '370', 'height' => '300', 'crop' => true ),
		'liquid-portfolio-sq'       => array( 'width'  => '295', 'height' => '295', 'crop' => true ),
		'liquid-portfolio-big-sq'   => array( 'width'  => '600', 'height' => '600', 'crop' => true ),
		'liquid-portfolio-portrait' => array( 'width'  => '350', 'height' => '500', 'crop' => true ),
		'liquid-portfolio-wide'     => array( 'width'  => '600', 'height' => '295', 'crop' => true ),
		
		'liquid-packery-wide'     => array( 'width' => '570', 'height' => '370', 'crop' => true ),
		'liquid-packery-portrait' => array( 'width' => '270', 'height' => '370', 'crop' => true ),
		
		'liquid-grid-hover-overlay' => array( 'width' => '570', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-classic' => array( 'width' => '500', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-3d'      => array( 'width' => '370', 'height' => '450', 'crop' => true ),
		'liquid-grid-caption'       => array( 'width' => '270', 'height' => '400', 'crop' => true ),
		
		'liquid-large-slider'       => array( 'width' => '1170', 'height' => '650', 'crop' => true ),
		
		'liquid-widget' => array( 'width' => '160', 'height' => '160', 'crop' => true  ),
		
		'liquid-portfolio-vertical-overlay' => array( 'width' => '400', 'height' => '550', 'crop' => true ),
		
	);
	
	$sizes = apply_filters( 'liquid_media_image_sizes', $sizes );
	
	$image_sizes = ! empty( $sizes[ $size ] ) ? $sizes[ $size ] : '';

	return $image_sizes;
}