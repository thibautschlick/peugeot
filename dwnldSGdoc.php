<?php
session_start();
session_regenerate_id();
if ((isset($_SESSION['validated_access'])) AND ($_SESSION['validated_access']==1 AND isset($_SESSION['access_cordoc'])) AND ($_SESSION['access_cordoc']==1))
{
    if (isset($_GET['docname'])) {$docname=htmlentities(addslashes($_GET['docname']));}
    $chemin='doc_cor_peg/';
    $path = $chemin.$docname;
    if(file_exists($path)) {
        
		// CONNEXION BASE DE DONNEES
		require ('_inc_bdd_connect.php');
        
        $path = mysql_real_escape_string($path);
		//$retour = mysql_query("SELECT nom, prenom, email, tel, fax, societe, id, perimetre FROM contacts_xnet WHERE pays='$pays_select' ORDER BY societe, nom");
		$req = mysql_query("INSERT INTO docs_xnet_count_17 SET doc='".$path."';");
		$resultat = mysql_query($req);
		//mysql_fetch_array($retour) // On fait une boucle pour lister les abonnés
		
	    
        //octet-stream
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');// IMPORTANT IE
        header('Pragma: public');// IMPORTANT IE
        header("Content-Length: " . filesize ( $path ) ); 
        header("Content-type: application/octet-stream"); 
        header("Content-disposition: attachment; filename=".basename($path));
        header('Expires: 0');
        ob_clean();
        flush();        
        readfile($path);
        }
    header('Location: site.php?page=espace_corres');
}

else {header('Location: index.php');} ?>