<?php

$_GET['pg'] = 'home';
$_GET['ct'] = 'france';

require_once ('inc_session_setup.php');
require_once ('inc_fonctions.php');
//require_once ('inc_var_globales_countries_list.php'); // listes pays
require_once ('inc_var_globales.php');
require_once ('inc_url_traitement.php');
require_once ('inc_var_globales_ct_lg.php'); // include les variables pour chaque ct et/ou lg, selon le GET ct

//fonctions pour site dynamique
require_once ('_inc_bdd_connect.php');
require_once ('inc_fonctions_dyn.php');




$modifs = array(

array(150, 'side', 'side_left_calendrier_date_4', 'Le 14 d&#233;cembre', 1500274965, 'vlepoivre@b-fly.com', 'france', NULL),
array(151, 'side', 'side_left_calendrier_periode_souscription', 'P&#233;riode de r&#233;tractation / <br /> souscription', 1500277110, 'vlepoivre@b-fly.com', 'france', NULL),
array(152, 'offre', 'offre_p_deux_formules', '<b>Accelerate Classic</b> vous permet de b&#233;n&#233;ficier d&#8217;une d&#233;cote de 20 % sur le prix de l&#8217;action et des dividendes &#233;ventuels. Votre investissement array(apport personnel et abondement re&#231;u dans cette formule) suit l&#8217;&#233;volution du cours de l&#8217;action Peugeot S.A., &#224; la hausse comme &#224; la baisse et est donc expos&#233; &#224; un risque de perte en capital. <br /><br /> <b>Accelerate Secure</b> vous permet d&#8217;investir en toute s&#233;curit&#233;, votre investissement array(apport personnel et abondement re&#231;u dans cette formule) est 100 % garanti<sup>&#65279;</sup>. En contrepartie, vous renoncez &#224; la d&#233;cote, aux dividendes &#233;ventuels et &#224; la totalit&#233; de l&#8217;&#233;ventuelle hausse du cours de l&#8217;action. <br /><br /> <b>Vous pouvez investir dans l&#8217;une ou l&#8217;autre des formules ou panacher votre investissement.</b>', 1500277201, 'vlepoivre@b-fly.com', 'france', NULL),
array(153, 'offre', 'offre_p_deux_formules', '<b>Accelerate Classic</b> vous permet de b&#233;n&#233;ficier d&#8217;une d&#233;cote de 20 % sur le prix de l&#8217;action et des dividendes &#233;ventuels. Votre investissement array(apport personnel et abondement re&#231;u dans cette formule) suit l&#8217;&#233;volution du cours de l&#8217;action Peugeot S.A., &#224; la hausse comme &#224; la baisse et est donc expos&#233; &#224; un risque de perte en capital. <br /><br /> <b>Accelerate Secure</b> vous permet d&#8217;investir en toute s&#233;curit&#233;, votre investissement array(apport personnel et abondement re&#231;u dans cette formule) est 100 % garanti<sup>&#65279;</sup>. En contrepartie, vous renoncez &#224; la d&#233;cote, aux dividendes &#233;ventuels et &#224;&#160;une partie de la hausse &#233;ventuelle&#160;du cours de l&#8217;action. <br /><br /> <b>Vous pouvez investir dans l&#8217;une ou l&#8217;autre des formules ou panacher votre investissement.</b>', 1500277720, 'vlepoivre@b-fly.com', 'france', NULL),
array(154, 'offre', 'offre_footnote_FCPE', '<sup class="sup_bas_de_page">1</sup> Les FCPE propos&#233;s dans cette offre ne sont pas ouverts &#224; la souscription pour les r&#233;sidents des &#201;tats-Unis d&#8217;Am&#233;rique. Pour plus d&#8217;informations, veuillez-vous r&#233;f&#233;rer aux r&#232;glements et aux documents d&#8217;information cl&#233;s pour l&#8217;investisseur des FCPE &#171; ACCELERATE SECURE 2017 &#187; et &#171; ACCELERATE RELAIS 2017 &#187;.', 1500277865, 'vlepoivre@b-fly.com', 'france', NULL),
array(155, 'side', 'side_left_calendrier_periode_souscription', 'P&#233;riode de r&#233;vocation / <br /> souscription', 1500278353, 'vlepoivre@b-fly.com', 'france', NULL),
array(156, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du [22 Septembre 2017 au 09 Octobre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le [9 novembre 2017]</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de souscription / r&#233;vocation : du [10 Novembre 2017 au 13 Novembre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500278377, 'vlepoivre@b-fly.com', 'france', NULL),
array(157, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du [22 Septembre 2017 au 09 Octobre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le [9 novembre 2017]</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;vocation/souscription : du [10 Novembre 2017 au 13 Novembre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500278428, 'vlepoivre@b-fly.com', 'france', NULL),
array(158, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du [22 Septembre 2017 au 09 Octobre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le [9 novembre 2017]</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;vocation/souscription : du [10 Novembre 2017 au 13 Novembre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500278434, 'vlepoivre@b-fly.com', 'france', NULL),
array(159, 'modalites', 'modalites_p_titre_qui_peut_participer', 'Tous les salari&#233;s ayant au moins trois mois d&#8217;anciennet&#233; array(cons&#233;cutifs ou non entre le 1er janvier 2016 et le 13 novembre 2017) et poss&#233;dant un contrat de travail au 13 novembre 2017 avec l’une des soci&#233;t&#233;s du Groupe PSA adh&#233;rente au Plan d’&#233;pargne groupe array(PEG).', 1500278550, 'vlepoivre@b-fly.com', 'france', NULL),
array(160, 'modalites', 'modalites_ss_titre_calendrier_offre', '<b>CALENDRIER</b> DE L&#8217;OFFRE', 1500278580, 'vlepoivre@b-fly.com', 'france', NULL),
array(161, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du 22 Septembre 2017 au 09 Octobre 2017 inclus</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le [9 novembre 2017]</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;vocation/souscription : du [10 Novembre 2017 au 13 Novembre 2017 inclus]</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500278600, 'vlepoivre@b-fly.com', 'france', NULL),
array(162, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du 22 Septembre 2017 au 09 Octobre 2017 inclus</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le 9 Novembre 2017</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;vocation/souscription : du 10 Novembre 2017 au 13 Novembre 2017 inclus</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500278643, 'vlepoivre@b-fly.com', 'france', NULL),
array(163, 'offre', 'offre_p_blocage_conditions', '<b>1.</b> Mariage ou conclusion d&#8217;un PACS, <br /> <b>2.</b> Naissance ou adoption d&#8217;un troisi&#232;me enfant et des enfants suivants, pour autant qu&#8217;il y en ait d&#233;j&#224; deux &#224; charge, <br /> <b>3.</b> Divorce, s&#233;paration ou dissolution d&#8217;un PACS, dans le cas o&#249; vous conservez au moins un enfant mineur dans votre r&#233;sidence habituelle unique ou partag&#233;e, <br /> <b>4.</b> D&#233;c&#232;s du salari&#233;, de son conjoint ou de la personne li&#233;e au b&#233;n&#233;ficiaire par un PACS, <br /> <b>5.</b> Cr&#233;ation ou reprise d&#8217;une entreprise par vous-m&#234;me, votre conjoint, vos enfants ou le b&#233;n&#233;ficiaire du PACS, <br /> <b>6.</b> Acquisition ou agrandissement de la r&#233;sidence principale, r&#233;paration de celle-ci en cas de catastrophe naturelle, <br /> <b>7.</b> Cessation de votre contrat de travail, <br /> <b>8.</b> Invalidit&#233; du salari&#233;, de ses enfants, de son conjoint ou du b&#233;n&#233;ficiaire du PACS, <br /> <b>9.</b> Surendettement.<br /><br />Dans les six premiers cas, vous devez demander le d&#233;blocage au plus tard six mois apr&#232;s l&#8217;&#233;v&#233;nement.<br /> Dans les autres cas, la demande peut &#234;tre faite &#224; tout moment<sup>&#65279;</sup>.', 1500278723, 'vlepoivre@b-fly.com', 'france', NULL),
array(164, 'secure', 'secure_p_garantie_de_investissement', 'Vous avez la garantie &#224; l&#8217;issue des cinq ann&#233;es de blocage ou en cas de d&#233;blocage anticip&#233; de r&#233;cup&#233;rer 100 % de votre investissement array(apport personnel et l&#8217;abondement vers&#233; par le groupe PSA dans la formule Accelerate Secure).', 1500279007, 'vlepoivre@b-fly.com', 'france', NULL),
array(165, 'secure', 'secure_ss_titre_un_gain_potentiel', '<b>Un gain potentiel repr&#233;sentant [70 %] de la hausse moyenne &#233;ventuelle de l&#8217;action PEUGEOT S.A.</b>', 1500279072, 'vlepoivre@b-fly.com', 'france', NULL),
array(166, 'secure', 'secure_footnote_cas_exceptionels', '<sup>1</sup> Sauf dans certains cas exceptionnels de r&#233;siliation de l&#8217;op&#233;ration d&#8217;&#233;change &#224; l&#8217;initiative de la soci&#233;t&#233; de gestion tels que d&#233;crits dans le r&#232;glement du FCPE &#171; ACCELERATE SECURE array(compartiment PSA SECURE 2017) &#187;.', 1500279153, 'vlepoivre@b-fly.com', 'france', NULL),
array(167, 'secure', 'secure_footnote_cas_exceptionels', '<sup>&#160;</sup>', 1500279255, 'vlepoivre@b-fly.com', 'france', NULL),
array(168, 'secure', 'secure_footnote_cas_exceptionels', '<sup>&#160;</sup>', 1500279276, 'vlepoivre@b-fly.com', 'france', NULL),
array(169, 'secure', 'secure_footnote_cas_exceptionels', '<sup>&#160;</sup>', 1500279307, 'vlepoivre@b-fly.com', 'france', NULL),
array(170, 'secure', 'secure_footnote_cours_moyen', '<sup>2</sup> Il s&#8217;agit du cours de moyen de r&#233;f&#233;rence tel que d&#233;fini dans le r&#232;glement du FCPE.', 1500279341, 'vlepoivre@b-fly.com', 'france', NULL),
array(171, 'secure', 'secure_footnote_cours_moyen', '<sup>&#160;</sup>', 1500279359, 'vlepoivre@b-fly.com', 'france', NULL),
array(172, 'offre', 'offre_footnote_FCPE', '<sup class="sup_bas_de_page">1</sup> Les FCPE propos&#233;s dans cette offre ne sont pas ouverts &#224; la souscription pour les r&#233;sidents des &#201;tats-Unis d&#8217;Am&#233;rique. Pour plus d&#8217;informations, veuillez-vous r&#233;f&#233;rer aux r&#232;glements et aux documents d&#8217;information cl&#233;s pour l&#8217;investisseur des FCPE &#171; ACCELERATE SECURE 2017 &#187; et &#171; ACCELERATE RELAIS 2017 &#187;.', 1500279388, 'vlepoivre@b-fly.com', 'france', NULL),
array(173, 'offre', 'offre_footnote_FCPE', '<sup>&#160;</sup>', 1500279412, 'vlepoivre@b-fly.com', 'france', NULL),
array(174, 'offre', 'offre_footnote_cas_de_deces', '&#160;', 1500279452, 'vlepoivre@b-fly.com', 'france', NULL),
array(175, 'offre', 'offre_footnote_cas_exceptionnels', '<sup class="sup_bas_de_page">&#160;</sup>', 1500279607, 'vlepoivre@b-fly.com', 'france', NULL),
array(176, 'classic', 'classic_ancre_choisir_la_formule_classique', '<b>POURQUOI CHOISIR LA FORMULE CLASSIC?</b>', 1500279754, 'vlepoivre@b-fly.com', 'france', NULL),
array(177, 'classic', 'classic_ancre_choisir_la_formule_classique', '<b>POURQUOI CHOISIR LA FORMULE CLASSIC ?</b>', 1500279763, 'vlepoivre@b-fly.com', 'france', NULL),
array(178, 'classic', 'classic_ancre_choisir_la_formule_classique', '<b>POURQUOI CHOISIR&#160;ACCELERATE CLASSIC ?</b>', 1500279812, 'vlepoivre@b-fly.com', 'france', NULL),
array(179, 'classic', 'classic_p_en_souscrivant', 'En souscrivant &#224; la formule Accelerate Classic, vous recevez des parts du FCPE &#171;&#160;ACCELERATE&#160;RELAIS&#160;2017&#160;&#187;.', 1500279839, 'vlepoivre@b-fly.com', 'france', NULL),
array(180, 'classic', 'classic_titre_pourquoi_choisir_la_formule_classique', '<b>POURQUOI CHOISIR LA FORMULE CLASSIC ?</b>', 1500279859, 'vlepoivre@b-fly.com', 'france', NULL),
array(181, 'classic', 'classic_footnote_cas_exceptionels', '<sup>&#160;</sup>', 1500279925, 'vlepoivre@b-fly.com', 'france', NULL),
array(182, 'classic', 'classic_ancre_comprendre_la_formule_classique', '<b>BIEN COMPRENDRE LA FORMULE&#160; CLASSIC</b>', 1500279959, 'vlepoivre@b-fly.com', 'france', NULL),
array(183, 'home', 'home_mot_de_xavier', 'Le mot de Xavier CHEREAU, Directeur des Ressources Humaines&#160;du Groupe PSA', 1500289134, 'vlepoivre@b-fly.com', 'france', NULL),
array(184, 'home', 'home_mot_de_xavier', 'Le mot de Xavier CHEREAU, Directeur des Ressources Humaines&#160;du Groupe PSA', 1500289242, 'vlepoivre@b-fly.com', 'france', NULL),
array(185, 'offre', 'offre_p_au_titre_abondement', 'Quelle que soit la formule choisie, le groupe PSA compl&#232;te votre apport personnel d&#8217;un abondement dans la limite de 450 &#8364; bruts. Il sera vers&#233; net par l&#8217;entreprise apr&#232;s d&#233;duction de la CSG/CRDS, auquel il est soumis, pour &#234;tre investi en net dans la ou les formules auxquelles vous aurez choisi de souscrire array(taux CSG/CRDS en vigueur au 1er septembre 2016 : 8%). <br /> <br />\r\n<table class="table">\r\n<tbody>\r\n<tr class="table_border">\r\n<td class="tableau bleuclair">Taux <br /> d’abondemment</td>\r\n<td class="tableau bleuclair">Pour un apport personnel</td>\r\n<td class="tableau bleuclair">Vous b&#233;n&#233;ficiez d&#8217;un abondement brut maximum de :</td>\r\n</tr>\r\n<tr class="table_border">\r\n<td class="tableau"><strong class="bleufonce">60 % </b></td>\r\n<td class="tableau"><strong class="bleufonce">De 1 &#224; 750 &#8364;</b></td>\r\n<td class="tableau"><strong class="bleuclair">60 % x 750 &#8364; = <strong class="bleufonce">450 &#8364;</b></b></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<br />\r\n<p class="small9_unuzed">L&#8217;abondement maximum correspond &#224; un versement de 750 &#8364; ; au-del&#224;, votre versement n&#8217;est plus abond&#233;. Pour un versement de 750&#8364;, le montant de l&#8217;investissement sera : 750&#8364; + 450&#8364; &#8211; array(8%*450&#8364;), soit 1164&#8364; net. <br /><br />', 1500289496, 'vlepoivre@b-fly.com', 'france', NULL),
array(186, 'modalites', 'modalites_p_calendrier_offre', '<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;servation : du 22 Septembre 2017 au 9 Octobre 2017 inclus</b></h3>\r\n<p class="small9">Vous pouvez effectuer votre r&#233;servation en ligne en cliquant sur le bouton &#171; Souscrire &#187;. Le prix de souscription est inconnu au moment o&#249; vous effectuez votre r&#233;servation. Vous investissez un montant en euros. Le nombre de parts souscrites gr&#226;ce &#224; votre investissement sera d&#233;termin&#233; en fonction du Prix de Souscription.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>Fixation du Prix de Souscription : le 9 Novembre 2017</b></h3>\r\n<p class="small9">Le Prix de Souscription vous sera communiqu&#233; via le site, par e-mail et par voie d&#8217;affichage. Inscrivez-vous d&#232;s maintenant dans le module &#171; Recevoir les alertes e-mail &#187; pr&#233;vu pour recevoir le Prix de Souscription par e-mail.\r\n<h3 class="bleuclair"><img class="picto_volant" src="assets/images/picto_volant_bleuclair.png" /> <b>P&#233;riode de r&#233;vocation/souscription : du 10 Novembre 2017 au 13 Novembre 2017 inclus</b></h3>\r\n<p class="small9">Vous pouvez annuler 100 % de votre r&#233;servation en ligne en cliquant sur &#171; Souscrire &#187;. La r&#233;vocation ne peut porter que sur la totalit&#233; de votre demande de r&#233;servation. Si vous n&#8217;avez pas r&#233;serv&#233;, vous avez toujours la possibilit&#233; de souscrire durant cette p&#233;riode, toutefois le montant maximum que vous pouvez investir est alors r&#233;duit : il ne pourra exc&#233;der 2,5 % de votre r&#233;mun&#233;ration annuelle brute, en lieu et place du plafond de 25 % tel que d&#233;fini ci-dessus. <br /> &#192; l&#8217;issue de cette p&#233;riode et en l&#8217;absence de r&#233;vocation, si vous avez r&#233;serv&#233;, votre r&#233;servation sera consid&#233;r&#233;e comme une souscription d&#233;finitive et irr&#233;vocable.', 1500289742, 'vlepoivre@b-fly.com', 'france', NULL),
array(187, 'offre', 'offre_ss_titre_au_titre_abondement', 'JUSQU&#8217;&#192; 450 &#8364; BRUT VERS&#201;S AU TITRE DE L&#8217;ABONDEMEN', 1500972496, 'vlepoivre@b-fly.com', 'france', NULL),
array(188, 'offre', 'offre_ss_titre_au_titre_abondement', 'JUSQU&#8217;&#192; 450 &#8364; BRUT VERS&#201;S AU TITRE DE L&#8217;ABONDEMENT', 1500972532, 'vlepoivre@b-fly.com', 'france', NULL),
array(189, 'home', 'home_souscrivez_au_plan', 'SOUSCRIVEZ AU PLAN D’ACTIONNARIAT<br />R&#201;SERV&#201; AUX SALARI&#201;S<br />DU GROUPE PS', 1501075419, 'vlepoivre@b-fly.com', 'france', NULL),
array(190, 'home', 'home_souscrivez_au_plan', 'SOUSCRIVEZ AU PLAN D’ACTIONNARIAT<br />R&#201;SERV&#201; AUX SALARI&#201;S<br />DU GROUPE PSA', 1501075440, 'vlepoivre@b-fly.com', 'france', NULL),
array(191, 'home', 'home_partagez_nos_valeurs', 'PARTAGEZ NOS VALEUR', 1501142804, 'vlepoivre@b-fly.com', 'france', NULL),
array(192, 'home', 'home_partagez_nos_valeurs', 'PARTAGEZ NOS VALEURS', 1501142830, 'vlepoivre@b-fly.com', 'france', NULL),

); // fin array modifs

echo '<table>';

foreach($modifs as $modif)
{
    $id = $modif[0];
    $code_page = $modif[1];
    $code_texte = $modif[2];
    $contenu_texte = $modif[3];
    $time = $modif[4];
    $membre = $modif[5];
    $country = $modif[6];
    $doc = $modif[7];
	
	$get_text = $code_texte;
	$text_new_content = $contenu_texte;
	$contenu_texte = str_replace('array(','(',$contenu_texte);
	$contenu_texte = str_replace('\r\n','',$contenu_texte);
	
		
	
	if (update_texte_dyn($get_text,$contenu_texte))
	{
		echo '<tr>';
			echo '<td style="color:green;">';
			echo 'OK';
			echo '</td>';
			echo '<td>';
			echo $get_text;
			echo '</td>';
			echo '<td>';
			echo htmlspecialchars($contenu_texte);
			echo '</td>';
		echo '</tr>';
	}
	else
	{
		echo '<tr>';
			echo '<td>';
			echo '<b style="color:red;">NOT OK</b>';
			echo '</td>';
			echo '<td>';
			echo $get_text;
			echo '</td>';
			echo '<td>';
			echo htmlspecialchars($contenu_texte);
			echo '</td>';
		echo '</tr>';
	}
	
	
    //
    //echo '<tr>';
    //    //echo '<td>';
    //    //echo $id;
    //    //echo '</td>';
    //    //echo '<td>';
    //    //echo $code_page;
    //    //echo '</td>';
    //    echo '<td>';
    //    echo $code_texte;
    //    echo '</td>';
    //    echo '<td style="width:50%;">';
    //    echo htmlspecialchars($contenu_texte);
    //    echo '</td>';
    //    echo '<td>';
    //    echo date('H:i:s, j-m-y',$time);
    //    echo '</td>';
    //    //echo '<td>';
    //    //echo $membre;
    //    //echo '</td>';
    //    //echo '<td>';
    //    //echo $country;
    //    //echo '</td>';
    //echo '</tr>';
}

echo '</table>';

?>