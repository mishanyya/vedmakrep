

<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
if(isset($_SESSION['login'])){$login=$_SESSION['login'];}//из сессии логин пользователя
if(isset($_SESSION['login_sms'])){
$login_sms=$_SESSION['login_sms'];//из сессии логин адресата

//вывод сообщений

$sms_in=$pdo->query("SELECT * FROM soobsh WHERE login='admin_or' AND komu='$login_sms' UNION SELECT * FROM soobsh WHERE login='$login_sms' AND komu='admin_or'   ORDER BY nomer ASC ");
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{
$imya_no_read=name_from_login($line->login,$pdo);
echo"<p class='sms'><b class='adresat'>$imya_no_read</b><br/>";
if($line->login=='admin_or'){echo"Мое сообщение<br/>";}
echo"&nbsp; <b> $line->sms </b>&nbsp;";

echo"<i>$line->data</i> </p>";}

//обозначение сообщений - как прочитанных - меняем 0 на 1

$sms_read=$pdo->exec("UPDATE soobsh SET proch='1' WHERE komu='admin_or' AND login='$login_sms' AND proch='0'");
}


?>


