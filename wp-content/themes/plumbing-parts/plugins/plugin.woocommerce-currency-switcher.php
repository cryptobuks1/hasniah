<?php
/* Woocommerce currwncy switcher support functions
------------------------------------------------------------------------------- */

    // Theme init
    if (!function_exists('plumbing_parts_wccs_theme_setup')) {
        add_action( 'plumbing_parts_action_before_init_theme', 'plumbing_parts_wccs_theme_setup', 1 );
        function plumbing_parts_wccs_theme_setup() {
            if (is_admin()) {
                add_filter( 'plumbing_parts_filter_required_plugins', 'plumbing_parts_wccs_required_plugins' );
            }
        }
    }

// Filter to add in the required plugins list
if ( !function_exists( 'plumbing_parts_wccs_required_plugins' ) ) {
    //add_filter('plumbing_parts_filter_required_plugins',    'plumbing_parts_wccs_required_plugins');
    function plumbing_parts_wccs_required_plugins($list=array()) {
        if (in_array('woocommerce-currency-switcher', (array)plumbing_parts_storage_get('required_plugins')))
            $list[] = array(
                'name'         => esc_html__('Woocommerce Currency Switcher', 'plumbing-parts'),
                'slug'         => 'woocommerce-currency-switcher',
                'required'     => false
            );
        return $list;
    }
}

// Check if plugin installed and activated
if ( !function_exists( 'plumbing_parts_exists_wccs' ) ) {
	function plumbing_parts_exists_wccs() {
		return function_exists('cp_shortcode_widget_init');
	}
}

?>