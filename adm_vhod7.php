<html>	
<head>

<title>Личная страница</title>
<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу


//if($_POST['admina_email'])
//{
$admina_email=$_POST['admina_email'];
$admina_email=trim($admina_email);//убирает пробелы из начала и конца поля
$admina_email=htmlspecialchars($admina_email);
//}

//if($_POST['admina_h1'])
//{
$admina_h1=$_POST['admina_h1'];
$admina_h1=trim($admina_h1);//убирает пробелы из начала и конца поля
$admina_h1=htmlspecialchars($admina_h1);
//}

//if($_POST['admina_h2'])
//{
$admina_h2=$_POST['admina_h2'];
$admina_h2=trim($admina_h2);//убирает пробелы из начала и конца поля
$admina_h2=htmlspecialchars($admina_h2);
//}

//if($_POST['admina_koordinaty'])
//{
$admina_koordinaty=$_POST['admina_koordinaty'];
$admina_koordinaty=trim($admina_koordinaty);//убирает пробелы из начала и конца поля
$admina_koordinaty=htmlspecialchars($admina_koordinaty);
//}


//if($_POST['admina_title'])
//{
$admina_title=$_POST['admina_title'];
$admina_title=trim($admina_title);//убирает пробелы из начала и конца поля
$admina_title=htmlspecialchars($admina_title);
//}



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

$admina_update=$pdo->prepare("UPDATE admregi_to SET email=?,h1=?,h2=?,koordinaty=?,title=?");
$admina_update->execute(array($admina_email,$admina_h1,$admina_h2,$admina_koordinaty,$admina_title));

$admina_update_count=$admina_update->rowCount();//количество строк в запросе

if($admina_update_count>0){echo"<p>Данные изменены</p>&nbsp;<a  href='adm_vhod2.php'>Далее</a>";}
else{echo"<p>Данные не изменены</p>&nbsp;<a  href='adm_vhod2.php'>Назад</a>";}


?>

</div>
</body>
</html>