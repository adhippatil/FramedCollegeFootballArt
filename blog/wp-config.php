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
define('DB_NAME', 'framed_blogDB');

/** MySQL database username */
define('DB_USER', 'framed');

/** MySQL database password */
define('DB_PASSWORD', 'stoprich');

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
define('AUTH_KEY',         '@*h<8[r l+GR<;k7;IDGN)S5fe|t<9,d)AB|8DHF^%B:a^[6J3>C@iQ[GGMQ5a]Y');
define('SECURE_AUTH_KEY',  'oqob]WDs^nud[4*}={]k+*H@{UUJeq)iUd=/h=RAa|,uk8P$aZ(iEX|h_X8M1HR-');
define('LOGGED_IN_KEY',    ' %+fu[CT/l<dRm4XqZ`1z`2-BDaVeiv,a1Afa<Tn| ynLgHK]-rvKaX{mt;)8e?]');
define('NONCE_KEY',        '@A!-?Bx@a]K^t@bs!4U&v1XxwbF,FyJV}$jaRam6>^!.3^s|o7g4d$1K5Ki`x9}J');
define('AUTH_SALT',        '-33mmJuz40@DNvonOz%c+z%8WFg-;EX_[(6aAg =g$h< A0]%/:(Kx0E=+9OC1CZ');
define('SECURE_AUTH_SALT', '&qQ tjirVO6LG;@.~(!(lLXti7Hhi% dd#RKU-E@k.FSC3mv<.J@Dyh- :^zPfy*');
define('LOGGED_IN_SALT',   'D&eMC7Mjx$Z*4mc~n:G_i=}7uq|LB+s@pWpqc.T+w+RUDgF0e/4B-+lnil6Sg&de');
define('NONCE_SALT',       '86^y~#xLb+[O$.-uPb#Ls|u,kc ,U7cxC-~>YsmuU}tbkKV_Ase}YTvT.5oH+a#F');

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
