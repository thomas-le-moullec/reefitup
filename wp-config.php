<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );
/** MySQL database username */
define( 'DB_USER', 'bn_wordpress' );
/** MySQL database password */
define( 'DB_PASSWORD', '1f8878600e' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '443c8d5e3fdcdde45fb9c6456da8302e8e0fdf944dc5ba6a16c04a3b208dd3f5');
define('SECURE_AUTH_KEY', 'bd0188014e24ff7385d4ed4d63cd32a89f7652f518c16da005944270eab4fd79');
define('LOGGED_IN_KEY', '788db6bd8bcc2db216e41cd6ab766550c28261727d12fed90b30e9ebf3a3627d');
define('NONCE_KEY', '29e795604ea2de2c7e3b728d0de21d7fd9054f934b7865c0c6041cc08a9ef4a9');
define('AUTH_SALT', '9a8d301de30d4595deaccd1189a6fe601f13312d99f4499f3db6f9465e1e6f86');
define('SECURE_AUTH_SALT', '464d6d8273e2ed91e3b20f5dc6fdb1ea3411e1bfa5a8a876b219734e4ed38a63');
define('LOGGED_IN_SALT', '100b395267d3df497d881a31f7be73f7562df6eda78c53aa3ad5223611c42232');
define('NONCE_SALT', '01401bad28408a74a13a64f22fef37a5e88dcdc36da3e9a439dff6b9277fd1ff');
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
/* That's all, stop editing! Happy publishing. */
define('FS_METHOD', 'direct');
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','https://example.com');
 *  define('WP_SITEURL','https://example.com');
 *
*/
if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}
define('WP_SITEURL','https://reefitup.org');
define('WP_HOME','https://reefitup.org');
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
define('WP_TEMP_DIR', '/opt/bitnami/apps/wordpress/tmp');
//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}
