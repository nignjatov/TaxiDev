<?php
/** Enable W3 Total Cache Edge Mode */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/taxideal/public_html/dev-site/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'taxideal_corporate_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Bx#JObW-)7EY,gdMh+l+nPbC,Y!QR/X+2n4*d3trUIf,*%]SwCp93**/IB(.=1f;');
define('SECURE_AUTH_KEY',  '`@h^&-1IcpY*S79d]kr.om@y5>1!Oj@Ye_oZ)N(!5=$[^zu|N%J8-.RC?r>v9]%m');
define('LOGGED_IN_KEY',    '033v2be>RhLU^/;P:w!wec3;u*SPMiLJ*gd&Rk4W!gb4{@q Fta*W-7(E0Z(^dpy');
define('NONCE_KEY',        'O$J>9atp-(ddc.jQ`Jpsp$7l|NlCDflQo%s2[Y4us5Tl~kCKCnNv%kAx>}^+4|km');
define('AUTH_SALT',        ')ebw#M!x[(L^k/] M^^-&E#&)Hc`wVR0NI+?<1s#[k&/#Fb+OVuPq2zHA{uB7sPj');
define('SECURE_AUTH_SALT', ']>?9lOu&@)CrEkG(]$G~pA{_}:w#t`!`;l8ck0PL[ZT,gqJBU]WkcpoMeha8=>pT');
define('LOGGED_IN_SALT',   'X:5D(gZP#EOTe%Oh>t<V7Fo+u-kqd-?AzR_NT|4-xT*`+nBES gA}*Dq+ZT$3g&A');
define('NONCE_SALT',       'Um+*]!sp>sCpGh<v%wG(37r0.EKahZF,JQ|Hh}11Ug]Z,SXdiiPe-,0UeT:v~+GS');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
