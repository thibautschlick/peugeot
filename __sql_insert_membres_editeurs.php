<?php

//     =============================             ATTENTION script direct pour insert en BDD
//     =============================             ATTENTION script direct pour insert en BDD
//     =============================             ATTENTION script direct pour insert en BDD

include('_inc_bdd_connect.php');


// DELETE tous sauf VL AVANT ?
$DELETE_ALL_BEFORE = false; // true false
if ($DELETE_ALL_BEFORE)
{
    $membre_a_garder = 'vlepoivre@b-fly.com';
    
    echo '<em>DELETE ALL sauf '.$membre_a_garder.' => <br/></em>';
    
    //membres_corres_last_time
    $req_str = "DELETE FROM `membres_corres_last_time` WHERE `MATR` <> '".$membre_a_garder."';";
    $req = $GLOBALS['bdd']->prepare($req_str);
     if ($req->execute())
        {echo 'OK DELETE ALL IN membres_corres_last_time';}
        else
        { echo '<b>NOT</b> OK DELETE ALL IN membres_corres_last_time';}
        echo '<br/>';
    //membres_corres_connexion
    $req_str = " DELETE FROM `membres_corres_connexion` WHERE MATR <> '".$membre_a_garder."';";
    $req = $GLOBALS['bdd']->prepare($req_str);
     if ($req->execute())
        {echo 'OK DELETE ALL IN membres_corres_connexion';}
        else
        { echo '<b>NOT</b> OK DELETE ALL IN membres_corres_connexion';}
        echo '<br/>';
    //membres_corres
    $req_str = " DELETE FROM `membres_corres` WHERE MATR <> '".$membre_a_garder."';";
    $req = $GLOBALS['bdd']->prepare($req_str);
     if ($req->execute())
        {echo 'OK DELETE ALL IN membres_corres';}
        else
        { echo '<b>NOT</b> OK DELETE ALL IN membres_corres';}
        echo '<br/>';
    //membres_countries
    $req_str = " DELETE FROM `membres_countries` WHERE email <> '".$membre_a_garder."';";
    $req = $GLOBALS['bdd']->prepare($req_str);
     if ($req->execute())
        {echo 'OK DELETE ALL IN membres_countries';}
        else
        { echo '<b>NOT</b> OK DELETE ALL IN membres_countries';}
        echo '<br/>';
    
    echo '<br/>';
}




$membres_editeurs = array(); //init
// BFLY
//$membres_editeurs[] = array("edelamare@b-fly.com","Elora DELAMARE","france");
//$membres_editeurs[] = array("mlaunay@b-fly.com","Mathilde LAUNAY Delamare","france");
//$membres_editeurs[] = array("klorge@b-fly.com","Karine LORGE","france");
//$membres_editeurs[] = array("rruaz@b-fly.com","Romain RUAZ","france");
//$membres_editeurs[] = array("tschlick@b-fly.com","Thibaut SCHLICK","france");

// PSA
//$membres_editeurs[] = array("emmanuelle.belhomme@mpsa.com","Emmanuelle BELHOMME","france");
//$membres_editeurs[] = array("brenda.sznajderhaus@mpsa.com","Brenda SZNAJDERHAUS","argentina");
//$membres_editeurs[] = array("daniela.palmberger-kals@mpsa.com","Daniela PALMBERGER-KALS","austria");
//$membres_editeurs[] = array("daniela.palmberger-kals@mpsa.com","Daniela PALMBERGER-KALS","switzerland_de");
//$membres_editeurs[] = array("daniela.palmberger-kals@mpsa.com","Daniela PALMBERGER-KALS","switzerland_fr");
//$membres_editeurs[] = array("daniel.denis@mpsa.com","Daniel DENIS","belgium_fr");
//$membres_editeurs[] = array("daniel.denis@mpsa.com","Daniel DENIS","belgium_nlbe");
//$membres_editeurs[] = array("fabio.ouchi@mpsa.com","Fabio OUCHI","brazil");
//$membres_editeurs[] = array("xin.shu@mpsa.com","Xin SHU (Diana)","china");
//$membres_editeurs[] = array("olaf.seitz@mpsa.com","OLAF SEITZ","germany");
//$membres_editeurs[] = array("mauro.negri@mpsa.com","Mauro NEGRI","italy");
//$membres_editeurs[] = array("serumi.bakker@mpsa.com","Serumi BAKKER","netherlands");
//$membres_editeurs[] = array("agnieszka.dziedzic@mpsa.com","Agnieszka DZIEDZIC","poland");
//$membres_editeurs[] = array("michal.nic@mpsa.com","Michal NIC","slovakia");
//$membres_editeurs[] = array("rafael.rivero@mpsa.com","Rafael RIVERO LOMBA","spain");
//$membres_editeurs[] = array("rafael.rivero@mpsa.com","Rafael RIVERO LOMBA","portugal");
//$membres_editeurs[] = array("paul.lawlor@mpsa.com","Paul LAWLOR","uk");
//$membres_editeurs[] = array("vincent.lepoivre@gmail.com","Vincent Lepoivre gmail","austria");
//$membres_editeurs[] = array("vincent.lepoivre@gmail.com","Vincent Lepoivre gmail","switzerland_de");
//$membres_editeurs[] = array("vincent.lepoivre@gmail.com","Vincent Lepoivre gmail","portugal");
$membres_editeurs[] = array("nian.cao@mpsa.com","NIAN CAO","china");





// si besoin, lowercase emails, mais fonction avant $req faite de toute façon ci dessous
        //UPDATE membres_corres SET MATR = LOWER(MATR);
        //UPDATE membres_corres SET EMAIL = LOWER(EMAIL);

function generateRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

foreach ($membres_editeurs as $array_membre)
{
    $email = strtolower($array_membre[0]);
    $email = str_replace(" ","",$email);
    $nom = $array_membre[1];
    $ct = strtolower($array_membre[2]);
    $ct = str_replace(" ","",$ct);
    
    $salt_membre = generateRandomString();
    
    $req_str = "";
    
    // pour table membres_countries    
    // contrôle si existe déjà dans bdd       // contrôle EMAIL et COUNTRY dans la membres_countries
    $req_str_check = $bdd->prepare("SELECT COUNT(*) FROM `membres_countries` WHERE email = '".$email."' AND country = '".$ct."'");
    $req_str_check->execute();
    $count_email_ct = ($req_str_check->fetchColumn());
    
    // if supprimé car plusieurs lignes avec email possible => si plusieurs pays par corres
    //if ($count_email_ct == 0) // ok l'entrée email et ct n'existe pas
    {
        //$req_str .= "        
        //    INSERT INTO `membres_countries` (`id`, `email`, `prenom`, `nom`, `country`) VALUES
        //    ('', '".$email."', '', '".$nom."', '".$ct."');            
        //"; // fin $req_str
        
        $req_str .= "        
            INSERT INTO `membres_countries` (`email`, `prenom`, `nom`, `country`) VALUES
            ('".$email."', '', '".$nom."', '".$ct."');            
        "; // fin $req_str 
    }
//    else
//    {
//		echo '<b>NOT</b> OK === dans membres_countries === EMAIL + CT EXISTS === : '.$email.' - '.$ct;
//		echo '<br/>';
//    }

    
    
    // contrôle si existe déjà dans bdd       // contrôle MATR ET EMAIL
    $req_str_check = $bdd->prepare("SELECT COUNT(*) FROM `membres_corres` WHERE MATR = '".$email."' OR EMAIL = '".$email."'");
    $req_str_check->execute();
    $count_matr_email = ($req_str_check->fetchColumn());
    //echo $count_login;
	
	if ($count_matr_email > 0)
	{
		echo '<b>NOT</b> OK === dans membres_corres === MATR ou EMAIL EXISTS === : '.$email;
		echo '<br/>';
	}
	else // OK insertion
	{        
        //$req_str .= " 
        //    INSERT INTO `membres_corres` (`idmembre`, `nom`, `bu`, `MATR`, `profil`, `EMAIL`) VALUES
        //    ('', '".$nom."', 'BFLY', '".$email."', 'admin', '".$email."');
        //    ";        
        //$req_str .= "
        //    INSERT INTO `membres_corres_connexion` (`nbCnx`, `MATR`, `token`, `token_time`, `mccnx_mdp`, `time`, `mdp1`, `mdp2`, `mdp3`, `mdp4`, `mdp5`, `mdp6`, `mdp7`, `mdp8`, `mdp9`, `tent_login_nbr`, `tent_login_time`, `mccnx_salt`) VALUES
        //    ('', '".$email."', 'PKuUf8BNmH2zSg1sTDr08c74aRYSVEmyQ9xfXX64qqnEZbtQNKCwvddfUu75vpwBVAe5z3nFehjHJZcC', 1476691944, '8a274282b2dba91f8e24d6d615b53ec6bb209389', 1476691944, '3288d9702ae3f5d3f3680f05b51dbefde44b715a', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', 0, 0, '".$salt_membre."');
        //    ";        
        //$req_str .= "
        //    INSERT INTO `membres_corres_last_time` (`MATR`, `time`) VALUES
        //    ('".$email."', 1476691951);
        //    ";
            
        $req_str .= " 
            INSERT INTO `membres_corres` (`nom`, `bu`, `MATR`, `profil`, `EMAIL`) VALUES
            ('".$nom."', 'BFLY', '".$email."', 'admin', '".$email."');
            ";        
        $req_str .= "
            INSERT INTO `membres_corres_connexion` (`nbCnx`, `MATR`, `token`, `token_time`, `mccnx_mdp`, `time`, `mdp1`, `mdp2`, `mdp3`, `mdp4`, `mdp5`, `mdp6`, `mdp7`, `mdp8`, `mdp9`, `tent_login_nbr`, `tent_login_time`, `mccnx_salt`) VALUES
            (0, '".$email."', 'PKuUf8BNmH2zSg1sTDr08c74aRYSVEmyQ9xfXX64qqnEZbtQNKCwvddfUu75vpwBVAe5z3nFehjHJZcC', 1476691944, '8a274282b2dba91f8e24d6d615b53ec6bb209389', 1476691944, '3288d9702ae3f5d3f3680f05b51dbefde44b715a', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', '377ec2cc03088343debe523f1698b9c288ffab34', 0, 0, '".$salt_membre."');
            ";        
        $req_str .= "
            INSERT INTO `membres_corres_last_time` (`MATR`, `time`) VALUES
            ('".$email."', 1476691951);
            ";
            
    }
    
    
    
    
    
    
    
    
    
    if ($req_str != '') // requête ok
    {
        $req = $GLOBALS['bdd']->prepare($req_str);
        
        if ($req->execute())
        {
            echo 'OK '.$email;
            echo '<br/>';
            echo '<br/>';
        }
        else
        {
            echo '<b>NOT</b> OK '.$email;
            echo '<br/>';
            echo '<br/>';
        }
    }
    else
    {
        echo '*** PAS DE SQL ***';
        echo '<br/>';
    }
    
} // foreach ($membres_editeurs as $array_membre)



?>