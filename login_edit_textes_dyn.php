<?php
// require_once('inc_session_setup.php'); // non ca cete pag est déjà include dans site.php
require_once('inc_fonctions_login.php');
require_once('inc_var_globales_connexions.php');
//require_once('inc_var_globales_login.php');
require_once('inc_var_globales_corres.php');
require_once('inc_token_gene.php');

$page='connexion';

// CAPTACHA functions
$cryptinstall="crypt_captcha/cryptographp.fct.php";
include $cryptinstall;
$code_captacha_ok = false;

// MESSAGE
$message = "";

$message_contact = "Please contact your Personal Correspondent or support at this email address:
	<a href='mailto:".$EMAIL_EXPEDITEUR."'>".$EMAIL_EXPEDITEUR."</a>";

$message_erreur_concat = "
	<br/>
	<span onclick='hidediv(\"popup_message\");' class='gris6 underline small8' style='cursor:pointer;'>(close the window)</span>
	<br/>
	<br/>
	<b>LOGIN error <u>or</u> PASSWORD error:</b>
	<br/>
	&bull; <u>Either the password is wrong</u>:
	<br/>
	In case of failure to request a new one by clicking on «Request my password».
	<br/>
	&bull; <u>Either the account is blocked</u> after 5 unsuccessful attempts:
	<br/>
	Please wait 30 seconds before trying again.
	<br/>
	&bull; <u>Either your LOGIN is not registered</u>.
	<br/>
	<br/>
	<u>In case of technical problems</u> please contact support at this e-mail address:
	<br/>
	<a href='mailto:".$EMAIL_EXPEDITEUR."'>".$EMAIL_EXPEDITEUR."</a>.	
	<br/>
";


$message_bienvenue_2016 = "
	<b>
	Welcome to your space to connect to modify extranet content.
	</b>
	<br/>
	If you are concerned, you will receive an e-mail informing you of the opening of the site.
	<br/>
	<b>You can now receive your access </b> by clicking on «Request my password».
	";

	
$redirection_vers_page_connexion = false;
	

$etat_verif_login = "";

// temps d'expiration du dernier mot de passe
$mdp_expire = false;

//	################################################
//	##### Vérifications des entrées formulaires ####
//	################################################

// Vérification CAPTCHA
if (isset ($_POST['code']))
{
	if(!verifCaractereSpec($_POST['code'],'captcha'))
	{
		$code_captacha_ok = false;
		$message .= '&bull; The anti-spam code is wrong.<br/>';
	}
	else
	{
		$post_code = sanitize($_POST['code']);
		if (chk_crypt($post_code))
		{
			$code_captacha_ok = true;
		}
		else
		{
			$code_captacha_ok = false;
			$message .= '&bull; The anti-spam code is wrong.<br/>';
		}
	}
}

// Vérification des entrées autres que Captcha
	if(isset($_POST['igg']))
	{
		$igg_entry = "";
		if(!verifCaractereSpec($_POST['igg'],'email'))
		{
		}
		else
		{
			$igg_entry = sanitize_bdd(sanitize($_POST['igg']));
		}
	}
	if(isset($_POST['mdp']))
	{
		$mdp_entry = substr($_POST['mdp'],0,1024); // trim à 1024		
	}
	if(isset($_POST['mdp_new']))
	{
		$mdp_new_entry = substr($_POST['mdp_new'],0,1024); // trim à 1024	
	}
	if(isset($_POST['mdp_new_confirm']))
	{
		$mdp_new_confirm_entry = substr($_POST['mdp_new_confirm'],0,1024); // trim à 1024
	}
	
	
function affiche_form()
{
	global $message, $igg_entry, $mdp_entry, $mdp_new_entry, $mdp_new_confirm_entry;
	?>
	<form id="register" name="register" method="post" action="site.php?pg=login_edit_textes_dyn&ct=france">
		<p class="">
			<!--
			<br/>
			<strong>
			SITE EN COURS DE MISE À JOUR
			<br/>
			MERCI DE PATIENTER ...			
			</strong>
			<br/>
			<br/>
			<br/>
			-->
			<b class="">Connection to the CONTENT MODIFICATION mode</b>
			<br/>
			<br/>
			Your LOGIN
			<br/>
			<input class="champ" type="igg" name="igg" autofocus="autofocus" value="<?php if (isset ($igg_entry)) {echo $igg_entry;} ?>" />
			<br/>
			<br/>
			Your PASSWORD
			<br/>
			<input class="champ" type="password" name="mdp" value=""  autocomplete="off" />
			<br/>
			>>> <a href="site.php?pg=login_edit_textes_dyn&ct=france&mdp=oublie" class="">Request my password</a>
			<br/>
			<br/>
			<br/>
			<input type="submit" name="button" class="btn_envoyer" value=" CONNECT " />
		</p>
		<?php
		if ($message != '')
		{
			echo '<br/><p class="erreur_mdp rouge bg_white center museo5 ombre_3_4" id="popup_message">'.$message.'</p>';
		}
		?>	
	</form>
	<?php
}


