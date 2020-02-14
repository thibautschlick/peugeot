<?php
if($page == 'contact')
{
	echo '';
}
elseif($page == 'qui_est_concerne')
{
	echo '';
}
elseif($page == 'offre')
{
	echo '';
}
elseif($page == 'question_reponse')
{
	echo '';
}
elseif($page != 'home')
{
?>	

<p id="fil_ariane" class="coheadline_regular">
	<?php
		if ($lang['menu_'.$PAGES_GROUPE[$page]] != $lang['menu_'.$page])
		{
			$fil = $lang['menu_'.$PAGES_GROUPE[$page]].' > '.$lang['menu_'.$page];
			$fil = str_replace('<br/>',' ',$fil);
			echo $fil;
		}
		else
		{
			$fil = $lang['menu_'.$PAGES_GROUPE[$page]];
			$fil = str_replace('<br/>',' ',$fil);
			echo $fil;
		}
	?>


</p>
<?php
}
else
{
	echo '';
}
?>