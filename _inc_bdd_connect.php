<?php


// Variables pour LocalHost
$HOST = "localhost"; $LOGIN = "root"; $PASSWORD = ""; $DATABASE = "psa_xnet17";

$dsn = 'mysql:dbname='.$DATABASE.';host='.$HOST.';charset=UTF8';
$user = $LOGIN;
$password = $PASSWORD;

try
{
    $bdd = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
    //global $bdd;
}
catch (PDOException $e)
{
    echo 'Connexion failed : ' . $e->getMessage();
}


//
//
////$HOST = "10.0.207.167"; $LOGIN = "bfly"; $PASSWORD = "9e*R/f8=6+f5R"; $DATABASE = "saintgobain_2013_contacts";
////$HOST = "89.185.57.225"; $LOGIN = "saintgobain"; $PASSWORD = "dnt9PXLRrPPxssrM"; $DATABASE = "saintgobain";	
//$HOST = "localhost"; $LOGIN = "root"; $PASSWORD = ""; $DATABASE = "saintgobain_peg_dyn";	
//// Connexion MySQL & BDD
//$cnx = mysql_connect($HOST, $LOGIN, $PASSWORD);
//$bdd = mysql_select_db($DATABASE, $cnx);
//mysql_set_charset('utf8',$cnx);
//

?>