<?php

$page_ok = $ct_ok = false;

if(isset($_GET['pg']))
{
	$pages_ok = array();
	
	$page = trim(addslashes(htmlspecialchars($_GET['pg'])));
	
	if (in_array($page,array_keys($PAGES_RENAME_VIA_URL_TRAITEMENT)))
	{
		$page = $PAGES_RENAME_VIA_URL_TRAITEMENT[$page];
	}
	
	
	if (in_array($page,array_keys($PAGES_GROUPE)))
	{
		$groupe = $PAGES_GROUPE[$page];
	}

		// LISTAGE DES PAGES OK Y COMPRIS MENU + SIDE RIGHT
		//$pages_codes = array_keys($PAGES_GROUPE);
		foreach (array_keys($PAGES_GROUPE) as $element) // liste simple de pages
		{
			$pages_ok[] = $element;
		}
		
		foreach ($ELEMENTS_RIGHT_BOUTONS as $element) // array 1d
		{
			$pages_ok[] = $element;
		}
	
	if (in_array($page,$pages_ok))
	{
		$page_ok = true;
	}
}

if(isset($_GET['ct']))
{
	$country = trim(addslashes(htmlspecialchars($_GET['ct'])));
	if (in_array($country,array_keys($countries_CODE_LG_FORM))) 
	{
		$ct_ok = true;
	}
}
	
//if ((!$page_ok OR !$ct_ok) AND $page != 'index')
if (!$ct_ok AND $page != 'index')
{
	//print_r($COUNTRIES_CODES);
	//ECHO $ct_ok;
	//ECHO $page_ok;
	header('location:index.php');
}




//country sans la langue 

if (strpos($country,'_') !== false) // si "_" dans le country
{
	$str_to_delete = substr($country, -3); // on prépare la suppression des 3 derniers caractères : du type "_lg"
	$country_sans_lg = str_replace($str_to_delete,'',$country);
}
else
{
	$country_sans_lg = $country;
}

	
	

$couleur = '';




$country_name = $countries_CODE_LG_FORM[$country][0];


$monnaie = $countries_CODE_LG_FORM[$country][5];
$taux = $countries_CODE_LG_FORM[$country][6];

$salaire = 50000 * $taux;

$monnaieref = 'EUR';


if ($FORCER_LANGUE_FR)
{
    $lg = 'fr';
}
else
{
    $lg = $countries_CODE_LG_FORM[$country][1];
}

$form = $countries_CODE_LG_FORM[$country][2];

$ze_hze = $countries_CODE_LG_FORM[$country][4];
$cla = false;
if ($form == 'fcpe_fra') {$fcpe_fra = true ;} else {$fcpe_fra = false ;}
if ($form == 'ad_fcpe') {$ad_fcpe = true ;} else {$ad_fcpe = false ;}
if ($form == 'cla_ad') {$cla_ad = true ;$cla = true;} else {$cla_ad = false ;}
if ($form == 'cla_fcpe') {$cla_fcpe = true ;$cla = true;} else {$cla_fcpe = false ;}
if ($form == 'fcpe') {$fcpe = true ;} else {$fcpe = false ;}
if ($ze_hze == 'hze') {$hze = true ;} else {$hze = false ;}
if ($ze_hze == 'ze') {$ze = true ;} else {$ze = false ;}



if ($country == 'france')
{
    $inter = false;
}
else
{
    $inter = true;
}



//// données init pour éviter bugs
//$iso_ctry = "";
//$monnaie = "€";
//$monnaieref = "€";
////$hze = false;
//$taux = 1;
//$salaire = 50000 * $taux;
//$versmul = 1;
//$verssec = 1;
//$verscla = 1;
//$rdtgarmul = 1;
    //$rdtgarsec = 1;
//$index = 1;
//
//
//








switch ($lg)
{
	case 'ar':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;
	case 'co':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;
	case 'cz':
        $prefixe_monnaie = $monnaie.' ';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'de':
        $prefixe_monnaie = '';
        $suffixe_monnaie = '&nbsp;'.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = '&nbsp;'.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;
	case 'da':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ' '.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ' '.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;
    case 'en':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'es':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ''.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ''.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'esal':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'fr':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ' '.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ' '.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='&nbsp;%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'gr':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'it':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
	case 'jp':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
	case 'cn':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ' '.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ' '.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'nl':
    case 'nlbe':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'pt':
    case 'ptbr':
        $prefixe_monnaie = '&nbsp;'.$monnaie;
        $suffixe_monnaie = '';
        $prefixe_monnaieref = '&nbsp;'.$monnaieref;
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;
	case 'pl':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ' '.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ' '.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='&nbsp;%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'fp':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ''.$monnaie;
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;  
	case 'su':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ''.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ''.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = ' ';
        $separ_millier_monnaie = '.';    // '.' si monnaie
        break;  
    case 'th':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
	case 'tr':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ''.$monnaie;
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='%';
        $suffixe_pourcent='';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
    case 'us':
        $prefixe_monnaie = $monnaie.'&nbsp;';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;  
    case 'ro':  
    case 'sr':
        $prefixe_monnaie = '';
        $suffixe_monnaie = ' '.$monnaie;
        $prefixe_monnaieref = '';
        $suffixe_monnaieref = ' '.$monnaieref;
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal =',';
        $separ_millier = '.';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;   
   default :
        $prefixe_monnaie = ' '.$monnaie.' ';
        $suffixe_monnaie = '';
        $prefixe_monnaieref = $monnaieref.'&nbsp;';
        $suffixe_monnaieref = '';
        $prefixe_pourcent='';
        $suffixe_pourcent='%';
        $separ_decimal = '.';
        $separ_millier =',';
        $separ_millier_monnaie = $separ_millier;    // = séparateur $separ_millier si monnaie
        break;
}

