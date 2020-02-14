<?php
		
		//if (!$LOCAL)
		{
			//$refresh_cours_minutes = 10;
			//$time_actuel = time();
			//
			//// verifie si timer dépassé
			//$refresh_depasse = false;
			//$req = $bdd->prepare("SELECT cours_bourse_time FROM cours_bourse LIMIT 1");
			//$req->execute();
			//$cours_bourse_time = $req->fetch(PDO::FETCH_ASSOC);
			//$cours_bourse_time = $cours_bourse_time['cours_bourse_time'];
			//
			//if ($time_actuel > ($cours_bourse_time + $refresh_cours_minutes * 60))
			//{
			//	$refresh_depasse = true;
			//}
			
			$refresh_depasse = true;
			
			//$cours_bourse_time = $cours_bourse_time['cours_bourse_time'];
			//echo '<p class="white">'.$cours_bourse_time['cours_bourse_time'].'  xxx </p>';
			
			//// si dépassé on met à jour le lien + on écrit en BDD
			//if ($refresh_depasse)
			//{
				//COURS DE BOURSE TEMPS REEL
				$URL_a_afficher = 'http://chronocomprod.glmultimedia.com/psapeugeotcitroen/intranet/cours.asp';				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $URL_a_afficher);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Cours de bourse');
				$cours_bourse_contenu_html = curl_exec ($ch);
				curl_close($ch);
				
				//echo $cours_bourse_contenu_html;
				
				$explode = explode("<td",$cours_bourse_contenu_html);				
				//// affiche tout le array généré
				//$i = 0;
				//foreach ($explode as $cellule)
				//{
				//	echo 'cellule : ';
				//	echo $i;
				//	echo '<br/>';
				//	//echo htmlspecialchars($cellule);
				//	//echo ($cellule);
				//	echo utf8_encode($cellule);
				//	echo '<br/>';
				//	echo '------------------<br/>';
				//	echo '<br/>';
				//	$i++;
				//}
				
				// on a donc les cellules voulues 
				$action_psa_capture = utf8_encode($explode[5]); // valeur
				$action_psa_capture = htmlspecialchars($action_psa_capture);
				//echo $action_psa_capture;
				//echo '<br/>';				
				$cac40_capture = utf8_encode($explode[6]); // valeur
				$cac40_capture = htmlspecialchars($cac40_capture);
				//echo $cac40_capture;
				//echo '<br/>';
				$action_psa_pc_capture = utf8_encode($explode[11]); // % variation
				$action_psa_pc_capture = htmlspecialchars($action_psa_pc_capture);
				//echo $action_psa_capture;
				//echo '<br/>';				
				$cac40_pc_capture = utf8_encode($explode[12]); // % variation
				$cac40_pc_capture = htmlspecialchars($cac40_pc_capture);
				//echo $cac40_capture;
				//echo '<br/>';
				
				// dans les cellules on a : width="127" align="center">17,80 
				// on explode donc avec > mais encodé avec htmlspecialchar
				
				$action_psa_explode = explode('&gt;',$action_psa_capture);
				//print_r($action_psa_explode);
				//echo '<br/>';			
				$action_psa = ($action_psa_explode[2]);
				$action_psa = str_replace("&lt;/font","",$action_psa); // on vire les caractères en trop
				$action_psa = str_replace(",",".",$action_psa);				
				// ============         OK ACTION PSA
				
				$cac40_explode = explode('&gt;',$cac40_capture);
				//print_r($cac40_explode);
				//echo '<br/>';
				$cac40 = $cac40_explode[2];
				$cac40 = str_replace("&lt;/font","",$cac40); // on vire les caractères en trop
				$cac40 = str_replace(",",".",$cac40);		
				// ============         OK CAC40
				
				$action_psa_pc_explode = explode('&gt;',$action_psa_pc_capture);
				//print_r($action_psa_explode);
				//echo '<br/>';			
				$action_psa_pc = ($action_psa_pc_explode[2]);
				$action_psa_pc = str_replace("&lt;/font","",$action_psa_pc); // on vire les caractères en trop
				if ($separ_decimal == '.')
				{
					$action_psa_pc = str_replace(",",".",$action_psa_pc);
				}
				// ============         OK ACTION PSA %
				
				$cac40_pc_explode = explode('&gt;',$cac40_pc_capture);
				//print_r($cac40_pc_explode);
				//echo '<br/>';
				$cac40_pc = $cac40_pc_explode[2];
				$cac40_pc = str_replace("&lt;/font","",$cac40_pc); // on vire les caractères en trop
				if ($separ_decimal == '.')
				{
					$cac40_pc = str_replace(",",".",$cac40_pc);
				}
				$cac40_pc = str_replace("&lt;/td","",$cac40_pc); // ici, reste &lt;/td
				// ============         OK CAC40 %
				
				
				
				if($separ_millier != ' ')
				{
					//pb avec espace millier
					//http://php.net/manual/fr/function.str-split.php
					$cac40_array_via_split = str_split($cac40);
					//print_r($cac40_array_via_split);
					// on voit que ça donne Array ( [0] => 5 [1] => � [2] => � [3] => 0 [4] => 8 [5] => 3 [6] => . [7] => 1 [8] => 0 )
					// espace pose pb avec 2 caractères inconnus => on les vire
					$cac40_new = '';
					foreach ($cac40_array_via_split as $character)
					{
						if ($character == '.' OR is_numeric($character))
						{
							$cac40_new .= $character;
						}
					}//  ok, espace millier supprimé
				}
				else
				{
					$cac40_new = $cac40;
				}

				
				
				
						
				
				
				
				// ==========================================     AFFICHAGE    ==============================================
				//echo $action_psa;
				//echo '<br/>';
				//echo $cac40_new;
				//echo '<br/>';
				//echo $action_psa_pc;
				//echo '<br/>';
				//echo $cac40_pc;
				//echo '<br/>';
				
				

				//
				////BDD UPDATE
				//$req = $bdd->prepare("UPDATE  `cours_bourse` SET  `cours_bourse_time` =  '".$time_actuel."', `cours_bourse_contenu` =  :cours_bourse_contenu_html WHERE  `cours_bourse`.`id` =1;");
				//$req->bindValue(':cours_bourse_contenu_html', $cours_bourse_contenu_html);				
				//$req->execute();
			//}
			//else // lecture cours bourse html en BDD
			//{
			//	$req = $bdd->prepare("SELECT cours_bourse_contenu FROM cours_bourse LIMIT 1");
			//	$req->execute();
			//	$cours_bourse_contenu = $req->fetch(PDO::FETCH_ASSOC);
			//	$cours_bourse_contenu = $cours_bourse_contenu['cours_bourse_contenu'];
			//	echo $cours_bourse_contenu;
			//}
		} // //if (!$LOCAL) si besoin
		
		
            
        ?>
