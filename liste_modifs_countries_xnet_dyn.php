<?php

//     =============================             ATTENTION script direct pour insert en BDD
//     =============================             ATTENTION script direct pour insert en BDD
//     =============================             ATTENTION script direct pour insert en BDD

$country = 'ivorycoast';
$lg = 'fr';
$page = 'index';
$TITRE_SITE = 'liste modifs';

include('inc_meta.php');

?>

<style>
    table td, table th {
        border:1px solid #ddd;
        font-size:10px;
    }
</style>

<?php

include('_inc_bdd_connect.php');

$table_history = 'pages__changes_history';

// pour table membres_countries    
// contrôle si existe déjà dans bdd       // contrôle EMAIL et COUNTRY dans la membres_countries
//$req_select_history = $bdd->prepare("SELECT * FROM `".$table_history."` WHERE email = '".$email."' AND country = '".$ct."'");
$req_select_history = $bdd->prepare("SELECT * FROM `".$table_history."` ORDER BY time DESC;");
$req_select_history->execute();
$count_select_history = ($req_select_history->fetchColumn());

if ($count_select_history == 0) // ok l'entrée email et ct n'existe pas
{
    echo "Pas d'historique avec ces données.";
}
else
{   
    if ($req_select_history->execute())
    {
        $modifications = array();
        while ($ligne = $req_select_history->fetch(PDO::FETCH_ASSOC))
        {
            $modifications[] = $ligne;
        }
    }
    echo '<table>';
    foreach($modifications as $modif)
    {
        echo '<tr>';
        
        echo '<td>';
            echo $modif['code_texte'];        
        echo '</td>';
        echo '<td style="word-break: break-all;">';
            echo htmlspecialchars($modif['contenu_texte']);
        echo '</td>';
        echo '<td>';
            echo date('j-m-y',$modif['time']);
        echo '</td>';
        echo '<td>';
            echo date('H:i:s',$modif['time']);
        echo '</td>';
        echo '<td>';
            echo $modif['membre'];        
        echo '</td>';
        echo '<td>';
            echo $modif['country'];        
        echo '</td>';
        
        echo '</tr>';
    }
    echo '</table>';
    
}


 

?>