$prefixe_deux_points ="";
if ($lg == 'fr')
{
	$prefixe_deux_points = " ";
}



    // affichage du multiple en texte

// rappel multiple cf var globales
//$multiple_fcpe = 7.2;
//$multiple_np = 5.35;
//$multiple_usa = 7.9;

if ($country == 'unitedstates')
{
    function affiche_multiple()
    {
        affiche_nombre($GLOBALS['multiple_usa'],1);
    }
}
elseif($form == 'np_im' OR $form == 'np_dif')
{
    function affiche_multiple()
    {
        affiche_nombre($GLOBALS['multiple_np'],2);
    }
}
else
{
    function affiche_multiple()
    {
        affiche_nombre($GLOBALS['multiple_fcpe'],1);
    }
}





// pour variable FR ou EN
if ($lg == 'fr')
{
    $fr_ou_en = 'fr';
}
else
{
    $fr_ou_en = 'en';
}



// pour bouton souscrire => OFFLINE  true ou false
if ($country == 'italy')
{
    $ONLINE = false;
    $OFFLINE = true;
}
else
{
    $ONLINE = true;
    $OFFLINE = false;
}



$lang['credits'] = 'Credits';
$lang['mentions_legales'] = 'Terms of use';
$lang['mentions_legales_mentions'] = 'Terms';
$lang['mentions_legales_legales'] = 'of use';
if ($lg == 'fr') {
$lang['credits'] = 'Crédits';
$lang['mentions_legales'] = 'Mentions légales';
$lang['mentions_legales_mentions'] = 'Mentions';
$lang['mentions_legales_legales'] = 'Légales';
}




if($page != 'index' AND $country == 'france')
{
    require_once 'contenu_pages/'.$lg.'/_commun_'.$lg.'.php';
}

//if($page == 'simuler')
//{
//    require_once 'contenu_pages/'.$lg.'/_sim_'.$lg.'_.php';
//}


$dossier_doc = 'doc_salaries_peg/'.$country.'/'; // voir dans ct_lg


// pour le MODULE VIDEO

//$country_video = array(
//	"france"=>"mod_tc17_fr_france",
//);

// pour activer les vidéos selon pays =>
//$video_fichier = $country_video[$country]; // not ok
//
//$video_fichier = $country_video['france']; // not ok

//if ($lg == 'fr') {$lg_video = 'fr';}
//else {$lg_video = 'en';}

$lg_video = $lg;

$video_fichier_defaut = 'sg17_mod_en';

$video_fichier = 'sg17_mod_'.$lg_video;
$video_fichier_itw = 'sg17_temoignages_'.$lg_video;

$video_poster = 'sg17_mod_poster.jpg';
$video_itw_poster = 'sg17_itw_poster.jpg';




// SOUSCRIRE => Page DOC ou lien banque
$COUNTRIES_SOUSCRIRE_BANQUE = array(
'belgium_fr',
'belgium_nlbe',
'canada_en',
'canada_fr',
'china',
'france',
'luxembourg',
'netherlands',
'uk',
);


// pages BLANK pour ouverture en blank
if ($lg == 'fr')
{
    $ELEMENTS_BLANK = array(
        'groupe_resultats'=>'https://www.saint-gobain.com/fr/finance/resultats-et-evenements-financiers',
        'groupe_bourse'=>'http://www.saint-gobain.com/fr/bourse',
        'groupe_publications'=>'https://www.saint-gobain.com/fr/presse/publications',
        'groupe_calendrier'=>'https://www.saint-gobain.com/fr/finance/evenements-financiers/calendrier',
        'epargnesg_suivreepargne'=>'http',
        'epargne_deblocage'=>'http',
    );
	if(in_array($country,$COUNTRIES_SOUSCRIRE_BANQUE))
	{
		$ELEMENTS_BLANK['peg_souscrire'] = $URL_SITE_SOUSCRIPTION;
	}
}
else
{
    $ELEMENTS_BLANK = array(
        'groupe_resultats'=>'https://www.saint-gobain.com/en/finance/events-and-financial-results',
        'groupe_bourse'=>'https://www.saint-gobain.com/en/finance/stock-information',
        'groupe_publications'=>'https://www.saint-gobain.com/en/press/corporate-publications',
        'groupe_calendrier'=>'https://www.saint-gobain.com/en/finance/events-and-financial-results/calendar',
        'epargnesg_suivreepargne'=>'http',
        'epargne_deblocage'=>'http',
    );
	//if(in_array($country,$COUNTRIES_SOUSCRIRE_BANQUE))
	//{
	//	if($country == 'china')
	//	{
	//		$ELEMENTS_BLANK['peg_souscrire'] = $URL_SITE_SOUSCRIPTION_CHINA;
	//	}
	//	elseif ($country == 'uk')
	//	{
	//		$ELEMENTS_BLANK['peg_souscrire'] = $URL_SITE_SOUSCRIPTION_UK;
	//	}
	//	else
	//	{
	//		$ELEMENTS_BLANK['peg_souscrire'] = $URL_SITE_SOUSCRIPTION;
	//	}
	//}
	$ELEMENTS_BLANK['peg_souscrire'] = '';
}









?>