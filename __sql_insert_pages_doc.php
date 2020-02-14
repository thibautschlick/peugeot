<?php

$doc_inserts = 15;

for ($i=1;$i<=$doc_inserts;$i++)
{
    echo "
        INSERT INTO  `saintgobain_peg17`.`pages_en_uk` (
        `id` ,
        `code_page` ,
        `code_texte` ,
        `contenu_texte` ,
        `time` ,
        `membre` ,
        `doc` ,
        `champ8`
        )
        VALUES (
        '' ,  'docpeg',  'docpeg_".$i."',  'Document',  '1454484956',  'vlepoivre@b-fly.com',  'document_".$i.".pdf', NULL
        );
		<br/>
    ";
}



?>