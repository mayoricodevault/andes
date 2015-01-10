<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


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
define('DB_NAME', 'andestoamazon');

/** MySQL database username */
define('DB_USER', 'forge');

/** MySQL database password */
define('DB_PASSWORD', '9AcXDriMMuqgz8CIQIc4');

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
define('AUTH_KEY',         'IW9QXWEd$u]TAv>~Sym7+Vs|Z>aW8%+t${{$Rhv;4>w}UvB9&|Uhki%|PE}~b2u]');
define('SECURE_AUTH_KEY',  'uSL/*dWkw9r;9oeB{#&IR!r.wi!%|<78| 26Y[}`TNT,N8Xmv:|FQ-R9%F:,SZ%,');
define('LOGGED_IN_KEY',    '~G5#<KNj2(>!UHJq8hB)xB;zHU[}K(0lYrq>VFPsAWf[v<V(x((G{MXOBpQT{glR');
define('NONCE_KEY',        'f[o^ awr*6~_TpNLk0J~26FmOI* 6BYmR5~)O0Ru.sDY-|AC =[G+Snke|Q9u^_f');
define('AUTH_SALT',        'v}@TConKKJn.@uuPz;qBa*? U*,UYU{:`I@$5k B ?.4DY>7l(&Iau~mIx;1/_iM');
define('SECURE_AUTH_SALT', 'Ta,sJrcHk8%E)Fz2n-+L=fZa.z>3B+fPR:}N]dowS9PcC[P^PwRSl6E T1f7h3l!');
define('LOGGED_IN_SALT',   'N_`ghp;p>,-bn#TS6yV]4R;Ys!XWw8S1TYb2A}.uz>dis*feknC8vwbr)XD|t-]V');
define('NONCE_SALT',       'sf;,(.^tO53K)PEA|ygI0~5.}]iZ:;fqpef-HiB2Td##1Ck#P#&$TGK0?ZM4SsGP');

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
define( 'WP_ALLOW_MULTISITE', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
