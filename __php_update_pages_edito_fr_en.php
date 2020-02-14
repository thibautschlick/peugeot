<?php

// ATTENTION ! SCRIPT DIRECT EN BDD

include ('_inc_bdd_connect.php');

// 0 NAME  1 LANGUE  2 FORMULE  3 AFFICHAGE_MAPMONDE
$countries_CODE_LG_FORM = array(
'argentina'=>array('Argentina','esal','fcpe',true),
'australia'=>array('Australia','en','fcpe',true),
'austria'=>array('Austria','de','fcpe',false),
'belgium_fr'=>array('Belgium (fr)','fr','fcpe',true),
'belgium_nlbe'=>array('Belgium (fla)','nlbe','fcpe',true),
'brazil'=>array('Brazil','ptal','fcpe',true),
'bulgaria'=>array('Bulgaria','bg','fcpe',true),
'canada_en'=>array('Canada (en)','en','fcpe',true),
'canada_fr'=>array('Canada (fr)','fr','fcpe',true),
'china'=>array('China','cn','fcpe',true),
'colombia'=>array('Colombia','esal','fcpe',true),
'czechrepublic'=>array('Czech republic','cs','fcpe',true),
'denmark'=>array('Denmark','dn','fcpe',true),
'estonia'=>array('Estonia','et','fcpe',true),
'finland'=>array('Finland','fi','fcpe',true),
'france'=>array('France','fr','fcpe',true),
'germany'=>array('Germany','de','fcpe',false),
'hungary'=>array('Hungary','hu','fcpe',false),
'india'=>array('India','en','fcpe',true),
'indonesia'=>array('Indonesia','id','fcpe',true),
'ireland'=>array('Ireland','en','fcpe',true),
'italy'=>array('Italy','it','fcpe',false),
'japan'=>array('Japan','jp','fcpe',true),
'latvia'=>array('Latvia','lv','fcpe',true),
'lithuania'=>array('Lithuania','lt','fcpe',true),
'luxembourg'=>array('Luxembourg','fr','fcpe',true),
'malaysia'=>array('Malaysia','en','fcpe',false),
'mexico'=>array('Mexico','esal','fcpe',true),
'netherlands'=>array('Netherlands','nl','fcpe',true),
'norway'=>array('Norway','no','fcpe',true),
'poland'=>array('Poland','pl','fcpe',true),
'portugal'=>array('Portugal','pt','fcpe',false),
'romania'=>array('Romania','ro','fcpe',true),
'serbia'=>array('Serbia','sr','fcpe',false),
'singapore'=>array('Singapore','en','fcpe',false),
'slovakia'=>array('Slovakia','sk','fcpe',true),
'southafrica'=>array('South Africa','en','fcpe',false),
'southkorea'=>array('South Korea','ko','fcpe',true),
'spain'=>array('Spain','es','fcpe',false),
'sweden'=>array('Sweden','sv','fcpe',true),
'switzerland_de'=>array('Switzerland (de)','de','fcpe',false),
'switzerland_fr'=>array('Switzerland (fr)','fr','fcpe',false),
//'switzerland_it'=>array('Switzerland (it)','it','fcpe',false),
'thailand'=>array('Thailand','th','fcpe',true),
'turkey'=>array('Turkey','tr','fcpe',false),
'uk'=>array('UK','en','fcpe',true),
);

echo '<table>';
foreach($countries_CODE_LG_FORM as $ct_code => $ct_array)
{
    $ct_lg = $ct_array[1];
    
    if($ct_lg == 'fr')
    {
        $req = $bdd->prepare("
            UPDATE  `pages_".$ct_code."`
            SET  `contenu_texte` =  'SUCCÈS POUR LE <b>30<sup>ème</sup> PEG !</b>'
            WHERE  `code_texte` = 'home_30ans_titre';
            ");
        $req->execute(); 
        echo '<tr>';          
        echo '<td>'.$ct_code.'</td>';
        echo '<td>'.$ct_lg.'</td>';
        echo '<td>**FR**</td>';
        echo '<td>home_30ans_titre</td>';
        echo '</tr>';
        $req = $bdd->prepare("
            UPDATE  `pages_".$ct_code."`
            SET  `contenu_texte` =  'La participation à la 30<sup>ème</sup> édition du Plan d’Épargne Groupe est en hausse de 24&nbsp;% par rapport à l’an dernier. 8&nbsp;000 nouveaux souscripteurs ont ainsi décidé de s’associer au développement de notre Groupe. Au total, plus de 40&nbsp;000 personnes ont souscrit, confirmant la place des salariés comme 1<sup>er</sup> actionnaire de Saint-Gobain. <br/> En France, le taux de participation approche ainsi les 60&nbsp;%. Dans les 41 autres pays, la hausse significative des souscriptions enregistrée en 2016 s’est amplifiée cette année avec une augmentation du nombre de souscripteurs de 32&nbsp;%. En deux ans, la participation y a augmenté de 55&nbsp;%.  <br/> Près de 169&nbsp;millions d’euros seront investis dans l’augmentation de capital le 17&nbsp;mai prochain par les fonds d’actionnariat salarié du Groupe.'
            WHERE  `code_texte` = 'home_30ans_contenu';
            ");
        $req->execute();  
        echo '<tr>';            
        echo '<td>'.$ct_code.'</td>';
        echo '<td>'.$ct_lg.'</td>';
        echo '<td>**FR**</td>';
        echo '<td>home_30ans_contenu</td>';
        echo '</tr>';
    }
    else
    {
        $req = $bdd->prepare("
            UPDATE  `pages_".$ct_code."`
            SET  `contenu_texte` =  '<b>30<sup>TH</sup> PEG</b> IS A SUCCESS!'
            WHERE  `code_texte` = 'home_30ans_titre';
            ");
        $req->execute(); 
        echo '<tr>';             
        echo '<td>'.$ct_code.'</td>';
        echo '<td>'.$ct_lg.'</td>';
        echo '<td>---EN---</td>';
        echo '<td>home_30ans_titre</td>';
        echo '</tr>';
        $req = $bdd->prepare("
            UPDATE  `pages_".$ct_code."`
            SET  `contenu_texte` =  'Participation in the 30<sup>th</sup> PEG (Group Savings Plan) was 24&nbsp;percent higher than last year. 8,000 new subscribers decided to join in our Group’s development, bringing to 40,000 the total number of people who subscribed. As a result the employees are Saint-Gobain’s number one shareholder. <br/> In France, the participation rate is now close to 60&nbsp;percent. In the 41 other countries, after an already significant rise in subscriptions in 2016, this year the number was up by 32&nbsp;percent. In two years, the participation rate has increased by 55&nbsp;percent in these countries. <br/> Almost €169 million will be invested in the capital increase on May 17, by the Group employee shareholder funds.'
            WHERE  `code_texte` = 'home_30ans_contenu';
            ");
        $req->execute();  
        echo '<tr>';            
        echo '<td>'.$ct_code.'</td>';
        echo '<td>'.$ct_lg.'</td>';
        echo '<td>---EN---</td>';
        echo '<td>home_30ans_contenu</td>';
        echo '</tr>';
    }
}

echo '</table>';



?>