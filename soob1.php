<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
$login=$_SESSION['login'];//из сессии логин пользователя

if($_GET['textarea']){
$textarea=$_GET['textarea'];

$textarea=trim($textarea);
$textarea=htmlspecialchars($textarea);

$textarea_insert=$pdo->prepare("INSERT INTO soobsh(nomer,login,sms,data,proch,komu) VALUES(NULL,'$login',?,NOW(),'0','admin_or')");
$textarea_insert->execute(array($textarea));

$www=isonline($pdo);


if($www=='notonline'){//если администратор не онлайн

$title ='Вам пришло сообщение';
$adres=$pdo->query("SELECT email FROM admregi_to ORDER BY nomer ASC");
while($adres_1=$adres->fetch(PDO::FETCH_LAZY))
{
$from=$adres_1->email;
$to=$adres_1->email;
}
// $to - кому отправляем
// $from - от кого

// $to - кому отправляем
$to=trim($to);
// $from - от кого

$from=trim($from);
$mes='с вашего сайта ';//.$_SERVER['HTTP_HOST']
//$mes='http://'.$_SERVER['HTTP_HOST'];
//$mes='http://'.$_SERVER['HTTP_HOST'];//вывод адреса страницы
//$mes='http://vmesteprosto.info/vedmak';
// функция, которая отправляет наше письмо.

//$headers = 'From:'.$from;//плохо работает на хостинге
$headers='From:klient';
mail($to,$title,$mes,$headers);

}}

?>