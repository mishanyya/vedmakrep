
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

$a=name_from_login($login,$pdo);

//для limita данные
$skakogo=$_GET['skakogo'];//с какого вывод производить
$skakogo=trim($skakogo);//убирает пробелы из начала и конца поля
$skakogo=htmlspecialchars($skakogo);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



$skolko=$_GET['skolko'];//сколько данных выводить
$skolko=trim($skolko);//убирает пробелы из начала и конца поля
$skolko=htmlspecialchars($skolko);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

$vsego=$_GET['vsego'];///сколько строк в результате запроса
$vsego=trim($vsego);//убирает пробелы из начала и конца поля
$vsego=htmlspecialchars($vsego);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение


$naskolko_bolshe=$_GET['naskolko_bolshe'];//на сколько строк увеличивается при каждом запросе
$naskolko_bolshe=trim($naskolko_bolshe);//убирает пробелы из начала и конца поля
$naskolko_bolshe=htmlspecialchars($naskolko_bolshe);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение



//подсчет результата запроса
$sms_number=$pdo->query("SELECT COUNT(*) FROM soobsh WHERE (login='$login' AND komu='admin_or') OR (login='admin_or' AND komu='$login')");

$vsego=$sms_number->fetchColumn();

if($skolko==''){$skolko=2;}
if($skakogo==''){$skakogo=$vsego-$skolko;}


//if($naskolko_bolshe==''){$naskolko_bolshe=2;}

//выбор и вывод сообщений
$sms_in=$pdo->query("SELECT * FROM soobsh WHERE login='$login' AND komu='admin_or' UNION SELECT * FROM soobsh WHERE login='admin_or' AND komu='$login' ORDER BY nomer ASC limit $skakogo,$skolko");
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{//начало 1
if(($line->login)==$login){//начало 2
$otkogo=name_from_login($login,$pdo);
echo"/от  $otkogo / &nbsp; ";
}
else{echo"* от админа * &nbsp;";
}//конец 2
echo"$line->sms &nbsp";
echo"$line->data <br/>";
}//конец 1

//обозначение сообщений - как прочитанных - меняем 0 на 1

$sms_read=$pdo->exec("UPDATE soobsh SET proch='1' WHERE komu='$login' AND proch='0'");
echo")))";
}


?>

