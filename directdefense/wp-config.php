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
define('DB_NAME', 'mhcgm_e');

/** MySQL database username */
define('DB_USER', 'mhcgm_d');

/** MySQL database password */
define('DB_PASSWORD', 'Og71#lW0jE');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
define('AUTH_KEY', '8~f(zi|l:Rqvu38DC+o03iWkEvo:MR3Cv7c6qD8O9GCB;o1E+nB2Jl;sD3gln6&_');
define('SECURE_AUTH_KEY', '!t987l9*E!TMF(153~n7p+H2njZA_U785QV32#W_2v-AhB:9[Yhtc2DA|5]ku8*5');
define('LOGGED_IN_KEY', 'VC3(d9]oCx)3|!)0Q51@3c3B7m)ri3j*]hBI]/9F;21#je20*5JL4M17P4sEP@u8');
define('NONCE_KEY', '[&cmI:GgeI7G!87//%m(83*6&[6|N7F8ZSH2N#:OPC189|obtN2f)p0#~C7!5+5U');
define('AUTH_SALT', 'XXlvxf%DA+9*w5@g6JHZM%[L*3H*l)1-P-v4:8!%~;Grd]_4#3g4pJ%7PrD20309');
define('SECURE_AUTH_SALT', '%)6o(s1IV7_[LsL)J+ee8SG7#3J5v&1ovwtVSE86mX~_(4xz5s+(HC_gA9/!jMZl');
define('LOGGED_IN_SALT', 'zCw#5c1)U6Pp8Rtq]%t6:CGtjlZ7*Y+;4NOV1nikq@%B5:DDaS2gs89o:8U-o@pn');
define('NONCE_SALT', '!6P|6p3v_Z|8pM1Or/]88myH9|9|3~3oWR]ZG@E2!8Bb(Es;Op5c~78N3Q1h7(_E');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'TmH42UB784_';

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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
?>