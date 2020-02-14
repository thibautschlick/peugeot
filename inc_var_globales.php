<?php

// ########################################################################
// ##################### Date connaissance prix ###########################
// ########################################################################
$connaissance_prix_date = "XX-XX-XXXX XX:XX";    // Date connaissance prix "14-11-2015 08:00"


// --------------------        !!!        ATTENTION      ---    ici    PSA PEG  2017   !!!       ----------------------
// --------------------        !!!        ATTENTION      ---    ici    PSA PEG  2017   !!!       ----------------------
// --------------------        !!!        ATTENTION      ---    ici    PSA PEG  2017   !!!       ----------------------



$prix_ref = $prixref = 45.888;
$coefinvestlim = 0.25;  // 25%
$prix_souscription = $prixsouscription = 36.72; // 42.72 // 51.61
$minsouscr = 0;
$PRIX_EUROS = '36';
$PRIX_CENTS = '72';
$prix_sous_euro = $PRIX_EUROS.".".$PRIX_CENTS;
$coursecheance = 45.888;

$prix_ref_euros = '45';
$prix_ref_cents = '888';
$prix_sous_euros = '36';
$prix_sous_cents = '72';

// LOCAL ?
if (strpos($_SERVER['DOCUMENT_ROOT'],'C:/wamp') !== false)
{
	$LOCAL = true;
}
else
{
	$LOCAL = false;
}

$PRIX_IS_FIXED = false; // true false

// fonction true false via GET pour test
if (isset($_GET['prix'])) {$PRIX_IS_FIXED = true;}

$EMAIL_CONTACT = 'vlepoivre@b-fly.com';
$EMAIL_WEBMASTER = 'vlepoivre@b-fly.com';
$EMAIL_SITE_NAME = 'PSA - Accelerate 2017';
$TITRE_SITE = $OPERATION = 'PSA - Accelerate 2017';
$NOM_OFFRE = $NOM_OPERATION = 'Accelerate 2017';
$EMAIL_EXPEDITEUR = 'contact@psa-accelerate2017.com';
$SOCIETE_OPERATION = 'PSA';
$ANNEE_OPERATION = '2017';
$URL_SITE_SOUSCRIPTION = 'https://www.ors.amundi-ee.com/cp/psa2017';
$URL_SUIVRE_EPARGNE = 'https://www.amundi-ee.com/psf/#login';

// sécus save BDD + envoi email
$SAVE_DOSSIER = 'Save_mQ-654_sdfhfz--7JBG_H6h-ui46/';
// appli ajoute à la suite : "articles" ou "groupes" ou "membres"
$SAVE_FILE = $SAVE_DOSSIER.'SmQhfz7JBGH6h5Opf_';
$SAVE_ACTIVATION = true; // true false
$SAVE_ENVOI_EMAIL = true; // true false





// VOIR aussi dans inc_var_globales_corres.php pour l'email expéditeur concernant l'EDIT Des sites

$MDP_COR_DOC = 'doc-cor/peg'; // MDP pour la documentation correspondants

$MDP_COR_DOC_RESULTS = 'doc-cor/peg_statsresults'; // MDP pour la documentation correspondants 



$EDITEURS_ALL_COUNTRIES = array(
	'vlepoivre@b-fly.com',
	'tschlick@b-fly.com',
	'edelamare@b-fly.com',
	'mlaunay@b-fly.com',
	'klorge@b-fly.com',
	'emmanuelle.belhomme@mpsa.com',
);




// dates clés modifiant le texte header haut droite      
date_default_timezone_set('Europe/Paris');
$time_actuel = time();
$time_selected_header = "05090000"; // 1er élément de texte / date de départ du site
$times_cles = array(
    $time_selected_header=>mktime(0,0,0,9,6,2016),
    "12090000"=>mktime(0,0,0,9,12,2016),
    "25090000"=>mktime(0,0,0,9,25,2016),
    "03100000"=>mktime(0,0,0,10,3,2016),
    "03102359"=>mktime(23,59,0,10,3,2016),
    "07110600"=>mktime(6,0,0,11,7,2016),
    "11112359"=>mktime(23,59,0,11,11,2016),
);

foreach ($times_cles as $time_str => $time_timestamp)
{
    if ($time_actuel > $time_timestamp)
    {
        $time_selected_header = $time_str;
    }
} // (=> ensuite, echo dans header)


// dépassement du 7 nov pour le changement dans les sims
$depasse7nov = false;
if ($time_actuel >= $times_cles['07110600']) {$depasse7nov = true;} //03100000     07110600            =============              ATTENTION bien REGLER SUR 07110600 POUR MEP 
// attention voir aussi dans index.php pour la condition spéciale pour USA => $depasse7nov = false;  dans ce cas pour le 7 nov
$sim1 = $sim2 = false;
if (isset($_GET['sim1'])) {$sim1 = true;}
if (isset($_GET['sim2'])) {$sim2 = true;}




//test de forçage du $time_selected_header pour test en PP   
//$time_selected_header = "07110600";       //  =============              ATTENTION bien MASQUER POUR MEP 
//$depasse7nov = true;




