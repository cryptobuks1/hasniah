<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hasniah_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qwFE{O4f}_<k0]MpC0^</kt{;Ra.#A/Oy#ZLaQ KV@n}+AfdDI_3fZw6?nqk5xO)' );
define( 'SECURE_AUTH_KEY',  'x!lpj)Z|m]:Ap=!d-Ghl5(n02OwIWupx83zLjVX>$!v6+-mP{mQx<2pR4p:F{C0X' );
define( 'LOGGED_IN_KEY',    '_D--d@ 4JnI2H0Y4Z]y)@_:!*D;)4Snf8%CT]q{AJ@yGLok717+1]r;[ijdKeE?3' );
define( 'NONCE_KEY',        '}v<mi.GX vWXIBvxi6qE|w)|q*mz*UVPM!K+-fY~5I%0}5HTToZx@dhV4Gw39uRG' );
define( 'AUTH_SALT',        'tkw!*1wlckZbRIjGo0m8;UV5+HDZH^of-`^bSF&m88c;=uELLjMkrUj]TwcM}z`E' );
define( 'SECURE_AUTH_SALT', '71)1k*zwx+i]6Ox7E2m8R]VickghFK_vw|p?eB+ggwWa94} Y~?9^Lw_(*Ld4*Ic' );
define( 'LOGGED_IN_SALT',   'TeJ%2jQYR8|mBGXapfwE/VAdtK%&6;T[|2D(ml6X`t!xuy*Z1g3DdDy<q[eH@;fA' );
define( 'NONCE_SALT',       ' TjP4.w0z!m^+IaKshz$Ow2p%HAD9v2CNVIodO#|[I9s%63!3iu[dN%t9~AfQfln' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


