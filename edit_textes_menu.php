<?php

	if (!$membre_editeur)
	{
		echo '<script language="javascript">document.location.href="country_choice.php"</script>';
	}
	
	
?>
<br/>
<br/>
<br/>

<div class="colonne_100pc">
<div class="colonne_100pc_contenu">

		<?php
		if ($lg == 'fr') {$lg_pour_edition = 'fr';} else {$lg_pour_edition = 'en';}
		include ('contenu_pages/edit_text_lg/edit_text_lg_'.$lg_pour_edition.'.php');
		
		
		
		// PAGE TITLE
		echo '<h3>';
		echo $edit_page_title;		
		echo '<br/><br/></h3>';
		echo '<p>';
		echo affiche_texte_dyn('page_title');							
		echo '</p>';
		echo '<br/><br/>';
		
		
		
		
		
		
		// TOP MENU
		echo '<h3>';
		echo $edit_liste_elements_menu;		
		echo '<br/><br/></h3>';
		foreach ($ELEMENTS_MENU as $menu_groupe => $contenu_groupe)
		{
			$affiche_menu = true;
			
			// MENUS CACHÉS (home)
			//if ($menu_groupe == 'home')  // OR $menu_groupe == 'home' puisque pas de texte pour la home => picto
			//{
			//	$affiche_menu = false;
			//}
			
			// MENUS CACHÉS (footer)
			if (in_array($menu_groupe,$ELEMENTS_MENU_CACHE))  // OR $menu_groupe == 'home' puisque pas de texte pour la home => picto
			{
				$affiche_menu = false;
			}
			
			// MENUS CACHÉS (menus France cachés pour Inter)
			if ($inter AND in_array($menu_groupe,$PAGES_SPECIALES_FRANCE))
			{
				$affiche_menu = false;
			}
			
			if ($affiche_menu)
			{
			?>
				<ul class="nopuce">
				<li>
					<?php
						if (empty($contenu_groupe["sous_menu"]))
						{
							$lien_groupe = $menu_groupe;
							$sous_menu_existe = false;
						}
						else
						{
							$lien_groupe = $contenu_groupe["sous_menu"][0];
							$sous_menu_existe = true;
						}
					?>					
					<?php				
					$affichage = affiche_texte_dyn('menu__'.$menu_groupe);					
					echo '';
					echo '<b>';
					echo $affichage;									
					echo '</b>';
					echo '<br/>';
					echo '<br/>';
				?>				
				</li>
				</ul>
				
					<?php if ($sous_menu_existe)
					{
						echo '<ul class="nopuce">';
						?>
							<?php
							foreach ($contenu_groupe["sous_menu"] as $key_ss_menu)
							{
								//if($lang['menu_'.$key_ss_menu] != '')
								//{
									?>
									<li style="position:relative;left: 5%;padding-left:0px;">						
									
											<?php
												//echo $lang['menu_'.$key_ss_menu];													
												echo affiche_texte_dyn('menu__'.$key_ss_menu); // exemple "menu_le_groupe", "menu_message_du_president" // false pour sans btn pour menu, car sinon lien dans lien
												echo '<br/>';
											?>
									</li>					
									<?php
								//}
							}
							?>
						<?php
						echo '<br/>';
						echo '</ul>';
					} // fin  if ($sous_menu_existe)
					?>
			<?php
			} // if ($affiche_menu)
		} // foreach ($ELEMENTS_MENU as $menu_groupe => $contenu_groupe)
		?>
	
</div>
</div>
<div class="clr"></div>	
	