// all countries

// includes : attention l'ordre importe
//require_once 'inc_var_globales_countries_list.php'; // include les variables pour chaque ct et/ou lg
//require_once 'inc_var_globales_ct_lg.php'; // include les variables pour chaque ct et/ou lg

$COUNTRIES_INDEX = array(); // contiendra country code => country nom

//foreach ($regions as $region_code => $region_nom)
//{
//    foreach(${'countries_'.$region_code} as $ct_code => $ct_nom)
//    {
//        $COUNTRIES_INDEX[$ct_code] = $ct_nom;
//    }
//}





$COUNTRIES_INDEX_2LANG = array(
	//"canada"=>array("en","fr"),
	//"luxembourg"=>array("de","fr"),
	//"switzerland"=>array("en","fr")
);

//liste de tous les codes de countries (compris les suffixes type "_fr")
$COUNTRIES_CODES = array();
foreach ($COUNTRIES_INDEX as $country => $country_name)
{
	// SI UNE SEULE LANGUE POUR LE COUNTRY
	if (!in_array($country,array_keys($COUNTRIES_INDEX_2LANG)))
	{
		$COUNTRIES_CODES[] = $country;
	}
	// SINON SI DEUX LANGUES POUR LE PAYS
	else
	{
		$COUNTRIES_CODES[] = $country.'_'.$COUNTRIES_INDEX_2LANG[$country][0];
		$COUNTRIES_CODES[] = $country.'_'.$COUNTRIES_INDEX_2LANG[$country][1];
	}
}



$COUNTRIES_INDEX_ALALIGNE = array('india','singapore');

$LANGUE_CODE_NOM = array(
	//"en"=>"English",
	//"fp"=>"Filipino",
	//"fr"=>"Français",
);

//array_keys($array)




//$FORM_OK = array('fcpe_ze','fcpe_hze','sar_ze','sar_hze');
$COUNTRY_OK = array('AUSTRALIA','AUSTRIA','BELGIUM','BRAZIL','CANADA','CHILE','CZECHREPUBLIC','FRANCE','FRENCHPOLYNESIA','GREECE','GERMANY','HUNGARY','INDIA','INDONESIA','ITALY','LUXEMBOURG','MALAYSIA','MEXICO','MONACO','NETHERLANDS','NEWCALEDONIA','NORWAY','OMAN','PERU','POLAND','PORTUGAL','ROMANIA','SLOVAKIA','SPAIN','SWITZERLAND','THAILAND','TURKEY','UAE','UK','USA');
$LG_OK = array('de','en','es','esal','fr','gr','it','nl','nlbe','pt','ptbr','th',);

$URL_BANQUE = 'https://www.amundi-ee.com/psf/#login';

// langues sur le site de la banque en fonction des langues du site
$langue_banque = array(
	'aust'=>'au',
	'arg'=>'ar',
	'chi'=>'ch',
    'co'=>'en',
    'cn'=>'en',
    'cz'=>'cs', //
    'de'=>'de', //
    'desu'=>'de', //
    'da'=>'en',
    'en'=>'en', //
    'en_uk'=>'en', //
    'es'=>'es', //
    'esal'=>'es',
    'fr'=>'fr', //
    'frbe'=>'fr', //
    'frsu'=>'su', //
    'fp'=>'en',
    'gr'=>'en',
    'it'=>'it', //
    'jp'=>'en',
    'nl'=>'nl', //
    'nlbe'=>'nl', //
    'pl'=>'pl', //
    'pt'=>'pt', //
    'ptbr'=>'pt', //
    'su'=>'en',

    'slo'=>'sl',
    'th'=>'en',  
    'tr'=>'tr', //
    'us'=>'en',
);



// éléments des menus, avec un array d'arrays => en [0] la tête de menu, ensuite les sous-menus
$ELEMENTS_MENU = array(
	"index" => array( // choix du pays
		"couleur" => '',
		"sous_menu" => array()),
	"home" => array(
		"couleur" => '',
		"sous_menu" => array()),
	"offre" => array(
		"couleur" => '',
		"sous_menu" => array('offre_avantages','offre_contreparties','classic_comprendre')),
	"modalites" => array(
		"couleur" => '',
		"sous_menu" => array('modalites_participer','modalites_demande','modalites_calendrier')),
	"secure" => array(
		"couleur" => '',
		"sous_menu" => array('secure_choisir','secure_comprendre')),
	"classic" => array(
		"couleur" => '',
		"sous_menu" => array('classic_choisir','classic_comprendre')),
	"ecollab" => array(
		"couleur" => '',
		"sous_menu" => array()),
	"edit" => array( // page d'edition des textes
		"couleur" => '',
		"sous_menu" => array()),
	"edit_textes_menu" => array( // page d'édition des textes des menus (page dédiée car pas de clic possible directement sur les textes dans les menus et sous menus)
		"couleur" => '',
		"sous_menu" => array()),
	"edit_document" => array( // page d'édition des textes des menus (page dédiée car pas de clic possible directement sur les textes dans les menus et sous menus)
		"couleur" => '',
		"sous_menu" => array()),
	"login_edit_textes_dyn" => array( // page de login avec mot de passe pour modifier tel pays
		"couleur" => '',
		"sous_menu" => array()),
);

