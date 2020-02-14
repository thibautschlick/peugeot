<?php
//
//$NOM_EXPEDITEUR_EMAILS = "SAINT-GOBAIN | PEG 2017 ";
//$EMAIL_EXPEDITEUR = "support@peg-saint-gobain.com";


if (strpos($_SERVER['DOCUMENT_ROOT'],'C:/wamp') !== false) // local
{
	$URL = 'http://localhost/PSA/psa_xnet17/'; // à prendre dans la barre du navigateur
}
else
{
	$URL = 'https://www.psa-accelerate2017.com/xnet_psa17_EDIT_in_progress/';
}

//$DOSSIER_CORRRESPONDANTS = "_correspondants/";
$DOSSIER_CORRRESPONDANTS = "";




//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
// ATTENTION BIEN INACTIVER si prod : true false
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


//=====>    sélection de membre par GET pour test dev
$TEST_MULTI_MEMBRES = false;

//=====>    affichage menu du haut pour accès tous membres pour test dev : inactivé dès que TOUS les 15k membres en place
$TEST_AFFICHE_MULTI_MEMBRES = false;

//=====>    tous les mails forcés à webmaster
// ATTENTION avant de désactiver, remettre tous les MDP à zéro + les nb de connexions + les stats
$FORCER_EMAIL_WEBMASTER = false; // true false						
//$EMAIL_WEBMASTER = 'vlepoivre@b-fly.com';

//=====>    si $FORCER_EMAIL_WEBMASTER == true, IGG fonctionnant normalement pour test équipe projet => recoivent mail mdp
//$TEST_IGG_AUTORISES = array();

$TEST_IGG_AUTORISES = array(
);




//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// fin       ATTENTION BIEN INACTIVER si prod : true false
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!






$pages_titres_pages = array(
	"connexion"=>"Connexion",
	"accueil"=>"Accueil",
	"fixe_variable"=>"Votre rémunération",
	"plans_epargne"=>"Votre épargne salariale",
	"avantages_sociaux"=>"Vos avantages sociaux",
	"synthese"=>"Synthèse",
	"pdf"=>"Télécharger en pdf",
	"avis"=>"Votre avis",
	"contact"=>"Contact",
	"stats_results"=>"Résultats des statistiques",
	"votre_avis_resultat"=>"Votre avis - résultats",
	"modifier_mot_de_passe"=>"Modifier le mot de passe",
    "mentions_legales"=>"Mentions légales",
    "cookies_donnees"=>"Cookies et données personnelles",
	"modifier_mot_de_passe"=>"Modifier le mot de passe",
);







// prefixes aux noms des colonnes sur bdd : ATTENTION pas de "_" dans le préfixe
$prefix_col = array(
	"membres_connexion"=>"mcnx_",
	"membres_corres"=>"mcor",
	"membres_corres_connexion"=>"mccnx_",
	"membres_corres_last_time"=>"mclt_",
	"membres_last_time"=>"mlt_",
	"stats"=>"sta_",
	"stats_corres"=>"scor_",
	"votre_avis"=>"va_"
);

$site_cnx_tables = array(
	'bsi'=>array('table'=>'membres_connexion','colonne_login'=>'MATR'),
	'corres'=>array('table'=>'membres_corres_connexion','colonne_login'=>'MATR')
);    
//    ".$prefix_col['membres_connexion']."



//$membres_non_inactives = array('0075116','0075117');
//$membres_non_inactives = array('0075117');
$membres_non_inactives = array();
$temps_inactivation = 60000; // 10 mn
//$temps_inactivation = 6000000; // 10 mn x 100
//$temps_inactivation = 5; // test>

$temps_valid_mdp_auto = 12; // en heures
$temps_valid_mdp_auto = $temps_valid_mdp_auto * 3600; // en secondes
$TOKEN_LENGHT = 80;
$TOKEN_VALID_SECS = 3600 * 4; // 4 heures de validation de token
//$TOKEN_VALID_SECS = 3600 * 400; // 4000 heures de validation de token


// HISTORIQUE MDP
$historique_mdp = 9;

// SALT
//$salt_old = "s48@Fld9d+Oh-*dNjf!b"; // ancien salt commun, à garder puisque tous les mdp y sont encodés
$salt = ""; // salt différent par membre




?>