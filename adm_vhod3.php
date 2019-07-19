<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
$login_a=$_SESSION['login_a'];//из сессии мой логин 
$rand_adm=$_SESSION['rand_adm'];//из сессии пароль
zash_vhod_admin($login_a,$rand_adm,$pdo);
$login_sms=$_SESSION['login_sms'];//из сессии логин адресата


if($_GET['textarea_a']){
$textarea=$_GET['textarea_a'];

$textarea=trim($textarea);
$textarea_a=htmlspecialchars($textarea);

$textarea_insert=$pdo->prepare("INSERT INTO soobsh(nomer,login,sms,data,proch,komu) VALUES(NULL,'admin_or',?,NOW(),'0','$login_sms')");
$textarea_insert->execute(array($textarea_a));
//header("location:adm_vhod2.php");
}
else{header("location:adm_vhod2.php");
}
?>