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
define('DB_NAME', 'sk_phpchat');

/** MySQL database username */
define('DB_USER', 'sk_phpchat');

/** MySQL database password */
define('DB_PASSWORD', 'sk_phpchat@1');

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
define('AUTH_KEY',         '*vX*8xA&X+fC1+UjOv==;=dGWNzSZBw+3MNR[Y/1t`eTa5Gb;%O+9Cz7{lk+jyO@');
define('SECURE_AUTH_KEY',  '+6K]g|Zq}emFrV~OWh0j3|EOf/-.G.Wz.h%9~+tZH*-c9uXCO=:/:8@y]Ef+;!rC');
define('LOGGED_IN_KEY',    'uJ?W5nad6=1M?c=1<vE(%b+Rgsje%[aW8[<Oe+]#7.S|n[?5$Hd,*|-7K[{LJn&s');
define('NONCE_KEY',        '-x<Y7A-3 DGocwffL_O&UK7i2e +a~/?UOk=}jpB:|s686%tDa.fPV,Tk}&{}3~B');
define('AUTH_SALT',        '$`f>b]zHzI_X2NKY#9VA%D|5CrQVqg|(iE7!ervW)(B#IXCb<m4>WVm+%@??T[)J');
define('SECURE_AUTH_SALT', '<W:i@$j1?oMy;NSk{y94Dr&p,V0Ma3BYk[B.j!fuwF!a]^FSi30@)yvd=z*L&8JF');
define('LOGGED_IN_SALT',   '`Vc4e +|wG~LnmRI{T3p52+a}L>XDh:J]>}UAxyu(]KiDTLE7VxC_Sc0le;+-|NE');
define('NONCE_SALT',       ')k%A<{[Fa4PatFC_?Ro-^c?[NI#I.&^oN1rWV(&.6)`0DP4rwEjJg0+|2_QHG;Ap');

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
