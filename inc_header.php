<?php
	// gestion du BG du header => visuel de gauche en photo changeant selon pages
	// développement => soit home, soit offre => ensuite les visuels seront à créer pour toutes les pages si besoin
	$page_bg_header = 'offre';
	//if ($page == 'home')
	//{
	//	$page_bg_header = 'home';
	//}
?>

<div class="bg_header" style="background-image: url('assets/images/bg_header_<?php echo $page_bg_header; ?>.jpg');"></div>
		
<?php include('inc_header_menu_countries_dev.php'); ?>

<?php
// LIEN CONTACT + LIEN PAYS vers mapemonde
?>

<p class="contact right p_contact_country small8">
	<!--CONTACT&nbsp;&nbsp;-->
		<span style="display:inline-block;">
			<a href="site.php?pg=contact&ct=<?php echo $country;?>">
					<span style="text-transform:uppercase;"><?php echo (affiche_texte_dyn('contact_1')); ?></span>
					<!--Contact-->
				</a>
		</span>


	<img src="assets/images/picto_contact.png" class="picto_contact"/>&nbsp;&nbsp;&nbsp;&nbsp;
	<b><a href="index.php"<?php if ($page == 'index'){echo 'style="visibility:hidden;"';} ?>><?php echo $country_name; ?></a></b>
	
	<br/>
	
	<?php
	// TEMPORAIRE LIEN POUR ETRE EDITEUR DU SITE
	// rappel dans site.php en haut
	// if (isset($_GET['statutediteurpsa']) => met ensuite le membre VL en éditeur
	
	if($EDIT_FORCED_AVEC_VL) // voir haut de site.php
	{
		?>
		<a href="site.php?pg=home&ct=france&statut_editeur_xnet">Éditeur</a>
		&bull;
		<a href="site.php?pg=home&ct=france&statut_editeur_xnet_end">Non éditeur</a>
		<?php
	}
	?>
	
</p>
<br/>

<?php
// COURS DE BOURSE
?>
<p class="bleufonce right small8 cours_de_bourse">
	<?php
		include('inc_bourse_dynamique.php');
		//echo $action_psa;
		//echo '<br/>';
		//echo $cac40_new;
		//echo '<br/>';
		//echo $action_psa_pc;
		//echo '<br/>';
		//echo $cac40_pc;
		//echo '<br/>';
	?>
	PEUP.PA
	<?php echo $prefixe_monnaieref; ?><?php echo $action_psa; ?><?php echo $suffixe_monnaieref; ?><!--18,285-->
	(<?php echo $action_psa_pc; ?><?php echo $suffixe_pourcent; ?><!--+0,59%-->)
	<?php
	$updown = 'up';
	if (strpos($action_psa_pc,"-") !== false) // si négatif
	{
		$updown = 'down';
	}
	?>	
	<img src="assets/images/fleche_bourse_<?php echo $updown; ?>.png" class="fleche_bourse" />
	
	<span class="cours_de_bourse_resp_espaces">
		&nbsp;&nbsp;&nbsp;&nbsp;
	</span>
	<span class="cours_de_bourse_resp_br">
		<br/>
	</span>
	
	CAC40 <?php echo $cac40_new; ?><!--5 272,26--> pts (<?php echo $cac40_pc; ?><!---0,86--><?php echo $suffixe_pourcent; ?>)
	<?php
	$updown = 'up';
	if (strpos($cac40_pc,"-") !== false) // si négatif
	{
		$updown = 'down';
	}
	?>	
	<img src="assets/images/fleche_bourse_<?php echo $updown; ?>.png" class="fleche_bourse" />
</p>