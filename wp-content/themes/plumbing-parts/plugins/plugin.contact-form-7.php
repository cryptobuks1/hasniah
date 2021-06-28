<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('plumbing_parts_cf7_theme_setup')) {
	add_action( 'plumbing_parts_action_before_init_theme', 'plumbing_parts_cf7_theme_setup', 9 );
	function plumbing_parts_cf7_theme_setup() {

        if (plumbing_parts_exists_cf7()){
            add_action('plumbing_parts_action_add_styles', 				'plumbing_parts_cf7_frontend_scripts' );
        }

		if (is_admin()) {
			add_filter( 'plumbing_parts_filter_importer_required_plugins',			'plumbing_parts_cf7_importer_required_plugins' );
            add_filter( 'plumbing_parts_filter_required_plugins',					'plumbing_parts_cf7_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'plumbing_parts_cf7_required_plugins' ) ) {
    //add_filter('plumbing_parts_filter_required_plugins',	'plumbing_parts_cf7_required_plugins');
    function plumbing_parts_cf7_required_plugins($list=array()) {
        if (in_array('contact-form-7', plumbing_parts_storage_get('required_plugins')))
            $list[] = array(
                'name' 		=> esc_html__('Contact Form 7', 'plumbing-parts'),
                'slug' 		=> 'contact-form-7',
                'required' 	=> false
            );
        return $list;
    }
}

// Check if cf7 installed and activated
if ( !function_exists( 'plumbing_parts_exists_cf7' ) ) {
	function plumbing_parts_exists_cf7() {
		return class_exists('WPCF7');
	}
}

// Enqueue custom styles
if ( !function_exists( 'plumbing_parts_cf7_frontend_scripts' ) ) {
    //add_action( 'plumbing_parts_action_add_styles', 'plumbing_parts_cf7_frontend_scripts' );
    function plumbing_parts_cf7_frontend_scripts()
    {
        if (file_exists(plumbing_parts_get_file_dir('css/plugin.contact-form-7.css')))
            wp_enqueue_style('plumbing_parts-plugin.contact-form-7', plumbing_parts_get_file_url('css/plugin.contact-form-7.css'), array(), null);
    }
}
?>