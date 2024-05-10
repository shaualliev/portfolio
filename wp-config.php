<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'f{8N.V`xy1QZ3~J0qkmysv=c;p@-#%S{zb.,j4.h]V](fOMC5K:,dy]58C$|C),q' );
define( 'SECURE_AUTH_KEY',  ' :.<F3ENQ]E7sP]a8UcI4}id(~H^1hgioOK/o|O[xzW<^eM.kiwKFx% Mb3kSlU`' );
define( 'LOGGED_IN_KEY',    'zJt7;M{dU#a[=$Yqaj,g[.DN,l9IZXBCXb&fBs/<=]2G,qI:FG&.Y[h/-9sy]y(>' );
define( 'NONCE_KEY',        '59=]H^G$E7}tvhJYz$s!ivs#:e0hHEARqyO+,; <b,(WsX?j_ZFH7gT5R6O4[:lF' );
define( 'AUTH_SALT',        ']]sesSN)mHCpc},oE:--@Ogw$rjA_%b8cN)Ar$N{ap9QMudZ|45Xg?-bQxB0H=/S' );
define( 'SECURE_AUTH_SALT', ' aa:;p5s33a`Km;]p((p2fxx(!;O9SZ=QQ}r/>VY/X[bT/gpa~Ausct_9~c(DTOb' );
define( 'LOGGED_IN_SALT',   '/N[@oBxMfjZ~ a2fn3(15^9yiZix6Ts|CsL+yWH2[w-io^E n3KUiCG56B<XffaZ' );
define( 'NONCE_SALT',       ', sXdomZeG4|S) 1!E#nLGO~TrJX6IDX!bj)Cr,HT8GQKS93yA5cV(>3JuDwgT}M' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
