<?php
$currentCookieParams = session_get_cookie_params();
if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {$currentCookieParams["secure"] = true;}
$currentCookieParams["httponly"] = true;
session_set_cookie_params(
	$currentCookieParams["lifetime"],
	$currentCookieParams["path"],
	$currentCookieParams["domain"],
	$currentCookieParams["secure"],
	$currentCookieParams["httponly"]
);
session_start();	
	
// AUCUNE ERREUR PHP
//error_reporting(0);
//ini_set('display_errors', 0);

// TOUTES ERREURS PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>