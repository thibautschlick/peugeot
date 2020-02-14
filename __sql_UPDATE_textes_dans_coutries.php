<?php

// ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');

$drop_tables = true; // true false

$countries_to_update_array = array(
	'argentina'=>array('Argentina','esal','fcpe',true,'hze'),
	'austria'=>array('Austria','de','fcpe',true,'ze',),
	'belgium_fr'=>array('Belgium (fr)','fr','cla_fcpe',true,'ze'),
	'belgium_nlbe'=>array('Belgium (fla)','nlbe','cla_fcpe',true,'ze'),
	'brazil'=>array('Brazil','ptbr','fcpe',true,'hze'),
	'china'=>array('China','cn','cla_fcpe','hze',true,'hze'),
	'france'=>array('France','fr','fcpe_fra',true,'ze'),
	'germany'=>array('Germany','de','ad_fcpe',true,'ze'),
	'italy'=>array('Italy','it','cla_ad',true,'ze'),
	'netherlands'=>array('Netherlands','nl','fcpe',true,'ze'), // pas passé ? => si, trier par ID dans la bdd
	'poland'=>array('Poland','pl','fcpe',true,'hze'),
	'portugal'=>array('Portugal','pt','fcpe',true,'ze'),
	'slovakia'=>array('Slovakia','sk','fcpe',true,'hze'),
	'spain'=>array('Spain','es','ad_fcpe',true,'ze'),
	'switzerland_de'=>array('Switzerland (de)','de','fcpe',true,'hze'),
	'switzerland_fr'=>array('Switzerland (fr)','fr','fcpe',true,'hze'),
	'uk'=>array('UK','en','fcpe',true,'hze'), // pas passé ? => si, trier par ID dans la bdd
);
$countries_to_update = array_keys($countries_to_update_array);

$textes_to_update = array(
	array(
		// 0 code_texte
		'texte_modalites_forte_demande_p1',
		// 1 contenu_texte
		'Si le montant global d&#233;di&#233; &#224; l&#8217;op&#233;ration est d&#233;pass&#233;, les montants de souscription et/ou le montant d&#8217;abondement brut maximum&#160; pourraient &#234;tre r&#233;duits. Vous pouvez consulter les r&#232;gles de r&#233;duction, en vous reportant &#224;&#160; la brochure accessible en ligne en cliquant sur &#171;&#160;[#1]T&#233;l&#233;charger la documentation[#2]&#160;&#187;.',
	),
);


foreach ($countries_to_update as $ct)
{
	
	$req_str = '';
	
	//ATTENTION remplacer les " par des \" dans le contenu du echo
	
	foreach($textes_to_update as $txt_array)
	{
		$code_texte = $txt_array[0];
		$contenu_texte = $txt_array[1];
		
		$req_str_update =
		"
			UPDATE `pages_".$ct."` SET `contenu_texte` = '".$contenu_texte."' WHERE `code_texte` = '".$code_texte."'
		"; 	// fin $req_str
		
		//echo $req_str_update;
		
		$req_str .= $req_str_update;
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