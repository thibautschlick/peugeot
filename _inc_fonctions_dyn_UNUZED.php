<?php
    $ACTIVATION_INSERT_TEXT_CODE = true; // pour pouvoir insérer un texte dyn s'il n'existe pas encore (fonction pour dèv)
    
    //$lg = 'fr';
    
    //table de recherche des contenus texte des pages
    $table = 'pages_'.$lg.'_'.$country;
    
    // temporaire avant développement de capture de l'email du membre
    $membre_email = 'vlepoivre@b-fly.com';
    
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
    
    function update_texte_dyn($code_texte,$text_new_content)
    {
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("UPDATE ".$GLOBALS['table']." SET contenu_texte=:text_new_content WHERE code_texte=:code_texte");
        $req->bindValue(':code_texte', $code_texte);
        $req->bindValue(':text_new_content', $text_new_content);
        if ($req->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function create_texte_dyn($code_texte)
    {
        $time = time();
        $code_page = substr($code_texte,0,strpos($code_texte,"_")); // premiers caractères jusqu'au premier _
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("INSERT INTO ".$GLOBALS['table']."
            (code_page,code_texte,contenu_texte,time,membre)
            VALUES (:code_page,:code_texte,:contenu_texte,:time,:membre)");
        $req->bindValue(':code_page', $code_page);
        $req->bindValue(':code_texte', $code_texte);
        $req->bindValue(':contenu_texte', '');
        $req->bindValue(':time', $time);
        $req->bindValue(':membre', $GLOBALS['membre_email']);
        if ($req->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
	
    function affiche_texte_dyn($code_texte,$bouton = true) // $bouton =  false or true, pour afficher btn  de edit (false pour les liens menus par ex., car eux ont leur bouton pour editer le menu entier )
    {        
        $select_texte_dyn = select_texte_dyn($code_texte);
		$affiche_texte_dyn = $select_texte_dyn['contenu_texte'];
		if ($select_texte_dyn == false)
		{
			global $edit_text_code_not_found_create;
			$affiche_texte_dyn = $edit_text_code_not_found_create;
		}    			
		// si le membre est éditeur, affichage du picto édition
		if ($GLOBALS['membre_editeur'] AND $bouton)
		{
			$affiche_texte_dyn .= affiche_picto_edition($code_texte);
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
			//"</html>",
			//"</head>",
			//"</body>",
			"</p>",
        );
		foreach ($strings_to_delete as $str)
		{
			$texte = str_replace($str,"",$texte);
		}
        
        // strong en b
        $texte = str_replace("<strong>","<b>",$texte);
        $texte = str_replace("</strong>","</b>",$texte);
        
        ////$texte = nl2br($texte); //=> non, puisque TinyMCE
		
        //$texte = str_replace("	","",$texte); // tab
        ////$texte = str_replace("\r"," ",$texte);
        ////$texte = str_replace("\n"," ",$texte);
        //$texte = str_replace("<p>","",$texte); // de tiny mce
        //$texte = str_replace("</p>","",$texte); // de tiny mce
        //$texte = str_replace("<!DOCTYPE html> <html> <head> </head> <body>","",$texte); // de tiny mce
        //$texte = str_replace("</body> </html>","",$texte); // de tiny mce
        //$texte = str_replace("  "," ",$texte); // double space
        
        return $texte;
    }
	
	
	
	// array d'arrays avec données des docs du pays
    function liste_tous_docs()
    {        
        // requete pour contenu du texte selon son code
        $req = $GLOBALS['bdd']->prepare("SELECT * FROM ".$GLOBALS['table']." WHERE code_page=:code_page");
        $req->bindValue(':code_page', "documentation");
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
	
	
	
	
	function sanitize($str_get)
	{
		$str = trim(htmlspecialchars($_GET[$str_get]));
		$str = str_replace(" ","",$str);
		return ($str);
	}
?>