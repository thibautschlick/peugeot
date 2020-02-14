<?php

// ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');

$drop_tables = true; // true false

$countries_to_insert = array(
	'belgium_fr',
	'belgium_nlbe',
	'china',
	'france',
);


$textes_to_insert = array(
	array(
		 190,
		'en_savoir_plus_2',
		'<b>POUR EN SAVOIR PLUS :</b>',
	),
	array(
		191,
		'texte_en_savoir_plus',
		'&#8226; Adressez-vous &#224; votre <b>correspondant RH</b><br /> &#8226; Consultez <b>les documents d&#8217;information cl&#233;s pour l&#8217;investisseur (DICI)</b> des fonds',
	),
	array(
		192,
		'avertissement_2',
		'<b>Avertissement</b>',
	),
	array(
		193,
		'texte_avertissement',
		'Vous &#234;tes invit&#233; &#224; consulter le rapport annuel de PSA et les rapports financiers disponibles sur le site Internet de la soci&#233;t&#233; (www.groupe-psa.com) qui contiennent des informations importantes relatives, notamment, &#224; l&#8217;activit&#233; de la soci&#233;t&#233;, &#224; sa strat&#233;gie et &#224; ses objectifs, aux facteurs de risques inh&#233;rents &#224; la soci&#233;t&#233; et &#224; son activit&#233;, ainsi qu&#8217;&#224; ses r&#233;sultats financiers. <br /> <br /> La d&#233;cision de participer &#224; cette offre vous revient enti&#232;rement et reste neutre au regard de votre emploi au sein du Groupe PSA. Les informations contenues dans la pr&#233;sente brochure vous sont communiqu&#233;es &#224; titre d&#8217;information. <br /> <br /> Ni Peugeot SA, ni aucune de ses filiales ne vous donne, ni n&#8217;entend vous donner par la remise dudit document, quelque conseil financier que ce soit ou autre conseil en placement. Les avantages re&#231;us par le biais de cette offre ne seront pas r&#233;put&#233;s faire partie de votre r&#233;mun&#233;ration aux fins du calcul de vos avantages ou droits &#224; venir.',
	),
);


foreach ($countries_to_insert as $ct)
{
	
	$req_str = '';
	
	//ATTENTION remplacer les " par des \" dans le contenu du echo
	
	foreach($textes_to_insert as $txt_array)
	{
		$req_str_ajout =
		"
			INSERT INTO `pages_".$ct."` (`id`, `code_page`, `code_texte`, `contenu_texte`, `time`, `membre`, `doc`, `champ8`) VALUES	
			(".$txt_array[0].", 'contact', '".$txt_array[1]."', '".$txt_array[2]."', 1487318279, 'vlepoivre@b-fly.com', NULL, NULL);
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