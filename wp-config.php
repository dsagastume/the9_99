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
define('DB_NAME', 'the9_99_dsagastume_info');

/** MySQL database username */
define('DB_USER', 'the999dsagastume');

/** MySQL database password */
define('DB_PASSWORD', 'jbxgsvHX');

/** MySQL hostname */
define('DB_HOST', 'mysql.the9-99.dsagastume.info');

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
define('AUTH_KEY',         't|EW=K&-M$|Y0zO/(#egM*+X@3<Uu|O}F)[:R1~8N*5fB[TJC(r3|era4Af<0_*v');
define('SECURE_AUTH_KEY',  'V|G.XFWl|B~`Ft.P{6/IK#k&hdKK]@n>_QSsxJ3>~%veNs K-pvG^i&5w>hgej8~');
define('LOGGED_IN_KEY',    'SFX?69Es!FEB7zPqfTLVv8-s1-{(Xy6m6)HM;mI{]Oe%.h=a{)JbsVP@0YG}A;hK');
define('NONCE_KEY',        '22q=2n|cr^J[1^}jbBKN_B5&Z[I+(r)|+$D3:^07oMk,x~G!jg& *Bn`UO|i=@t|');
define('AUTH_SALT',        'zKNN^6WG=w|(Zj5=a&fj>W(5 X>%B|xai8}p3oPGHxGi2* 5(lM-hiN`|b8+2|3t');
define('SECURE_AUTH_SALT', ',j![oKnlu@E0;ZNYbn@8:sH9cvb}tNge+14b2kv]<sm!{T[RH6o-`;O14Am44>nw');
define('LOGGED_IN_SALT',   '*n+gPY]D9%+el+H^gWtc)fLuoI-u//3Vx-_Qc$9QK9LzUr]`-@aDi16RlJu3@bY_');
define('NONCE_SALT',       'ELF+sh}<~h6:nHIrB;Q!T;t[q>V{Z~&NE2QrLJYsp<tyJD{G|w+Eo^vP<lcV+C >');

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
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
