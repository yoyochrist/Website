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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '&Y^L!X<V*AR/<6(Z|dOh*)46iO:[goUk-bKus7-CKA/B|SpeQsq,AY_dO7Fm!v2^');
define('SECURE_AUTH_KEY',  'QNK|Um7R+R?/Yg[C-K%#?ef_pC:W8UtIifw|E,nzThHE*rXj&iWeh7+jXar@iQeH');
define('LOGGED_IN_KEY',    'Z3lD$?uPz9G^a?dSID_9R4> $Ru6dxZ+;LZ>4-eG C[agFHK2? (iu:6LB|,0.w[');
define('NONCE_KEY',        'd0sr5Il}cgmL@18!d*fkqEQR<g{$kzxRp_]K_mqI3FQk&6.+|GVI)E|z*Vd?|s<}');
define('AUTH_SALT',        '`N@;HIj5;LBlOi;8&P!H+sx;%B/NE2?m2(E>-W,Fu5)|dDfAEKa&ui.*`pVs|fM_');
define('SECURE_AUTH_SALT', 'H8J?Oaf|Q8Xnw=WB$|+35bF&u<Qjx)j+W-06./bRGv:S7-C[zcRM+% RTTO$m<*x');
define('LOGGED_IN_SALT',   '+$rSG[lV7.+s96{:,.W2%x!zj+}2bJ#VQf,=a&TFCr+|l17:%kOzqi@/k}_pWa}g');
define('NONCE_SALT',       '7++%4SqxdS0ERP+MD~8Z/QwOL>~|g@65pX(bOQJ`5^H1ow---}|^]Y.-yI^GX{1x');

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
