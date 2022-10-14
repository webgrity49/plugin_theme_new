<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plugin_theme' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'zzD,)z+RG>/Lg)9(?g|1O;WnxQuz0]_xSUhHlP{|<ufI@;Z(=oAjn~Ov..l i&oe' );
define( 'SECURE_AUTH_KEY',  ';yDZRspHkQe`1]!8{,~hDzm*JF618t XDxDw&-y* K7R=U?<;rC<z))/xaa-C.Ah' );
define( 'LOGGED_IN_KEY',    ',U.[#|H8!KzWWIr50XGG}p(RbM| {8T)7$:_z8QDUda)s#hE<B)Ss&x r<MpA%TD' );
define( 'NONCE_KEY',        'ZEBNDE83o`DN9y+?s;O4*is)q:y8lE9/7Z4@4k<v1#Cn_@&e?F[FxkF=S;<7Xxm1' );
define( 'AUTH_SALT',        'T^vW7dG~04 |h<VOe,Re*Bfsy 0iPql9Nq0g9e*u8|ewu(:=bSPsK5,l~N:87EcY' );
define( 'SECURE_AUTH_SALT', ' dC{7nbPI=cBqo)JQLr!CL;~b0WhX8~FT&SN5/_O`A-*-*-Pcp!I{y@u^L5BZys4' );
define( 'LOGGED_IN_SALT',   'Uc.Q}qpbyG}A~]CLV{h:1X/iC28O|B4lbT0)UxMGY1 zYp~rs%,TpFSs;I@pd5[t' );
define( 'NONCE_SALT',       '*Xb}%wye8v4A /x`+{xfgWiqE3J;=[m]PMQzM2iUgZAp#&eDyB_V@VuEGocIObD ' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
