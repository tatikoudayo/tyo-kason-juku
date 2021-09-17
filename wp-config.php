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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_DEBUG', true );

if ( WP_DEBUG ) {
	define( 'WP_DEBUG_LOG', true );
	define( 'WP_DEBUG_DISPLAY', false );
	@ini_set( 'display_errors', 0 );
}

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F8IuaarAi8/DSxs4dSqAYgGkgvBlNd5EzJARCknXuw3nn8I7AR2Np6Vys8g+/L2YTYVFP0EgqrlVkwRcq25SEQ==');
define('SECURE_AUTH_KEY',  '/qKofDHrMihoUqvA35OoLabAUulXRDgDlpeYVnSE52A1GhyFxiw5ln4omiI5aJUBJHNpz8X068tl7zssSYIypg==');
define('LOGGED_IN_KEY',    '4y3jZ9EoY/Dsahsn9nAJW9sCvpd26R45fFk1Ze1p7YCHhCPBUTYDByrHgf+ANs2AkeVkRtz1pHMmSXD9bakQiA==');
define('NONCE_KEY',        'sL6pZPB+0L2paalcWNkd5+TrccKoXq3Z1CmTj47t58pCoD7gDOmb0yp7ShIc8Oby4Lu5F7g62IEPmvaGtrL9Gg==');
define('AUTH_SALT',        'dXoFw/jPVMIrF6+oLY1KLbu7hLxL2MXi6nWJhSVDmXnzOnT/TOL7ZIgI7qPEmBYUtCXAqGerBbQPAW+VIso8lA==');
define('SECURE_AUTH_SALT', 'Sw4v2sSUmrbdx0gYf9KlXNG5iTztPmFL2OoUxvP9jxcso8sfgE8IE5QzP4Fw16pQAydDEBdsOyRGH14oWE4bsQ==');
define('LOGGED_IN_SALT',   'Bditn+9chY+tcb3j5fjAEWg3EwPMDh2XrdIeLbqhmSjRS0ue5nkkxlGE9WpeLlf5l+J3j0B6lRuFtr9OsEF1Aw==');
define('NONCE_SALT',       'tVxKLO+HovCg3Mgywgpzvlp+C2F81EvNpGHdLDFXhMCxpbxYDMmt2/KBK30w8qP5keTjEMCyU31+gF3xR0vVwA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
