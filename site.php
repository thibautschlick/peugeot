<?php
require_once ('inc_session_setup.php');
require_once ('inc_fonctions.php');
//require_once ('inc_var_globales_countries_list.php'); // listes pays
require_once ('inc_var_globales.php');
require_once ('inc_var_globales_ct_lg.php'); // include les variables pour chaque ct et/ou lg, selon le GET ct
require_once ('inc_url_traitement.php');

//fonctions pour site dynamique
require_once ('_inc_bdd_connect.php');
require_once ('inc_fonctions_dyn.php');



// édition forcée sur VL pour dév
$EDIT_FORCED_AVEC_VL = false; // true false
if($LOCAL)
{
	$EDIT_FORCED_AVEC_VL = false; // car pb en local, perte de session... et pas en ligne...
}
if ($EDIT_FORCED_AVEC_VL)
{
	if (isset($_GET['statut_editeur_xnet']))
	{
		// forçage en éditeur VL
		$_SESSION['membre_is_editeur'] = true; // membre non loggué par défaut
		$_SESSION['membre_editeur_countries'] = 'france';
		$membre_email = $_SESSION['donnees_membre']['EMAIL'] = $_SESSION['membre_email'] = 'vlepoivre@b-fly.com';
		$membre_editeur = true;
	}		
	if (isset($_GET['statut_editeur_xnet_end']))
	{
		// forçage en éditeur VL
		$_SESSION['membre_is_editeur'] = false; // membre non loggué par défaut
		$_SESSION['membre_editeur_countries'] = 'france';
		$membre_email = $_SESSION['donnees_membre']['EMAIL'] = $_SESSION['membre_email'] = 'vlepoivre@b-fly.com';
		$membre_editeur = false;
	}
	
	$_SESSION['membre_is_editeur'] = true; // membre non loggué par défaut
	$_SESSION['membre_editeur_countries'] = 'france';
	$membre_email = $_SESSION['donnees_membre']['EMAIL'] = $_SESSION['membre_email'] = 'vlepoivre@b-fly.com';
	$membre_editeur = true;
}

//
//echo $_SESSION['membre_is_editeur'];
//echo $membre_editeur;


	
// pour édition textes
if (isset($_SESSION['membre_is_editeur']))
{
	$membre_editeur = $_SESSION['membre_is_editeur'];
}
else
{
	$membre_editeur = false; // true false
}
if (!isset($_SESSION['membre_editeur_countries']) OR !is_array($_SESSION['membre_editeur_countries']))  // attention => donc en BDD = 1 ligne par email, avec 1 pays seulement, donc plusieurs lignes si plusieurs pays
{
	$_SESSION['membre_editeur_countries'] = array();
}
if (isset($_SESSION['donnees_membre']['EMAIL']))
{
	$membre_email = $_SESSION['donnees_membre']['EMAIL'];
}
else
{
	$membre_email = '';
}
// check si $membre_editeur_all_countries
if (in_array($membre_email,$EDITEURS_ALL_COUNTRIES)) // $EDITEURS_ALL_COUNTRIES cf var globales
{
	$membre_editeur_all_countries = true;
	$_SESSION['membre_editeur_countries'] = array_keys($countries_CODE_LG_FORM);
}
else
{
	$membre_editeur_all_countries = false;
}
// filtrage pour EDIT => contrôle que le country édité est autorisé, sinon on efface les autorisations
// ne concerne que les membres NON $membre_editeur_all_countries
if (!$membre_editeur_all_countries)
{
	if (!isset($_SESSION['membre_editeur_countries']) OR !in_array($country,$_SESSION['membre_editeur_countries'])) // si pas de countries ou bien le country pas dans sa liste
	{
		$_SESSION['membre_is_editeur'] = false;
		$_SESSION['membre_editeur_countries'] = '';
		$membre_editeur = false;
	}
}



// include des éléments et messages pour le formulaire
if ($membre_editeur)
{
	if ($lg == 'fr') {$lg_pour_edition = 'fr';} else {$lg_pour_edition = 'en';}
	include ('contenu_pages/edit_text_lg/edit_text_lg_'.$lg_pour_edition.'.php');
}


// redirection vers index si membre non éditeur et page d'édition
if (!$membre_editeur AND strpos($page,"edit") !== false AND $page != 'login_edit_textes_dyn')
{
	header('location:index.php');
}




//echo 'CT= ';
//print_r ($_SESSION['membre_editeur_countries']);
//echo '<br/>';


$page_blank = false;
if (in_array($page,array_keys($ELEMENTS_BLANK)))
{
	$page_blank = true;
}


?>
<!DOCTYPE html 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<?php require_once ('inc_meta.php'); ?>
</head>

