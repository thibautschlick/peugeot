<?php

// ################################################################################
// ###### FONCTION DE RECHERCHE DANS ARRAY MULTIDIMENSIONNEL (retourne TRUE/FALSE)
// ################################################################################
function multi_array_search($search_for, $search_in) {
				foreach ($search_in as $element) {
					if ( ($element === $search_for) || (is_array($element) && multi_array_search($search_for, $element)) ){
						return true;
					}
				}
				return false;
			}
			

// ----------------------------------------------------------------------------------
// ### FIN FONCTION DE RECHERCHE DANS ARRAY MULTIDIMENSIONNEL (retourne TRUE/FALSE)
// ----------------------------------------------------------------------------------


// ################################################################################
// ############# FONCTION COMPARAISON DATES (retourne TRUE/FALSE) #################
// ################################################################################
	// compare le timestamp du jour avec celui de la date fournie, Si time_zone absent: defaut 'Europe/Paris'
	// Format date	: "02-11-2015 07:30"
	// Renvoi :
	//			True	: Si date supérieur au jour
	//			False	: Si date inférieur au jour 
function jour_supp_date($date, $time_zone = 'Europe/Paris') {
		
		date_default_timezone_set($time_zone); 
		
		if(time() >= strtotime($date))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

// ----------------------------------------------------------------------------------
// ### FIN FONCTION COMPARAISON DATES (retourne TRUE/FALSE)
// ----------------------------------------------------------------------------------



// ################################################################################
// ############# FONCTION EST-CE IE? (retourne TRUE/FALSE) #################
// ################################################################################
//	Retourne :
//				1 - Internet Explorer (toutes versions)
//				2 - Firefox
//				3 - Chrome
//				0 - Autres navigateurs
function quel_navigateur() {
		if(strpos($_SERVER['HTTP_USER_AGENT'], "Trident") || strpos($_SERVER['HTTP_USER_AGENT'], "MSIE"))
		{
			return 1;	// Internet Explorer (toutes versions)
		}
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], "Firefox"))
		{
			return 2;	// Firefox
		}
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], "Chrome"))
		{
			return 3;	// Chrome
		}
		else
		{
			return 0;	// Autres navigateurs
		}
		
	}

// ----------------------------------------------------------------------------------
// ### FIN FONCTION COMPARAISON DATES (retourne TRUE/FALSE)
// ----------------------------------------------------------------------------------






// ############# FONCTIONS AFFICHAGE DES CHIFFRES MONNAIE ET POURCENT => s'adapte à la nomenclature des langues #################

function affiche_euro($nb,$dec=0)
{
	if ($nb == 0)
	{
		if ($dec==0)
		{
			$nb = 'X';
		}
		else
		{
			$nb = 'XX'.$GLOBALS['separ_decimal'].'xx';
		}
	}
	else
	{
		$nb = number_format ($nb,$dec,$GLOBALS['separ_decimal'],$GLOBALS['separ_millier']);
		$nb = str_replace(' ','&nbsp;',$nb);
	}	
	echo $GLOBALS['prefixe_monnaieref'].$nb.$GLOBALS['suffixe_monnaieref'];
}

function affiche_pourcent($nb,$dec=0)
{
	if ($nb == 0)
	{
		if ($dec==0)
		{
			$nb = 'X';
		}
		else
		{
			$nb = 'XX'.$GLOBALS['separ_decimal'].'xx';
		}
	}
	else
	{
		$nb = number_format ($nb,$dec,$GLOBALS['separ_decimal'],$GLOBALS['separ_millier']);
		$nb = str_replace(' ','&nbsp;',$nb);
	}
	echo $GLOBALS['prefixe_pourcent'].$nb.$GLOBALS['suffixe_pourcent'];
}

function affiche_monnaie($nb,$dec=0)
{
	if ($nb == 0)
	{
		if ($dec==0)
		{
			$nb = 'X';
		}
		else
		{
			$nb = 'XX'.$GLOBALS['separ_decimal'].'xx';
		}
	}
	else
	{
		$nb = number_format ($nb,$dec,$GLOBALS['separ_decimal'],$GLOBALS['separ_millier']);
		$nb = str_replace(' ','&nbsp;',$nb);
	}
	echo $GLOBALS['prefixe_monnaie'].$nb.$GLOBALS['suffixe_monnaie'];
}

function affiche_nombre($nb,$dec=0)
{
	if ($nb == 0)
	{
		if ($dec==0)
		{
			$nb = 'X';
		}
		else
		{
			$nb = 'XX'.$GLOBALS['separ_decimal'].'xx';
		}
	}
	else
	{
		$nb = number_format ($nb,$dec,$GLOBALS['separ_decimal'],$GLOBALS['separ_millier']);
		$nb = str_replace(' ','&nbsp;',$nb);
	}
	echo $nb;
}

// ----------------------------------------------------------------------------------
// ### FIN FONCTIONS AFFICHAGE DES CHIFFRES MONNAIE ET POURCENT
// ----------------------------------------------------------------------------------











function replace_crochets_bold($str)
{
	$str = str_replace("[","<b>",$str);
	$str = str_replace("]","</b>",$str);
	return $str;
}

function displaynone() {
	echo 'style="display:none;"';
}

function supp_br($str)
{
	$str = str_replace('<br/>','',$str);
	$str = str_replace('<br />','',$str);
	$str = str_replace('<br>','',$str);
	$str = str_replace('<br >','',$str);
	return $str;
}

function b_to_orange($str)
{
	$str = str_replace('<b>','<b class="orange">',$str);
	return $str;		
}








// Détermine l'icone en fonction de l'extentions
// Renvoi l'ID de l'extention
function icone_document($document, $dot=false)
{
	// Récupère l'extention
	$explode = explode('.', $document); // array en fonction des points dans le nom de fichier  
	$ext = $explode[sizeof($explode) - 1];
	if ($dot == true) // si on prend en compte l'extention avec le point
	{
		$ext = '.'.$ext;
	}		
	// Récupère l'ID de l'extention
	//$idextention = id_extention($ext);	
	//
	//// Si pas d'ID, renvoie NULL
	//if ($GLOBALS['NUM_ROWS_EXTENTIONS'] == 0)
	//{
	//	$idextention =  NULL;
	//}	
	//return $idextention;
	if ($ext == '')
	{
		$idextention =  NULL;
	}
	return $ext;
}





	
	
	
	
	

?>