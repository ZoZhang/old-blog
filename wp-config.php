<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fainz');

/** MySQL database username */
define('DB_USER', 'test');

/** MySQL database password */
define('DB_PASSWORD', 'test');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'dBegN9,IvS5AK_^#4|_ab?Z*u:I{Gr3kCv#,E2$&s_FYA&vh>sb!/>M.MF0IreV|');
define('SECURE_AUTH_KEY',  '^)U-gXcMqT8X8*:5t%MQ;sCMIBtoyp|Jjc4yd!+!GnNzgz%8@JP>mU8FV7e%>y<p');
define('LOGGED_IN_KEY',    '8ycmX6=I6<GZR(Xo;aZuIV-mg47E^-lrG&[m)tGR-`;xlY`%s1D79FtmU3>ebrmS');
define('NONCE_KEY',        'dMOvaaMI6^@,O?_i[U0M-2Z,%n|j=K`Ff>jwlfsnD9>oq&)hT,iKy^S!ll$5oqt*');
define('AUTH_SALT',        '^Tt|@qshiG1<F&&HKX/B<8:=P+S4XJTn>[(KLyH$| =2z0r0:1V^_,7ILnGN;F.v');
define('SECURE_AUTH_SALT', 'DRBx0<s$(=CI0M7+hyW@o(M812I3V%J[^+`TPb}/StVgz$fk%ES:}F7kc&[%z(O`');
define('LOGGED_IN_SALT',   '71(x-HZH[<]@5x2Gu;bvyhvpC3vGNd@!U#[hCD2R~gw,#S)Hkf]U6o%C_e|y?b&?');
define('NONCE_SALT',       'DX[~K5?NO~MXO1!miDL4t~1{A`} KRDV=418>.,H-LEBsLc[$bunyKVirZf~)f=3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'zh_CN');

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
