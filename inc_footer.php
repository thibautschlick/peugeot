		<div id="footer">
			<div class="liens_footer">
				
			<?php if($page != 'index')
			{
				?>
				<span style="display:inline-block;">
				<a href="site.php?pg=contact&ct=<?php echo $country;?>">
					<?php
						//echo ucfirst(strtolower(affiche_texte_dyn('menu__contact')));
						echo affiche_texte_dyn('menu__contact');
					?>
					<!--Contact-->
				</a>
				</span>
				<span class="barre_verticale_footer">|</span>
				<a href="site.php?pg=credits&ct=<?php echo $country;?>">
					<?php echo supp_br($lang['credits']); ?>
				</a>
				
				<span class="barre_verticale_footer">|</span>
				<a href="site.php?pg=mentions_legales&ct=<?php echo $country;?>">
					<?php echo supp_br($lang['mentions_legales']); ?>
				</a>
				
				<span class="barre_verticale_footer">|</span>
				
				<?php
			}
			?>
			
				<span class="footer_copyright">© <?php echo $ANNEE_OPERATION; ?> <?php echo $SOCIETE_OPERATION; ?></span>
			</div>
		</div> <!-- / footer -->
		