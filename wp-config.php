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
define('DB_NAME', 'wp_99');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ',Ss_/H4Z}Aqi -Gg8Q.{(KOcO0Z$UCoRIx2Im|RU09-/DZ+s7n~V~AAZkw-F!Vk!');
define('SECURE_AUTH_KEY',  'Mpb_{9#qmF>DwkQ<D[gW-RX|[>SFoV`Y(64-OV.-3xc-nV-lWVLjOcWI_x#M-R#%');
define('LOGGED_IN_KEY',    'X H%,Y8C#_&RN~8cty2,,tHs0-b1)mc v3qE)x)bm-<${{tDr#pXP#W~$W@*N j@');
define('NONCE_KEY',        '$(E^1;-e3G@Ay7Eo]M4JhdLcew=P. :=&CPZmPHTw5l[wDzh;% ||F4)U@u@5g7f');
define('AUTH_SALT',        'SK[z6|p oyi[$tNp39zhJgoGN6]cJo+L8*~MF;8(oC<lzH&1dPvZDije9!+El#Wa');
define('SECURE_AUTH_SALT', 'a);q)+d3O<)UX{)rT=.@hD^X`0=,{cvseH=YtA+6SkkYZ{[8O&v_r2tO,H3%Rn,B');
define('LOGGED_IN_SALT',   '85N+NFMX&O;$51EQZw1GzHL:p}i_domia<PU23{t(uDC2098Ts5M%s-RR-Aq/tK4');
define('NONCE_SALT',       '6niWl/dIJR_.!tzuV7&S>jnY[o[d#`C>k4l>jTm6c3LFJBd*voZ=fc:ve|-W6[O:');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
