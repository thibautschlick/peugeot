<?php

	if ($membre_editeur)
	{
		$modify = $add = $order = $delete = $create_texte = $move = $moveup = $movedown = false;
		$get_doc = $get_pagedoc = $select_texte_dyn = $get_pg_src = '';
		
		if (isset($_GET['doc']) AND isset($_GET['pg_src']) AND isset($_GET['modify'])) // GETs pour MODIFY
		{
			$get_doc = sanitize_get('doc');
			$select_texte_dyn = select_texte_dyn($get_doc);
			
			// page de provenance, pour pouvoir y retourner
			$get_pg_src = sanitize_get('pg_src');
			
			$modify = true;
		}
		elseif (isset($_GET['page_doc']) AND isset($_GET['pg_src']) AND isset($_GET['add'])) // GETs pour ADD
		{
			$pagedoc = sanitize_get('page_doc');
			
			// page de provenance, pour pouvoir y retourner + aussi implique la pagedoc
			$get_pg_src = sanitize_get('pg_src');
			
			$add = $create_texte = true;
		}
		elseif (isset($_GET['doc']) AND isset($_GET['pg_src']) AND (isset($_GET['moveup']) OR isset($_GET['movedown']))) // GETs pour MOVE
		{
			if (isset($_GET['moveup'])) {$moveup = true;}
			if (isset($_GET['movedown'])) {$movedown = true;}
			$get_doc = sanitize_get('doc');
			$select_texte_dyn = select_texte_dyn($get_pagedoc);
			
			// page de provenance, pour pouvoir y retourner
			$get_pg_src = sanitize_get('pg_src');
			
			$move = true;
		}
		elseif (isset($_GET['page_doc']) AND isset($_GET['doc']) AND isset($_GET['pg_src']) AND isset($_GET['delete'])) // GETs pour DELETE
		{
			$pagedoc = sanitize_get('page_doc');
			$get_doc = sanitize_get('doc');
			$select_texte_dyn = select_texte_dyn($get_pagedoc);
			
			// page de provenance, pour pouvoir y retourner
			$get_pg_src = sanitize_get('pg_src');
			
			$delete = true;
		}
		else // pas les bons GETs
		{
			//header('location:site.php?pg=home&ct='.$country);
			echo '<br/><br/><br/><br/><br/>[no gets]';
		}
	}
	else
	{
		//header('location:site.php?pg=home&ct='.$country);
		echo '<br/><br/><br/><br/><br/>[no membre_editeur]';
	}

	
?>

<br/>
<br/>
<br/>

