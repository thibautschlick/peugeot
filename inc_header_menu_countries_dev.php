<?php
	if($LOCAL)
	{
		$display = true; // true false
	}
	else
	{
		$display = false; // true false
	}
	if ($page == "index") {$display = false;}
?>
<div style="
	<?php if (!$display) {echo 'display: none;';} ?>
	position: absolute;
	z-index:99999;
	top:32px;
	left:50%;
	width:60%;
	margin:0 0 0 -30%;
	background-color: #eee;
	padding:0px;
	border:1px solid #666;
	font-size:10px;
	font-family:'Arial';
">
	
	<strong>
		<b class="rouge">
			TEMPORARY MENU:
		</b>
		

<?php

$TEST_SEULEMENT_FRANCE = false;

$countries_differentes_formules = array(
	//'austria', // fcpe im
	//'angola', // fcpe dif
	//'cambodia',// cla im
	//'argentina',// cla dif
	//'switzerland_fr',// np im
	//'canada_fr',// np dif
	//'france',//france
);


foreach ($countries_differentes_formules as $country_code)
{
	// rappel de  $countries_CODE_LG_FORM =====>       'angola'=>array('Angola','pt','fcpe_dif'),
	$nom_ct = $countries_CODE_LG_FORM[$country_code][0];
	$form_ct = $countries_CODE_LG_FORM[$country_code][2];
	if ($TEST_SEULEMENT_FRANCE) {$variable_pour_ct = 'france';} else {$variable_pour_ct = $country_code;}
	echo '
		<a href="site.php?pg='.$page.'&ct='.$variable_pour_ct.'"
	';
	if ($country == $country_code)
	{
		echo 'class="rouge"';
	}
	echo '
		>'.$nom_ct.' | '.$form_ct.'</a> &bull;
	';
}

// pour avoir TOUS les pays
$countries_differentes_formules = $countries_CODE_LG_FORM;


foreach ($countries_differentes_formules as $country_code => $country_array)
{
	// rappel de  $countries_CODE_LG_FORM =====>       'angola'=>array('Angola','pt','fcpe_dif'),
	$nom_ct = $countries_CODE_LG_FORM[$country_code][0];
	$form_ct = $countries_CODE_LG_FORM[$country_code][2];
	if ($TEST_SEULEMENT_FRANCE) {$variable_pour_ct = 'france';} else {$variable_pour_ct = $country_code;}
	echo '
		<a href="site.php?pg='.$page.'&ct='.$variable_pour_ct.'" style="text-decoration:none;"
	';
	if ($country == $country_code)
	{
		echo 'class="rouge"';
	}
	echo '
		>'.$nom_ct.'</a> &bull;
	';
}
	
?>
<!--		
	<a href="site.php?pg=home&ct=<?php echo $country; ?>" class="big3 rouge">&bull;&bull;&bull; PAGE D'ACCUEIL &bull;&bull;&bull;</a>
-->
	</strong>
</div>