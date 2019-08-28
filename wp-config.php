<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'oo' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost:8889' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'at*tM6#@V$l7w7IKS~E5elW_&.U1XR:MLF15T$VN Eg4z<w&OOmbl9=ao6cK(ggB' );
define( 'SECURE_AUTH_KEY',  'W}1}}hI717%rnF>E]vs4B@uzBN|h{D}&q~F,<d (#$uByN+np9*Uj5yVbcs!U9|*' );
define( 'LOGGED_IN_KEY',    'G;@z/ni6f tB^)AE)XRk,C2@J]edND$~F%lWdIzWUcnQB%Iw1Q%N*pcp8Oz]A[|D' );
define( 'NONCE_KEY',        ';ckFn@I{Q3S]9V@Nq+v[i+=2M-_g_R5K9L=/P7LzZ+ktYwi+p]DGb01xmi66psaE' );
define( 'AUTH_SALT',        'er(vEZ$ht5~j%Su|2Ur }Rp0elaJRA=F ~(j>}9q= Dj8)_o1$3*!H9NbH$+-UO}' );
define( 'SECURE_AUTH_SALT', '!I|QKiAJ2w|r5*U^a5FJs@iDQQ?202@^x]&sVWWO^[r:61>|i@eB@iesdT>i0a+C' );
define( 'LOGGED_IN_SALT',   'h9MEqHABo5>nCJ5c98aIV]u{gmry3rcjpXw|q6NT0d?!rDEC6::!r&XdRXzbIQ]3' );
define( 'NONCE_SALT',       '(X-pz|*^KQB|JPRKvf,->>9z,Sn0Fu+]yo!*D9:]D-/I<q%!}M(%27S4T?$2%q(j' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'ocl_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
