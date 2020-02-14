<?php

// - 1 - REQUETE BDD
// - 2 - AFFICHAGE DE POPUP
// - 3 - ENCART WAT
// - 4 - ENCART WAT V2
// - 5 - ENCART WAT TYPE 2
// - 6 - btnAction
// - 7 - AFFICHAGE DES VALEURS ET FORMATAGE
// - 8 - ENCODE MDP
// - 8_2 - SALT DU MEMBRE
// - 9 - SANITIZE
// - 10 - SANITIZE BDD
// - 11 -  FONCTION IGG_FORMAT_OK
// - 11_2 -  FONCTION EMAIL_FORMAT_OK
// - 12 -  FONCTION VerifLogin
// - 13 -  FONCTION VERIFICATION_PASSWORD
// - 14 -  DEPLACEMENT DES MDP HISTORIQUE D'UN CRAN
// - 15 - VERIFICATION NOMBRES DE TENTATIVES DE CONNEXIONS ERRONNÉES
// - 16 - VERIFICATION CHARACTERES ET LONGUEURS DES CHAMPS D'ENTRÉS
// - 17 - SUPPRESSION DES PREFIXES DES COLONNES DE TABLE de BDD

//********** - 1 - FONCTION REQUETE BDD ********************            REMPLACEE PAR DES REQUETES PREPAREES DANS LA PAGE
//function executeRequete($req)
//{
//	global $HOST, $LOGIN, $PASSWORD, $DATABASE;
//	$mysqli = @new Mysqli($HOST, $LOGIN, $PASSWORD, $DATABASE);
//	$mysqli->set_charset("utf8");
//	$resultat = $mysqli->query($req);	// Execute la requête reçue en argument.	
//	if(!$resultat)	// En cas d'erreur affiche le message ci-dessous
//	{
//		//die('Erreur sur la requete SQL <br />Message: ' . $mysqli->error . '<br /> Code: '.$req);
//	}
//	mysqli_close($mysqli);
//	return $resultat;	// Retourne le résultat dans $resultat.
//}


//----------------------------------------------------------------------------


//********** - 2 - FONCTION AFFICHAGE DE POPUP ********************/
function affichePopup($id, $texte, $classe_optionnelle = ''){
	echo '
	<div id="'.$id.'" class="popup_window border_gris trame_gris ombre_3_4 '.$classe_optionnelle.'">
		<a onclick="popup_close()" class="btn_croix" ></a>
		'.$texte.'
	</div>
	';
}


//*********** - 3 -  FONCTION ENCART WAT ****************************/
function encartWat($id,$texte, $lien){
	$popupAction = $popupAff = '';
	if (!empty($id))
	{
		$popupAction ='onmouseover = "$(\'#popup_warning_wat_'.$id.'\').show();" onmouseout = "$(\'#popup_warning_wat_'.$id.'\').hide();"';
		$popupAff = '<div id="popup_warning_wat_'.$id.'" class="rouge strong ombre_3_4 popup_warning_wat"> 
							Link accessible via a connection Société.
						</div>';
	}
	echo '<div class="encart_wat" onclick = "window.open(\''.$lien.'\',\'_blank\')" '.$popupAction.'>
						<span>'.$texte.'</span>					
						<!--<div class="encart_coin_bas"></div>-->
						
						'.$popupAff.'
					</div>
	';
	
}

//*********** - 4 -  FONCTION ENCART WAT V2 ****************************/
function encartWatV2($couleur, $id,$texte, $lien, $phraseLien, $newpage){
	$popupAction = $popupAff = '';
	if (!empty($id))
	{
		$popupAction ='onmouseover = "$(\'#popup_warning_wat_'.$id.'\').show();" onmouseout = "$(\'#popup_warning_wat_'.$id.'\').hide();"';
		$popupAff = '<div id="popup_warning_wat_'.$id.'" class="rouge strong ombre_3_4 popup_warning_wat"> 
							Link accessible via a connection Société.
						</div>';
	}
	if ($newpage == 1)
	{
		$name = '_blank';
	}
	else
	{
		$name = '_self';
	}
	
	$onclick = "window.open('".$lien."','".$name."')";
	
	if ($newpage == 'V') // Type video, 
	{
		$onclick = (string)$lien;
	}
	
	echo '<div class="encart_wat bg_'.$couleur.'">
			<span>'.$texte.'</span>					
			<!--<div class="encart_coin_bas"></div>-->
			
			'.$popupAff.'
		</div>
		<div class="right zone_lien_texte">
			<span class="'.$couleur.' total-triangle"></span><a class="'.$couleur.' lien_texte" onclick = "'.$onclick.'" '.$popupAction.'>'.$phraseLien.'</a>
		</div>
	';
	
}

