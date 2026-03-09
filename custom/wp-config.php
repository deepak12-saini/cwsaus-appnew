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
define('DB_NAME', 'admin_newcws');

/** MySQL database username */
define('DB_USER', 'admin_newcws');

/** MySQL database password */
define('DB_PASSWORD', '5cE2Cx74tJQvD9@1233');

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
define('AUTH_KEY',         'W*U=[2!H4Xp[?9}%oHI7URVgQZrkt+Nc7J$m7t~+;H8-I MbAKpN?ksV?F/kjX:-');
define('SECURE_AUTH_KEY',  'H|o[rv&oJmIfA;D5^BBWhNGR2~D9D&V6_ )WCUTV5L5m^ReLx=t$FRhv.io9#.kr');
define('LOGGED_IN_KEY',    '{03Y|fwLaH)Hm&1__TOB+<Z]Rh&XRv>pK` uCcJsnS3)C:V7,bdIdb>=Nb>zg 8m');
define('NONCE_KEY',        '*n%,]|kwYP;sa9HY/QUbh;UY5Icum<,LY5eEbZG14$%[JP-P@xH/WQ|3Nfp4Sf~~');
define('AUTH_SALT',        'f1]upVQ<~^<g%Wh78o%j}xc7`?n_|jNoDdd,G6Uqc#T}C}<DV5s]YnNT^NDD09$p');
define('SECURE_AUTH_SALT', 'D%uCeAF-Q`*4R[aVqD~<fr4^/0~ vL<p7%g,V|e2sI?3@>Y[lgmNO9KQ~5#H;m3*');
define('LOGGED_IN_SALT',   'v91X/z>gfVntk{{a]HH{MkA-Amk%EMkHr#vf-~ch~eFMss1)u=3 P$k_-0Es%jSM');
define('NONCE_SALT',       'ZEyPX<`ZR,4(@<Fl]4l]8pX-5eu~4n6!,UW7@#easmk8:r=~jI|DCq04#Zo;A%y/');

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
