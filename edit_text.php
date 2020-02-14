<?php

	if ($membre_editeur)
	{
		if (isset($_GET['text']) AND isset($_GET['pg_src']))
		{
			$get_text = sanitize_get('text');
			
			// page de provenance, pour pouvoir y retourner
			$get_pg_src = sanitize_get('pg_src');
			
			$select_texte_dyn = select_texte_dyn($get_text);
			
			//fonction de création de texte si n'existe pas en bdd
			$create_texte = false;
			if (isset($_GET['create']))
			{
				$create_texte = true;
			}
		}
		//else header('location:country_choice.php');
	}
	//else header('location:country_choice.php');

	
	// include des éléments et messages pour le formulaire
	if ($lg == 'fr') {$lg_pour_edition = 'fr';} else {$lg_pour_edition = 'en';}
	include ('contenu_pages/edit_text_lg/edit_text_lg_'.$lg_pour_edition.'.php');
	
?>

<br/>
<br/>
<br/>

<div class="colonne_100pc">
<div class="colonne_100pc_contenu">

	
	<h1 class="big3">
		<?php echo $edit_modify_text; ?>
	</h1>
	
	<br/>
	
	
	<?php
		//message lors de création de texte
		if (isset($_GET['createok']))
		{
			echo '<p class="strong vert">'.$edit_create_texte_ok_cree.'</p><br/><br/>';
		}
		if (isset($_GET['createnotok']))
		{
			echo '<p class="strong rouge">'.$edit_create_texte_notok_notcree.'</p><br/><br/>';
		}
	?>
	
	
	
	<?php
	
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
					<a href="site.php?pg=edit&ct='.$country.'&text='.$get_text.'&pg_src='.$get_pg_src.'&create">'.$edit_create_text.' >>></a>
				';
			}
		}
		// si fonction de création de texte APPELÉE
		elseif ($create_texte AND $ACTIVATION_INSERT_TEXT_CODE)
		{
			if (create_texte_dyn($get_text))
			{
				echo '<script language="javascript">document.location.href="site.php?pg=edit&ct='.$country.'&text='.$get_text.'&pg_src='.$get_pg_src.'&createok"</script>';
			}
			else
			{
				echo '<script language="javascript">document.location.href="site.php?pg=edit&ct='.$country.'&text='.$get_text.'&pg_src='.$get_pg_src.'&createnotok"</script>';
			}
		}
	}
	
	//code ok trouvé
	else
	{
		$message = '';
		$color = '';
		
		if (isset($_POST['textarea_edit']) AND $_POST['textarea_edit'] == '')
		{
			$message .= $edit_text_enter_content;
			$color = 'rouge';
		}
		elseif (isset($_POST['textarea_edit']) AND $_POST['textarea_edit'] != '')
		{
			$text_new_content = $_POST['textarea_edit'];
			
			$text_new_content = filtrage($text_new_content);
			
			//si update en BDD ok
			if (update_texte_dyn($get_text,$text_new_content))
			{
				$message .= $edit_text_text_modified.'>>> <a href="site.php?pg='.$get_pg_src.'&ct='.$country.'" class="btn_see_the_page ombre_3_3">'.$edit_text_see_the_page.'</a>';
				$color = 'vert';
				$select_texte_dyn = select_texte_dyn($get_text);
				create_texte_dyn_history($get_text,$text_new_content,$membre_email,$country);
				
				// sécu bdd
				if ($SAVE_ACTIVATION)
				{
					include($SAVE_FILE.'countries.php');
				}
			}
			else
			{
				$message .= $edit_text_update_problem;
				$color = 'rouge';
			}
		}
		
		?>
		
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
			<?php echo $edit_text_text_content; ?>
		</p>
		<form method="post" action="#">
			<textarea name="textarea_edit" class="textarea_edit"><?php echo $select_texte_dyn['contenu_texte']; ?></textarea>
			
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
	
</div> 
</div>