//*********** - 5 -  FONCTION ENCART WAT TYPE 2 ****************************/
function encartWatType2($couleur, $id,$texte, $lien, $phraseLien, $newpage){
	$popupAction = $popupAff = '';
	if (!empty($id))
	{
		$popupAction ='onmouseover = "$(\'#popup_warning_wat_'.$id.'\').show();" onmouseout = "$(\'#popup_warning_wat_'.$id.'\').hide();"';
		$popupAff = '<div id="popup_warning_wat_'.$id.'" class="rouge strong ombre_3_4 popup_warning_wat"> 
							Link accessible via a connection Société.
						</div>';
	}
	if ($newpage == 1)
	{
		$name = '_blank';
	}
	else
	{
		$name = '_self';
	}
	
	echo '<div class="encart_wat encart_wat_type2 bg_'.$couleur.'">
			<span>'.$texte.'</span>					
			<!--<div class="encart_coin_bas"></div>-->
			
			'.$popupAff.'
		<div class="right zone_lien_texte" onclick = "window.open(\''.$lien.'\',\''.$name.'\')" '.$popupAction.'>
			<span class="'.$couleur.' total-triangle"></span><a class="'.$couleur.' lien_texte">'.$phraseLien.'</a>
		</div>
		</div>
	';
	
}


//*********** - 6 -  FONCTION btnAction ****************************/
function btnAction($id, $couleur, $texte, $action){

	$popupAction = $popupAff = '';
	if (!empty($id))
	{
		$popupAction ='onmouseover = "$(\'#popup_warning_wat_'.$id.'\').show();" onmouseout = "$(\'#popup_warning_wat_'.$id.'\').hide();"';
		$popupAff = '<div id="popup_warning_wat_'.$id.'" class="rouge strong ombre_3_4 popup_warning_wat"> 
							Link accessible via a connection Société.
						</div>';
	}
	echo '<div class="btn_action btn_action_'.$couleur.'" onclick="'.$action.';" '.$popupAction.'>
			<span class="align_vertical"></span><span class="total-triangle"></span><a>'.$texte.'</a>
			'.$popupAff.'
		</div>
	';
	
}



//*********** - 7 -  AFFICHAGE DES VALEURS ET FORMATAGE ****************************/

function affiche($var)
{
	$var = number_format($var, 0, ',', ' ');
	$var = str_replace(" ","&nbsp;",$var);
	if ($var < 1) {echo "<span class='small8' style='position:relative;top:-2px;'><</span> 1";} else {echo $var;}
}
function format($var)
{
	$var = number_format($var, 0, ',', ' ');
	$var = str_replace(" ","&nbsp;",$var);
	return $var;
}

//*********** - 8 -  FONCTION ENCODE MDP ****************************/
function encodeMdp($mdp,$salt)
{
	// nouveau salage
	$new_cryptage = sha1(sha1($mdp).$salt); // nouveau salage avec salt perso
	return $new_cryptage;
}

//*********** - 8_2 -  SALT DU MEMBRE ****************************/
function saltMembre($matr, $site = 'bsi')
{
	$table = 'membres_connexion';
	if ($site == 'corres')
	{
		$table = 'membres_corres_connexion';
	}
	global $bdd;
	global $prefix_col;
	$req = $bdd->prepare("SELECT ".$prefix_col[$table]."salt FROM ".$table." WHERE MATR = :matr");
	$req->bindValue(':matr', $matr);
	$req->execute();
	$membres = array();
	
	if ($req->execute()) {
	  while ($ligne = $req->fetch()) {
		$membres[] = $ligne;
	  }
	}
	$membre = $membres[0]; // array 1 membre
	return ($membre["".$prefix_col[$table]."salt"]);
}


//
//*********** - 9 -  FONCTION SANITIZE ****************************/              =            attention déjà déclarée dans inc_fonctions_dyn
function sanitize($str)
{	
	$str = trim($str);
	$str = htmlspecialchars($str);
	$str = addslashes($str);
	return $str;
}

