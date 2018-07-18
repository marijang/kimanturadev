<?php

if ( class_exists( 'ACF' ) || class_exists( 'acf_pro' ) ) {
	return;
}

// 1. customize ACF path
add_filter( 'acf/settings/path', 'ct_ultimate_gdpr_acf_settings_path' );

function ct_ultimate_gdpr_acf_settings_path( $path ) {

	// update path
	$path = plugin_dir_path( __FILE__ ) . 'advanced-custom-fields/acf.php';

	// return
	return $path;

}


// 2. customize ACF dir
add_filter( 'acf/settings/dir', 'ct_ultimate_gdpr_acf_settings_dir' );

function ct_ultimate_gdpr_acf_settings_dir( $dir ) {

	// update path
	$dir = plugin_dir_path( __FILE__ ) . 'advanced-custom-fields/';

	// return
	return $dir;

}

// 3. Hide ACF field group menu item
add_filter( 'acf/settings/show_admin', '__return_false' );


// 4. Include ACF
include_once( plugin_dir_path( __FILE__ ) . '/advanced-custom-fields/acf.php' );

add_action( "init", "ct_acf_hooks_modification" );
function ct_acf_hooks_modification() {
	add_filter( 'acf/settings/path', 'ct_ultimate_gdpr_acf_settings_path' );
	add_filter( 'acf/settings/dir', 'ct_ultimate_gdpr_acf_settings_dir' );
}