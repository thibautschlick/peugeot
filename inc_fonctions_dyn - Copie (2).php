<?php
    $ACTIVATION_INSERT_TEXT_CODE = true; // pour pouvoir insérer un texte dyn s'il n'existe pas encore (fonction pour dèv)
    
    //$lg = 'fr';
    
    //table de recherche des contenus texte des pages
    //$table = 'pages_'.$lg.'_'.$country;
    $table = 'pages_'.$country;
    
    // temporaire avant développement de capture de l'email du membre
    //$membre_email = 'vlepoivre@b-fly.com';
    
    //echo $table;
    
    function affiche_picto_edition($code_texte)
    {
        $picto = '<a class="picto_edition" href="?pg=edit&ct='.$GLOBALS['country'].'&text='.$code_texte.'&pg_src='.$GLOBALS['page'].'"></a>';
        return ($picto);
    }
    
    function select_texte_dyn($code_texte)
    {        
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("SELECT * FROM ".$GLOBALS['table']." WHERE code_texte=:code_texte");
        $req->bindValue(':code_texte', $code_texte);
        $resultats = array();
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
                $resultats[] = $ligne;
            }
        }
        if (isset($resultats[0]))
        {
            return ($resultats[0]); // un seul résultat, le code texte étant unique en BDD
        }
        else
        {
            return false;
        }
    }
	
	function select_ids_docs_de_la_page($page) // array retournant tous les IDS des docs de la page (exemple de doc dont le code est par ex docpeg_11)
	{  
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("SELECT code_texte FROM ".$GLOBALS['table']." WHERE code_texte LIKE '%".$page."_%'");
		//"
		//SELECT * 
		//FROM  `pages_uk` 
		//WHERE  `code_texte` LIKE  '%docpeg_%'
		//LIMIT 0 , 30
		//"

        $resultats = array();
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
				$insert = $ligne['code_texte'];
				$insert = str_replace($page."_","",$insert);
                $resultats[] = intval($insert);
            }
        }
		sort ($resultats);
		return $resultats;
	}
	
	
    
    function update_texte_dyn($code_texte,$text_new_content,$doc_file=NULL)
    {
        // requete pour contenu du texte selon son code
        if ($doc_file == NULL)
		{
			$req = $GLOBALS['bdd']->prepare("UPDATE ".$GLOBALS['table']." SET contenu_texte=:text_new_content WHERE code_texte=:code_texte");
			$req->bindValue(':code_texte', $code_texte);
			$req->bindValue(':text_new_content', $text_new_content);
		}
		else
		{
			$req = $GLOBALS['bdd']->prepare("UPDATE ".$GLOBALS['table']." SET contenu_texte=:text_new_content, doc=:doc_file WHERE code_texte=:code_texte");
			$req->bindValue(':code_texte', $code_texte);
			$req->bindValue(':text_new_content', $text_new_content);
			$req->bindValue(':doc_file', $doc_file);
		}
        if ($req->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function create_texte_dyn($code_texte,$doc=NULL)
    {
        $time = time();
        $code_page = substr($code_texte,0,strpos($code_texte,"_")); // premiers caractères jusqu'au premier _
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("INSERT INTO ".$GLOBALS['table']."
            (code_page,code_texte,contenu_texte,time,membre,doc)
            VALUES (:code_page,:code_texte,:contenu_texte,:time,:membre,:doc)");
        $req->bindValue(':code_page', $code_page);
        $req->bindValue(':code_texte', $code_texte);
        $req->bindValue(':contenu_texte', '');
        $req->bindValue(':time', $time);
        $req->bindValue(':membre', $GLOBALS['membre_email']);
        $req->bindValue(':doc', $doc);
        if ($req->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function create_texte_dyn_history($code_texte,$contenu_texte,$membre_email_texte,$country_texte,$doc=NULL)
    {
        $time = time();
        $code_page = substr($code_texte,0,strpos($code_texte,"_")); // premiers caractères jusqu'au premier _
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("INSERT INTO pages__changes_history
            (code_page,code_texte,contenu_texte,time,membre,country,doc)
            VALUES (:code_page,:code_texte,:contenu_texte,:time,:membre,:country,:doc)");
        $req->bindValue(':code_page', $code_page);
        $req->bindValue(':code_texte', $code_texte);
        $req->bindValue(':contenu_texte', $contenu_texte);
        $req->bindValue(':time', $time);
        $req->bindValue(':membre', $membre_email_texte);
        $req->bindValue(':country', $country_texte);
        $req->bindValue(':doc', $doc);
        if ($req->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	
	// OLD b4 remplacement par autre améliorée
//    
//	
//    function affiche_texte_dyn($code_texte,$bouton = true) // $bouton =  false or true, pour afficher btn  de edit (false pour les liens menus par ex., car eux ont leur bouton pour editer le menu entier )
//    {
//        $select_texte_dyn = select_texte_dyn($code_texte);
//		
//		$affiche_texte_dyn = '';
//		
//		// test bouton avant texte
//		// si le membre est éditeur, affichage du picto édition
//		if ($GLOBALS['membre_editeur'] AND $bouton)
//		{
//			$affiche_texte_dyn = affiche_picto_edition($code_texte);
//		}
//		
//		//$affiche_texte_dyn = $select_texte_dyn['contenu_texte']; // pas concaténation
//		$affiche_texte_dyn .= $select_texte_dyn['contenu_texte']; // concaténation
//		if ($select_texte_dyn == false)
//		{
//			global $edit_text_code_not_found_create;
//			//$affiche_texte_dyn = $edit_text_code_not_found_create; // pas concaténation
//			$affiche_texte_dyn .= $edit_text_code_not_found_create; // concaténation
//		}
//		
//		// test bouton après texte
//		//// si le membre est éditeur, affichage du picto édition
//		//if ($GLOBALS['membre_editeur'] AND $bouton)
//		//{
//		//	$affiche_texte_dyn .= affiche_picto_edition($code_texte);
//		//}
//		
//		//remplacement des espaces par &nbsp si FR
//		if($GLOBALS['lg'] == 'fr')
//		{
//			$affiche_texte_dyn = str_replace(" €","&nbsp;€",$affiche_texte_dyn);
//			$affiche_texte_dyn = str_replace(" &#8364;","&nbsp;&#8364;",$affiche_texte_dyn); // car € encodé sous la forme &#8364;
//			$affiche_texte_dyn = str_replace(" %","&nbsp;%",$affiche_texte_dyn);
//		}
//		
//		return ($affiche_texte_dyn);
//    }
	
	
	// NEW autre améliorée
	
	 function affiche_texte_dyn($code_texte,$bouton = true) // $bouton =  false or true, pour afficher btn  de edit (false pour les liens menus par ex., car eux ont leur bouton pour editer le menu entier )
    {
        $select_texte_dyn = select_texte_dyn($code_texte);
		
		$affiche_texte_dyn = '';
		
		// test bouton avant texte
		// si le membre est éditeur, affichage du picto édition
		if ($GLOBALS['membre_editeur'] AND $bouton)
		{
			$affiche_texte_dyn = affiche_picto_edition($code_texte);
		}
		
		//$affiche_texte_dyn = $select_texte_dyn['contenu_texte']; // pas concaténation
		
		$texte_contenu_select = $select_texte_dyn['contenu_texte'];
		
		// filtrage sortie au cas où
		$texte_contenu_select = str_replace("<div>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("</div>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("<div","<divvvv",$texte_contenu_select);
		$texte_contenu_select = str_replace("<p>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("</p>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("<h1>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("</h1>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("<h2>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("</h2>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("<h3>","",$texte_contenu_select);
		$texte_contenu_select = str_replace("</h3>","",$texte_contenu_select);
		//strong en b
        $texte_contenu_select = str_replace("<strong","<b",$texte_contenu_select);
        $texte_contenu_select = str_replace("</strong","</b",$texte_contenu_select);
		// élimination des classes entrées ou id
        $texte_contenu_select = str_replace('class="','classsss="',$texte_contenu_select);
        $texte_contenu_select = str_replace('class ="','classsss="',$texte_contenu_select);
        $texte_contenu_select = str_replace('style="','styleeee="',$texte_contenu_select);
        $texte_contenu_select = str_replace('style ="','styleeee="',$texte_contenu_select);
        $texte_contenu_select = str_replace('id="','idddd="',$texte_contenu_select);
        $texte_contenu_select = str_replace('id ="','idddd="',$texte_contenu_select);
		
		
		
		$affiche_texte_dyn .= $texte_contenu_select; // concaténation
		if ($select_texte_dyn == false)
		{
			global $edit_text_code_not_found_create;
			//$affiche_texte_dyn = $edit_text_code_not_found_create; // pas concaténation
			$affiche_texte_dyn .= $edit_text_code_not_found_create; // concaténation
		}
		
		// test bouton après texte
		//// si le membre est éditeur, affichage du picto édition
		//if ($GLOBALS['membre_editeur'] AND $bouton)
		//{
		//	$affiche_texte_dyn .= affiche_picto_edition($code_texte);
		//}
		
		
		
		//remplacement des espaces par &nbsp si FR
		if($GLOBALS['lg'] == 'fr')
		{
			$affiche_texte_dyn = str_replace("« ","«&nbsp;",$affiche_texte_dyn); //  « espace
			$affiche_texte_dyn = str_replace("&laquo; ","&laquo;&nbsp;",$affiche_texte_dyn); //  &laquo; espace  («)
			$affiche_texte_dyn = str_replace(" »","&nbsp;»",$affiche_texte_dyn); // espace »
			$affiche_texte_dyn = str_replace(" &raquo;","&nbsp;&raquo;",$affiche_texte_dyn); // espace &raquo;  (»)
			$affiche_texte_dyn = str_replace(" ?","&nbsp;?",$affiche_texte_dyn); // espace ?
			$affiche_texte_dyn = str_replace(" !","&nbsp;!",$affiche_texte_dyn); // espace !
			$affiche_texte_dyn = str_replace(" €","&nbsp;€",$affiche_texte_dyn); // espace €
			$affiche_texte_dyn = str_replace(" &#8364;","&nbsp;&#8364;",$affiche_texte_dyn); // car € encodé sous la forme &#8364;
			$affiche_texte_dyn = str_replace(" %","&nbsp;%",$affiche_texte_dyn); // espace %
		}
		
		return ($affiche_texte_dyn);
    }
	
	
	
	
    
    function filtrage($texte)
    {
        $strings_to_delete = array(
			//"	", // tab
			//"\r",
			//"\n",
			//"<!DOCTYPE html>",
			//"<html>",
			//"<head>",
			//"<body>",
			"<p>",
			"<h1>",
			"<h2>",
			"<h3>",
			//"</html>",
			//"</head>",
			//"</body>",
			"</p>",
			"</h1>",
			"</h2>",
			"</h3>",
        );
		foreach ($strings_to_delete as $str)
		{
			$texte = str_replace($str,"",$texte);
		}
        
        // strong en b
        $texte = str_replace("<strong>","<b>",$texte);
        $texte = str_replace("</strong>","</b>",$texte);
		
		// élimination des classes entrées ou id
        $texte = str_replace('class="','classsss="',$texte);
        $texte = str_replace('class ="','classsss="',$texte);
        $texte = str_replace('style="','styleeee="',$texte);
        $texte = str_replace('style ="','styleeee="',$texte);
        $texte = str_replace('id="','idddd="',$texte);
        $texte = str_replace('id ="','idddd="',$texte);
        
		//et
		//<span style="font-size: 13px; line-height: 12px;">L'abondement est vers&#233; au prorata de votre versement dans l'une et l'autre des deux formules dans la limite de 450&#160;&#8364; brut.</span>
		
		
		
        
        return $texte;
    }
	
	
	
	// array d'arrays avec données des docs du pays
    function liste_tous_docs($page_docs='docpeg')
    {        
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("SELECT * FROM ".$GLOBALS['table']." WHERE code_page=:code_page");
        $req->bindValue(':code_page', $page_docs);
        $resultats = array();
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
                $resultats[] = $ligne;
            }
        }
        return ($resultats);
    }
	
	
	// array simple avec seulement les codes des docs du pays
    function liste_tous_docs_codes()
    {
		$liste_codes_docs = array();
        $req = $GLOBALS['bdd']->prepare("SELECT code_texte FROM ".$GLOBALS['table']." WHERE code_page=:code_page");
        $req->bindValue(':code_page', "documentation");
        $resultats = array();
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
                $liste_codes_docs[] = $ligne['code_texte'];
            }
        }
        return ($liste_codes_docs);
    }
	
	
	// array simple avec seulement les noms des docs du pays
    function liste_tous_docs_noms()
    {
		$liste_noms_docs = array();
        $req = $GLOBALS['bdd']->prepare("SELECT contenu_texte FROM ".$GLOBALS['table']." WHERE code_page=:code_page");
        $req->bindValue(':code_page', "documentation");
        $resultats = array();
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
                $liste_noms_docs[] = $ligne['code_texte'];
            }
        }
        return ($liste_noms_docs);
    }
	
	
	
	
	function sanitize_get($str_get)
	{
		$str = trim(htmlspecialchars($_GET[$str_get]));
		$str = str_replace(" ","",$str);
		return ($str);
	}
	
	
	
	
	function membre_editeur_countries($email)
	{
		$membre_editeur_countries = array();
        $req = $GLOBALS['bdd']->prepare("SELECT country FROM membres_countries WHERE email=:email");
        $req->bindValue(':email',$email);
        if ($req->execute())
        {
            while ($ligne = $req->fetch())
            {
                $membre_editeur_countries[] = $ligne['country'];
            }
        }
        return ($membre_editeur_countries);
	}
	
	
	function remplace_accents($str, $charset='utf-8')
	{
		$str = strtr($str,
			 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
			 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
		//On remplace les lettres accentutées par les non accentuées dans $fichier.
		//Et on récupère le résultat dans fichier
		 
		//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
		//dans $fichier par un underscore "_" et qui place le résultat dans $fichier.
		$str = preg_replace('/([^.a-z0-9]+)/i', '_', $str);
		
		// fonctions pour supprimer les points dans le nom du doc mais garder celui de l'extension => évite d'uploader des fichiers dangereux du type .php.pdf
		$explode = explode('.', $str); // array en fonction des points dans le nom de fichier  ex.:  array('az','ert','yui','doc');
		$ext = $explode[sizeof($explode) - 1]; // dernier élément du array => ex.: doc
		$explode_sans_ext = $explode; // ex.:  array('az','ert','yui','doc');
		array_pop($explode_sans_ext); // ex.:  array('az','ert','yui');
		$nom_fichier_sans_ext = implode("_",$explode_sans_ext);	  // ex.: az_ert_yui
		$str = $nom_fichier_sans_ext.".".$ext; // ex.: az_ert_yui.doc
		
		return $str;
	}
	
	
	
?>