//*********** - 10 -  FONCTION SANITIZE BDD ****************************/
function sanitize_bdd($str)
{	
	global $HOST, $LOGIN, $PASSWORD, $DATABASE;
	$mysqli = @new Mysqli($HOST, $LOGIN, $PASSWORD, $DATABASE);
	$str = trim($str);
	$str = mysqli_real_escape_string($mysqli,$str);
	mysqli_close($mysqli);
	return $str;
}


//*********** - 11 -  FONCTION IGG_FORMAT_OK ****************************/
function igg_format_ok($igg_entry)
{
	// si IGG 7 chiffres
	if (strlen($igg_entry) == 7 AND is_numeric($igg_entry))
	{
		return true;
		//echo 'true';
	}
	else
	{
		return false;
		//echo 'false';
	}
}


//*********** - 11_2 -  FONCTION EMAIL_FORMAT_OK ****************************/
function email_format_ok($email_entry)
{
	$chaine = '#^[\w\.\d-]+@[\w\.\d-]{2,}\.[A-z]{2,4}$#'; // Accepté: [A-z0-9._-]+@[A-z0-9._-]{2,}\.[A-z]{2,4}
	if (preg_match($chaine,$email_entry))
	{
		return true;
	}
	else
	{
		return false;
	}
}




//*********** - 12 -  FONCTION VerifLogin ****************************/
// Retourne:
//			-	0 : Membre non trouvé
//			-	1 : Membre trouvé, mdp erronné
//			-	2 : Membre trouvé & mdp OK MAIS égal à mdp_auto & Nombre Connexion = 0	: première connexion
//			-	3 : Membre trouvé & mdp OK MAIS égal à mdp_auto & Nombre Connexion > 0 : nécéssité de modifier mdp (demande de nouveau mdp effectuée)
//			-	4 : Membre trouvé & mdp OK
//			-	loginTentMax : Membre trouvé MAIS nb tentatives atteintes

function verifLogin($login_check, $mdp_check, $site = 'bsi')
{
    global $bdd;
	global $prefix_col;
	global $site_cnx_tables;
	$table = $site_cnx_tables[$site]['table'];
	$colonne_login = $site_cnx_tables[$site]['colonne_login'];	
	
	//$req = $bdd->prepare("SELECT nbCnx, ".$prefix_col[$table]."mdp, mdp_auto FROM ".$table." WHERE ".$colonne_login." = '".$login_check."'");
	$req = $bdd->prepare("SELECT nbCnx, ".$prefix_col[$table]."mdp FROM ".$table." WHERE ".$colonne_login." = '".$login_check."'");
	//$req->bindValue(':matr', $igg_entry);
	$req->execute();
	//$resultats = array();
	//if ($req->execute()) {
	//  while ($ligne = $req->fetch()) {
	//	$resultats[] = $ligne;
	//  }
	//}
	//
	//$req = "SELECT nbCnx, ".$prefix_col[$table]."mdp, mdp_auto FROM ".$table." WHERE ".$colonne_login." = '".$login_check."'";
	//$resultat = executeRequete($req);		
	$num_ligne = $req->rowCount();
	//$count = $del->rowCount();
	if($num_ligne >= 1)	// Membre(igg) existant
	{
		//extract($ligne = $resultat->fetch_array());
		extract($req->fetch(PDO::FETCH_ASSOC));
		$mdp = ${$prefix_col[$table].'mdp'};
		$TempsAtt = verifTentativesMdp($login_check,$site);
		if($TempsAtt == '0')
		{
			$salt = saltMembre($login_check,$site);
			$mdp_login = encodeMdp($mdp_check,$salt);
			switch($mdp_login)
			{
				case $mdp:	// Membre trouvé & mdp OK
					//if($mdp == $mdp_auto && $nbCnx == 0 )	// Première connexion
					//{
					//	return 2;	
					//	break;
					//}
					//elseif($mdp == $mdp_auto && $nbCnx > 0 )	// En période de nouveau mdp effectuée
					//{
					//	return 3;
					//	break;
					//}
					//else
					{
						return 4;	// Membre trouvé & mdp OK
						break;
					}
				default:	// Incrémentation du nombre de tentative de connexion et memorisation du timestamp de la tentative.
					$req = $bdd->prepare("UPDATE ".$table." SET tent_login_nbr = tent_login_nbr + 1, tent_login_time = ".time()." WHERE ".$colonne_login." = '".$login_check."'");
					//$req->bindValue(':matr', $igg_entry);
					$req->execute();
					
					//$req="UPDATE ".$table." SET tent_login_nbr = tent_login_nbr + 1, tent_login_time = ".time()." WHERE ".$colonne_login." = '".$login_check."'";
					//executeRequete($req);
					return 1;	// Membre trouve, mdp erroné
					break;
			}	
		}
		else
		{
			$affAttente = gmdate("i:s;", $TempsAtt);
			$affAttente = str_replace(":", " min ", $affAttente);
			$affAttente = str_replace(";", " sec ", $affAttente);
			return $affAttente;
		}
	}
	else	// Membre non existant
	{
		return 0;
	}
}

