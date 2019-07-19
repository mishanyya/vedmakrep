<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу


if($_POST['otzyv_otkogo'])
{
$otzyv_otkogo=$_POST['otzyv_otkogo'];
$otzyv_otkogo=trim($otzyv_otkogo);//убирает пробелы из начала и конца поля
$otzyv_otkogo=htmlspecialchars($otzyv_otkogo);

$otzyv_otkogo=filter_var($otzyv_otkogo);


}

if($_POST['otzyv_text'])
{
$otzyv_text=$_POST['otzyv_text'];
$otzyv_text=trim($otzyv_text);//убирает пробелы из начала и конца поля
$otzyv_text=htmlspecialchars($otzyv_text);

$otzyv_text=filter_var($otzyv_text);
}

session_start();
$login_a=$_SESSION['login_a'];//из сессии мой логин 
$rand_adm=$_SESSION['rand_adm'];//из сессии пароль
zash_vhod_admin($login_a,$rand_adm,$pdo);
$login_a_session=$_SESSION['login_a'];//из сессии мой логин 

if($login_a_session!='')
{//если логин есть в сессии
$login_a=$login_a_session;

}
else if ($_POST['login_a'])
{//если логина в сессии нет , но он прислан формой 
$login_a=$_POST['login_a'];
$login_a=trim($login_a);//убирает пробелы из начала и конца поля
$login_a=htmlspecialchars($login_a);
}
else{exit("Что-то сделали не так<a href='adm_vhod.php'>Попробовать еще раз</a>");}


if(($otzyv_otkogo!='')&&($otzyv_text!='')){

$otzyv_insert=$pdo->prepare("INSERT INTO otzyvy(nomer,otkogo,otzyv,data) VALUES(null,?,?,CURDATE())");
$otzyv_insert->execute(array($otzyv_otkogo,$otzyv_text));
$otzyv_insert_count=$otzyv_insert->rowCount();//количество строк
if($otzyv_insert_count>0)
{
echo"<p>Отзыв добавлен</p>&nbsp;<a  href='adm_vhod2.php'>Далее</a>";
}
else{echo"<p>Отзыв не добавлен</p>&nbsp;<a  href='adm_vhod2.php'>Назад</a>";}
}

else{echo"<a  href='adm_vhod2.php'>Назад</a>";}
?>

</div>
</body>
</html>