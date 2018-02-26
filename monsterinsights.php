<?php
/*
Plugin Name: WP Real Media Library Conflict Fix for MonsterInsights
Plugin URI: 
Description: Fixes conflict with WP Real Media Library on MonsterInsights admin pages
Version: 1.0.0
Author: MonsterInsights Support Team
Author URI: https://www.monsterinsights.com
License: 
License URI: 
*/
function custom_monsterinsights_remove_conflicting_asset_files() {
	// Get current screen.
	$screen = get_current_screen();
	
	// Bail if we're not on a MonsterInsights screen.
	if ( empty( $screen->id ) || strpos( $screen->id, 'monsterinsights' ) === false ) {
		return;
	}
	
	$styles  = array();
	$scripts = array();

	$styles = array(
		'jquery-tooltipster', // WP Real Media Library
	);
	
	$scripts = array(

		'jquery-tooltipster', // WP Real Media Library
    	'jquery-nested-sortable', // WP Real Media Library
		'jquery-aio-tree', // WP Real Media Library
		'wp-media-picker', // WP Real Media Library
		'rml-general',
		'rml-library',
		'rml-grid',               
        'rml-list',                 
        'rml-modal', 
        'rml-order', 
        'rml-meta',    
        'rml-uploader',          
        'rml-options',          
        'rml-usersettings',   
        'rml-main', 

	);

	if ( ! empty( $styles ) ) {
		foreach ( $styles as $style ) {
			wp_dequeue_style( $style ); // Remove CSS file from MI screen
			wp_deregister_style( $style );
		}
	}
	if ( ! empty( $scripts ) ) {
		foreach ( $scripts as $script ) {
			wp_dequeue_script( $script ); // Remove JS file from MI screen
			wp_deregister_script( $script );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'custom_monsterinsights_remove_conflicting_asset_files', 9998 );