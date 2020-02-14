<?php

// pour TOTAL CAPITAL => UNUSED , cf plus bas

//switch ($country)
//{
//   case 'france':
//        $country_name = "FRANCE";
//        $iso_ctry = "FRA";
//        $lg = "fr";
//        $monnaie = "€";
//        $monnaieref = "€";
//        $form = 'france';
//        $hze = false;
//        $taux = 1;
//        $salaire = 30000;
//        $versmul = 78;
//        $verssec = 56;
//        $verscla = 73;
//        $rdtgarmul = 1.5;
//        $rdtgarsec = 1.5;
//        $index = 10.3;
//        break;
//}

// pour TOTAL CAPITAL => langues, form, mais pas de monnaies ni de taux (sim en € seulement)

$FORCER_LANGUE_FR = false; // true false

// rappel des formules
/*
ad_fcpe
cla_ad
cla_fcpe
fcpe_fra
fcpe
*/

// 0 NAME  1 LANGUE  2 FORMULE  3 AFFICHAGE_MAPMONDE  4 ze/hze
$countries_CODE_LG_FORM = array(
'argentina'=>array('Argentina','esal','fcpe',true,'hze','ARS',20.48),
'austria'=>array('Austria','de','fcpe',true,'ze','EUR',1.000),
'belgium_fr'=>array('Belgium (fr)','fr','cla_fcpe',true,'ze','EUR',1.000),
'belgium_nlbe'=>array('Belgium (fla)','nlbe','cla_fcpe',true,'ze','EUR',1.000),
'brazil'=>array('Brazil','ptbr','fcpe',true,'hze','BRL',3.74),
'china'=>array('China','cn','cla_fcpe',true,'hze','CNY',7.9),
'france'=>array('France','fr','fcpe_fra',true,'ze','€',1.000),
'germany'=>array('Germany','de','ad_fcpe',true,'ze','EUR',1.000),
'italy'=>array('Italy','it','cla_ad',true,'ze','EUR',1.000),
'netherlands'=>array('Netherlands','nl','fcpe',true,'ze','EUR',1.000),
'poland'=>array('Poland','pl','fcpe',true,'hze','PLN',4.257),
'portugal'=>array('Portugal','pt','fcpe',true,'ze','EUR',1.000),
'slovakia'=>array('Slovakia','sk','fcpe',true,'ze','EUR',1.000),
'spain'=>array('Spain','es','ad_fcpe',true,'ze','EUR',1.000),
'switzerland_de'=>array('Switzerland (de)','de','fcpe',true,'hze','CHF',1.13),
'switzerland_fr'=>array('Switzerland (fr)','fr','fcpe',true,'hze','CHF',1.13),
'uk'=>array('UK','en','fcpe',true,'hze','GBP',0.917),
);

$COUNTRIES_FERMES_POPUP = array(
	'portugal'=>'We are waiting for the CMVM agreement to open the website for Portugal.',
);





?>