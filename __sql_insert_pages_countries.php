<?php

// ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');

$drop_tables = true; // true false

$countries_to_insert = array(
'argentina',
'australia',
'austria',
'belgium_fr',
'belgium_nlbe',
'brazil',
'bulgaria',
'canada_en',
'canada_fr',
'china',
'colombia',
'czechrepublic',
'denmark',
'estonia',
'finland',
'germany',
'hungary',
'india',
'indonesia',
'ireland',
'italy',
'japan',
'latvia',
'lithuania',
'luxembourg',
'malaysia',
'mexico',
'netherlands',
'norway',
'poland',
'portugal',
'romania',
'serbia',
'singapore',
'slovakia',
'southafrica',
'southkorea',
'spain',
'sweden',
'switzerland_de',
'switzerland_fr',
'switzerland_it',
'thailand',
'turkey',
'uk',
'zimbabwe',
);

foreach ($countries_to_insert as $ct)
{
	
	
	$req_str = '';
	
	if ($drop_tables)
	{
		$req_str .= "
			DROP TABLE IF EXISTS `pages_".$ct."`;
		";
	}
	
	//ATTENTION remplacer les " par des \" dans le contenu du echo
	
    $req_str .= "

CREATE TABLE IF NOT EXISTS `pages_".$ct."` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `code_page` varchar(512) NOT NULL,
  `code_texte` varchar(512) NOT NULL,
  `contenu_texte` text NOT NULL,
  `time` int(16) DEFAULT NULL,
  `membre` varchar(512) DEFAULT NULL,
  `doc` varchar(1024) DEFAULT NULL,
  `champ8` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_texte` (`code_texte`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182 ;


INSERT INTO `pages_".$ct."` (`id`, `code_page`, `code_texte`, `contenu_texte`, `time`, `membre`, `doc`, `champ8`) VALUES



(1, 'home', 'home_quizz_titre', 'QUIZ', 1487318279, 'vlepoivre@b-fly.com', NULL, NULL),
(2, 'home', 'home_quizz_contenu1', 'So you think you know everything about the PEG?', 1487318818, 'vlepoivre@b-fly.com', NULL, NULL),
(3, 'home', 'home_quizz_btn_participer', 'Participate', 1487318855, 'vlepoivre@b-fly.com', NULL, NULL),
(4, 'home', 'home_btn_decouvrir', 'Discover', 1487318891, 'vlepoivre@b-fly.com', NULL, NULL),
(5, 'home', 'home_quizz_contenu2', 'Test your knowledge of the PEG.', 1487318915, 'vlepoivre@b-fly.com', NULL, NULL),
(6, 'home', 'home_30ans_titre', '<b>The PEG</b> celebrates <br />its <b>30<sup>th</sup> anniversary</b> in 2017!', 1487319100, 'vlepoivre@b-fly.com', NULL, NULL),
(7, 'home', 'home_30ans_contenu', 'This year, the PEG will be celebrating its 30th anniversary. Every year for the past 30 years, our Group has been offering its employees the opportunity to share in its expansion via its employee shareholder program. Tens of thousands of employees, proud to belong to our Group and confident in its strategy, have thus invested in Saint-Gobain making them, after 30 years, the Group''s largest shareholder.<br /><b>To mark this occasion, the Group has decided to offer a special additional employer''s contribution. For an initial investment of &euro;30, the existing employer''s contribution will be topped up to &euro;30.</b><br /><b>We hope many of you take part this year!</b>', 1487319480, 'vlepoivre@b-fly.com', NULL, NULL),
(12, 'home', 'home_bloc_epargnesg_contenu', '<span id=\"result_box\" class=\"\" lang=\"en\" tabindex=\"-1\"><span class=\"\">Everything you need to know about Groupe Savings Plan at Saint-Gobain</span></span>', 1487320853, 'vlepoivre@b-fly.com', NULL, NULL),
(10, 'home', 'home_bloc_docs_contenu', 'See all useful documents: Brochure, forms, key informations, regulations...', 1487320697, 'vlepoivre@b-fly.com', NULL, NULL),
(11, 'home', 'home_bloc_docs_titre', '<b>2017 DOCUMENTS</b>', 1487320737, 'vlepoivre@b-fly.com', NULL, NULL),
(13, 'home', 'home_bloc_epargnesg_titre', '<b>SAINT-GOBAIN GROUP GSP<br /></b>', 1487320885, 'vlepoivre@b-fly.com', NULL, NULL),
(14, 'home', 'home_bloc_dates_titre', '<b>KEY DATES OF THE OFFER</b>', 1487320913, 'vlepoivre@b-fly.com', NULL, NULL),
(15, 'home', 'home_bloc_dates_contenu', '<b>From Feb. 20 to March 17, 2017</b> <br />Reference price setting period &nbsp; <br /><br /><b>March 20, 2017</b> <br />Fixing of the subscription price &nbsp; <br /><br /><b>From March 20 to April 3, 2017</b> <br />Subscription period', 1487321110, 'vlepoivre@b-fly.com', NULL, NULL),
(16, 'home', 'home_bloc_dates_btn', 'See all dates', 1487321375, 'vlepoivre@b-fly.com', NULL, NULL),
(17, 'trenteans', 'trenteans_titre_orange', '<b>30 YEARS IN 2017<br /></b>', 1487321947, 'vlepoivre@b-fly.com', NULL, NULL),
(18, 'trenteans', 'trenteans_titre_30ans', '<b>30 YEARS!</b>', 1487322164, 'vlepoivre@b-fly.com', NULL, NULL),
(19, 'trenteans', 'trenteans_titre_contenu', 'Every year for the past 30 years, our Group has been offering its employees the opportunity to share in its expansion via its employee shareholder program. Tens of thousands of employees, proud to belong to our Group and confident in its strategy, have thus invested in Saint-Gobain making them, after 30 years, the Group''s largest shareholder.<br />I would therefore like to thank you all for having placed your trust in us year after year.<br />This 30<sup>th</sup> PEG operation, renewed this year by our Group''s Board of Management, deserves to be special.<br />To celebrate this anniversary, the Board of Management has decided to raise the ceiling to 6 million shares, an increase of nearly 30% on last year''s subscription.<br />This 30<sup>th</sup> edition will, as usual, give you an opportunity to take part in this capital increase under attractive tax and financial conditions, in particular with a 20% discount on the Saint-Gobain reference share price.<br />I also wanted each and every one of you to be able to take part in this 30th operation. An exceptional employer''s contribution of &euro;30 will be paid. This means that for an initial investment of &euro;30, the existing employer''s contribution will be topped up to &euro;30.<br />We hope this new operation will enable all employees, whatever their income or country, to share in the capital of our Group and benefit from the fruits of its performance.<br /><br />On this anniversary date, we are looking to the future; a future that we wish to build together over the next 30 years!<br /><br /><b>Pierre-Andr&eacute; de Chalendar</b><br />Chief Executive Officer of Saint-Gobain', 1487322215, 'vlepoivre@b-fly.com', NULL, NULL),
(20, 'trenteans', 'trenteans_temoignages_titre', '<b>VIDEO TESTIMONIALS</b>', 1487322392, 'vlepoivre@b-fly.com', NULL, NULL),
(21, 'trenteans', 'trenteans_temoignages_contenu', '<b>The PEG &amp; you, 30 years of trust!</b>', 1487322420, 'vlepoivre@b-fly.com', NULL, NULL),
(22, 'trenteans', 'trenteans_quizz_titre', '<b>QUIZ</b>', 1487322480, 'vlepoivre@b-fly.com', NULL, NULL),
(23, 'trenteans', 'trenteans_quizz_vouspensez', '<em>So you think you know everything about the PEG? Test your knowledge by ticking the right answers to the questions! On your mouse, get set, go!</em>', 1487322853, 'vlepoivre@b-fly.com', NULL, NULL),
(24, 'trenteans', 'trenteans_quizz_uneseulebonne', '<span id=\"result_box\" class=\"short_text\" lang=\"en\" tabindex=\"-1\"><span class=\"\">(Only one correct answer per question.)</span></span>', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(25, 'trenteans', 'quiz_question', 'Question', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(26, 'trenteans', 'quiz_oui', '<span id=\"result_box\" class=\"\" lang=\"en\" tabindex=\"-1\"><span class=\"\">Yes, the correct answer is:</span></span>', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(27, 'trenteans', 'quiz_non', '<span id=\"result_box\" class=\"\" lang=\"en\" tabindex=\"-1\"><span class=\"\">No, the correct answer is:</span></span>', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(28, 'trenteans', 'quiz_q1', 'The Saint-Gobain PEG began in:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(29, 'trenteans', 'quiz_q1_r1', '1987', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(30, 'trenteans', 'quiz_q1_r2', '1988', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(31, 'trenteans', 'quiz_q1_r3', '1989', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(32, 'trenteans', 'quiz_q1_reponse', 'After being nationalised in 1982, Saint-Gobain was privatised in 1986 and less than 2 years later, launched its first employee shareholder program.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(33, 'trenteans', 'quiz_q2', 'Since it was created, the PEG has been offered each year:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(34, 'trenteans', 'quiz_q2_r1', 'True', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(35, 'trenteans', 'quiz_q2_r2', 'False', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(36, 'trenteans', 'quiz_q2_reponse', 'Saint-Gobain is one of the few major international groups to have offered a shareholder program to its employees every year for 30 years.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(37, 'trenteans', 'quiz_q3', 'In 2016, the PEG was available in:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(38, 'trenteans', 'quiz_q3_r1', '30 countries', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(39, 'trenteans', 'quiz_q3_r2', '34 countries', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(40, 'trenteans', 'quiz_q3_r3', '41 countries', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(41, 'trenteans', 'quiz_q3_reponse', 'Year after year, the PEG is made available in an increasing number of the countries in which Saint-Gobain is established, depending on local legislation.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(42, 'trenteans', 'quiz_q4', 'In 2016, the number of PEG subscribers was:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(43, 'trenteans', 'quiz_q4_r1', '28,165', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(44, 'trenteans', 'quiz_q4_r2', '30,849', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(45, 'trenteans', 'quiz_q4_r3', '32,896', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(46, 'trenteans', 'quiz_q4_reponse', 'On a comparable basis, the number of subscribers is up 3.5% on the previous year and up nearly 18% outside of France.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(47, 'trenteans', 'quiz_q5', 'At the end of 2016, employees, who are the Group''s leading shareholder, owned:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(48, 'trenteans', 'quiz_q5_r1', '7.7% of voting rights', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(49, 'trenteans', 'quiz_q5_r2', '10.8% of voting rights', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(50, 'trenteans', 'quiz_q5_r3', '12.7% of voting rights', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(51, 'trenteans', 'quiz_q5_reponse', 'In 2016, shareholding employees became the Group''s leading shareholder, owning 7.7% of share capital.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(52, 'trenteans', 'quiz_q6', 'In 2016, the PEG subscription represented nearly:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(53, 'trenteans', 'quiz_q6_r1', '101 million euros', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(54, 'trenteans', 'quiz_q6_r2', '128 million euros', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(55, 'trenteans', 'quiz_q6_r3', '137 million euros', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(56, 'trenteans', 'quiz_q6_reponse', 'On a comparable basis, the amount of subscriptions in Euros was up 6% on the previous year.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(57, 'trenteans', 'quiz_q7', 'The discount on the reference price is:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(58, 'trenteans', 'quiz_q7_r1', '10%', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(59, 'trenteans', 'quiz_q7_r2', '15%', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(60, 'trenteans', 'quiz_q7_r3', '20%', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(61, 'trenteans', 'quiz_q7_reponse', 'This is the maximum authorised percentage discount for a 5-year lock-in period.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(62, 'trenteans', 'quiz_q8', 'The number of people holding PEG shares at the end of 2016 is around:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(63, 'trenteans', 'quiz_q8_r1', '60 000', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(64, 'trenteans', 'quiz_q8_r2', '75 000', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(65, 'trenteans', 'quiz_q8_r3', '80 000', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(66, 'trenteans', 'quiz_q8_reponse', 'Year after year, the number of people holding shares has been continually increasing with new subscriptions, as well as with the increased number of countries in which the PEG is offered.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(67, 'trenteans', 'quiz_q9', 'The ceiling for voluntary payments into the PEG is:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(68, 'trenteans', 'quiz_q9_r1', '20% of gross annual remuneration', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(69, 'trenteans', 'quiz_q9_r2', '25% of gross annual remuneration', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(70, 'trenteans', 'quiz_q9_r3', '30% of gross annual remuneration', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(71, 'trenteans', 'quiz_q9_reponse', 'This legal ceiling only applies to voluntary payments and does not include the employer''s contribution.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(72, 'trenteans', 'quiz_q10', 'The Group pays PEG management and account holder fees:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(73, 'trenteans', 'quiz_q10_r1', 'True', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(74, 'trenteans', 'quiz_q10_r2', 'False', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(75, 'trenteans', 'quiz_q10_reponse', 'Saint-Gobain pays all financial and administrative management fees for employees and previous employees.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(76, 'trenteans', 'quiz_q11', 'PEG subscribers benefit from any dividends paid out to shareholders:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(77, 'trenteans', 'quiz_q11_r1', 'True', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(78, 'trenteans', 'quiz_q11_r2', 'False', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(79, 'trenteans', 'quiz_q11_reponse', 'PEG subscribers benefit from any dividends paid out to shareholder.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(80, 'trenteans', 'quiz_q12', 'The PEG reference price is the average of the opening share prices of the:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(81, 'trenteans', 'quiz_q12_r1', '10&nbsp;sessions preceding subscription', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(82, 'trenteans', 'quiz_q12_r2', '20&nbsp;sessions preceding subscription', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(83, 'trenteans', 'quiz_q12_r3', '30 sessions preceding subscription', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(84, 'trenteans', 'quiz_q12_reponse', 'This average has been set by law, thus reflecting the stock market value of Saint-Gobain shares.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(85, 'trenteans', 'quiz_q13', '&nbsp;The minimum number of months/years of service required for subscribing to the PEG is:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(86, 'trenteans', 'quiz_q13_r1', '3 months', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(87, 'trenteans', 'quiz_q13_r2', '1 year', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(88, 'trenteans', 'quiz_q13_r3', '3 years', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(89, 'trenteans', 'quiz_q13_reponse', 'This is the number of months of service with the Group as assessed on the closure of the subscription period. It takes into account all employment contracts fulfilled during the year of payment and the 12 months preceding payment.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(90, 'trenteans', 'quiz_q14', 'Employee shareholders have a representative on the Group''s Board of Management:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(91, 'trenteans', 'quiz_q14_r1', 'True', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(92, 'trenteans', 'quiz_q14_r2', 'False', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(93, 'trenteans', 'quiz_q14_reponse', 'A member of one of the two employee mutual fund Supervisory Boards is appointed by the Group Shareholder Meeting to represent employee shareholders on the Group''s Board of Management.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(94, 'trenteans', 'quiz_q15', 'The employee mutual fund Supervisory Boards vote on resolutions at Group Shareholder Meetings:', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(95, 'trenteans', 'quiz_q15_r1', 'True', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(96, 'trenteans', 'quiz_q15_r2', 'False', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(97, 'trenteans', 'quiz_q15_reponse', 'The members of the two employee mutual fund Supervisory Boards hold an internal vote prior to Shareholder Meetings and a representative for each Supervisory Board carries these votes forward to Group Annual General Meetings.', 1487322866, 'vlepoivre@b-fly.com', NULL, NULL),
(98, 'peg', 'peg_comprendre_titre', 'UNDERSTAND THE OFFER <b>IN 2 MINUTES</b>', 1487327955, 'vlepoivre@b-fly.com', NULL, NULL),
(99, 'peg', 'peg_calendrier_titre', '<b>AGENDA</b> OF THE OFFER', 1487328139, 'vlepoivre@b-fly.com', NULL, NULL),
(100, 'peg', 'peg_calendrier_contenu', '<b>From Feb. 20 to March 17, 2017</b> <br />Reference price setting period &nbsp; <br /><br /><b>March 20, 2017</b> <br />Fixing of the subscription price &nbsp; <br /><br /><b>From March 20 to April 3, 2017</b> <br />Subscription period<br /><br /><b>May 17, 2017</b><br />Capital increase<br /><br /><b>June 8, 2017</b><br />Annual General Meeting of Compagnie de Saint-Gobain shareholders', 1487328152, 'vlepoivre@b-fly.com', NULL, NULL),
(101, 'peg', 'peg_prixreference_prixsous_titre', 'SUBSCRIPTION PRICE FOR THE <b>PEG </b>(GROUP SAVINGS PLAN) 2017', 1487329249, 'vlepoivre@b-fly.com', NULL, NULL),
(102, 'peg', 'peg_prixreference_prixsous_contenu1', 'On 21/03/2016, as delegated by the Executive Board of Saint-Gobain, the Chairman and Chief Executive Officer closed the share reference price and subscription price for the PEG&nbsp;2016:', 1487329259, 'vlepoivre@b-fly.com', NULL, NULL),
(107, 'peg', 'peg_prixreference_prixsous_contenu6', 'SUBSCRIPTION PERIOD: from 21<sup>st</sup> March, 2016 to 6<sup>th</sup> April, 2016', 1487329410, 'vlepoivre@b-fly.com', NULL, NULL),
(103, 'peg', 'peg_prixreference_prixsous_contenu2', 'Reference price:', 1487329295, 'vlepoivre@b-fly.com', NULL, NULL),
(104, 'peg', 'peg_prixreference_prixsous_contenu3', 'Average initial listed rates for the Saint-Gobain share on the 20 trading sessions preceding the 21/03/2016.', 1487329306, 'vlepoivre@b-fly.com', NULL, NULL),
(105, 'peg', 'peg_prixreference_prixsous_contenu4', 'Subscription price:', 1487329314, 'vlepoivre@b-fly.com', NULL, NULL),
(106, 'peg', 'peg_prixreference_prixsous_contenu5', 'I.E. 80% of the reference price.', 1487329323, 'vlepoivre@b-fly.com', NULL, NULL),
(108, 'peg', 'peg_prixreference_prixsous_contenu7', '21/03/2016 : <br /> Opening of the subscription period for all countries <br /> 6/04/2016 : <br /> End of the subscription period for all countries', 1487329428, 'vlepoivre@b-fly.com', NULL, NULL),
(109, 'peg', 'peg_prixreference_courbes_titre', 'FIXATION OF THE REFERENCE PRICE', 1487329507, 'vlepoivre@b-fly.com', NULL, NULL),
(110, 'peg', 'peg_prixreference_courbes_contenu', 'Follow daily from February 20 to March 17, 2017 the evolution of the Saint-Gobain stock for determining the subscription price.<br /><br />Legend:<br /><b>A)</b> 20 opening share prices<br /><b>B)</b> Opening share prices<br /><b>C)</b> Reference price&nbsp; (at the date of last opening share price displayed) = opening share prices average (price before discount)<br /><b>D)</b> Days of the reference period', 1487329637, 'vlepoivre@b-fly.com', NULL, NULL),
(111, 'epargnesg', 'epargnesg_historique_titre', 'GROUP SAVINGS PLAN &ndash; HISTORICAL DATA', 1487332690, 'vlepoivre@b-fly.com', NULL, NULL),
(112, 'epargnesg', 'epargnesg_documentation_titre', 'DOCUMENTS', 1487333012, 'vlepoivre@b-fly.com', NULL, NULL),
(113, 'epargnesg', 'epargnesg_documentation_sstitre_inter', 'KIID (Key Investor Information Document) &amp; REGULATIONS OF &laquo; SAINT-GOBAIN PEG MONDE &raquo;', 1487333166, 'vlepoivre@b-fly.com', NULL, NULL),
(114, 'correspondant', 'correspondant_titre', 'CORRESPONDENT WEBSITE', 1487333335, 'vlepoivre@b-fly.com', NULL, NULL),
(115, 'correspondant', 'correspondant_accedez', '<span id=\"result_box\" class=\"short_text\" lang=\"en\" tabindex=\"-1\">Go to the page dedicated to PEG on the <b>My Saint-Gobain</b> site:</span>', 1487333355, 'vlepoivre@b-fly.com', NULL, NULL),
(116, 'correspondant', 'correspondant_attention', '(Please note: site accessible only via a Saint-Gobain connection)', 1487333433, 'vlepoivre@b-fly.com', NULL, NULL),
(117, 'contact', 'contact_titre', 'CONTACT', 1487334393, 'vlepoivre@b-fly.com', NULL, NULL),
(118, 'contact', 'contact_votre_correspondant', 'YOUR SAINT-GOBAIN PEG CORRESPONDENT', 1487334416, 'vlepoivre@b-fly.com', NULL, NULL),
(119, 'contact', 'contact_selectacountry', 'Please select a country', 1487334502, 'vlepoivre@b-fly.com', NULL, NULL),
(120, 'contact', 'contact_practicalinfos_titre', 'PRACTICAL INFORMATION', 1487334558, 'vlepoivre@b-fly.com', NULL, NULL),
(121, 'contact', 'contact_practicalinfos_contenu', '<b>How to find out more?</b><br /><br />\r\n<ul style=\"list-style-type: disc;\">\r\n<li>Call centre: You may reach your corresponding call centre (the different phone numbers correspond to the language spoken) from 8:30 am to 5:30 pm Monday through Friday to answer any questions you may have and help guide you through the process.</li>\r\n<li><a href=\"http://www.amundi-ee.com\" target=\"_blank\">www.amundi-ee.com</a> website: Free access to your employee savings accounts is provided 24-7.</li>\r\n<li>Your Saint-Gobain representative: Your Saint-Gobain Group Savings Plan (PEG) correspondent.</li>\r\n</ul>', 1487334603, 'vlepoivre@b-fly.com', NULL, NULL),
(122, 'menu', 'menu__groupe', 'THE GROUP', 1487337962, 'vlepoivre@b-fly.com', NULL, NULL),
(123, 'menu', 'menu__home', 'HOME', 1487337973, 'vlepoivre@b-fly.com', NULL, NULL),
(124, 'menu', 'menu__groupe_resultats', 'Results', 1487338018, 'vlepoivre@b-fly.com', NULL, NULL),
(125, 'menu', 'menu__groupe_bourse', 'Stock information', 1487338030, 'vlepoivre@b-fly.com', NULL, NULL),
(126, 'menu', 'menu__groupe_publications', 'Corporate publications', 1487338039, 'vlepoivre@b-fly.com', NULL, NULL),
(127, 'menu', 'menu__groupe_calendrier', 'Agenda', 1487338048, 'vlepoivre@b-fly.com', NULL, NULL),
(128, 'menu', 'menu__trenteans', 'PEG 30<sup>TH</sup> <br />ANNIVERSARY', 1487338059, 'vlepoivre@b-fly.com', NULL, NULL),
(129, 'menu', 'menu__peg2017', '2017 PEG', 1487338115, 'vlepoivre@b-fly.com', NULL, NULL),
(130, 'menu', 'menu__peg_comprendre', 'Understand the offer in 2 mn', 1487338125, 'vlepoivre@b-fly.com', NULL, NULL),
(131, 'menu', 'menu__peg_calendrier', 'Offer agenda', 1487338140, 'vlepoivre@b-fly.com', NULL, NULL),
(132, 'menu', 'menu__peg_prixreference', 'Subscription price', 1487338151, 'vlepoivre@b-fly.com', NULL, NULL),
(133, 'menu', 'menu__peg_simulateurs', 'Simulate your investment', 1487338163, 'vlepoivre@b-fly.com', NULL, NULL),
(134, 'menu', 'menu__peg_documentationpeg', '2017 documents', 1487338174, 'vlepoivre@b-fly.com', NULL, NULL),
(135, 'menu', 'menu__peg_souscrire', 'Subscribe to the 2017 PEG', 1487338195, 'vlepoivre@b-fly.com', NULL, NULL),
(136, 'menu', 'menu__epargnechezsg', 'SAINT-GOBAIN<br /> GROUP SAVINGS PLAN', 1487338205, 'vlepoivre@b-fly.com', NULL, NULL),
(137, 'menu', 'menu__epargnesg_informations', 'General informations', 1487338399, 'vlepoivre@b-fly.com', NULL, NULL),
(138, 'menu', 'menu__epargnesg_historique', 'Historical data', 1487338413, 'vlepoivre@b-fly.com', NULL, NULL),
(139, 'menu', 'menu__epargnesg_documentationepargne', 'Documents', 1487338429, 'vlepoivre@b-fly.com', NULL, NULL),
(140, 'peg', 'peg_documentationpeg_titre', '2017 DOCUMENTS', 1487338574, 'vlepoivre@b-fly.com', NULL, NULL),
(141, 'menu', 'menu__epargnesg_suivreepargne', 'Track your employee savings', 1487339941, 'vlepoivre@b-fly.com', NULL, NULL),
(142, 'menu', 'menu__epargne', 'L&rsquo;&Eacute;PARGNE<br />SALARIALE', 1487339954, 'vlepoivre@b-fly.com', NULL, NULL),
(143, 'menu', 'menu__epargne_toutcomprendre', 'Tout comprendre sur l&rsquo;&eacute;pargne salariale', 1487339999, 'vlepoivre@b-fly.com', NULL, NULL),
(144, 'menu', 'menu__epargne_deblocage', 'Le d&eacute;blocage anticip&eacute;', 1487340009, 'vlepoivre@b-fly.com', NULL, NULL),
(145, 'menu', 'menu__correspondant', 'CORRESPONDENTS <br />WEBSITE', 1487340019, 'vlepoivre@b-fly.com', NULL, NULL),
(146, 'menu', 'menu__contact', 'CONTACT', 1487340031, 'vlepoivre@b-fly.com', NULL, NULL),
(148, 'sideleft', 'sideleft__peg_comprendre', 'UNDERSTAND', 1487342829, 'vlepoivre@b-fly.com', NULL, NULL),
(147, 'page', 'page_title', 'Saint-Gobain | 2017 PEG', 1487342157, 'vlepoivre@b-fly.com', NULL, NULL),
(149, 'sideleft', 'sideleft__peg_simulateurs', 'SIMULATE', 1487343077, 'vlepoivre@b-fly.com', NULL, NULL),
(150, 'sideleft', 'sideleft__peg_souscrire', 'SUBSCRIBE', 1487343085, 'vlepoivre@b-fly.com', NULL, NULL),
(151, 'sideleft', 'sideleft__correspondant', 'CORRESPONDENTS', 1487343094, 'vlepoivre@b-fly.com', NULL, NULL),
(152, 'sideleft', 'sideleft__contact', 'CONTACTS', 1487343108, 'vlepoivre@b-fly.com', NULL, NULL),
(153, 'sideleft', 'sideleft__groupe_bourse', 'STOCK MARKET', 1487343115, 'vlepoivre@b-fly.com', NULL, NULL),
(154, 'peg', 'peg_prixreference_titre', 'SUBSCRIPTION PRICE', 1487586306, 'vlepoivre@b-fly.com', NULL, NULL),
(155, 'widget', 'widget_periode_date2', '<b>03</b><br />APRIL<br />2017', 1487681360, 'mlaunay@b-fly.com', NULL, NULL),
(156, 'widget', 'widget_periode', 'SUBSCRIPTION PERIOD', 1487681416, 'mlaunay@b-fly.com', NULL, NULL),
(157, 'widget', 'widget_periode_date1', '<b>20</b><br />MARCH<br />2017', 1487681427, 'mlaunay@b-fly.com', NULL, NULL),
(158, 'widget', 'widget_comprendre', '<b>UNDERSTAND</b><br />THE OFFER IN 2 MN', 1487681739, 'mlaunay@b-fly.com', NULL, NULL),
(159, 'widget', 'widget_simuler', '<b>SIMULATE</b><br />YOUR INVESTMENT', 1487681763, 'mlaunay@b-fly.com', NULL, NULL),
(160, 'widget', 'widget_souscrire', '<b>SUBSCRIBE</b><br />TO THE 2017 PEG', 1487681779, 'mlaunay@b-fly.com', NULL, NULL),
(166, 'docesDOC_ORDER', 'docesDOC_ORDER', '1,2,3,', 1454484956, 'vlepoivre@b-fly.com', 'document_8.pdf', NULL),
(162, 'peg', 'peg_simulateur_sim2', 'Calculate your employer contribution', 1487692829, 'vlepoivre@b-fly.com', NULL, NULL),
(163, 'peg', 'peg_simulateur_sim1', 'Calculate your maximum investment amount', 1487692923, 'vlepoivre@b-fly.com', NULL, NULL),
(164, 'peg', 'peg_simulateur_titre', 'SIMULATE YOUR INVESTMENT IN THE PEG', 1487692948, 'vlepoivre@b-fly.com', NULL, NULL),
(167, 'docpeg', 'docpeg_2', 'SG RELAIS 2016 - FCPE Rules', 1454484956, 'vlepoivre@b-fly.com', 'document_2.pdf', NULL),
(168, 'docpeg', 'docpeg_3', 'GSP Brochure (English version)', 1454484956, 'vlepoivre@b-fly.com', 'document_3.pdf', NULL),
(169, 'docpeg', 'docpeg_4', 'GSP Brochure (French version)', 1454484956, 'vlepoivre@b-fly.com', 'document_4.pdf', NULL),
(170, 'docpeg', 'docpeg_5', 'GSP Rules of the Saint-Gobain Group Savings Plan (English version)', 1454484956, 'vlepoivre@b-fly.com', 'document_5.pdf', NULL),
(171, 'docpeg', 'docpeg_6', 'DICI SG Relais Monde', 1454484956, 'vlepoivre@b-fly.com', 'document_6.pdf', NULL),
(199, 'docpeg', 'docpeg_7', 'Regulations SG Relais Monde', 1487854357, 'vlepoivre@b-fly.com', 'document_7.pdf', NULL),
(161, 'contact', 'contact_country', 'Country(ies):', 1487768160, 'vlepoivre@b-fly.com', NULL, NULL),
(165, 'docpegDOC', 'docpegDOC_ORDER', '1,2,3,4,5,6,7,', 1487847638, 'vlepoivre@b-fly.com', NULL, NULL),
(206, 'doces', 'doces_3', 'SG PEG MONDE REGULATIONS (English version)', 1487856691, 'vlepoivre@b-fly.com', '_document_coming_soon.pdf', NULL),
(205, 'doces', 'doces_2', 'SG PEG MONDE REGULATIONS (French version)', 1487856677, 'vlepoivre@b-fly.com', 'RGT_SG_PEG_MONDE_FR.pdf', NULL),
(204, 'doces', 'doces_1', 'SG PEG MONDE KIID (French version)', 1487856651, 'vlepoivre@b-fly.com', 'DICI_SG_PEG_MONDE_FR.pdf', NULL);



	
	
	
	
	


    "; 	// fin $req_str
	
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