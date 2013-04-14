<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'disney');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'afJJd27v.?');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

define('WP_POST_REVISIONS', false ); 

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$R!b$J*-!$)I1^QK;&a^<cW] O~^,mO)dCBeqde5-|=&o~p~9Jm19-;^`yv@j#D,');
define('SECURE_AUTH_KEY',  '7MnY8F|}<0/2^AdLGyC5J|*U2 #*UuQ>KhZ@*Pasqv9&2VkW]^#trCj6+sFVG%4A');
define('LOGGED_IN_KEY',    'm+N&|1Bygx>ADt%KgpFn_l~pSqT[1@S/3$pEZd2K8Mvnrd.b[)[0-@sy][r?JTlG');
define('NONCE_KEY',        'c5j u9)~Bc#~8hl`g$ty(| t@|OM,9X3xRA$8j.>`S=n>{uuzpYQg?|q.`Wg:MWQ');
define('AUTH_SALT',        'QQBM}T@3!|k0a-]FzR^MDxSNTIWd,AuHIW c@d >|%Kc->|#OP|CYxBVG2S=XA)%');
define('SECURE_AUTH_SALT', 'TH&[K<qu]W}5|W@-|i}7YZ;O7>/=;xlS{=n%@J/|x,b+}@K%P,%E=(xSSf@C_^yv');
define('LOGGED_IN_SALT',   'Wjv+}`vl%2oIu)KO(G]U1Db[*Je:W!][|FvX7pIc=%AxD}|imr7:+9P*`~L`XTG+');
define('NONCE_SALT',       '>a}hRe}P:h.!WM`7}FAe)R#95w1H-j7u%k-sClDvblN*-vXc9QVU2:.r7PU%#PTL');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'disney_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');