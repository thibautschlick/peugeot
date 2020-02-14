<title>
<?php
	if ($page == 'index')
	{
		echo $PAGE_TITLE;
	}
	else
	{
		if ($country == 'france')
		{
			echo $lang['texte_acrs'];
		}
		else		
		{
			echo affiche_texte_dyn('page_title',false);
		}
	}
?>
</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name='robots' content='noindex,nofollow' />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
		
	<?php
		
		// ==============        mettre la date css à jour            ==================
		
		echo '<link rel="stylesheet" href="assets/css/styles_170828.css" />';
		echo '<link rel="stylesheet" href="assets/css/styles_responsive_170823.css" />';
		echo '<link rel="stylesheet" href="assets/css/styles_fonts_170823.css" />';
		// + voir plus bas pour IEDM
		//function ae_detect_ie()
		//{
		
			//=> attention pour IE11, naturellement, pas comme dab, chercher "Trident"
			if (isset($_SERVER['HTTP_USER_AGENT']) && ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) OR (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)))
			{
				//return true;
				echo '<link rel="stylesheet" href="assets/css/styles_iedm.css" />';
			}
		//}
		
		if ($page == 'simuler')
		{
			$js_sim_form_date = array( // pour modifier dans les meta les dates des js en fonction de leurs modifs
				"ad_fcpe"=>"170905", // ok
				"cla_ad"=>"170905", // en dev
				"cla_fcpe"=>"170905", // ok
				"fcpe_fra"=>"170907", // ok
				"fcpe"=>"170905", // ok
			);
			echo '<script type="text/javascript" src="assets/js/simulateur_'.$form.'_'.$js_sim_form_date[$form].'.js"></script>';
			echo '<link rel="stylesheet" href="assets/css/simulateur_170828.css" />';
		}
	?>
	
	<script type="text/javascript" src="assets/js/jquery1.8.2.js"></script>	
	<script type="text/javascript" src="assets/js/jquery-fcshow.js"></script>

	<?php
	
	// STYLES ARIAL, après sim pour que le sim soit modifié aussi	
	$langues_arial = array('ar','cs','cz','gr','hu','jp','pl','ro','sk','tr');
	if (in_array($lg,$langues_arial))
	{
		echo '<link rel="stylesheet" href="assets/css/styles_arial.css" />';
	}
	
	// TINY MCE éditeur pour les textarea
	include_once('inc_meta_tinymce.php');
	?>