<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу


if($_POST['otzyvy_massiv_radio'])
{
$otzyvy_massiv_radio=$_POST['otzyvy_massiv_radio'];
$otzyvy_massiv_radio=trim($otzyvy_massiv_radio);//убирает пробелы из начала и конца поля
$otzyvy_massiv_radio=htmlspecialchars($otzyvy_massiv_radio);

$otzyvy_massiv_radio=filter_var($otzyvy_massiv_radio);


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



$otzyvy_massiv_del=$pdo->exec("DELETE FROM otzyvy WHERE nomer='$otzyvy_massiv_radio'");


if($otzyvy_massiv_del>0)
{
echo"<p>Отзыв удален</p>&nbsp;<a  href='adm_vhod2.php'>Далее</a>";
}

else{echo"<a  href='adm_vhod2.php'>Назад</a>";}


?>

</div>
</body>
</html>