<?php
/**
 * Theme sprecific functions and definitions
 */

/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'plumbing_parts_theme_setup' ) ) {
	add_action( 'plumbing_parts_action_before_init_theme', 'plumbing_parts_theme_setup', 1 );
	function plumbing_parts_theme_setup() {

		// Register theme menus
		add_filter( 'plumbing_parts_filter_add_theme_menus',		'plumbing_parts_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'plumbing_parts_filter_add_theme_sidebars',	'plumbing_parts_add_theme_sidebars' );

		// Set options for importer
		add_filter( 'plumbing_parts_filter_importer_options',		'plumbing_parts_set_importer_options' );

		// Add theme required plugins
		add_filter( 'plumbing_parts_filter_required_plugins',		'plumbing_parts_add_required_plugins' );

		// Add theme specified classes into the body
		add_filter( 'body_class', 'plumbing_parts_body_classes' );

        // Add tags to the head
        add_action('wp_head', 'plumbing_parts_head_add_page_meta', 1);

		// Set list of the theme required plugins
		plumbing_parts_storage_set('required_plugins', array(

			'essgrids',
			'revslider',
			'trx_utils',
			'visual_composer',
			'woocommerce',
            'gdpr-framework',
            'woocommerce-currency-switcher'
			)
		);

        // Gutenberg support
        add_theme_support(
            'gutenberg',
            array( 'wide-images' => true )
        );
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'plumbing_parts_add_theme_menus' ) ) {
	//add_filter( 'plumbing_parts_filter_add_theme_menus', 'plumbing_parts_add_theme_menus' );
	function plumbing_parts_add_theme_menus($menus) {
		//For example:
		//$menus['menu_footer'] = esc_html__('Footer Menu', 'plumbing-parts');
		//if (isset($menus['menu_panel'])) unset($menus['menu_panel']);
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'plumbing_parts_add_theme_sidebars' ) ) {
	//add_filter( 'plumbing_parts_filter_add_theme_sidebars',	'plumbing_parts_add_theme_sidebars' );
	function plumbing_parts_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> esc_html__( 'Main Sidebar', 'plumbing-parts' ),
				'sidebar_footer'	=> esc_html__( 'Footer Sidebar', 'plumbing-parts' )
			);
			if (function_exists('plumbing_parts_exists_woocommerce') && plumbing_parts_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = esc_html__( 'WooCommerce Cart Sidebar', 'plumbing-parts' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}


// Add theme required plugins
if ( !function_exists( 'plumbing_parts_add_required_plugins' ) ) {
	//add_filter( 'plumbing_parts_filter_required_plugins',		'plumbing_parts_add_required_plugins' );
	function plumbing_parts_add_required_plugins($plugins) {
		$plugins[] = array(
			'name' 		=> esc_html__('Plumbing Parts Utilities', 'plumbing-parts' ),
			'version'	=> '3.1',					// Minimal required version
			'slug' 		=> 'trx_utils',
			'source'	=> plumbing_parts_get_file_dir('plugins/install/trx_utils.zip'),
			'force_activation'   => true,			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => true,			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'required' 	=> true
		);
		return $plugins;
	}
}


// Add theme specified classes into the body
if ( !function_exists('plumbing_parts_body_classes') ) {
	//add_filter( 'body_class', 'plumbing_parts_body_classes' );
	function plumbing_parts_body_classes( $classes ) {

		$classes[] = 'plumbing_parts_body';
		$classes[] = 'body_style_' . trim(plumbing_parts_get_custom_option('body_style'));
		$classes[] = 'body_' . (plumbing_parts_get_custom_option('body_filled')=='yes' ? 'filled' : 'transparent');
		$classes[] = 'theme_skin_' . trim(plumbing_parts_get_custom_option('theme_skin'));
		$classes[] = 'article_style_' . trim(plumbing_parts_get_custom_option('article_style'));
		
		$blog_style = plumbing_parts_get_custom_option(is_singular() && !plumbing_parts_storage_get('blog_streampage') ? 'single_style' : 'blog_style');
		$classes[] = 'layout_' . trim($blog_style);
		$classes[] = 'template_' . trim(plumbing_parts_get_template_name($blog_style));
		
		$body_scheme = plumbing_parts_get_custom_option('body_scheme');
		if (empty($body_scheme)  || plumbing_parts_is_inherit_option($body_scheme)) $body_scheme = 'original';
		$classes[] = 'scheme_' . $body_scheme;

		$top_panel_position = plumbing_parts_get_custom_option('top_panel_position');
		if (!plumbing_parts_param_is_off($top_panel_position)) {
			$classes[] = 'top_panel_show';
			$classes[] = 'top_panel_' . trim($top_panel_position);
		} else 
			$classes[] = 'top_panel_hide';
		$classes[] = plumbing_parts_get_sidebar_class();

		if (plumbing_parts_get_custom_option('show_video_bg')=='yes' && (plumbing_parts_get_custom_option('video_bg_youtube_code')!='' || plumbing_parts_get_custom_option('video_bg_url')!=''))
			$classes[] = 'video_bg_show';

		return $classes;
	}
}

// Add page meta to the head
if (!function_exists('plumbing_parts_head_add_page_meta')) {
    //add_action('wp_head', 'plumbing_parts_head_add_page_meta', 1);
    function plumbing_parts_head_add_page_meta() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1<?php if (plumbing_parts_get_theme_option('responsive_layouts')=='yes') echo ', maximum-scale=1'; ?>">
        <meta name="format-detection" content="telephone=no">

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php
        if (($preloader=plumbing_parts_get_theme_option('page_preloader'))!='') {
            $clr = plumbing_parts_get_scheme_color('bg_color');
            ?>
            <style type="text/css">
                <!--

                -->
            </style>
            <?php
        }

        if ( !function_exists('has_site_icon') || !has_site_icon() ) {
            $favicon = plumbing_parts_get_custom_option('favicon');
            $theme_skin = plumbing_parts_esc(plumbing_parts_get_custom_option('theme_skin'));
            if (!$favicon) {
                if ( file_exists(plumbing_parts_get_file_dir('skins/'.($theme_skin).'/images/favicon.ico')) )
                    $favicon = plumbing_parts_get_file_url('skins/'.($theme_skin).'/images/favicon.ico');
                if ( !$favicon && file_exists(plumbing_parts_get_file_dir('favicon.ico')) )
                    $favicon = plumbing_parts_get_file_url('favicon.ico');
            }
            if ($favicon) {
                ?><link rel="icon" type="image/x-icon" href="<?php echo esc_url($favicon); ?>" /><?php
            }
        }
    }
}

// Add theme required plugins
if ( !function_exists( 'plumbing_parts_add_trx_utils' ) ) {
    add_filter( 'trx_utils_active', 'plumbing_parts_add_trx_utils' );
    function plumbing_parts_add_trx_utils($enable=true) {
        return true;
    }
}

// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'plumbing_parts_trx_utils_privacy_text' ) ) {
    add_filter( 'trx_utils_filter_privacy_text', 'plumbing_parts_trx_utils_privacy_text' );
    function plumbing_parts_trx_utils_privacy_text( $text='' ) {
        return plumbing_parts_get_privacy_text();
    }
}

// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'plumbing_parts_importer_set_options' ) ) {
    add_filter( 'trx_utils_filter_importer_options', 'plumbing_parts_importer_set_options', 9 );
    function plumbing_parts_importer_set_options( $options=array() ) {
        if ( is_array( $options ) ) {
            // Save or not installer's messages to the log-file
            $options['debug'] = false;
            // Prepare demo data
            if ( is_dir( PLUMBING_PARTS_THEME_PATH . 'demo/' ) ) {
                $options['demo_url'] = PLUMBING_PARTS_THEME_PATH . 'demo/';
            } else {
                $options['demo_url'] = esc_url( plumbing_parts_get_protocol().'://demofiles.themerex.net/plumbing-parts/' ); // Demo-site domain
            }

            // Required plugins
            $options['required_plugins'] =  array(
                'essential-grid',
                'revslider',
                'js_composer',
                'woocommerce'
            );

            $options['theme_slug'] = 'plumbing_parts';

            // Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
            // Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
            $options['regenerate_thumbnails'] = 3;
            // Default demo
            $options['files']['default']['title'] = esc_html__( 'Plumbing Parts Demo', 'plumbing-parts' );
            $options['files']['default']['domain_dev'] = esc_url(plumbing_parts_get_protocol().'://plumbing-parts.upd..themerex.net'); // Developers domain
            $options['files']['default']['domain_demo']= esc_url(plumbing_parts_get_protocol().'://plumbing-parts.themerex.net'); // Demo-site domain

        }
        return $options;
    }
}



/* Include framework core files
------------------------------------------------------------------- */
require_once trailingslashit( get_template_directory() ) . 'fw/loader.php';
?>