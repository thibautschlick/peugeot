<?php

// ATTENTION script direct pour modif en BDD

include('_inc_bdd_connect.php');


//[70 %] // ok
//[70%] // ok
//[70&nbsp;%] // non
//
//
//UPDATE `table`
//SET colonne = REPLACE(colonne, 'ed-temp/', '')
//WHERE colonne LIKE '%ed-temp/%';


// 0 NAME  1 LANGUE  2 FORMULE  3 AFFICHAGE_MAPMONDE  4 ze/hze
$countries_to_insert = array(
'argentina'=>array('Argentina','esal','fcpe',true,'hze'),
'austria'=>array('Austria','de','fcpe',false,'ze',),
'belgium_fr'=>array('Belgium (fr)','fr','cla_fcpe',true,'ze'),
'belgium_nlbe'=>array('Belgium (fla)','nlbe','cla_fcpe',true,'ze'),
'brazil'=>array('Brazil','ptal','fcpe',true,'hze'),
'china'=>array('China','cn','cla_fcpe','hze',true,'hze'),
'france'=>array('France','fr','fcpe_fra',true,'ze'),
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
	
	// manuellement dans phpmyadmin =>
	//SELECT * FROM `pages_france` WHERE `contenu_texte` LIKE '%70 %%'
	
	$req_str = "
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '[70 %]', '125 %')
	WHERE contenu_texte LIKE '%[70 \%]%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '[70&nbsp;%]', '125&nbsp;%')
	WHERE contenu_texte LIKE '%[70&nbsp;\%]%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '[70&#160;%]', '125&nbsp;%')
	WHERE contenu_texte LIKE '%[70&#160;\%]%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '70 %', '125 %')
	WHERE contenu_texte LIKE '%70 \%%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '70&#160;%', '125&nbsp;%')
	WHERE contenu_texte LIKE '%70&#160;\%%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '[70%]', '125%')
	WHERE contenu_texte LIKE '%[70\%]%';
	
	UPDATE `pages_".$ct_key."`
	SET contenu_texte = REPLACE(contenu_texte, '70%', '125%')
	WHERE contenu_texte LIKE '%70\%%';


	
	";
	
	$req = $GLOBALS['bdd']->prepare($req_str);
	
	if ($req->execute())
	{
		echo 'modif OK '.$ct_key;
		echo '<br/>';
	}
	else
	{
		echo 'modif <b> NOT</b> OK '.$ct_key;
		echo '<br/>';
	}
	
}

?>

