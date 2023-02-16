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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'uMy2ZeYM|i9|7o>DJa(h?g/@pJ;#E]B?At4Ip8IyginYnZpm~wpm>y{fh[C`*$!m' );
define( 'SECURE_AUTH_KEY',  'KG#g$]VzAt+q1WboU [-MN/r?lW`=$M4cdKsYP1MQo xFwg=sWR^&iH<0-3DHf,P' );
define( 'LOGGED_IN_KEY',    'P5lhTl<&/tuP-{Qc2yE#$4NZSGT)]o}bHxZV H{5.]ybkxrXHA+Pk+O)Lkog<gyq' );
define( 'NONCE_KEY',        '5<<eEUU.y*+Wc,ofgUYdp4]x }a7O6*O/48/_S~GYAWmER^MgJVDI.W4`V0+H8BC' );
define( 'AUTH_SALT',        '}gZWZ$|Y|9yU,3rwy?gu>K0a!*o<QZ:h4KHvR%P{R$|GH2<+US]B#Sk.g;orjth(' );
define( 'SECURE_AUTH_SALT', 'm_k1zycl5[)=]Ehe8[LY#qW*Pqh_!Xyu|G( +w}}Wxt*/ 4rb,0e `{)rQ9uNM}[' );
define( 'LOGGED_IN_SALT',   'dM!t0:Hlh+([H!/>H*&lyuMa(7|YT}=l1_9&XC3@/esLe^h;M&Q,&({Dg2k*d_]:' );
define( 'NONCE_SALT',       '/@`03JkfEkny4-%;gP;VX6wc#9c,[25UL[kUt^wMfH2ZS[ {A#=7~?1}qV< [w2^' );

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

define( 'FS_METHOD', 'direct' );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
