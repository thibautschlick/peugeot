<?php
include ('languages.php');
$groupe='index';
$page='index';
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<?php include ('inc_meta.php'); ?>
</head>

<body <?php if ($url_ok!=3) echo 'style="display:none"'; ?>>

		
	<div id="container_1000">
		
		
		<?php include ('inc_header.php'); ?>
	

		<?php //include ('inc_menu_left.php'); ?>

	
		<div class="contenu_930px">
			
			<div id="mosaique_agenda">
				
				<div id="home_technip capital" style="background-image: url('assets/images/home_technip_capital_baseline_<?php echo$lang['LANG'];?>.jpg');"></div>
			
				<div id="home_groupe">
					<h2>
						LE GROUPE GDF SUEZ
					</h2>				
					<p>
						<img src="assets/images/puce_groupe.png" />
						<a href="technip_groupe_profil.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>">
							PROFIL DE GDF SUEZ
						</a>
					</p>			
					<p>
						<img src="assets/images/puce_groupe.png" />
						<a href="technip_groupe_ambitions.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>">
							AMBITIONS ET STRATÉGIE
						</a>
					</p>				
					<p>
						<img src="assets/images/puce_groupe.png" />
						<a href="technip_groupe_actionnariat.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>">
							L’ACTIONNARIAT SALARIÉ
							<br/>
							DANS LE GROUPE
						</a>
					</p>				
					<p>
						<img src="assets/images/puce_groupe.png" />
						<a href="technip_groupe_technip capital2010.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>">
							LINK 2010 : QUEL BILAN ?
						</a>
					</p>
				</div>
			
				<!--<div id="home_photo" style="background-image: url('assets/images/home_photo_fille.jpg');"></div>-->
				<div id="home_photo" style="background-color:#3d3c92;">
					<h1 class="white center" style="color:#fff;font-family: 'NeoSansStd-Medium', 'Arial';font-size:26px;margin:20px 0 0 0;padding:0;">
						PRIX DE SOUSCRIPTION
						<br/>
						XX,xx €
					</h1>
				</div>
			
				<div id="home_contact"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_contact.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					<h1 class="white">
						CONTACT
					</h1>
				</div>
			
				<div id="home_film"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_film.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					<h3>
						DÉCOUVRIR
						<br/>
						LE FILM LINK 2014
					</h3>
				</div>
			
				<div id="home_multiple"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_multiple_offre.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					<h1 class="center white">
						LINK
						<br/>
						multiple
					</h1>				
					<p class="white">
						Protégez votre capital<br/>
						et profitez d’une performance<br/>
						minimum garantie<br/>
						de 2&nbsp;% par an.
					</p>
				</div>
			
				<div id="home_classic"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_classic_offre.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					<h1 class="center white">
						LINK
						<br/>
						classique
					</h1>				
					<p class="white">
						Profitez pleinement<br/>
						de l’évolution<br/>
						de l’action GDF SUEZ.
					</p>				
				</div>
			
				<div id="home_interview"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_interview.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					
					<h1>						
						<a href="technip_interview.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>">
							<strong>
							L’INTERVIEW
							</strong>
							<br/>
							DE GÉRARD MESTRALLET
						</a>
					</h1>
				</div>
			
				<div id="home_simuler"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_simuler.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">
					<h1>
						SIMULER VOTRE
						<br/>
						INVESTISSEMENT
					</h1>					
				</div>
			
				<div id="home_souscrire"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.open('https://www.capital.olisnet.com/technip capital2014/Login');">
					<h1>
						SOUSCRIRE
					</h1>	
				</div>
			
				<div id="home_videos_offre" style="background-image: url('assets/images/home_comprendre_<?php echo$lang['LANG'];?>.jpg');"
					 onmouseover="this.style.opacity=0.5;" onmouseout="this.style.opacity=1;"
					 onclick="window.location='technip_capital_videos_offre.php?lg=<?php echo$lang['LANG'];?>&form=<?php echo$form['FORM'];?>&ct=<?php echo$country;?>';">				
				</div>
			
				<div id="home_agenda">
					<div id="home_agenda_titres">
						<h3>
							AGENDA
						</h3>
						<h1>
							DE LINK 2014
						</h1>
					</div>
					<div class="agenda_bloc" style="margin-left:218px;">
						<p class="agenda_bloc_date">
							<img src="assets/images/puce_violette.png" />
							22 SEPTEMBRE
							<br/>
							13 OCTOBRE
						</p>
						<p class="agenda_bloc_evenement">
							Période de
							<br/>
							réservation
						</p>
					</div>
					<div class="agenda_bloc">
						<p class="agenda_bloc_date">
							<img src="assets/images/puce_violette.png" />
							12 NOVEMBRE
						</p>
						<p class="agenda_bloc_evenement">
							Fixation du prix
							<br/>
							de souscription
							<br/>
							des actions GDF SUEZ
						</p>
					</div>
					<div class="agenda_bloc">
						<p class="agenda_bloc_date">
							<img src="assets/images/puce_violette.png" />
							14 AU 17
							<br/>
							NOVEMBRE
						</p>
						<p class="agenda_bloc_evenement">
							Période de révocation /
							<br/>
							souscription
						</p>
					</div>
					<div class="agenda_bloc" style="border: none;">
						<p class="agenda_bloc_date">
							<img src="assets/images/puce_violette.png" />
							11 DÉCEMBRE
						</p>
						<p class="agenda_bloc_evenement">
							Augmentation de capital
						</p>
					</div>
				</div>
			
			
			
			</div> <!-- / mosaique et agenda -->
			
			
			
			<?php include ('inc_footer.php'); ?>
			
			
			
			
		</div><!--/contenu_930px -->
		
		
		
		
			
			
		
		<?php include ('inc_cours_bourse.php'); ?>
	</div><!--/container 1000-->
	
	<br/>
	<br/>
	<br/>
	<br/>
      
      
       
	<script type="text/javascript" src="assets/js/superfish_footer_activation.js"></script>

	
<?php include ('inc_footer_gan.php'); ?>

</body>
</html>
