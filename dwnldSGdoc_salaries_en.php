<?php
if (isset($_GET['docname'])) {$doc = (htmlspecialchars(addslashes($_GET['docname'])));} else {$doc = '';}

// test avant dèv docs
$doc_coming_soon = '_document_coming_soon.pdf';
//$doc = $doc_coming_soon; // force tous les docs vers ce doc coming soon

$si_doc_not_found_doc_coming_soon = false; // true - false => permet d'inactiver le message d'erreur et l'email, et de forcer le doc coming soon à la place

$filePath = "doc_salaries_peg/";
$fileName = $doc;

if(substr($filePath,-1)!="/") $filePath .= "/";

$pathOnHd = $filePath . $fileName;

require_once ('inc_fonctions.php');
require_once ('inc_var_globales_countries_list.php'); // listes pays
require_once ('inc_var_globales.php');
require_once('_inc_bdd_connect.php');

if (file_exists($pathOnHd))
{
	
	$req = $bdd->prepare("INSERT INTO docs_xnet_count_17 SET doc='".$pathOnHd."';");
	$req->execute();
	
	// TEST download 2  http://www.developpez.net/forums/d797157/php/langage/fonctions/telechargement-ie8/
	//$file = "http://www.domaine.ext/chemin/vers/le/_fichier.ext";
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($pathOnHd));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	ob_clean();
	flush();
	readfile($pathOnHd);
	exit;
	
}
else
{
	if ($si_doc_not_found_doc_coming_soon) // on force vers le doc coming soon sans email et sans bdd
	{
		$pathOnHd = $filePath . $doc_coming_soon;
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($pathOnHd));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		ob_clean();
		flush();
		readfile($pathOnHd);
		exit;
	}
	
	else // message d'erreur de doc not found + envoi d'email à l'admin
	{
		$headers = "From: ".$EMAIL_SITE_NAME." <".$EMAIL_WEBMASTER.">\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$to = $EMAIL_WEBMASTER;
		$sujet =  $EMAIL_SITE_NAME." - doc pb : ".$pathOnHd;
		$texte_mail = "Document pb : ".$pathOnHd;
		
		
		//TEST ONLY MAUIS AFFICHAGE DES EMAILS
		//if(1==1)
		
		if(mail( $to,utf8_decode($sujet), utf8_decode($texte_mail),utf8_decode($headers) ) )
		{
			echo '
				<!DOCTYPE html "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<title>
						'.$EMAIL_SITE_NAME.' | DOCUMENT NOT FOUND
					</title>
					<meta http-equiv="content-type" content="text/html; charset=UTF-8">
					<meta name="robots" content="noindex,nofollow" />			
					<link rel="stylesheet" type="text/css" href="assets/css/MyFontsWebfontsKit.css">			
					<link rel="stylesheet" href="assets/css/styles.css" />  
					<!--[if lte IE 7]><link rel="stylesheet" href="assets/css/ie7.css" /><![endif]-->
					<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
				</head>		
				<body>
				
				<h3 style="text-align:center;color:#2a5ea8">
						<br/><br/><br/>
						Document non trouvé.
						<br/>
						Le webmaster est averti et ajoutera le document dès que possible.		
				</h3>
				<h3 style="text-align:center;color:#8ec549">
						<br/>
						Document not found.
						<br/>
						The webmaster is informed and will add the document as soon as possible.
						<br/><br/><br/>			
				</h3>
				</body>
				</html>
			';
		}
		else
		{
			echo '
				<!DOCTYPE html "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<title>
						'.$EMAIL_SITE_NAME.' | DOCUMENT NOT FOUND
					</title>
					<meta http-equiv="content-type" content="text/html; charset=UTF-8">
					<meta name="robots" content="noindex,nofollow" />			
					<link rel="stylesheet" type="text/css" href="assets/css/MyFontsWebfontsKit.css">			
					<link rel="stylesheet" href="assets/css/styles.css" />  
					<!--[if lte IE 7]><link rel="stylesheet" href="assets/css/ie7.css" /><![endif]-->
					<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
				</head>		
				<body>
				<h3 style="text-align:center;color:#2a5ea8">
						<br/><br/><br/>
						Document non trouvé.
						<br/>
						Merci de contacter <a href="mailto:'.$EMAIL_WEBMASTER.'&subject=document problem: '.$pathOnHd.'">'.$EMAIL_WEBMASTER.'</a>.
				</h3>
				<h3 style="text-align:center;color:#8ec549">
						<br/>
						Document not found.
						<br/>
						Please contact <a href="mailto:'.$EMAIL_WEBMASTER.'&subject=document problem: '.$pathOnHd.'">'.$EMAIL_WEBMASTER.'</a>.
						<br/><br/><br/>			
				</h3>
				</body>
				</html>
			';
		}
	}

}

?>