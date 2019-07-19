<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу


//if($_POST['admina_login'])
//{
$admina_login=$_POST['admina_login'];
$admina_login=trim($admina_login);//убирает пробелы из начала и конца поля
$admina_login=htmlspecialchars($admina_login);
$admina_login=filter_var($admina_login);
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




if(($admina_login!='')&&($login_a!='')){//начало 1
$admina_update=$pdo->prepare("UPDATE admregi,admregi_to SET admregi.login=?,admregi_to.login=? WHERE (admregi.login=?)AND(admregi_to.login=?)");
$admina_update->execute(array($admina_login,$admina_login,$login_a,$login_a));

$admina_update_count=$admina_update->rowCount();//количество строк

if($admina_update_count>0){echo"<p>Логин изменен на $admina_login</p>&nbsp;<a  href='adm_vhod.php'>Войти снова</a>";}
else{echo"<p>Логин не изменен</p>&nbsp;<a  href='adm_vhod2.php'>Назад</a>";}
}
else{
echo"<p>Логин не введен</p>&nbsp;<a  href='adm_vhod2.php'>Назад</a>";
}//конец 1 
?>

</div>
</body>
</html>