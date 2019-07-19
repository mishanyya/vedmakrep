<html>	
<head>

<title>Личная страница</title>

<link rel="stylesheet" type="text/css" href="style.css"/>	
</head>
<body>
<div class="autoriz">
<?php               
include "config.php";//присоединить файл для подключения к серверу

session_start();
                                        
                 //модуль ввода введеных логина и пароля в переменные

$parol = $_POST['parol_a'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol_a=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol_a=sha1($parol_a);// зашифровка пароля 
  
                                                                            
$login = $_POST['login_a'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login_a=htmlspecialchars($login);
                                                                     
$login_a=filter_var($login_a);

$login_proverka=$pdo->prepare("SELECT COUNT(login) FROM admregi WHERE login=? AND parol=?");//количество совпавших логина с паролем пользователя
$login_proverka->execute(array($login_a,$parol_a));
$login_proverenniy=$login_proverka->fetchColumn();


$_SESSION['login_a']=$login_a;

$rand_adm=rand();//создание временного пароля
$_SESSION['rand_adm']=$rand_adm;


if($login_proverenniy=='1'){
//$_SESSION['login_a']=$login_a;

//$rand_adm=rand();//создание временного пароля

$up_adm=$pdo->prepare("UPDATE admregi SET vrepar=? WHERE login=?");
$up_adm->execute(array($rand_adm,$login_a));
//$_SESSION['rand_adm']=$rand_adm;
header("location:adm_vhod2.php");
}
else {echo"<p >Введенный логин или пароль неверный</p>";
echo"<br/><a href='adm_vhod.php'>Попробовать еще раз</a>";
echo"<br/><a href='adm_vhod4.php'>Вспомнить пароль</a>";
}
?>
</div>
</body>
</html>

   

