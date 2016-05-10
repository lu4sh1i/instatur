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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'instadb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '&|BVJ!qM&h(.]H>+6&,.XrniMj%PST#@4N gWKA.8RkW+wMjX+DVA-_.nb;4$qS-');
define('SECURE_AUTH_KEY',  '3pA?Dvx)|Qv5S<Zo{<tfVIjiI&eua3X#MDy:&_+.P<j-g05T7<$:/3W{j Qp<+J[');
define('LOGGED_IN_KEY',    'x91T=]i1+F0)RC0.C*cF[0$ouzg.e*1#Z? ;S[o+HhfVHm$>!OBiTbB?|P1|j-9w');
define('NONCE_KEY',        '1@D3!r-xG7^51tl-|@:]jmjbaarTHCn%TY|FefWPA2=IEp_yU$5N|rbO`*dR(+/9');
define('AUTH_SALT',        '?oezIK=8W,6f]]a&Hq9fnuql<>C_sVo`).Wdj)<(==kVnNslPH2fvasLyis$%-vq');
define('SECURE_AUTH_SALT', 'NG#gtTyz1 6*,X,Z|W.AOYwb,Ihf{T8G<G5-+,+.Fp]/3<JKAmL&]QAF+V@v%$ng');
define('LOGGED_IN_SALT',   'M@vW,;7-eXo>Nq8$c,]Rj}I~TC:W7AE(|+8(|_oG&de0+@y).#7;w|E:.IYSBQyv');
define('NONCE_SALT',       '3-`4v?ENYHhAtrGKC[M>c`*@EiF;X<00}bzoUq|X?9kz&Rd|GGOW?nAuZ+xN9WDB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
