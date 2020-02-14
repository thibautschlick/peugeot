<?php
session_start(); // pour l'export xls
include_once('inc_var_globales.php');
$table_doc_xnet_count = 'docs_xnet_count_17';
?>

<!DOCTYPE html 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<title>
    <?php echo $TITRE_SITE; ?>
</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name='robots' content='noindex,nofollow' />	
	<link rel="stylesheet" type="text/css" href="assets/css/MyFontsWebfontsKit.css">
	<link rel="stylesheet" href="assets/css/styles.css" />   
	<!--[if lte IE 7]><link rel="stylesheet" href="assets/css/ie7.css" /><![endif]-->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />

</head>

<body>	
	
	<div id="container_1000">
	
		<div id="contenu_texte" style="width:100%;margin:0px auto;">			
			
			  <p>
				<br/>
				<br/>
					<a href="index.php" class="small">			
						<em>
							(Retour vers le site)
						</em>
					</a>
			  </p>			  
				<br/>
			  
				<h1 class="bleu">
					Documents de l’extranet : Statistiques des clics
				</h1>			  
				<br/>
				
				<p>Export excel : <a href="download_documentation_count_excel.php"><img src="assets/images/ico_xls.png" /></a></p>
				<br/>
					
					<?php
						
						require_once('_inc_bdd_connect.php');
		
						//
						////old
						//$req = mysql_query("SELECT doc FROM docs_xnet_count");
						//$tous_docs = array();
						//$total_clics = 0;						
						//while ($doc_bdd = mysql_fetch_array($req)) // boucle de tous les docs
						//{
						//	$tous_docs[] = $doc_bdd['doc'];
						//}
						
						$req = $bdd->prepare("SELECT doc FROM ".$table_doc_xnet_count);
						$tous_docs = array();
						if ($req->execute())
						{
							while ($ligne = $req->fetch(PDO::FETCH_ASSOC))
							{
								$tous_docs[] = $ligne['doc'];
							}
						}
						
						
						$total_clics = 0;	
						
						
						$liste_docs = array_unique($tous_docs); // liste des différents docs
						sort($liste_docs); // tri alpha
						$nb_docs = sizeof($liste_docs); // nb de docs
						
						// initialisation des compteurs
						foreach ($liste_docs as $doc)
						{
							$doc = str_replace('.','',$doc); // on retire le point
							$doc = str_replace('-','',$doc); // on retire le -
							${$doc} = 0; // création variable ex.: $BRESAADDIFDE15pdf
						}
						
						foreach ($tous_docs as $doc)
						{							
							$doc = str_replace('.','',$doc); // on retire le point
							$doc = str_replace('-','',$doc); // on retire le -
							${$doc} ++; // incrémentation de la bonne variable
						}
						
						echo '<p><strong>'.sizeof($tous_docs).' clics au total sur '.sizeof($liste_docs).' documents.</strong>
							<br/><br/>
							Classement par nom de document :</p><br/>';
						
						?>
				
					<?php
					  ob_start();	// ON COMMENCE LE TAMPON POUR EXPORT XLS
					?>
						
				<table style="width:100%;">
					<tr>
						<th class="" style="border-bottom:1px solid #999;font-weight:bold;">
							DOSSIER
							<br/>
							<br/>
						</th>
						<th class="" style="border-bottom:1px solid #999;font-weight:bold;">
							COUNTRY
							<br/>
							<br/>
						</th>
						<th class="" style="border-bottom:1px solid #999;font-weight:bold;">
							DOCUMENT
							<br/>
							<br/>
						</th>
						<th class="" style="border-bottom:1px solid #999;font-weight:bold;">
							CLICS
							<br/>
							<br/>
						</th>
					</tr>
					
					<?php
						
						// on affiche les lignes du tableau
						foreach ($liste_docs as $doc)
						{
							$docs_array = explode("/",$doc); // array 2 ou 3 éléments
							if (sizeof($docs_array) == 1)
							{
								$col1 = '';
								$col2 = '';
								$col3 = $docs_array[0];
							}
							else if (sizeof($docs_array) == 2)
							{
								$col1 = $docs_array[0];
								$col2 = '';
								$col3 = $docs_array[1];
							}
							else // size 3
							{
								$col1 = $docs_array[0];
								$col2 = $docs_array[1];
								$col3 = $docs_array[2];
							}
							//if($docs_array[0]=="doc_cor_peg"){
							//	$docs_array[0]='Correspondant';
							//}
							//else{
							//	$docs_array[0]= 'Salarié';
							//}
						
							echo '<tr>';
							
								echo '<td style="border-bottom:1px solid #ccc;">';
									echo $col1;
								echo '</td>';
								
								echo '<td style="border-bottom:1px solid #ccc;">';
									echo $col2;
								echo '</td>';
								
								echo '<td style="border-bottom:1px solid #ccc;">';
									echo $col3;
								echo '</td>';
								
								// cellule des clics
								$doc = str_replace('.','',$doc); // on retire le point
								$doc = str_replace('-','',$doc); // on retire le -
								echo '<td style="border-bottom:1px solid #ccc;">';
									echo ${$doc};
								echo '</td>';
								
							echo '</tr>';							
						}
						
					?>
					
				</table>
				
				<?php
				$_SESSION['export_xls'] = ob_get_contents(); // COPIE DU TABLE HTML POUR L EXPORT XLS
				ob_end_flush();
				
				//echo $export_xls;
				?>

		</div><!--/contenu_texte-->		
		
	</div><!--/container 1000-->

</body>
</html>