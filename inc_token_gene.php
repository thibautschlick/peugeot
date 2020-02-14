<?php

    $chiffres = '0123456789';
    $minuscules = 'abcdfeghjkmnpqrstuvwxyz';
    $majuscules = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    //$signes = '-!/+*()@';
    $signes = 'abcdfeghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ0123456789';
    
	// règles de complexité =
	// longueur 10
	// au moins un chiffre
	// au moins une maj
	// au moins une min
	// au moins un signe
	// commence par une maj (évite les erreurs de maj en début de mot lors d’un recopiage)
	// pas de charactères en double

function wd_generateToken_create()
{
    global $chiffres, $minuscules, $majuscules, $signes,$TOKEN_LENGHT;
    $length = $TOKEN_LENGHT;
    $possible = $chiffres.$minuscules.$majuscules.$signes;
	$password = '';
	
	# 1er CARACTERE = MAJUSCULE    
    $possible_1er_char = $majuscules;
    $possible_1er_char_length = strlen($possible_1er_char) - 1;
    $premier_char = $possible_1er_char{mt_rand(0, $possible_1er_char_length)};
	$password .= $premier_char;
	
	$length --;
	
	//retire la MAJ choisie
	$possible = str_replace ($premier_char,"",$possible);
	
	$password_suite = str_shuffle($possible); // on mélange possible
	$password_suite = substr($password_suite,0,$length); // on garde les 9 premiers caractères
	$password .= $password_suite;
	
    return $password;
}

// fonction de check du pw créé ci-dessus qui retourne le pw créé ssi ok
function wd_generateToken()
{
    global $chiffres, $minuscules, $majuscules, $signes;
	
	$pw_is_ok = false;
	while ($pw_is_ok == false)
	{
		//création d'un mdp
		$pw = wd_generateToken_create();
		
		// récupère la longueur du mot de passe	
		$pw_length = strlen($pw);
		
		// init des variables de check de précense signes, maj, min, signes
		$chiffres_ok = false;
		$minuscules_ok = false;
		$majuscules_ok = false;
		$signes_ok = false;
		
		// boucle pour lire chaque lettre
		for($i = 0; $i < $pw_length; $i++)
		{
			// $i étant à 0 lors du premier passage de la boucle
			$lettre = $pw[$i];
			if (strpos($chiffres, $lettre) !== false) {$chiffres_ok = true;}
			if (strpos($minuscules, $lettre) !== false) {$minuscules_ok = true;}
			if (strpos($majuscules, $lettre) !== false) {$majuscules_ok = true;}
			if (strpos($signes, $lettre) !== false) {$signes_ok = true;}
		}
		
		if ($chiffres_ok AND $minuscules_ok AND $majuscules_ok AND $signes_ok)
		{
			$pw_is_ok = true; // sort de la boucle ensuite
		}
	}
	return $pw;
}

//echo wd_generateToken();

//for ($i = 1; $i <= 100; $i++)
//{
//    echo wd_generateToken();
//    echo '<br />';
//}