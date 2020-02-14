<?php

$_GET['pg'] = $page = 'index';
$_GET['country'] = $country = 'france';


require_once ('inc_session_setup.php');
require_once ('inc_fonctions.php');
//require_once ('inc_var_globales_countries_list.php'); // listes pays
require_once ('inc_var_globales.php');
require_once ('inc_var_globales_ct_lg.php'); // include les variables pour chaque ct et/ou lg, selon le GET ct
require_once ('inc_url_traitement.php');

//fonctions pour site dynamique
require_once ('_inc_bdd_connect.php');
require_once ('inc_fonctions_dyn.php');

$page_blank = false;
if (in_array($page,array_keys($ELEMENTS_BLANK)))
{
	$page_blank = true;
}

include ('contenu_pages/fr/_commun_fr.php');

$PAGE_TITLE = $NOM_OPERATION;

// effacement du statut d'éditeur
$_SESSION['membre_is_editeur'] = false;
$_SESSION['membre_editeur_country'] = '';

?>

<!DOCTYPE html 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<?php require_once ('inc_meta.php'); ?>
</head>

<body <?php if($page_blank){displaynone();} ?> >
	
	<div class="container_1200">

		<!--
		<?php
			if ($page != 'index')
			{
				require_once ('inc_header.php');
			}
		?>
		-->
		
		<?php
			if ($page != 'index')
			{
				include 'inc_side_left.php';
			}
		?>
	
		<?php
			if (!strpos($page,'edit'))
			{
				if ($page != 'index')
				{
					require_once ('inc_menu.php');
				}
			}
		?>
		
        <div class="contenu_page">
			
			
			<div class="index_container_map">
				
				<?php
					// FONCTION DE TEST ==> FRANCE seulement
					$TEST_FRANCE_SEULEMENT = false; // true false
					
					// 2e fonction de test pour FRANC ET UK seulement
					$test_FRANCE_UK_seulement = false; // true false
					function france_ou_uk($ct)
					{
						if ($ct != 'france')
						{
							$ct = 'uk';
						}
						return $ct;
					}
					
					$AFFICHE_COUNTRIES_READY_SEULEMENT = true; // true false; // voir $COUNTRIES_READY array dans inc_var_globales_ct_lg
					
					if (isset($_GET['recetteallcountriessg17']))
					{
						$AFFICHE_COUNTRIES_READY_SEULEMENT = false;
					}
					
					function affiche_country($ct)
					{
						global $countries_CODE_LG_FORM;
						global $AFFICHE_COUNTRIES_READY_SEULEMENT;
						
						if ($AFFICHE_COUNTRIES_READY_SEULEMENT)
						{
							$affiche_country = $countries_CODE_LG_FORM[$ct][3];
						}
						else // affichage de tous les pays
						{
							$affiche_country = true;
						}
						return $affiche_country;
					}
					
				?>
				
				<h2 class="center orange">
					<span class="height05em"></span>	
				</h2>
				<!--<p class="center big2">
					PLEASE CHOOSE YOUR COUNTRY IN THE COUNTRIES LIST OR TYPE IT:
					<br/>
					
				</p>-->
				
				<!--
				<h2 class="center orange">
					<span class="height05em"></span>
					
				</h2>
				<p class="center big2">
					
				</p>
				-->
				
		
				<?php
				if (isset($_POST['input_country']) AND $_POST['input_country'] != '')
				{
					$input_country = htmlspecialchars(trim(addslashes($_POST['input_country'])));
				}
				else
				{
					$input_country = '';
				}
				
				//test
				//echo $input_country;
				
				if ($input_country != '')
				{
					$countries_found = array();
					foreach($countries_CODE_LG_FORM as $ct_code => $ct_data)
					{
						if (affiche_country($ct_code))
						{
							$ct_name = $ct_data[0];
							// si str input dans le nom du pays (
							if (strpos(strtolower($ct_name),strtolower($input_country)) !== false)
							{
								$countries_found[$ct_code] = $ct_name;
							}
						}
					}
				}
				
				?>
				
				<form method="post" action="index.php" class="center">
					
					<p class="center">
						<!--<input type="text" name="input_country" class="input_country"  value="" placeholder="SELECT">-->
						<select class="input_country" placeholder="SELECT" onChange="location = this.options[this.selectedIndex].value;">
							
							<option value="">SELECT</option>
							
							<?php
							foreach($countries_CODE_LG_FORM as $ct_code => $ct_array)
							{
								if ($TEST_FRANCE_SEULEMENT)
								{
									//$ct_code_cible = 'france';
									$ct_code_cible = 'france';
								}
								else
								{
									$ct_code_cible = $ct_code;
								}
								
								$country_nom = $ct_array[0];
								$country_affiche = $ct_array[3]; // true false
								
								if ($country_affiche)
								{
									// cas spécial pays pas encore ouvert => popup JS
									if(in_array($ct_code_cible,array_keys($COUNTRIES_FERMES_POPUP)))
									{
										echo '
										<option value="#" onclick="alert(\''.$COUNTRIES_FERMES_POPUP[$ct_code_cible].'\'); return false;">'.$country_nom.'
											<a href="#"></a>
										</option>';
									}
									else
									{
										echo '
										<option value="site.php?pg=home&ct='.$ct_code_cible.'">'.$country_nom.'
											<a href="site.php?pg=home&ct='.$ct_code_cible.'"></a>
										</option>';
									}
								} // if ($country_affiche)
							}
							?>
						</select>
					
						<input type="submit" class="input_country_submit gris6" value="">
					</p>
				</form>
				
				

				
				<div class="container_countries_lists">
						
					
					
					<p class="center">
						<span class="height05em"></span>
						<!--<span class="triangle_bas_gris"><img src="assets/images/triangle_bas_gris.png" /></span>-->
						 <!--<a href="#" onclick='showdiv("countries_list");return false;' class="underline">COUNTRIES LIST
						 </a>--> 
						<!--<span class="triangle_bas_gris"><img src="assets/images/triangle_bas_gris.png" /></span>-->
						<div class="map_small_responsive"><img src="assets/images/bg_mapemonde_small.png" /></div>	
					</p>
					
					<?php if ($TEST_FRANCE_SEULEMENT) { ?>
	<!--					<p class="center big1 gris6 italic">
							<br/>
							<b>TEST MODE:</b> all countries target the <b>France</b> test website
						</p>-->
					<?php } ?>
				
					<br/>
					
					
					
					
					<div class="container_colonnes" id="countries_list">
						<div class="bg_full_white_opacity"></div>
						
					<?php
					
						//$region_code = 'world';
						//$region_nom = 'ALL';				
						
						$countries_de_la_region = array();
						
						// attention PEG17 = tous pays dans WORLD et non dans des régions = liste unique
					
						// calcul de la taille de $countries_CODE_LG_FORM
						$size_countries_CODE_LG_FORM = sizeof(array_keys($countries_CODE_LG_FORM));
						$nb_colonnes = 5;
						$nb_ct_par_colonne = round($size_countries_CODE_LG_FORM / $nb_colonnes);
						
						//echo $nb_colonnes;
						
						$i = 0;
						
						//echo $size_countries_CODE_LG_FORM;
					
					$class_p_lien_ct = 'center';
					//if (!$AFFICHE_COUNTRIES_READY_SEULEMENT)
					//{
						echo '<div class="colonne_countries">';
						$class_p_lien_ct = '';
					//}
					//else
					//{
					//	echo '<br/>';
					//}
						
						foreach($countries_CODE_LG_FORM as $ct_code => $ct_array)
						{
							$countries_de_la_region[] = $ct_code;
						}
						
						foreach($countries_de_la_region as $ct_code)
						{
								if ($TEST_FRANCE_SEULEMENT)
								{
									$ct_code_cible = 'france';
								}
								else
								{
									$ct_code_cible = $ct_code;
								}
								
								if ($test_FRANCE_UK_seulement) {$ct_code_cible = france_ou_uk($ct_code_cible);}
								
								if (affiche_country($ct_code))
								{
									// LIEN REEL DU PAYS menant à HOME
									echo '
										<p class="'.$class_p_lien_ct.'"><a href="site.php?pg=home&ct='.$ct_code_cible.'">'.$countries_CODE_LG_FORM[$ct_code][0].'</a></p>
									'; // <br class="br_countries" />
								} // if (affiche_country($ct_code))
								else
								{
									// LIEN REEL DU PAYS menant à HOME
									echo '
										<p class="'.$class_p_lien_ct.'"><a class="a_country_coming_soon" href="#"
											onclick="alert(\''.$countries_CODE_LG_FORM[$ct_code][0].' website will open soon.\r\n\r\nLe site '.$countries_CODE_LG_FORM[$ct_code][0].' ouvrira prochainement.\');">
											'.$countries_CODE_LG_FORM[$ct_code][0].'<sup> *</sup></a>
											</p>
									'; // <br class="br_countries" />
								}
								
								$i++;
								
								if ($i > $nb_ct_par_colonne)
								{
									echo '
									</div>
									';
									echo '
									<div class="colonne_countries">
									';	
									$i = 0;
								}
							//echo $nb_ct_par_colonne;
						}
						
					//if (!$AFFICHE_COUNTRIES_READY_SEULEMENT)
					//{
						echo '</div>'; // fin colonne
					//}
					
					?>
						<div class="clr"></div>
					
					
						<?php if($AFFICHE_COUNTRIES_READY_SEULEMENT)
						{
							?>
							<br/>
							<br/>
							<p class="center gris6 italic">
								&nbsp;&nbsp;(* Websites for those countries will open soon)
								<br/>
								&nbsp;&nbsp;(* Les sites pour ces pays ouvriront prochainement)
							<br/>
							<br/>
							</p>
							<?php
						}
						?>
					
					</div> <!-- container_colonnes -->
					
				</div> <!-- container_countries_lists -->

			</div><!-- / index_container_map -->
			
			
        </div> <!-- / contenu_page -->
		
			
		<a href="#" class="lien_top"></a>
		<div class="clr"></div>
		
		

		<?php require_once ('inc_footer.php'); ?>
		
	</div><!--/container 1200-->
	
	
<?php require_once ('inc_footer_gan.php'); ?>

</body>
</html>