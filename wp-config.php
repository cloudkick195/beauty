<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'opal' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'J/XZ>;M7.8i|zSzX0Xmiep+d-13XvP`x:ja]JOiH;HBDiy{Gz!R?qY9L,x9$zI:K' );
define( 'SECURE_AUTH_KEY',  'aNU9~sk$ubpTG gY~Akc[a`(U,_77{m&JX4$x<4Hc84$(|QQHU>RCIE.jM1Fkzsb' );
define( 'LOGGED_IN_KEY',    '(I`,AAh)W3`_Q_?,&|$/>T~-ol9@# (Obni6KQf:IVK:D{cSxdX<vKZ=pz*OL+Tj' );
define( 'NONCE_KEY',        '|cRFO(M{]R=v/acWD]*g<X}^O@N-(ZYZYwwOc,je+%e,C^Zqg|s3HoDR!Grjey6s' );
define( 'AUTH_SALT',        '_+!+E8k>~l$Ad%&wCXDvsyc6qU^f/4pugei*UNX3*V&E5+*@b1B 7^oq8+N`f.?B' );
define( 'SECURE_AUTH_SALT', 'F3X%TrEsX_jwl&4VpR].sRe-5ZlNb(UBW$8sOAN]j|a ]Jh?:fI8x@ye;*OL[;FR' );
define( 'LOGGED_IN_SALT',   '}3>3gg{k1`Ecml%6DVvbzg++]]v~NM59%>LY)bqI-#fERD!5i#^>F(g*4a@y95_[' );
define( 'NONCE_SALT',       'oO]4 XW7mr!J;.TqsWFL2ruxWKhb:]Rx,bD=$*@qU-tC:{l^`5*/|s[JF[yPibkx' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wphopt892_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
