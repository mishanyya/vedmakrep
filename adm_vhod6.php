<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php

include "config.php";//присоединить файл для подключения к серверу

if($_POST['pv'])
{
$pv=$_POST['pv'];
$pv=trim($pv);//убирает пробелы из начала и конца поля
$pv=htmlspecialchars($pv);
}

if($_POST['pn'])
{
$pn=$_POST['pn'];
$pn=trim($pn);//убирает пробелы из начала и конца поля
$pn=htmlspecialchars($pn);
}

if($_POST['pn1'])
{
$pn1=$_POST['pn1'];
$pn1=trim($pn1);//убирает пробелы из начала и конца поля
$pn1=htmlspecialchars($pn1);
}

session_start();
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

if(($pv!='')&&($pn!='')&&($pn==$pn1)&&($login_a!='')){//начало 1 - если есть временный и новый пароли и логин
$adm_vre_par=$pdo->query("SELECT COUNT(login) FROM admregi WHERE login='$login_a' AND vrepar='$pv'");
$adm_vre_par_kolvo=$adm_vre_par->fetchColumn();

if($adm_vre_par_kolvo=='1')
{//начало 2 - если есть такая строка с таким логином и временным паролем
$pn1=sha1($pn1);// зашифровка пароля
$adm_vre_par_up=$pdo->prepare("UPDATE admregi SET parol=? WHERE login='$login_a' AND vrepar='$pv'");
$adm_vre_par_up->execute(array($pn1));
echo"Пароль изменен<a href='adm_vhod2.php'>Далее</a>";

}
else{echo"Введен неверный логин и/или временный пароль<a href='adm_vhod.php'>Попробовать еще раз</a>";}//конец 2

}//продолжение 1
else
{//продолжение 1
echo"Пароль не введен<a href='adm_vhod.php'>Попробовать еще раз</a>";
//header("location:adm_vhod2.php");
}//конец 1
?>

</div>
</body>
</html>