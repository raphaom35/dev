<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rapha35om_com_br');

/** MySQL database username */
define('DB_USER', 'rapha35om_com_br');

/** MySQL database password */
define('DB_PASSWORD', 'UXYwGU2L');

/** MySQL hostname */
define('DB_HOST', 'rapha35om.com.br.mysql.service.one.com');

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
define('AUTH_KEY',         '_7fG7qwbYKxeahix9IFJhMJ2AmRSjsu1XESFS-RzTxA=');
define('SECURE_AUTH_KEY',  '1LJd5lW-Ada8IXg0oH4xg07RkrG1fST-U4jSVJqkQ_c=');
define('LOGGED_IN_KEY',    'XVqV0Yx6p0YDd_RQI9iDL9xM8auI9G5WH5nbGP-d6TY=');
define('NONCE_KEY',        'CEqTbZlge6Mi_UuVPP7M3uK0C3lv8kNzL-gWtlDarF4=');
define('AUTH_SALT',        'I4CfYAEbWWEiQGRCwRxJEZNBsmHWKeI1tjeOecSLsVA=');
define('SECURE_AUTH_SALT', 'TOxX_8h5QwD1pAU-Kv4nNuojMWvaqT6ICUSwvEG7N4U=');
define('LOGGED_IN_SALT',   'Wx6oe2g63yWBPE0yKDesk5GNDti-rOaxt7Ksq7ZM0Bo=');
define('NONCE_SALT',       'g206I9sc0a4_-HtKi79Clz2Sgtvn074-jYoekR5JgqE=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'blog_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'en_GB');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/** 
 * Prevent file editing from WP admin.
 * Just set to false if you want to edit templates and plugins from WP admin.  
 */
define('DISALLOW_FILE_EDIT', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
