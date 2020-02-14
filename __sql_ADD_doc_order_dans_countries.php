<?php

// ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');

$drop_tables = true; // true false

// 0 NAME  1 LANGUE  2 FORMULE  3 AFFICHAGE_MAPMONDE  4 ze/hze
$countries_to_insert = array(
'argentina'=>array('Argentina','esal','fcpe',true,'hze'),
'austria'=>array('Austria','de','fcpe',false,'ze',),
'belgium_fr'=>array('Belgium (fr)','fr','cla_fcpe',true,'ze'),
'belgium_nlbe'=>array('Belgium (fla)','nlbe','cla_fcpe',true,'ze'),
'brazil'=>array('Brazil','ptal','fcpe',true,'hze'),
'china'=>array('China','cn','cla_fcpe','hze',true,'hze'),
//'france'=>array('France','fr','fcpe_fra',true,'ze'),
'germany'=>array('Germany','de','ad_fcpe',false,'ze'),
'italy'=>array('Italy','it','cla_ad',false,'ze'),
'netherlands'=>array('Netherlands','nl','fcpe',true,'ze'),
'poland'=>array('Poland','pl','fcpe',true,'hze'),
'portugal'=>array('Portugal','pt','fcpe',false,'ze'),
'slovakia'=>array('Slovakia','sk','fcpe',true,'hze'),
'spain'=>array('Spain','es','ad_fcpe',false,'ze'),
'switzerland_de'=>array('Switzerland (de)','de','fcpe',false,'hze'),
'switzerland_fr'=>array('Switzerland (fr)','fr','fcpe',false,'hze'),
'uk'=>array('UK','en','fcpe',true,'hze'),
'_changes_history'=>array(),
);

foreach ($countries_to_insert as $ct_key => $ct_array)
{
	
	
	$req_str = "INSERT INTO `pages_".$ct_key."` (`code_page`, `code_texte`, `contenu_texte`, `time`, `membre`) VALUES ('docDOC', 'docDOC_ORDER', '', 1502207711, 'vlepoivre@b-fly.com');";
	
	//if ($drop_tables)
	//{
	//	$req_str .= "
	//		DROP TABLE IF EXISTS `pages_".$ct_key."`;
	//	";
	//}
	
	$req = $GLOBALS['bdd']->prepare($req_str);
	
	if ($req->execute())
	{
		echo 'add OK '.$ct_key;
		echo '<br/>';
	}
	else
	{
		echo 'add <b> NOT</b> OK '.$ct_key;
		echo '<br/>';
	}
	
}

?>