//*********** - 13 -  FONCTION VERIFICATION_PASSWORD ****************************/
function verification_password ($essai1, $essai2)
{
	global $message;
	// Code Erreur :
	// 1: password vide
	// 2 : essai1 différent de essai2
	// 3 : non respect de complexité (8 chars + 1 lettre au moins + 1 chiffre au moins  + 1 char spé au moins )
	
	//$chiffres=array("0","1","2","3","4","5","6","7","8","9");
	//$lettres=array("a","z","e","r","t","y","u","i","o","p","q","s","d","f","g","h","j","k","l","m","w","x","c","v","b","n","A","Z","E","R","T","Y","U","I","O","P","Q","S","D","F","G","H","J","K","L","M","W","X","C","V","B","N");
	//$caracteres=array("-","*","+","/","_","!");
	//$caracteres_valides = array_merge($chiffres,$lettres,$caracteres);
	
	$mdp_valide = false;
	//if ($essai1!='') {
	//	$longueur = strlen($essai1);
	//	$comporte_chiffre = $comporte_lettre = $comporte_caractere = 0;
	//	$caractere_interdit = 0;
	//	for($i = 0; $i < $longueur; $i++) 	{
	//		$lettre = $essai1[$i];
	//		if (in_array($lettre,$chiffres)) {$comporte_chiffre=1;}
	//		if (in_array($lettre,$lettres)) {$comporte_lettre=1;}
	//		if (in_array($lettre,$caracteres)) {$comporte_caractere=1;}
	//		if (!in_array($lettre,$caracteres_valides)) {$caractere_interdit=1;}
	//	}
	//	if (strstr($essai1," ")) {$caractere_interdit=1;}	
	//	if ($comporte_chiffre==1 AND $comporte_lettre==1 AND $comporte_caractere==1 AND $longueur >= 8 AND $caractere_interdit == 0) {
	//		$mdp_valide = true;
	//	}
	//}
	
	if(preg_match("/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9\t\n\x0B\f\r]).{8,}$/", $essai1))
	{
		//$info = 'Le nouveau mot de passe doit contenir au moins 8 caractères, une minuscule ou une majuscule, un caractère spécial et un chiffre.';
		$mdp_valide = true;
	}

	
	if ($essai1 == '' OR $essai2 == '')
	{
		$message .= "&bull; Please enter a new password and its confirmation.";
		$message .= "<br/>";
		return false;
	}
	elseif ($essai1 != $essai2)
	{
		$message .= "&bull; The new password is badly confirmed.";
		$message .= "<br/>";
		return false;	
	}
	elseif (!$mdp_valide)
	{						
		$message .= "&bull; The password does not respect the requested complexity, and / or has invalid(s) character(s).";
		$message .= "<br/>";
		return false;	
	}	
	elseif ($mdp_valide)
	{
		return true;
	}
	else
	{
		return false;
	}
}

//*********** - 14 -  DEPLACEMENT DES MDP HISTORIQUE D'UN CRAN ****************************/
function depHistMdp($igg, $historique_mdp, $site = 'bsi')	// Parametres: idMembre & nombre de mdp mémorisés
{
    global $bdd;
	global $site_cnx_tables;
	$table = $site_cnx_tables[$site]['table'];
	$colonne_login = $site_cnx_tables[$site]['colonne_login'];
	
	global $prefix_col;
	$nbMdpHist = $historique_mdp;	// 9 mots de passe historique en BDD
	$mdpSet = '';
	for($i=$nbMdpHist; $i>1; $i--)
	{
		$mdpSet .= 'mdp'.$i.' = mdp'.($i-1).', ';
	}
	$req = $bdd->prepare("UPDATE ".$table." SET $mdpSet mdp1 = ".$prefix_col[$table]."mdp WHERE ".$colonne_login." = '".$igg."'");
	//$req->bindValue(':matr', $igg_entry);
	$req->execute();

	//$req = "UPDATE ".$table." SET $mdpSet mdp1 = ".$prefix_col[$table]."mdp WHERE ".$colonne_login." = '".$igg."'";
	//$resultat = executeRequete($req);
	
}

