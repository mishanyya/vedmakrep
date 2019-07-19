<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
$login=$_SESSION['login'];//из сессии логин пользователя
/*
if($login==''){echo"<a href='vhodi.php'>Войти в личный кабинет</a>";}
else if($login!=''){
$name_from_login=name_from_login($login,$pdo);
echo"Вы вошли как $name_from_login";}
*/


if($login!=''){



//подсчет результата запроса
$sms_number=$pdo->query("SELECT COUNT(*) FROM soobsh WHERE (login='$login' AND komu='admin_or') OR (login='admin_or' AND komu='$login')");

$vsego=$sms_number->fetchColumn();
echo"$vsego";

}

?>

