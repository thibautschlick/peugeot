<!--			<img class="img_home" id="img_home_<?php echo $lg; ?>" src="assets/images/home_ban_<?php echo $lg; ?>.png"></img>-->
<?php
    if($PRIX_IS_FIXED)
    {
        $lg_banniere = "prix_".$lg;
    }
    else
    {
        $lg_banniere = $lg;
    }
?>
<div class="banniere_container">
	<img id="banniere_img" src="assets/images/banniere_1420_<?php echo $lg_banniere ?>.png">
	<img id="banniere_img_2" src="assets/images/banniere_600_<?php echo $lg_banniere ?>.png">
	<img id="banniere_img_3" src="assets/images/banniere_400_<?php echo $lg_banniere ?>.png">
</div>

