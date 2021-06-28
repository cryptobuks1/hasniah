<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('plumbing_parts_gutenberg_theme_setup')) {
    add_action( 'plumbing_parts_action_before_init_theme', 'plumbing_parts_gutenberg_theme_setup', 1 );
    function plumbing_parts_gutenberg_theme_setup() {
        if (is_admin()) {
            add_filter( 'plumbing_parts_filter_required_plugins', 'plumbing_parts_gutenberg_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'plumbing_parts_exists_gutenberg' ) ) {
    function plumbing_parts_exists_gutenberg() {
        return function_exists( 'the_gutenberg_project' ) && function_exists( 'register_block_type' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'plumbing_parts_gutenberg_required_plugins' ) ) {
    //add_filter('plumbing_parts_filter_required_plugins',    'plumbing_parts_gutenberg_required_plugins');
    function plumbing_parts_gutenberg_required_plugins($list=array()) {
        if (in_array('gutenberg', (array)plumbing_parts_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Gutenberg', 'plumbing-parts'),
                'slug'         => 'gutenberg',
                'required'     => false
            );
        return $list;
    }
}