function affiche_form_mdp_changer()
{
	//global $message, $igg_entry, $mdp_entry, $mdp_new_entry, $mdp_new_confirm_entry;
	global $message, $mdp_new_entry, $mdp_new_confirm_entry, $get_token;
	?>
	<form id="register" name="register" method="post" action="site.php?pg=login_edit_textes_dyn&ct=france&mdp=changer&token=<?php echo $get_token;?>">
			<p class="">
			<b class="">CHOICE OF PASSWORD</b>
			<br/>
			<br/>
			Please choose your <strong style="text-decoration: underline;">NEW</strong> password
			<br/>
			<em>
				(Please do not use the last 9 passwords and respect the following complexity:
				At least 8 characters, combine letters (uppercase and / or lowercase), digits and special characters (at least one character of each type).
			</em>
			<br/>
			<input class="champ" type="password" name="mdp_new" value="" autocomplete="off" />
			<br/>
			<br/>
			Please confirm your <strong style="text-decoration: underline;">NEW</strong> password
			<br/>
			<input class="champ" type="password" name="mdp_new_confirm" value="" autocomplete="off" />
			<br/>
			<br/>
			<input type="submit" name="button" class="btn_envoyer" value=" SEND " />
			<br/>
			<br/>
			<<< <a href="site.php?pg=login_edit_textes_dyn&ct=france" class="">Back to login page</a>
		</p>		
		<?php
		if ($message != '')
		{
			echo '<p class="erreur_mdp rouge bg_white center museo5 ombre_3_4">'.$message.'</p>';
		}
		?>	
	</form>			
	<?php
}




function affiche_form_mdp_oublie()
{
	global $message, $igg_entry, $mdp_entry, $mdp_new_entry, $mdp_new_confirm_entry;
	?>
	<form id="register" name="register" method="post" action="site.php?pg=login_edit_textes_dyn&ct=france&mdp=oublie">
		<p class="">
			<b class="">PASSWORD REQUEST</b>
			<br/>
			<br/>
			Please complete this form to receive a link to choose your password.
			<br/>
			<br/>
			Your LOGIN
			<br/>
			<input class="champ" type="igg" name="igg" autofocus="autofocus" value="<?php if (isset($igg_entry)) {echo $igg_entry;} ?>" />
			<br/>
			<br/>
			Please copy the anti-spam code below:
			<br/>
			<input class="champ" type="text" name="code" />
			<br/>
			<br/>
			<div class="captcha_container"><?php dsp_crypt(0,1); ?></div> <!-- cf cryptographp.inc.php -->
			<br/>							
			<input type="submit" name="button" class="btn_envoyer" value=" SEND " />
			<br/>
			<br/>
			<<< <a href="site.php?pg=login_edit_textes_dyn&ct=france" class="">Back to login page</a>
		</p>						
		<?php
		if ($message != '')
		{
			echo '<p class="erreur_mdp rouge bg_white center museo5 ombre_3_4">'.$message.'</p>';
		}
		?>						
	</form>			
	<?php
}



if (isset($_GET['tempsexpire']))
{
	$message .= "&bull; The inactivity time has been reached. Thank you for logging in.";
	$message .= "<br/>";
}


// FORMULAIRE DE CONNEXION
	
	
// ###################################################################
// ###################### DEBUT DES FORMULAIRES ######################
// ###################################################################




// ####################### FORMULAIRE DE CONNEXION #######################
	// SI MDP ou LOGIN ENTRÉ, mais pas de GET mdp (forgot ou change)
	
	if ((isset ($mdp_entry) OR isset ($igg_entry)) && !isset($_GET['mdp']) )
	{
		if (!isset($mdp_entry)) {$mdp_entry='';}	
		$mdp_ok = false;
		$igg_ok = false;
		$mdp_expire = false;
		$mdp_auto_expire = false;
		
		$etat_verif_login = verifLogin($igg_entry, $mdp_entry, 'corres'); // attention ajout du paramètre de fin pour prendre en compte la table
		if(strstr($etat_verif_login, 'min'))	// Si le retour comtiens "min", le retour est le temps de blocage du compte, DONC compte bloqué temporairement
		{
			$message .= "&bull; Number of connection attempts reached, you must wait ".$etat_verif_login." before the next attempt.";
			
			$message .= "<br/>";
		}
		elseif($etat_verif_login == 0)	// Membre non trouvé
		{
			$igg_format_ok = igg_format_ok($igg_entry); // verif si LOGIN = 7 chiffres.
			if ($igg_format_ok)
			{
				$message .= $message_erreur_concat;
			}
			else
			{
				$message .= $message_erreur_concat;
			}
			$message .= "<br/>";
		}
		elseif($etat_verif_login == 1)	// Membre trouve, mdp erronné
		{
			$igg_ok = true;
			$message .= $message_erreur_concat;
			$message .= "<br/>";
		}		
		elseif(($etat_verif_login == 2 || $etat_verif_login == 3)) // sans le captcha
		//			-	2 : Membre trouvé & mdp OK MAIS égal à mdp_auto & Nombre Connexion = 0	: première connexion
		//			-	3 : Membre trouvé & mdp OK MAIS égal à mdp_auto & Nombre Connexion > 0 : nécéssité de modifier mdp (demande de nouveau mdp effectuée)
		{
			// ***************************
			// TEMPS LIMITE DU MDP DEPASSÉ
			// ***************************
			$req = "SELECT nbCnx, time AS last_time_chg_mdp FROM membres_corres_connexion WHERE MATR = '".$igg_entry."'";
			$resultat = executeRequete($req);
			extract($resultat->fetch_array());
			$time_actu = time();
	
			if (($nbCnx != 0) && ($time_actu > ($last_time_chg_mdp + $temps_valid_mdp_auto))) // Pas première connexion & date limite du mdp_auto dépassé
			{
				$mdp_auto_expire = true;
				$message .= "&bull; The validity of your temporary password has expired. Thank you for making a new password request.";
			}
			// ***************************
			// fin      TEMPS LIMITE DU MDP DEPASSÉ
			// ***************************
			else
			{
				if($etat_verif_login == 2)	// Nombre Connexion = 0	: première connexion
				{
					$message .= "&bull; First connection. Please change your password.";
				}
				else	// nécéssité de modifier mdp (demande de nouveau mdp effectuée)
				{
					$message .= "&bull; Please change this temporary password.";
				}
			}
			$message .= "<br/>";
		}	
		elseif($etat_verif_login == 4)	// Membre trouvé & mdp OK
		{
			$igg_ok = true;
			$mdp_ok = true;
			
			// == == == == == == ==  == 
			// TEMPS EXPIRATION MOT DE PASSE 80 JOURS
			// == == == == == == ==  == 
			$req = $bdd->prepare("SELECT time AS derniere_conn FROM membres_corres_connexion WHERE MATR = :matr");
			$req->bindValue(':matr', $igg_entry);
			$req->execute();			
			extract($req->fetch(PDO::FETCH_ASSOC));
			
			$time_actu = time();
			$temps_valid_mdp = 80; // en jours
			$temps_valid_mdp = $temps_valid_mdp * 3600 * 24; // en secondes
	
			if ($time_actu > ($derniere_conn + $temps_valid_mdp)) // date limite du mdp dépassé
			{
				$mdp_expire = true;
			}
			else
			
			// == == == == == == ==  == 
			// OK
			// == == == == == == ==  == 
			
			{
				// NEW pour sg17
				$_SESSION['membre_is_editeur'] = true;
				$_SESSION['membre_editeur_countries'] = membre_editeur_countries($igg_entry); // array des countries   // attention => donc en BDD = 1 ligne par email, avec 1 pays seulement, donc plusieurs lignes si plusieurs pays
				// fin NEW pour sg17
				
				$_SESSION['validated_access'] = 1;
				
				$req = $bdd->prepare("SELECT * FROM membres_corres WHERE MATR = :matr");
				$req->bindValue(':matr', $igg_entry);
				$resultats = array();
				if ($req->execute()) {
				  while ($ligne = $req->fetch()) {
					$resultats[] = $ligne;
				  }
				}
				$_SESSION['donnees_membre'] = $resultats[0]; // array 1 membre
				
				// ECRITURE DE LA CONNEXION DANS STATS
				$time = time();
				//$req = $bdd->prepare("INSERT INTO stats_corres VALUES ('',:igg_entry,:time,'connexion')");
				// non, l'auto incremente fonctionne pas avec '' inséré... =>
				//test avec
				//INSERT INTO `membres_corres` (`nom`, `bu`, `MATR`, `profil`, `EMAIL`) VALUES ('".$nom."', 'BFLY', '".$email."', 'admin', '".$email."');
				$req = $bdd->prepare("INSERT INTO stats_corres (`stats_id_membre`,`stats_time`,`stats_page`) VALUES (:igg_entry,:time,'connexion')");
				$req->bindValue(':igg_entry', $igg_entry);
				$req->bindValue(':time', $time);
				$req->execute();
				
				// ECRITURE Du temps actuel dans membres_corres_last_time
				$req = $bdd->prepare("UPDATE membres_corres_last_time SET time = :time WHERE MATR = :matr");
				$req->bindValue(':matr', $igg_entry);
				$req->bindValue(':time', $time);
				$req->execute();
				
				//// Vérification si première connexion
				//$req = $bdd->prepare("SELECT * FROM membres_corres_connexion WHERE nbCnx = 0 AND MATR = :matr");
				//$req->bindValue(':matr', $igg_entry);
				//if($req->num_rows == 1)
				//{
				//	$_SESSION['first_cnx'] = 1;	// Première connexion
				//}
				//else
				//{
				//	$_SESSION['first_cnx'] = 0;
				//}
				
				$_SESSION['first_cnx'] = 0;
				
				// Incrémentation du nombre de connexion dans membres_corres_connexion & RAZ variables tentatives de connexion
				$req = $bdd->prepare("UPDATE membres_corres_connexion SET nbCnx = nbCnx + 1, tent_login_nbr = 0, tent_login_time = 0 WHERE MATR = :matr");
				$req->bindValue(':matr', $igg_entry);
				$req->execute();
				
				echo "<script language='javascript'>document.location.href='site.php?pg=home&ct=".$_SESSION['membre_editeur_countries'][0]."'</script>";
				
				//header("location:site.php?pg=home&ct=".$_SESSION['membre_editeur_countries'][0]); // on va sur le 1er contry de sa liste de countries
				
				break;	
			}
		}		
	} // fin SI MDP ou LOGIN ENTRÉ
	
// ---------------- FIN FORMULAIRE DE CONNEXION --------------------



// ####################### FORM MDP OUBLIÉ #######################
	
	if (isset($_GET['mdp']) AND $_GET['mdp'] == 'oublie')
	{
		// SI LOGIN ENTRÉ seul				
		if (isset ($igg_entry))
		{
			$igg_ok = false;
			$req = $bdd->prepare("SELECT * FROM membres_corres WHERE MATR = :matr");
			$req->bindValue(':matr', $igg_entry);
			$membres = array();
			if ($req->execute()) {
			  while ($ligne = $req->fetch()) {
				$membres[] = $ligne;
			  }
			}
			
			if (!empty ($membres)) // LOGIN trouvé
			{
				$igg_ok = true;
			}
			else // LOGIN non trouvé
			{
				$message .= $message_erreur_concat;				
				$message .= "<br/>";
			}
			
			
			// SI TOUT EST OK 
			
			if ($igg_ok AND $code_captacha_ok)
			{
				//// on insère un nouveau mdp				
				//require ('inc_motdepasse_gene.php');
				//$mdp_genere = wd_generatePassword();
				//$salt = saltMembre($igg_entry);
				//$mdp_genere_sha = encodeMdp($mdp_genere,$salt);
				//
				//$time = time();
				//// INSERT EN BASE DU NOUVEAU mdp => en "mdp_auto" +  mdp  + màj de time
				//$req = $bdd->prepare("UPDATE membres_corres_connexion SET mdp_auto = :mdp_auto, ".$prefix_col['membres_corres_connexion']."mdp = :mdp, time = :time WHERE MATR = :matr");
				//$req->bindValue(':mdp_auto', $mdp_genere_sha);
				//$req->bindValue(':mdp', $mdp_genere_sha);
				//$req->bindValue(':time', $time);
				//$req->bindValue(':matr', $igg_entry);					
				//$req->execute();
				
				
				//  DONNEES MEMBRE PRENOM NOM EMAIL
				
				$req = $bdd->prepare("SELECT nom, EMAIL FROM membres_corres WHERE MATR = :matr");
				// liaison de la variable de la req prepa
				$req->bindValue(':matr', $igg_entry);
				$membres = array();
				if ($req->execute()) {
				  while ($ligne = $req->fetch()) {
					$membres[] = $ligne;
				  }
				}
				$membre = $membres[0]; // array 1 membre				
				
				// SI MEMBRE A  UN EMAIL
				if ($membre['EMAIL'] != '')
				{
					// création du token unique
					$token_existe_deja = true;					
					while ($token_existe_deja)
					{
						// génération du token
						$token_genere = wd_generateToken();
						// RECHERCHE si token existe déjà dans bdd
						$req = $bdd->prepare("SELECT token FROM membres_corres_connexion WHERE token = :token");
						$req->bindValue(':token', $token_genere);					
						$req->execute();
						$count = $req->rowCount();
						if ($count == 0)
						{
							$token_existe_deja = false;
						}
						// sinon token regénéré
					}// si boucle finie, ok token unique					
					$time = time();
					// UPDATE EN BASE DU token + time
					$req = $bdd->prepare("UPDATE membres_corres_connexion SET token = :token, token_time = :time WHERE MATR = :matr");
					$req->bindValue(':token', $token_genere);
					$req->bindValue(':time', $time);
					$req->bindValue(':matr', $igg_entry);					
					$req->execute();
					
					//$salt = saltMembre($igg_entry);
					//$mdp_genere_sha = encodeMdp($mdp_genere,$salt);
					
					// ENVOI DU MAIL					
					$headers = "From: ".$NOM_EXPEDITEUR_EMAILS." <".$EMAIL_EXPEDITEUR.">\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					if ($FORCER_EMAIL_WEBMASTER)
					{
						$to = $EMAIL_WEBMASTER;
					}
					else
					{
						$to = $membre['EMAIL'];
					}
					$sujet =  "Password for ".$NOM_EXPEDITEUR_EMAILS;
					
					$href_mdp_email = $URL.$DOSSIER_CORRRESPONDANTS."site.php?pg=login_edit_textes_dyn&ct=france&mdp=changer&token=".$token_genere;
					
					$texte_mail = "Hello ".$membre['nom'].",<br/>
					<br/>
					Here is your link to choose a new password:<br/>
					<a href='$href_mdp_email'>".$href_mdp_email."</a><br/>
					<em>(If this link is not clickable, please copy and paste it into the address bar of your web browser.)</em><br/>
					<br/>
					<br/>
					Regards,<br/>
					".$NOM_EXPEDITEUR_EMAILS."";
					
					//$texte_mail = "Bonjour ".$membre['PRENOM']." ".$membre['NOM'].",<br/>
					//<br/>
					//Voici votre nouveau mot de passe.
					//<br/>
					//<strong>
					//	Attention ce mot de passe est <span style='text-decoration:underline;'>temporaire</span>, il vous sera demandé de le changer à la prochaine connexion.
					//</strong>
					//<br/>
					//<strong>
					//	Merci de bien veiller, lors du copié-collé, à ne pas ajouter d'espace avant ni après.
					//</strong>
					//<br/>
					//<br/>
					//Mot de passe :
					//<br/>
					//<br/>
					//<strong>".$mdp_genere."</strong><br/>
					//<br/>
					//Bonne visite sur votre BSI.
					//<br/>
					//<br/>
					//<br/>
					//Cordialement,<br/>
					//".$NOM_EXPEDITEUR_EMAILS."";
					//
					
					
					// en test destinataire VL
					//$to = 'vlepoivre@b-fly.com';
				
					if( mail($to,utf8_decode($sujet), utf8_decode($texte_mail),utf8_decode($headers)))
					{
						$message .= "
							Thank you, an email has been sent to you with a link to choose a password.
							<br/>
							Please check in your unwanted (spam) emails if necessary.
							<br/>
							You can close this window.
							<br/>
						";
						$redirection_vers_page_connexion = true;
					}
					else
					{
						$message .= "Sorry, sending email failed, please try again or contact the webmaster.";
					$message .= "<br/>";
					}
				} // if ($membre['EMAIL'] != '')
				else // MEMBRE SANS EMAIL
				{
					$message .= "
						You do not have an e-mail, please recover your password from your Personnal Correspondent or by contacting the support at this e-mail address:
						<a href='mailto:".$EMAIL_EXPEDITEUR."'>".$EMAIL_EXPEDITEUR."</a>.
					";
					$message .= "<br/>";
				}
			}
			
		} // fin SI MDP ou LOGIN ENTRÉ
		
		
		
	}
// ---------------- FIN FORM MDP OUBLIÉ --------------------	
	
	
	
	
	
	
	
	
	
	
// ####################### FORM MDP CHANGER #######################

	elseif (isset($_GET['mdp']) && $_GET['mdp'] == 'changer')
	{
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == NOUVEAU => TOKEN
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == NOUVEAU => TOKEN
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == NOUVEAU => TOKEN
		
		$token_ok = false;
		
		if (isset($_GET['token']))
		{
			$get_token = sanitize($_GET['token']);
			// vérif token : longueur $TOKEN_LENGHT et seulement chiffres et lettres
			if (preg_match('<^[A-Za-z0-9]*$>',$get_token) AND strlen($get_token) == $TOKEN_LENGHT)			
			{
				// token a le bon format
				$req = $bdd->prepare("SELECT * FROM membres_corres_connexion WHERE token = :token LIMIT 1");
				$req->bindValue(':token', $get_token);
				$req->execute();
				$count = $req->rowCount();
				// token trouvé
				if ($count == 1)
				{
					$time = time();				
					while ($ligne = $req->fetch())
					{
						$resultats[] = $ligne;
					}
					//$ligne = $req->fetch();
					$membre_du_token = $resultats[0];
					
					//$message .= "<br/>LOGIN ok : ".$membre_du_token['MATR']." --- ".print_r($membre_du_token)."<br/>.";
					
					// vérif de la validité du token
					if ($time <=  ($membre_du_token['token_time'] + $TOKEN_VALID_SECS))
					{
						// TOKEN OK ET toujours VALIDE en temps
						$token_ok = true;
						$token_expire = false;
						$req = $bdd->prepare("SELECT EMAIL FROM membres_corres WHERE MATR = :matr");
						$req->bindValue(':matr', $membre_du_token['MATR']);
						$membres = array();
						if ($req->execute()) {
						  while ($ligne = $req->fetch()) {
							$membres[] = $ligne;
						  }
						}
						$membre_du_token_email = $membres[0]['EMAIL'];
						
					}
					else // TEMPS DE VALIDITE dépassé
					{
						$message .= "&bull; For security, this link is no longer valid. Please ask for a new password using this form.";	
						$message .= "<br/>";
						$token_expire = true;			
						//header("location:site.php?pg=login_edit_textes_dyn&ct=france&mdp=oublie");
					}
				} // fin  if ($count == 1)
				else
				{
					$message .= "&bull; This link is not valid.";	
					$message .= "<br/>";
				}
			} // fin    if (preg_match('<^[A-Za-z0-9]*$>',$get_token) AND strlen($get_token) == $TOKEN_LENGHT)
			else
			{
				$message .= "&bull; This link is not valid.";	
				$message .= "<br/>";
			}
		} // fin     if (isset($_GET['token']))
		
		
		
		
		if ($token_ok)
		{
			// == == == == == == == == == == == == == ==  FORMULAIRE CHANGEMENT DE MDP	
			
			// SI MDP ou mdp_new ou mdp_new_confirm ou LOGIN ENTRÉ
			if (isset($mdp_new_entry) OR isset($mdp_new_confirm_entry))
			{
				if (!isset($mdp_new_entry)){$mdp_new_entry='';}
				if (!isset($mdp_new_confirm_entry)){$mdp_new_confirm_entry='';}	
				$mdp_new_ok = false;
				$mdp_new_confirm_ok = false;
				$mdp_no_historique_ok = false;
				$mdp_maj = false;
				
				//
				//$req = $bdd->prepare("SELECT MATR, EMAIL FROM membres_corres WHERE MATR = :matr");
				//$req->bindValue(':matr', $igg_entry);
				//$membres = array();
				//if ($req->execute()) {
				//  while ($ligne = $req->fetch()) {
				//	$membres[] = $ligne;
				//  }
				//}
				//
				//if (!empty ($membres)) // LOGIN trouvé
				//{				
					//$etat_verif_login = verifLogin($igg_entry, $mdp_entry);
					//if(strstr($etat_verif_login, 'min'))	// Si le retour comtiens "min", le retour est le temps de blocage du compte, DONC compte bloqué temporairement
					//{
					//	$message .= "&bull; Nombre de tentatives de connexion atteintes, vous devez attendre ".$etat_verif_login." avant la prochaine tentative.";
					//	$message .= "<br/>";
					//}				
					//else // pas de blocage on continue
					//{
					
						// ***************************
						// TEMPS LIMITE DU MDP temporaire DEPASSÉ
						// ***************************
						//$req = $bdd->prepare("SELECT nbCnx, mdp_auto, time AS last_time_chg_mdp FROM membres_corres_connexion WHERE MATR = :matr");
						//$req->bindValue(':matr', $igg_entry);
						//$req->execute();			
						//extract($req->fetch(PDO::FETCH_ASSOC));
						//
						//$time_actu = time();			
						//if (($nbCnx != 0) && ($time_actu > ($last_time_chg_mdp + $temps_valid_mdp_auto)) && $mdp_entry == $mdp_auto) // Pas première connexion & date limite du mdp_auto dépassé
						//{
						//	$mdp_auto_expire = true;
						//	$message .= "&bull; La validité de votre mot de passe temporaire à expiré. Merci de faire une nouvelle demande de mot de passe.";					
						//	header("location:site.php?pg=login_edit_textes_dyn&ct=france&mdp=oublie");
						//	break;
						//}
						//else
						//{
							//$mdp_auto_expire = false;
						//}
						
						
						
						// ***************************
						// fin      TEMPS LIMITE DU MDP DEPASSÉ
						// ***************************
						//
						//$igg_ok = true;			
						//$salt = saltMembre($igg_entry);
						//
						//$req = $bdd->prepare("SELECT COUNT(*) AS db_count FROM membres_corres_connexion WHERE ".$prefix_col['membres_corres_connexion']."mdp = :mdp AND MATR = :matr");
						//// liaison de la variable de la req prepa
						//$req->bindValue(':matr', $igg_entry);
						//$req->bindValue(':mdp', encodeMdp($mdp_entry,$salt));
						//$req->execute();					
						//extract($req->fetch(PDO::FETCH_ASSOC));
						//
						//if($db_count == 1)	// mdp ok
						//{
						//	$mdp_ok = true;	
							// Vérification que les 2 nouveaux mdp sont identiques
							
							
							
							
							
				
				
				
				
				$validation =  verification_password($mdp_new_entry,$mdp_new_confirm_entry);
				if($validation) // mdp_new  & mdp_new_confirm identiques
				{
					$mdp_new_ok = $mdp_new_confirm_ok = true;
					$mdpCol = '';
					$salt = saltMembre($membre_du_token['MATR'], 'corres');
					for($i=$historique_mdp; $i>0; $i--)
					{
						$mdpCol .= "mdp".$i." = '".encodeMdp($mdp_new_entry,$salt)."' OR ";
					}
					
					$req = $bdd->prepare("SELECT COUNT(*) AS db_count FROM membres_corres_connexion WHERE $mdpCol ".$prefix_col['membres_corres_connexion']."mdp = :mdp AND MATR = :matr");
					$req->bindValue(':matr', $membre_du_token['MATR']);
					$req->bindValue(':mdp', encodeMdp($mdp_new_entry,$salt));
					$req->execute();							
					extract($req->fetch(PDO::FETCH_ASSOC));
					
					if($db_count == 0)	// mdp_new non présent dans l'historique et différent de l'actuel
					{
						$mdp_no_historique_ok = true;
					}
					else
					{
						$message .= "&bull; The new password is part of the ".$historique_mdp." last used or is identical to the current one.";
						$message .= "<br/>";
					}
				}
				
				
							
							
							
							
							
							
							
							
							
							
							
						//}
						//else // mdp not ok
						//{
						//	//$message .= "&bull; L'ancien mot de passe est erroné.";
						//	$message .= $message_erreur_concat;
						//	$message .= "<br/>";
						//}
					
					
					//} // fin - pas de blocage
					
				//} // fin LOGIN trouvé
				
				//else // LOGIN non trouvé
				//{
				//	$igg_format_ok = igg_format_ok($igg_entry); // verif si LOGIN = 7 chiffres.
				//	if ($igg_format_ok)
				//	{
				//		$message .= $message_erreur_concat;
				//	}
				//	else
				//	{
				//		$message .= $message_erreur_concat;
				//	}
				//	$message .= "<br/>";
				//}
				//
				
				
				// CHECK MDP
				//if ($mdp_ok AND $igg_ok AND $mdp_new_ok AND $mdp_new_confirm_ok AND $mdp_no_historique_ok AND $code_captacha_ok) { // si MDP ok -- SANS CAPTCHA pour développement
				//if ($mdp_ok AND $igg_ok AND $mdp_new_ok AND $mdp_new_confirm_ok AND $mdp_no_historique_ok) { // si MDP ok -- SANS CAPTCHA
				if ($mdp_new_ok AND $mdp_new_confirm_ok AND $mdp_no_historique_ok) { // si MDP ok -- SANS CAPTCHA
					// UPDATE BDD => on écrase mdp[n]par le mdp [n-1]
					depHistMdp($membre_du_token['MATR'], $historique_mdp, 'corres');
					
					// MAJ du nouveau mdp et date de cette MAJ.
					$salt = saltMembre($membre_du_token['MATR'], 'corres');
					$req = $bdd->prepare("UPDATE membres_corres_connexion SET ".$prefix_col['membres_corres_connexion']."mdp = :mdp, time = :time WHERE MATR = :matr");
					$req->bindValue(':mdp', encodeMdp($mdp_new_entry,$salt));
					$req->bindValue(':time', time());
					$req->bindValue(':matr', $membre_du_token['MATR']);
					$req->execute();
					
					//$code_captacha_ok = false;
					$message .= '&bull; Thank you, your password has been updated.<br/>';
					//$message .= '(mail='.$membres[0]['EMAIL'];
					$mdp_maj = true;
					
					
					
					// modif du token pour rendre invalide l'ancien
					// création du token unique
					$token_existe_deja = true;					
					while ($token_existe_deja)
					{
						// génération du token
						$token_genere = wd_generateToken();
						// RECHERCHE si token existe déjà dans bdd
						$req = $bdd->prepare("SELECT token FROM membres_corres_connexion WHERE token = :token");
						$req->bindValue(':token', $token_genere);					
						$req->execute();
						$count = $req->rowCount();
						if ($count == 0)
						{
							$token_existe_deja = false;
						}
						// sinon token regénéré
					}// si boucle finie, ok token unique					
					$time = time();
					// UPDATE EN BASE DU token + time
					$req = $bdd->prepare("UPDATE membres_corres_connexion SET token = :token, token_time = :time WHERE MATR = :matr");
					$req->bindValue(':token', $token_genere);
					$req->bindValue(':time', $time);
					$req->bindValue(':matr', $membre_du_token['MATR']);					
					$req->execute();
					
					
					
					////////////////////////////////
					// AJOUT LE 16 03 21 POUR ENVOI DE MAIL CONFIRMANT LA MODIF DU MDP				
					////////////////////////////////
					
					// SI MEMBRE A  UN EMAIL
					if ($membres[0]['EMAIL'] != '')
					{
						// ENVOI DU MAIL
						$headers = "From: ".$NOM_EXPEDITEUR_EMAILS." <".$EMAIL_EXPEDITEUR.">\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						if ($FORCER_EMAIL_WEBMASTER)
						{
							$to = $EMAIL_WEBMASTER;
						}
						else
						{
							$to = $membre_du_token_email;
						}
						$sujet =  "Your password for ".$NOM_EXPEDITEUR_EMAILS." has been changed";
						$texte_mail = "Hello,<br/>
						<br/>
						Your password has been changed.
						<br/>
						If you are not the owner of this action, please notify the support immediately: <a href='mailto:".$EMAIL_EXPEDITEUR."'>".$EMAIL_EXPEDITEUR."</a>.
						<br/>
						<br/>
						Cordialement,<br/>
						".$NOM_EXPEDITEUR_EMAILS."";
						
						// en test destinataire VL
						//$to = 'vlepoivre@b-fly.com';
					
						if( mail($to,utf8_decode($sujet), utf8_decode($texte_mail),utf8_decode($headers)))
						{
							$message .= "A password confirmation email has been sent to you.";
							$message .= "<br/>";
						}
						else
						{
							$message .= "We have not been able to send you an email confirmation of change of password, thank you to contact the support:
							<a href='mailto:".$EMAIL_EXPEDITEUR."'>".$EMAIL_EXPEDITEUR."</a>.";
							$message .= "<br/>";
						}
					}
					
					////////////////////////////////
					// FIN DE
					// AJOUT LE 16 03 21 POUR ENVOI DE MAIL CONFIRMANT LA MODIF DU MDP				
					////////////////////////////////
				}
				
				
			} // fin SI MDP ou LOGIN ENTRÉ
			
			// == == == == == == == == == == == == == ==   fin  FORMULAIRE CHANGEMENT DE MDP
			
		} //  fin      if ($token_ok)
		else
		{
			//header("location:site.php?pg=login_edit_textes_dyn&ct=france");
		}
		
		
		
		
		
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == /fin/     NOUVEAU => TOKEN
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == /fin/     NOUVEAU => TOKEN
		// == == == == == == == == == == == == == == == == == == == == == == == == == == == /fin/     NOUVEAU => TOKEN
		
		
		
		
		if (isset($_GET['auto']) || (isset($etat_verif_login) && ($etat_verif_login == 2 || $etat_verif_login == 3) ))
		{
		}
		if (isset($_GET['expire']) || (isset($etat_verif_login) && ( $etat_verif_login == 4 && $mdp_expire) ))
		{
			$message .= "&bull; The last password was changed more than 80 days ago. Please change your password.";
			$message .= "<br/>";
		}
	}
// ---------------- FIN FORM MDP CHANGER --------------------

// -------------------------------------------------------------------
// ####################### Fin DES FORMULAIRES #######################
// -------------------------------------------------------------------

















?>










<?php
	//echo 'F+CTXnNY';
	//echo $_SERVER['SERVER_ADDR'];
	//echo '<br/>';
	//echo sha1('F+CTXnNY');
	//echo '<br/>';
	//echo encodeMdp('F+CTXnNY');
	//echo $etat_verif_login;
	//var_dump(get_defined_vars ());	
?>


		
			<div class="contenu_form_mdp center">
				
				<br/>
				<br/>
				<br/>
				
				<?php
				
				if (isset($_GET['deconnexion']) AND $_GET['deconnexion'] == 'deconnected')
				{
					//détruit toutes le variables de session
					$_SESSION = array();
					//détruit le cookie de session
					if (ini_get("session.use_cookies"))
					{
						$params = session_get_cookie_params();
						setcookie(session_name(), '', time() - 42000,
							$params["path"],
							$params["domain"],
							$params["secure"],
							$params["httponly"]
						);
					}
					session_destroy();
					echo "<p class='erreur_mdp rouge bg_white center museo5 ombre_3_4' id='popup_message'>
							<span onclick='hidediv(\"popup_message\");' class='gris6 underline small8' style='cursor:pointer;'>(close the window)</span>
							<br/>
							<br/>
							<b>
								You are offline.
							</b>
							<br/>
							<br/>
						</p>";
				}
				
				
				// FORM MDP OUBLIÉ
				//Sif ((isset($_GET['mdp']) AND $_GET['mdp'] == 'oublie') || (isset($mdp_auto_expire) AND $mdp_auto_expire))
				if
				(
					(
						(isset($_GET['mdp']) AND $_GET['mdp'] == 'oublie')
						OR (isset($token_expire) AND $token_expire)
					)
					AND
					(
						!$redirection_vers_page_connexion // $redirection_vers_page_connexion == true si l'email avec lien token a bien été envoyé, dans ce cas, form connexion
					)
				)
				{
					affiche_form_mdp_oublie();
				}	// FIN FORM MDP OUBLIÉ
				
				//OLD
				//// FORM MDP OUBLIÉ
				////if ((isset($_GET['mdp']) AND $_GET['mdp'] == 'oublie') || (isset($mdp_auto_expire) AND $mdp_auto_expire))
				//if ((isset($_GET['mdp']) AND $_GET['mdp'] == 'oublie') OR (isset($token_expire) AND $token_expire))
				//{
				//	affiche_form_mdp_oublie();
				//}	// FIN FORM MDP OUBLIÉ
			
			
				// FORM MDP CHANGER
				
				elseif
				(
					(
						(
							($etat_verif_login == 2 || $etat_verif_login == 3)
						)
						OR
						(
							$mdp_expire
						)
						OR
						(
							isset($_GET['mdp'])
							AND
							(
								// $_GET['mdp'] == 'changer' OR $mdp_ok == 'changer' // lien changer de mot de passe        =>   non not ok après audit aout 16
								$_GET['mdp'] == 'changer' // lien changer de mot de passe
							)
						)
					)
					AND
					(
						!isset($mdp_maj)
						OR
						(
							isset($mdp_maj) AND !$mdp_maj // si le mdp n'a pas été bien màj
						)
					)
					AND
					(
						$token_ok
					)
				)
				{
					affiche_form_mdp_changer();
				}	// FIN FORM MDP CHANGER
				
				else // FORMULAIRE DE CONNEXION
				{
					affiche_form();  
				} // fin FORMULAIRE DE CONNEXION
				
				
				?>	
		
			</div> <!-- / contenu_form_mdp-->			
		