// $ELEMENTS_BLANK = array();  // cf ct_lg

$ELEMENTS_MENU_LEFT = array(
//	'comprendre'=>'peg_comprendre',
//	'simuler'=>'peg_simulateurs',
//	'souscrire'=>'peg_souscrire',
//	'correspondant'=>'correspondant',
//	'contact'=>'contact',
//    'bourse'=>'groupe_bourse',
);

$ELEMENTS_MENU_RIGHT = array(
	'comprendre'=>'comprendre',
	'simuler'=>'simuler',
	'souscrire'=>'souscrire',
	'documentation'=>'documentation',
	'alertes'=>'alertes',
    'performance'=>'performance',
);

$ELEMENTS_MENU_CACHE = array(
	'index',
	'module',
	'faq',
	//'alertes',
	'calendrier',
	'credits',
    'edit',
    'edit_textes_menu',
    'edit_document',
    'login_edit_textes_dyn',
);

$ELEMENTS_MENU_CACHE_POUR_CLA = array(
	'secure',
	'classic',
);

$ELEMENTS_MENU_EDIT_TEXTES = array(
    'edit',
    'edit_textes_menu',
    'edit_document',
    'login_edit_textes_dyn',
);

$PAGES_SPECIALES_FRANCE = array(
    'performance',
    //'peg_simulateurs',
);

$ELEMENTS_MENU_1_LIGNE = array( // dans menu, leur ajoute <br/><br/> pour être alignés aux autres
    'groupe',    
    'peg2017',
    'contact',
);


// si le texte n'est pas le même dans le menu et dans le sous-menu, mais que les pages cibles sont les mêmes
$PAGES_RENAME_VIA_URL_TRAITEMENT = array(
	//'toute_documentation'=>'documentation',
);

$LANGUES_SMALL_SOUS_MENU = array(
);

$PAGES_AVEC_IMG_BG_FOOTER = array(
);
$PAGES_COMMUNES_TOUTES_FORMULES = array(
);
$PAGES_SANS_SIDE_LEFT = array(
);

// ne sont pas des pages mais des ancres, et on donne quelle page est concernée par l'ancre
$PAGES_ANCRES = array( // ancre => "pseudo" page
);


// création de $MOTSDEPASSE_EDIT_TEXTES qui répertorie les mdp et les pays à modifier
$MOTSDEPASSE_EDIT_TEXTES = array(
    //"aus***peg17"=>"australia",
    //"belfr***peg17"=>"belgium_fr",
    //"belnl***peg17"=>"belgium_nlbe",
    //"ger***peg17"=>"germany",
    //"spa***peg17"=>"spain",
    //"france***peg17"=>"france",
    //"ita***peg17"=>"italy",
    //"new***peg17"=>"newzealand",
    //"usa***peg17"=>"usa",
    //"uk***peg17"=>"uk",
    //"pt***peg17"=>"portugal",
);




// liste des pages => groupe associé
$PAGES_GROUPE = array();

// modif 161117 car pb de pages non autorisée si sous menu...
foreach ($ELEMENTS_MENU as $element_groupe => $element_contenu) // nom du groupe => array du contenu
{
    $PAGES_GROUPE[$element_groupe] = $element_groupe; // on enregistre le groupe comme page autorisée
	if (!empty($element_contenu['sous_menu'])) // si  sous menu
	{
		foreach ($element_contenu['sous_menu'] as $sous_menu)
		{
			$PAGES_GROUPE[$sous_menu] = $element_groupe; // on enregistre le sous menu comme page autorisée
		}
	}
}


$ELEMENTS_RIGHT_BOUTONS = array(
);

// complète la liste des pages => groupe associé
foreach ($ELEMENTS_RIGHT_BOUTONS as $element_groupe)
{
	$PAGES_GROUPE[$element_groupe] = $element_groupe; // page = groupe
}


$ELEMENTS_RIGHT_WIDGETS = array(

);

// docs commun à plusieurs pays
$DOCUMENTS_COMMUNS = array(
    'document_coming_soon.pdf',
);





//       CLASSES de styles

// classes pour les nombres des tableaux mis en valeur 
$class_nombre_1 = 'big3 bleufonce';
$class_nombre_2 = 'big3 rouge';


// pour page doc

//$dossier_doc = 'doc_salaries_peg/'.$country.'/'; // voir dans ct_lg
$TAILLE_PJ = 1024 * 1024 * 100; // 100 Mo
//$EXTENTIONS_VALIDES = array('pdf','doc','docx','ppt','pptx','xls','xlsx','png','jpg','jpeg','gif','mp4',);
$EXTENTIONS_VALIDES = array('pdf','doc','docx','ppt','pptx','xls','xlsx','txt');

//$str_url_test = array(
//    '_XNET_test_peg17',
//    'wamp',
//);
//foreach ($str_url_test as $str)
//{
//    if (strpos($_SERVER['HTTP_REFERER'],$str)
//        {
//            
//        }
//}



?>