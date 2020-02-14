<?php

// ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');

$drop_tables = true; // true false

$countries_to_insert_array = array(
	'argentina'=>array('Argentina','esal','fcpe',true,'hze'),
	'austria'=>array('Austria','de','fcpe',true,'ze',),
	//'belgium_fr'=>array('Belgium (fr)','fr','cla_fcpe',true,'ze'),
	//'belgium_nlbe'=>array('Belgium (fla)','nlbe','cla_fcpe',true,'ze'),
	'brazil'=>array('Brazil','ptbr','fcpe',true,'hze'),
	//'china'=>array('China','cn','cla_fcpe','hze',true,'hze'),
	'france'=>array('France','fr','fcpe_fra',true,'ze'),
	'germany'=>array('Germany','de','ad_fcpe',true,'ze'),
	//'italy'=>array('Italy','it','cla_ad',true,'ze'),
	'netherlands'=>array('Netherlands','nl','fcpe',true,'ze'), // pas passé ? => si, trier par ID dans la bdd
	'poland'=>array('Poland','pl','fcpe',true,'hze'),
	'portugal'=>array('Portugal','pt','fcpe',true,'ze'),
	'slovakia'=>array('Slovakia','sk','fcpe',true,'hze'),
	'spain'=>array('Spain','es','ad_fcpe',true,'ze'),
	'switzerland_de'=>array('Switzerland (de)','de','fcpe',true,'hze'),
	'switzerland_fr'=>array('Switzerland (fr)','fr','fcpe',true,'hze'),
	'uk'=>array('UK','en','fcpe',true,'hze'), // pas passé ? => si, trier par ID dans la bdd
);
$countries_to_insert = array_keys($countries_to_insert_array);

$textes_to_insert = array(
	array(
		'offre', // 0 code_page
		'offre_lesaviezvous', // 1 code_texte
		'Le saviez-vous&nbsp;?', // 2 contenu_texte
	),
);


foreach ($countries_to_insert as $ct)
{
	
	$req_str = '';
	
	//ATTENTION remplacer les " par des \" dans le contenu du echo
	
	foreach($textes_to_insert as $txt_array)
	{
		$code_page = $txt_array[0];
		$code_texte = $txt_array[1];
		$contenu_texte = $txt_array[2];
		
		$req_str_ajout =
		"
			INSERT INTO `pages_".$ct."` (`code_page`, `code_texte`, `contenu_texte`, `time`, `membre`, `doc`, `champ8`) VALUES	
			('".$code_page."', '".$code_texte."', '".$contenu_texte."', 1480000000, 'vlepoivre@b-fly.com', NULL, NULL);
		"; 	// fin $req_str
		
		//echo $req_str_ajout;
		
		$req_str .= $req_str_ajout;
	}
		
		
	
	$req = $GLOBALS['bdd']->prepare($req_str);
	
	if ($req->execute())
	{
		echo 'OK '.$ct;
		echo '<br/>';
	}
	else
	{
		echo '<b>NOT</b> OK '.$ct;
		echo '<br/>';
	}
	
}



?>