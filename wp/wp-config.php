<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'db_scbtfinal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '<*<nRQkl3}]E{|7J?V~L|>Q6(_m>CC*aq$NA+ra;IJ1;<{cXHB.>-w E;rQeW+L9');
define('SECURE_AUTH_KEY',  ':#?-uR%oSdk>ql?_BY``!w>$<`t:@*E]i+Fk ~.Vy*Ih}fM_(yc=CzZT>+X7LoGD');
define('LOGGED_IN_KEY',    'N[n?EDB5% ],5LnwEu#r}PhUxwg^|gz$D](Si1b:.l6YF7qIXDAL`1LCKN>W^.T2');
define('NONCE_KEY',        'Nhr;hK}T( $xz,+#|z>#/|[HX1C2s2.bj]-.]#M]#/f@2|VuRm8I51)0WRZm2?,0');
define('AUTH_SALT',        'bQSu<178YL(SphaGVXf*EH]OFI;^|ROE^+ N.|?J4k}[TM+Ff79WHF.@%RmTmFQl');
define('SECURE_AUTH_SALT', 'WP1r_(T[NR;iUBCU6/CJn{dC1AQOJ0jvT=qzbM&mHsORX*~0C7yIEyH5SeVd69!<');
define('LOGGED_IN_SALT',   's>D^dbCqKQMMz3_rzP{j1W&+o_}{ +NsBmJMb(hsx}aJD|$l984/|<|ClLXXU5w#');
define('NONCE_SALT',       'SA.?PV3#c*c>GqB}dcB%1+Wmfxi]60D&G4gz|paG[;^PukA1u5!+qJ+,Gr|y}Lb>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'db_';

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
