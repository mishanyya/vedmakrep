<link rel="stylesheet" type="text/css" href="style_pol.css"/>
<title>Гадания, пророчества,привороты</title>
<?php
               
include "config.php";//присоединить файл для подключения к серверу
 
         

session_start();

                                        
                 //модуль ввода введеных логина и пароля в переменные

$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol=sha1($parol);// зашифровка пароля 
                                                                                  
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);
$login=base64_encode($login);//шифрование

                                                                      
 $ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$ip=htmlspecialchars($ip);


$login_proverka=$pdo->prepare("SELECT COUNT(login) FROM regi WHERE login=? AND parol=?");//количество совпавших логина с паролем пользователя
$login_proverka->execute(array($login,$parol));
$login_proverenniy=$login_proverka->fetchColumn();


if($login_proverenniy=='1'){

$kontrol=rand();
 
$kontrol_proverka=$pdo->exec("UPDATE regi SET vrepar='$kontrol' WHERE login='$login'");
$_SESSION['kontrol']=$kontrol;


$_SESSION['login']=$login;
header("location:index.php");
}
else {echo"<b>Логин или пароль неверный</b><a href='index.php'><span>На главную</span></a>";}
?>



   