//*********** - 15 -  VERIFICATION NOMBRES DE TENTATIVES DE CONNEXIONS ERRONÉES ****************************/

function verifTentativesMdp($igg, $site = 'bsi')	// $igg = MATR
{
    global $bdd;
	global $site_cnx_tables;
	$table = $site_cnx_tables[$site]['table'];
	$colonne_login = $site_cnx_tables[$site]['colonne_login'];
	
	$temps_blocage_login = 0.5; // en minutes
	$temps_blocage_login = $temps_blocage_login * 60; // en secondes
	
	$req = $bdd->prepare("SELECT tent_login_nbr, tent_login_time FROM ".$table." WHERE ".$colonne_login." = '".$igg."'");
	//$req->bindValue(':matr', $igg_entry);
	$req->execute();			
	extract($req->fetch(PDO::FETCH_ASSOC));


	//$req = "SELECT tent_login_nbr, tent_login_time FROM ".$table." WHERE ".$colonne_login." = '".$igg."'";
	//$resultat = executeRequete($req);		
	//extract($ligne = $resultat->fetch_array());
	
	
	$timestamp_blocage_login = $tent_login_time + $temps_blocage_login;
	
	if($tent_login_nbr >= 5 &&  time() < $timestamp_blocage_login )
	{
		$attente = ($timestamp_blocage_login - time());
		return $attente;	// Nombre de tentaives atteintes et dnns la période de blocage login());
	}
	elseif($tent_login_nbr >= 5 &&  time() > $timestamp_blocage_login )
	{
		$req = $bdd->prepare("UPDATE ".$table." SET tent_login_nbr = 0, tent_login_time = 0 WHERE ".$colonne_login." = '".$igg."'");
		//$req->bindValue(':matr', $igg_entry);
		$req->execute();
		
		//$req = "UPDATE ".$table." SET tent_login_nbr = 0, tent_login_time = 0 WHERE ".$colonne_login." = '".$igg."'";
		//$resultat = executeRequete($req);
		return 0;
	}
	else
	{
		return 0;
	}
	
}

//*********** - 16 -  VERIFICATION CHARACTERES ET LONGUEURS DES CHAMPS D'ENTRÉS ****************************/

function verifCaractereSpec($entree,$type)
{
	switch ($type)
	{
		case 'captcha':
			$chaine = '#^[A-z]{4}$#'; // Accepté: a-zA-Z, 4 charactères obligatoires
			break;
		case 'igg':
			$chaine = '#^[\d]{7}$#'; // Accepté: 0-9, 7 charactères obligatoires
			break;
		case 'email':
			$chaine = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i'; // Accepté: 0-9, 7 charactères obligatoires
			break;
		case 'mdp':
			//$chaine = '#^[\dA-z-!/+*@()]{8,1024}$#'; // Accepté: 0-9,A-z, -, !, /, +, *, @, (, ) entre 8 et 1024 charactères
			//$chaine = '#^[\dA-z-!/+*@()]{8,1024}$#'; // Accepté: 0-9,A-z, -, !, /, +, *, @, (, ) entre 8 et 1024 charactères
			//$chaine = '/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9\t\n\x0B\f\r]).{8,}$/';		
			break;
	}	
	$verif_caractere = preg_match($chaine, $entree);
	if($verif_caractere)
	{
		return true;	// Renvoi true si l'entrée correspond aux contraintes.
	}
	else
	{
		return false;	// Renvoi false si l'entrée ne correspond pas aux contraintes.
	}
}



//*********** - 17 -  SUPPRESSION DES PREFIXES DES COLONNES DE TABLE de BDD ****************************/


	function supp_bdd_prefixe_col($ligne_result)
	{
		$ligne_result_sans_prefix = array();
		foreach ($ligne_result as $key => $value)
		{
			$key = preg_replace('/^.*?_/','',$key);
			$ligne_result_sans_prefix[$key] = $value;
		}
		return $ligne_result_sans_prefix;
	}
	
	
