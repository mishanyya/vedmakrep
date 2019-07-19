<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу


//if($_POST['admina_biografia'])
//{
$admina_biografia=$_POST['admina_biografia'];
$admina_biografia=trim($admina_biografia);//убирает пробелы из начала и конца поля
$admina_biografia=htmlspecialchars($admina_biografia);

$admina_biografia=filter_var($admina_biografia);


//}

//if($_POST['admina_rod_zanyatiy'])
//{
$admina_rod_zanyatiy=$_POST['admina_rod_zanyatiy'];
$admina_rod_zanyatiy=trim($admina_rod_zanyatiy);//убирает пробелы из начала и конца поля
$admina_rod_zanyatiy=htmlspecialchars($admina_rod_zanyatiy);

$admina_rod_zanyatiy=filter_var($admina_rod_zanyatiy);
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




$admina_update=$pdo->prepare("UPDATE admregi_to SET biografia=?,rod_zanyatiy=? WHERE login=?");
$admina_update->execute(array($admina_biografia,$admina_rod_zanyatiy,$login_a));
$admina_update_count=$admina_update->rowCount();//количество строк в запросе

if($admina_update_count>0)
{
echo"<p>Данные изменены</p>&nbsp;<a  href='adm_vhod2.php'>Далее</a>";
}

else{echo"<p>Данные не изменились</p>&nbsp;<a  href='adm_vhod2.php'>Назад</a>";}


?>

</div>
</body>
</html>