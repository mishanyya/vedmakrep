<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>

<form action="adm_vhod6.php" class="autoriz" method="POST">

<?php
session_start();
$login_a=$_SESSION['login_a'];//из сессии мой логин 
if($login_a==''){
echo"<p>Введите логин<input type='text' name='login_a'/></p>";
}
?>


<p>Введите</p>
<p>Временный пароль(полученный по email)</p><input type="text" name="pv" required/>
<p>Новый пароль</p><input type="text" name="pn" required/>
<p>Новый пароль повторно</p><input type="text" name="pn1" required/>
<input type="submit" value="Заменить">
<a href='adm_vhod.php'>Назад</a>
</form>

</body>
</html>