<body <?php if($page_blank){displaynone();} ?> <?php if($page == "simuler") {echo 'onKeyPress="if (event.keyCode == 13) calc()"';} // touche Entrée pour calcul sim, pour IEDM ?> >
	
	<div class="container_1200">
		
	
		<?php
		
		
		// ==============       	ENCADRÉ ROUGE POUR MODE ÉDITION ================
		if ($membre_editeur)
		{
			echo '
				<p class="p_top_membre_editeur">
					<b>
						';
				if ($membre_editeur_all_countries)
				{
					echo 'EDIT:';
					echo '
						<span class="small7">
						';
				}
				else
				{
					echo 'EDIT:';
					echo '
						<span class="small8">
						'.$country.' | '.$membre_email.'
						| Change country:
						';
				}
				
			foreach ($_SESSION['membre_editeur_countries'] as $ct_editeur)
			{
				echo '<a href="site.php?pg='.$page.'&ct='.$ct_editeur.'" class="white" ';
				if ($ct_editeur == $country)
				{
					echo 'style="text-decoration:underline;"';
				}
				echo '>'.$ct_editeur.'</a> - ';
			}
			
			//if (!$membre_editeur_all_countries)
			{
				echo ' | <b class="big1"><a href="index.php" class="white">Log out</a></b>';
			}
			
			// SAVE BDD => ici inactivé puisque placé à chaque modif de texte, dans 
		
			// SECU DE LA BDD sur ftp + email, si email activé
			//if ($SAVE_ACTIVATION)
			//{
			//	echo ' | <b class="big1"><a href="site.php?pg='.$page.'&ct='.$country.'&saveallchanges" class="white">SAVE ALL CHANGES</a></b>';
			//	if(isset($_GET['saveallchanges']))
			//	{
			//		include($SAVE_FILE.'countries.php');
			//		
			//		echo '<script type="text/javascript">alert('.$email_message_confirm.');</script>';
			//	}
			//}
		
			
			
			echo'
				</span>
					</b>
				</p>';
				
		}
		// ==============       fin	ENCADRÉ ROUGE POUR MODE ÉDITION ================
		?>

			




		<?php
			
			// ==============       HEADER ================			
			
			require_once ('inc_header.php');
			
			//echo $lg;
			//echo "***";
		?>
		
		
		
		
		<?php
			
			// ==============       MENU ================
			
			
			//if (!strpos($page,'edit')) => non fait masquer aussi le menu sur la page credits !
			//if (!in_array($page,$ELEMENTS_MENU_EDIT_TEXTES)) => ok mais inactivé
			{
				require_once ('inc_menu.php');
			}
		?>
		
        <div class="contenu_page">
			
				
				<?php
			
				// ==============       CONTENU PAGES ================
			
					
					
				
				
					
				// ==============       SIDE LEFT ================
					
				include ('inc_side_left.php');
				
			
				
				
				?>
				
				<div class="contenu_centre <?php if($page == 'simuler') {echo 'contenu_centre_large';} ?>">
				
					<?php
						// pour edit textes dyns
							if ($page == 'edit') // page de modif des textes dynamiques
							{
								include ('edit_text.php');
							}
							elseif ($page == 'edit_document') // page de modif des textes dynamiques du menu
							{
								include ('edit_document.php');
							}
							elseif ($page == 'edit_textes_menu') // page de modif des textes dynamiques du menu
							{
								include ('edit_textes_menu.php');
							}
							elseif ($page == 'edit_textes_menu_right') // page de modif des textes dynamiques du menu
							{
								include ('edit_textes_menu_right.php');
							}
							elseif ($page == 'edit_text_create_text') // page de création de texte dynamique (appelée par edit_text.php)
							{
								include ('edit_text_create_text.php');
							}
							elseif ($page == 'login_edit_textes_dyn') // page de création de texte dynamique (appelée par edit_text.php)
							{
								include ('login_edit_textes_dyn.php');
							}
						// fin       pour edit textes dyns
				
				
						else
						{
							//if($country == 'france')
							//{
							//	include ('contenu_pages/'.$page.'_france.php');
							//}						
							//else
							{
								include ('contenu_pages/'.$page.'.php');
							}
						}
						
						
					?>
				
				</div> <!-- contenu_centre -->
				
				<?php
				// ==============       SIDE LEFT ================
					
				if ($page != "simuler")
				{
					include ('inc_side_right.php');
				}
					
				?>
		
			<a href="#" class="lien_top"></a>
	
        </div> <!-- / contenu_page -->
		
		<div class="clr"></div>

		<?php require_once ('inc_footer.php'); ?>
		
	</div><!--/container 1200-->
	
	
<?php require_once ('inc_footer_gan.php'); ?>

</body>
</html>