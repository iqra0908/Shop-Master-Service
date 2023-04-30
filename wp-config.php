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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'shopmas4_WP7ZL');

/** Database username */
define('DB_USER', 'shopmaster');

/** Database password */
define('DB_PASSWORD', 'ImT!@z331962');

/** Database hostname */
define('DB_HOST', 'shop-master.mysql.database.azure.com');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', 'b3e6b4460877ae0544329d9d1a87456eceea05744c3a9fd1b0cd9694a4af0cbb');
define('SECURE_AUTH_KEY', '6e034603706018073014e585d85df601fc8d217391564477f64b7bb767cb7759');
define('LOGGED_IN_KEY', 'ffb99dddc658b56f76625dcec32e105601a661a262c1a0da7c6797239c20e3a5');
define('NONCE_KEY', '531ad6d0e0367fe01e2ac989e3c7b1f02fab1ee120b132c1c3e880bc6bb68173');
define('AUTH_SALT', '595e9cec2f3d9f53add2c6e06f54f4b9dbd8847ee449cb48416bba2bdf2a2147');
define('SECURE_AUTH_SALT', '398690c3862a719c0b4c5c8ef932f73301a9b2f6f42b73e010ece72f895b8317');
define('LOGGED_IN_SALT', '8d26e279252a86e19b58b03f82f9acefec387648b0d5fecac19c97fa637cc480');
define('NONCE_SALT', '0fbf14a6ef3535a16f805ccf60efb4be534f98c2b9e1f6e7cfa2c9872fcc7c6b');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cVN_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 20);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
