<img class="line_slide_right_blue_res" id="line_slide_right_blue_res"  src="assets/images/line_slide_right_blue_res.png" />


<div class="side_right">
	
	<?php
		if ($membre_editeur)
		{
			?>
			<a class="picto_edition picto_edition_menu" href="?pg=edit_textes_menu_right&ct=<?php echo $country; ?>&pg_src=<?php echo $page; ?>"></a>
			<?php
		}
	?>
		
		
	<div class="line_logos_slide_right">
		<img class="line_slide_right_blue" src="assets/images/line_slide_right_blue.png" />
        <img class="line_slide_right_blue_res_second" src="assets/images/line_slide_right_blue_res.png" />
		<div class="column_right small9">
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logos_slide_right_play.png" />
				<div class="cell_txt">
					<a class="lien_txt_1" href="site.php?pg=comprendre&ct=<?php echo $country;?>">
                        <?php echo affiche_texte_dyn('side_right_menu_comprendre',false); ?>
<!--
						COMPRENDRE
						<br/>
						ACCELERATE 2017 EN 2 MINUTES
-->
					</a>
				</div>
			</div>
		
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logos_slide_right_investissement.png" />
				<div class="cell_txt">
					<a class="lien_txt_2" href="site.php?pg=simuler&ct=<?php echo $country;?>">
                        <?php echo affiche_texte_dyn('side_right_menu_simuler',false); ?>
<!--
						SIMULER
						<br/>
						MON INVESTISSEMENT
-->
					</a>
				</div>
			</div>
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logos_slide_right_souscrire.png" />
				<div class="cell_txt">
					<a class="lien_txt_3" href="https://www.interepargne.natixis.com/jcms/c_5189/fr/salaries-et-epargnants" target="_blank"> 
                        <?php echo affiche_texte_dyn('side_right_menu_souscrire',false); ?>
<!--                        -->
<!--
						SOUSCRIRE
						<br/>
						À ACCELERATE 2017
-->
					</a>
				</div>
			</div>
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logos_slide_right_documentation.png" />
				<div class="cell_txt">	
					<a class="lien_txt_4" href="site.php?pg=documentation&ct=<?php echo $country;?>">
                        <?php echo affiche_texte_dyn('side_right_menu_documentation',false); ?>
<!--
						TÉLÉCHARGER
						<br/>
						LA DOCUMENTATION
-->
					</a>
				</div>
				
			</div>
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logos_slide_right_telephone.png" />
				<div class="cell_txt">
					<a class="lien_txt_5" href="site.php?pg=alertes&ct=<?php echo $country;?>">
                        <?php echo affiche_texte_dyn('side_right_menu_alertes',false); ?>
<!--
						RECEVOIR
						<br/>
						LES ALERTES SMS/EMAILS
-->
					</a>
				</div>
			</div>
			
	<?php if($fcpe_fra)
	{
		?>
			<div class="cell_accelerate">
				<img class="logos_slide_right" src="assets/images/logo_performance.png" />
				<div class="cell_txt">
					<a class="lien_txt_6" href="site.php?pg=performance&ct=<?php echo $country;?>">
                        <?php echo affiche_texte_dyn('side_right_menu_performance',false); ?>
<!--	PERFORMANCE
						
-->
					</a>
				</div>
			</div>
		<?php
	}
	?>
			
			
			
			<img class="photo_slide_right" src="assets/images/photo_slide_right.png" />
			</div>		
		</div>
	</div>
</div>