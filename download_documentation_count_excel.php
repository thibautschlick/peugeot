<?php
session_start();
header("content-disposition: attachment;filename=download_docs_count.xls");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Pragma: no-cache"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
header("Expires: 0");
$contenu_xls = $_SESSION['export_xls'];
$contenu_xls = utf8_decode($contenu_xls);
//$contenu_xls = str_replace('<br/>',' // ',$contenu_xls);
//$contenu_xls = str_replace('<br />',' // ',$contenu_xls);
$contenu_xls = str_replace('(sort)','',$contenu_xls);
$contenu_xls = str_replace('Edit','',$contenu_xls);
echo $contenu_xls;
?>