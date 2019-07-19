

<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
$login_a=$_SESSION['login_a'];//из сессии логин админа


if(isset($_SESSION['login'])){$login_sms=$_SESSION['login'];}//из сессии логин адресата

$no_read_sms=$pdo->query("SELECT DISTINCT login FROM soobsh WHERE komu='admin_or' AND proch='0'");
while($line_neproch=$no_read_sms->fetch(PDO::FETCH_LAZY)){

$imya_no_read=name_from_login($line_neproch[0],$pdo);

if($login_sms==$line_neproch[0]){
echo"<p>Имеется непрочитанное сообщение от </p><a href='adm_vhod2.php?a=$line_neproch[0]'><p><b>$imya_no_read</b></p></a> <br/> ";
}
else if((($login_sms=='')&&($line_neproch[0]!=''))||(($login_sms!='')&&($login_sms!=$line_neproch[0])))  {
echo"<p>Имеется непрочитанное сообщение от </p><a href='adm_vhod2.php?a=$line_neproch[0]'><p><b>$imya_no_read</b></p></a> <br/> ";
}
}

?>


