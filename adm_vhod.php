<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<?php
include "config.php";//присоединить файл для подключения к серверу

$loginCount=$pdo->query("SELECT COUNT(login) FROM admregi");//количество строк в таблице админа
$loginCount_proverenniy=$loginCount->fetchColumn();
echo "$loginCount_proverenniy";

if($loginCount_proverenniy>0){
echo"<form action='adm_vhod1.php' method='POST' class='autoriz'>";

echo"<h3>Войдите в  кабинет администратора</h3>";

echo"<p>Логин:</p>";
echo"<input required name='login_a'/>";
echo"<p>Пароль:</p>";
echo"<input type='password' required name='parol_a'/>";
echo"<input type='submit'  value='Войти'>";
}

else{
echo"<form action='adm_vhod12.php' method='POST' class='autoriz'>";

echo"<h3>Зарегистрируйтесь в  кабинете администратора</h3>";



echo"<p>Логин:</p>";
echo"<input required name='login_a'/>";
echo"<p>Пароль:</p>";
echo"<input type='password' required name='parol_a'/>";
echo"<input type='submit'  value='Зарегистрироваться'>";


}




?>

<a href="index.php">На главную</a>
</form>
</body>
</html>