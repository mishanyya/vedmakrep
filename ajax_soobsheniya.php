<?php
include "config.php";//присоединить файл для подключения к серверу
session_start();
$imya_gadalki=$_SESSION['imya_gadalki'];//имя гадалки
$login=$_SESSION['login'];//из сессии логин пользователя
$kontrol=$_SESSION['kontrol'];//контрольное число для входа
$kontrol_entrance=$pdo->prepare("SELECT COUNT(login) FROM regi WHERE login='$login' AND vrepar=?");
$kontrol_entrance->execute(array($kontrol));
$kontrol_entrance_count=$kontrol_entrance->fetchColumn();
$kolvo_sms=$pdo->prepare("SELECT COUNT(sms) FROM soobsh WHERE login=? OR komu=?");
$kolvo_sms->execute(array($login,$login));
$kolvo_sms_count=$kolvo_sms->fetchColumn();//количество имеющихся сообщений

if($kontrol_entrance_count>0){
$a=name_from_login($login,$pdo);
//для limita данные
$skolko;//сколько данных выводить
$vsego;///сколько строк в результате запроса
//подсчет результата запроса
$sms_number=$pdo->prepare("SELECT COUNT(*) FROM soobsh WHERE (login=? AND komu='admin_or') OR (login='admin_or' AND komu=?)");
$sms_number->execute(array($login,$login));
$vsego=$sms_number->fetchColumn();


$skolko=$_GET['skolko'];
$skolko=trim($skolko);//убирает пробелы из начала и конца поля
$skolko=htmlspecialchars($skolko);


if($skolko==''){$skolko=5;}

$skakogo=$vsego-$skolko;//с какого вывод производить
if($skakogo<0){$skakogo=0;}
if($skolko<0){$skolko=0;}


//выбор и вывод сообщений
$sms_in=$pdo->prepare("SELECT * FROM soobsh WHERE login=? AND komu='admin_or' UNION SELECT * FROM soobsh WHERE login='admin_or' AND komu=? ORDER BY nomer ASC limit $skakogo,$skolko");
$sms_in->execute(array($login,$login));
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{//начало 1
if(($line->login)==$login){//начало 2
$otkogo=name_from_login($login,$pdo);
echo"<p class='sms'><b class='adresat'>$otkogo</b>  &nbsp; <br/>";
}
else{echo"<p class='sms'>$imya_gadalki &nbsp;<br/>";
}//конец 2
echo"&nbsp; <b> $line->sms </b>&nbsp;";
echo"<i>$line->data</i> </p>";
}//конец 1
//обозначение сообщений - как прочитанных - меняем 0 на 1
$sms_read=$pdo->prepare("UPDATE soobsh SET proch='1' WHERE komu=? AND proch='0'");
$sms_read->execute(array($login));
}
?>