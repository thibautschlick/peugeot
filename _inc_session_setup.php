<?php
if (strpos($_SERVER['DOCUMENT_ROOT'],'C:/wamp') !== false)
{
	$currentCookieParams = session_get_cookie_params();
	//if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {$currentCookieParams["secure"] = true;}
	$currentCookieParams["httponly"] = true;
	session_set_cookie_params(
		$currentCookieParams["lifetime"],
		$currentCookieParams["path"],
		$currentCookieParams["domain"],
		$currentCookieParams["secure"],
		$currentCookieParams["httponly"]
	);
}

session_start();	
	
// AUCUNE ERREUR PHP
//error_reporting(0);
//ini_set('display_errors', 0);

// TOUTES ERREURS PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// pour edition site dyn	
//$_SESSION['membre_is_editeur'] = false; // membre non loggué par défaut
//$membre_email = $_SESSION['membre_email'] = 'vlepoivre@b-fly.com';

//if (isset($_GET['edit']))
//{
//	$_SESSION['membre_is_editeur'] = true;
//}
//if (isset($_GET['nonedit']))
//{
//	$_SESSION['membre_is_editeur'] = false;
//}
//
//if (isset($_SESSION['membre_is_editeur']))
//{
//	$membre_editeur = $_SESSION['membre_is_editeur'];
//}
//else
//{
//	$membre_editeur = false; // true false
//}
?>