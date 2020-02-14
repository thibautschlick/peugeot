<?php


// Variables pour LocalHost

$HOST = "localhost"; $LOGIN = "u_psa_17"; $PASSWORD = "Trwwp7tqHqrbWRVw"; $DATABASE = "psa_xnet17";

//$HOST = "localhost"; $LOGIN = ""; $PASSWORD = ""; $DATABASE = "saintgobain_peg17";

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

?>