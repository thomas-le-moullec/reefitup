<?php

// Enqueue Conditional Script
$this->generate_css();

$style = isset( $atts['style'] ) ? $atts['style'] : 'default';

// check
$located = locate_template( "templates/header/header-search-$style.php" );

if ( !file_exists( $located ) ) {
	$located = locate_template( 'templates/header/header-search.php' );
}
?>
<div class="header-module">
	<?php include $located; ?>
</div>