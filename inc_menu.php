

<span id="menu_burger"></span>
<div id="menu_burger_content">
	<ul id="menu_top">
		
		<?php
		if ($membre_editeur)
		{
			?>
			<a class="picto_edition picto_edition_menu" href="?pg=edit_textes_menu&ct=<?php echo $country; ?>&pg_src=<?php echo $page; ?>"></a>
			<?php
		}
		?>
		<!--
				<li class="li_lien_menu">
					<a href="site.php?pg=home&ct=<?php //echo $country;?>"
						class="a_lien_menu_home <?php //if ($page == 'home') {echo 'a_lien_menu_home_selected';} ?>">
					</a>
				</li>
		-->
		<?php
		
		// BOUCLE POUR LISTE DES ELEMENTS MENU => $ELEMENTS_MENU dans inc_var_globales.php
		
		foreach ($ELEMENTS_MENU as $menu_groupe => $contenu_groupe)
		{
			$affiche_menu = true;
			
			// MENUS CACHÉS (footer)
			if (in_array($menu_groupe,$ELEMENTS_MENU_CACHE))
			{
				$affiche_menu = false;
			}
			
			// MENUS CACHÉS (OFFLINE)
			if ($menu_groupe == 'souscrire' AND $OFFLINE)
			{
				$affiche_menu = false;
			}
			
			// MENUS CACHÉS (menus France cachés pour Inter)
			if ($inter AND in_array($menu_groupe,$PAGES_SPECIALES_FRANCE))
			{
				$affiche_menu = false;
			}
			// MENUS CACHÉS pour les classic => les 2 menus des 2 offres sécure + classic
			if (($cla_ad OR $cla_fcpe) AND in_array($menu_groupe,$ELEMENTS_MENU_CACHE_POUR_CLA))
			{
				$affiche_menu = false;
			}
			
			if ($affiche_menu)
			{
			?>
				
				<li class="li_lien_menu " id="id_menu_<?php echo $menu_groupe;?>">
					<?php
					
					// si pas de sous menu => lien du menu = groupe du menu
					if (empty($contenu_groupe["sous_menu"]))
					{
						$lien_groupe = $menu_groupe;
						$sous_menu_existe = false;
					}
					// si sous menu => lien du menu = 1er sous menu
					else
					{
						$lien_groupe = $contenu_groupe["sous_menu"][0];
						
						// paragraphe inactivé
						//if ($inter)
						//{
						//	$lien_groupe = $contenu_groupe["sous_menu"][1];
						//} // 1er sous onglet masqué pour inter
						
						$sous_menu_existe = true;
					}
					
					// inactivation du pointage vers le 1er sous menu, puisque ici sous menus = ANCRES et non pages disctinctes
					$lien_groupe = $menu_groupe;
					
					
					// AFFICHAGE D'UN LIEN PRINCIPAL DU  MENU
				    if ($menu_groupe == 'ecollab'){
                        $href = 'http://psa-accelerate2017.com/ecollaboration';
					   $target = 'target ="_blank"';
                        
                    }
                else{  
					
					$href = 'site.php?pg='.$lien_groupe.'&ct='.$country;
					$target = '';
                }


					
					if (in_array($lien_groupe,array_keys($ELEMENTS_BLANK)))
					{
						$href = $ELEMENTS_BLANK[$lien_groupe];
						$target = 'target="_blank"';
					}
					
					?>
					<a href="<?php echo $href;?>" <?php echo $target;?>
						class="a_lien_menu <?php if (in_array($page,$ELEMENTS_MENU[$menu_groupe]["sous_menu"]) OR $page == $menu_groupe) {echo 'a_lien_menu_selected';} ?>">
						<?php
													
							// AFFICHAGE DU TEXTE DU LIEN
	
							//// OLD = différence entre France qui est en dur, et inter qui est en dynamique BDD
							//if($inter) // pour inter, fonction affichage depuis BDD
							//{
							//	echo affiche_texte_dyn('menu__'.$menu_groupe,false); // exemple "menu_le_groupe", "menu_message_du_president" // false pour sans btn pour menu, car sinon lien dans lien
							//}
							//else // sinon France, en dur
							//{
							//	echo $lang['menu_'.$menu_groupe];
							//}
							
							
							// NEW => ici tous, même France, sont en dynamiques
							echo affiche_texte_dyn('menu__'.$menu_groupe,false); // exemple "menu_le_groupe", "menu_message_du_president" // false pour sans btn pour menu, car sinon lien dans lien
							
							

							// insertion picto home
							if ($menu_groupe =='home')
							{
								echo '<br/><span class="picto_home"></span>';
							}

							// insertion trait_menu
							//if ($menu_groupe == 'ecollab')
							if ($menu_groupe == $page)
							{
								echo '<img src="assets/images/trait_gauche_menu.png" class="trait_gauche_menu">';
								echo '<img src="assets/images/trait_droite_menu.png" class="trait_droite_menu">';
							}


							// insertion trait_menu
							if ($menu_groupe =='offre')
							{
								
							}

							if(in_array($menu_groupe,$ELEMENTS_MENU_1_LIGNE))
							{
								echo '<br/><br/>';
							}

													
						?>
					</a>
					
		
					<?php if ($sous_menu_existe)
					{
						
						// AFFICHAGE D'UN SOUS MENU
						
						?>
						<ul class="sub_nav">
							<?php
							foreach ($contenu_groupe["sous_menu"] as $page_ss_menu)
							{
								
								$href_ss_menu = 'site.php?pg='.$page_ss_menu.'&ct='.$country;
								$target_ss_menu = '';
								if (in_array($page_ss_menu,array_keys($ELEMENTS_BLANK)))
								{
									$target_ss_menu = 'target="_blank"';
								}
								//pour créer conditions d'affichage
								$affiche_sous_menu = true;
			
								// SOUS MENUS CACHÉS (menus France cachés pour Inter)
								if ($inter AND in_array($page_ss_menu,$PAGES_SPECIALES_FRANCE))
								{
									$affiche_sous_menu = false;
								}
								
								// SOUS MENU CACHÉ classic_comprendre => pour les NON cla_ad ou les NON cla_fcpe => 
								if (($fcpe_fra OR $ad_fcpe OR $fcpe) AND $page_ss_menu == 'classic_comprendre' AND $menu_groupe == 'offre')
								{
									$affiche_sous_menu = false;
								}
								
								if($affiche_sous_menu)
								{	
									$class_li_sous_menu = '';
									
									// ATTENTION ici HREF des sous menus = ancres									
									$href_ss_menu = 'site.php?pg='.$menu_groupe.'&ct='.$country.'#'.$page_ss_menu;
									
									//$onclick = 'document.location.href="site.php?pg='.$page_ss_menu.'&ct='.$country.'";';
									$onclick = 'document.location.href="'.$href_ss_menu.'";';
									
									if (in_array($page_ss_menu,array_keys($ELEMENTS_BLANK)))
									{
										//$onclick = 'window.open("site.php?pg='.$page_ss_menu.'&ct='.$country.'");';
										$onclick = 'window.open("'.$href_ss_menu.'");';
									}
									
									?>
									<li class="<?php echo $class_li_sous_menu; ?> "  onclick='<?php echo $onclick; ?> return false' >
										<div class="sub_nav_table"><table><tr><td>
											<a class="menu_sub_menu_link" href="<?php echo $href_ss_menu; ?>"
											<?php if ($page == $page_ss_menu) {echo 'class="selected"';} ?>>
												<?php if (in_array($lg,$LANGUES_SMALL_SOUS_MENU)) {echo '<span class="small_sous_menu">';} ?>
													<?php
													
													// AFFICHAGE DES TEXTES DANS LES SOUS MENUS
													
													//
													//// OLD = différence entre France qui est en dur, et inter qui est en dynamique BDD
													//if($inter) // pour inter, fonction affichage depuis BDD
													//{
													//	echo affiche_texte_dyn('menu__'.$page_ss_menu,false); // exemple "menu_le_groupe", "menu_message_du_president" // false pour sans btn pour menu, car sinon lien dans lien
													//}
													//else // sinon France, en dur
													//{
													//	echo $lang['menu_'.$page_ss_menu];
													//}
													
													// NEW => ici tous, même France, sont en dynamiques
													echo affiche_texte_dyn('menu__'.$page_ss_menu,false); // exemple "menu_le_groupe", "menu_message_du_president" // false pour sans btn pour menu, car sinon lien dans lien
													
													
													?>
												<?php if (in_array($lg,$LANGUES_SMALL_SOUS_MENU)) {echo '</span>';} ?>
													
											</a>
										</td></tr></table></div>
									</li>					
									<?php
								}
							}
							?>				
						</ul>
						<?php
					} // fin  if ($sous_menu_existe)
					?>
		
					<div class="clr"></div>	
				</li>
				
				<?php
				if($menu_groupe != 'home' AND $menu_groupe != 'contact')
				{
					?>
					<!--<li class="lien_menu lien_menu_barre">&nbsp;</li>-->
					<?php
				}
				?>
				
				
			<?php
			}
		}
		?>
	</ul>
	
	<br/>
	
</div> <!-- / menu_burger_content -->

<div class="clr"></div>	
	
	
	
	
	
	
	