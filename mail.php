<?php 
$email = $_REQUEST['email'];
$to = $email;
$subject = "Scenekey";
$txt = "Hello This is text message.";
$headers = "From: info@igdsdc_com_md-in-21_webhostbox_net";
$mail =  mail($to,$subject,$txt,$headers);
if($mail='true')
{
echo '<script type="text/javascript">window.location.href="index.php?msg=suc"</script>'; 
}else
{echo '<script type="text/javascript">window.location.href="index.php?msg=fail"</script>'; 
}
?> 