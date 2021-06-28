<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('plumbing_parts_gdpr_framework_theme_setup')) {
    add_action( 'plumbing_parts_action_before_init_theme', 'plumbing_parts_gdpr_framework_theme_setup', 1 );
    function plumbing_parts_gdpr_framework_theme_setup() {
        if (is_admin()) {
            add_filter( 'plumbing_parts_filter_required_plugins', 'plumbing_parts_gdpr_framework_required_plugins' );
        }
    }
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'plumbing_parts_exists_gdpr_framework' ) ) {
    function plumbing_parts_exists_gdpr_framework() {
        return defined( 'GDPR_FRAMEWORK_VERSION' );
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'plumbing_parts_gdpr_framework_required_plugins' ) ) {
    //add_filter('plumbing_parts_filter_required_plugins',    'plumbing_parts_gdpr_framework_required_plugins');
    function plumbing_parts_gdpr_framework_required_plugins($list=array()) {
        if (in_array('gdpr-framework', (array)plumbing_parts_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('The GDPR Framework', 'plumbing-parts'),
                'slug'         => 'gdpr-framework',
                'required'     => false
            );
        return $list;
    }
}