<div class="colonne_100pc">
<div class="colonne_100pc_contenu">

	<?php
	///////////            DELETE        ////////////////// 
	if ($delete)
	{
		// pour deleter on update en gardant le doc, mais avec le titre [deleted] et le doc sur NULL
		$text_new_content = $nom_fichier = '[deleted]';
		
		//si update en BDD ok
		if (update_texte_dyn($get_doc,$text_new_content,$nom_fichier))
		{
			//$message .= $edit_doc_doc_modified.'>>> <a href="site.php?pg='.$get_pg_src.'&ct='.$country.'" class="btn_see_the_page ombre_3_3">'.$edit_text_see_the_page.'</a>';
			
			echo '
				<script language="javascript">document.location.href="site.php?pg='.$get_pg_src.'&ct='.$country.'"</script>
			';
			
			$color = 'vert';
			$select_texte_dyn = select_texte_dyn($get_doc);
			create_texte_dyn_history($get_doc,$text_new_content,$membre_email,$country,$nom_fichier);			
			
			// suppression du document dans la ligne ORDER
			$id_doc = str_replace($pagedoc."_","",$get_doc); // capture id du doc
			$select_order = affiche_texte_dyn($pagedoc.'DOC_ORDER',false); // ancien order
			$select_order .= ","; // ajout de la dernière virgule si absente
			$select_order = str_replace(",,",",",$select_order); // suppression de double virgule
			$new_order = str_replace($id_doc.",","",$select_order); // suppression de la string
			update_texte_dyn($pagedoc.'DOC_ORDER',$new_order); // update order
			
		}
		else
		{
			$message .= $edit_doc_delete_problem;
			$color = 'rouge';
		}
		
		?>
		
		<h1 class="big3">
			<?php echo $edit_delete_doc; ?>
		</h1>
		<br/>
		
		<?php
			if ($message != '')
			{
				echo '<b class="big2 strong '.$color.'">'.$message.'</b><br/><br/>';
			}
			?>
			<br/>
			<br/>
			<a href="site.php?pg=<?php echo $get_pg_src; ?>&ct=<?php echo $country; ?>"><<< <?php echo $edit_text_cancel_back_page; ?></a>
		?>
		
		
		
		
	<?php
	
	}       //        fin DELETE
	
	///////////            MODIFY or ADD       ////////////////// 
	
	elseif ($modify OR $add)
	{
		?>
		
		<h1 class="big3">
			<?php if ($modify) {echo $edit_modify_doc;} else {echo $edit_add_doc;} ?>
		</h1>
		<br/>
		
		<?php
		
		// création d'un doc si ADD
		if ($add)
		{
			$doc_file_default = '[no file attached]';
			
			//recherche du dernier ID de doc, exemple docpeg_11 => ici donc de la forme "$pagedoc"_id
			$ids_docs_de_la_page = select_ids_docs_de_la_page($pagedoc);
			$last_doc_id = $ids_docs_de_la_page[sizeof($ids_docs_de_la_page)-1];
			//echo $last_doc_id;
			//print_r ($ids_docs_de_la_page);
			
			$doc_a_creer = $pagedoc.'_'.($last_doc_id+1);
			//création du doc dans BDD
			create_texte_dyn($doc_a_creer,$doc_file_default);
			
			// insertion du document dans la ligne ORDER
			$select_order = affiche_texte_dyn($pagedoc.'DOC_ORDER',false);
			$select_order .= ","; // ajout de la dernière virgule si absente
			$select_order = str_replace(",,",",",$select_order); // suppression de double virgule
			$new_order = $select_order.($last_doc_id+1).",";
			update_texte_dyn($pagedoc.'DOC_ORDER',$new_order);
			
			// ???
			//1,2,3,4,5,6,25,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,,26,
			//1,2,3,4,5,6,25,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,,26,,27,
			//1,2,3,4,5,6,25,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,26,27,28,29,30,
			
			//$select_texte_dyn sur True pour ne pas continuer le code ci-dessous de création de doc
			$select_texte_dyn = true;
			
			//on charge la page de modification du doc créé
			echo '<script language="javascript">document.location.href="site.php?pg=edit_document&ct='.$country.'&pg_src='.$get_pg_src.'&modify&doc='.$doc_a_creer.'"</script>';
			
			// recherche du nouveau doc
			//$select_texte_dyn = select_texte_dyn($pagedoc.'_'.($last_doc_id+1));
		}
		
		////message lors de création de texte
		//if (isset($_GET['createok']))
		//{
		//	echo '<p class="strong vert">'.$edit_create_texte_ok_cree.'</p><br/><br/>';
		//}
		//if (isset($_GET['createnotok']))
		//{
		//	echo '<p class="strong rouge">'.$edit_create_texte_notok_notcree.'</p><br/><br/>';
		//}
		//
		// si code en get non trouvé
		if ($select_texte_dyn === false)
		{
			// si fonction de création de texte NON appelée
			if (!$create_texte)
			{
				echo '<b class="rouge">'.$edit_text_code_not_found.'</b>';
				if ($ACTIVATION_INSERT_TEXT_CODE)
				{
					// echo lien de création
					echo '
						<br/>
						<br/>
						<a href="site.php?pg=edit&ct='.$country.'&text='.$get_doc.'&pg_src='.$get_pg_src.'&create">'.$edit_create_text.' >>></a>
					';
				}
			}
			// si fonction de création de texte APPELÉE
			elseif ($create_texte AND $ACTIVATION_INSERT_TEXT_CODE)
			{
				if (create_texte_dyn($get_doc))
				{
					echo '<script language="javascript">document.location.href="site.php?pg=edit&ct='.$country.'&text='.$get_doc.'&pg_src='.$get_pg_src.'&createok"</script>';
				}
				else
				{
					echo '<script language="javascript">document.location.href="site.php?pg=edit&ct='.$country.'&text='.$get_doc.'&pg_src='.$get_pg_src.'&createnotok"</script>';
				}
			}
		}
		
		//code ok trouvé
		else
		{
			$message = '';
			$color = '';
			//$text_new_content = '';
			
			if (isset($_POST['textarea_edit']) AND $_POST['textarea_edit'] == '') // posté et titre vide
			{
				$message .= $edit_doc_enter_titre.'<br/>';
				$color = 'rouge';
			}
			elseif (isset($_POST['textarea_edit']) AND $_POST['textarea_edit'] != '') // posté et titre non vide
			{
				$text_new_content = $_POST['textarea_edit'];			
				$text_new_content = filtrage($text_new_content);			
				
				// file
				$validation_fichier = false;			
				if ((isset($_FILES['fichierjoint']['name']) AND $_FILES['fichierjoint']['name'] != '')) // si nouvelle PJ choisie via bouton
				{
					$dot = false;
					// Vérification de la pièce jointe
					$source_fichier = $_FILES['fichierjoint']['tmp_name'];
					$nom_fichier = $_FILES['fichierjoint']['name'];
					$nom_fichier = remplace_accents($nom_fichier);			
					$doc_cible_path = $dossier_doc.$nom_fichier;			
					$extention = icone_document($_FILES['fichierjoint']['name'], $dot);			
					if ( $_FILES['fichierjoint']['size'] > $TAILLE_PJ )
					{
						$message .= $edit_doc_filesize_depassee.'<br/>';
						$validation_fichier = false;						
					}
					if ($extention == NULL OR !in_array($extention,$EXTENTIONS_VALIDES))
					{
						$message .= $edit_doc_extention_invalide.'<br/>';
						$validation_fichier = false;
					}
					else
					{
						// On valide la pièce jointe
						$validation_fichier = true;
					}
				}
				else // pas de changement de PJ
				{
					$nom_fichier = $select_texte_dyn['doc'];
				}
				
				if ($validation_fichier)
				{	
					// Copier le fichier sur le serveur
					copy ($source_fichier, $doc_cible_path);
				}
				
				//si update en BDD ok
				if (update_texte_dyn($get_doc,$text_new_content,$nom_fichier))
				{
					$message .= $edit_doc_doc_modified.'>>> <a href="site.php?pg='.$get_pg_src.'&ct='.$country.'" class="btn_see_the_page ombre_3_3">'.$edit_text_see_the_page.'</a>';
					$color = 'vert';
					$select_texte_dyn = select_texte_dyn($get_doc);
					create_texte_dyn_history($get_doc,$text_new_content,$membre_email,$country,$nom_fichier);
				}
				else
				{
					$message .= $edit_text_update_problem;
					$color = 'rouge';
				}
			}
			?>
			<br/>
			<p>
				<?php echo $edit_text_text_id; ?> <?php echo $select_texte_dyn['id']; ?>
				<br/>
				<?php echo $edit_text_page_code; ?> <?php echo $select_texte_dyn['code_page']; ?>
				<br/>
				<?php echo $edit_text_text_code; ?> <?php echo $select_texte_dyn['code_texte']; ?>
				<br/>
				<?php echo $edit_text_last_change_date; ?> <?php echo date('d-m-Y',$select_texte_dyn['time']); ?>
				<br/>
				<?php echo $edit_text_last_change_member; ?> <?php echo $select_texte_dyn['membre']; ?>
				<br/>
				<br/>
			</p>
			<form method="post" enctype="multipart/form-data"  action="#">
				<?php echo $edit_doc_doc_titre; ?>
				<br/>
				<textarea name="textarea_edit" class="textarea_edit textarea_edit_doc_titre"><?php echo $select_texte_dyn['contenu_texte']; ?></textarea>
				<br/>
				<br/>
				<?php echo $edit_doc_doc_file; ?>
				<br/>
				<b><?php echo $select_texte_dyn['doc']; ?></b>
				<br/>
				<label for='fichierjoint'>
					<?php if($modify) {echo $edit_doc_file_modifier;} else {echo $edit_doc_file_ajouter;} ?>
				</label>
				<input type="file" name="fichierjoint" id="fichierjoint"  class="" value="<?php if(isset($_FILES['fichierjoint']['name'])) {echo $_FILES['fichierjoint']['name'];} ?>" /><br /><br />
				<br/>
				<br/>
				<input type="submit" name="btn_submit" value="<?php echo $edit_text_ok; ?>" class="btn_submit" />			
				<br/>
				<br/>
				<?php if ($message != '')
				{
					echo '<b class="big2 strong '.$color.'">'.$message.'</b><br/><br/>';
				}
				?>
				<br/>
				<br/>
				<a href="site.php?pg=<?php echo $get_pg_src; ?>&ct=<?php echo $country; ?>"><<< <?php echo $edit_text_cancel_back_page; ?></a>
			</form>
			<?php
		}  //code ok trouvé
		?>
		
		
		
		
	<?php
	
	}       //        fin MODIFY or ADD
	
	
	
	?>
	
	
	
	
</div> 
</div>
