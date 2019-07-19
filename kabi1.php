<html>	
<head>

<title>Гадания, пророчества,привороты</title>
<link rel="stylesheet" type="text/css" href="style_pol.css"/>	
</head>
<body>
<div class="autoriz">
<?php
               
include "config.php";//присоединить файл для подключения к серверу
 

                                                    
                 //модуль ввода введеных логина и пароля в переменные

$imya = $_POST['imya'];//передает значение из поля в переменную
$imya=trim($imya);//убирает пробелы из начала и конца поля
$imya=htmlspecialchars($imya);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

if($imya==''){echo"<p>Не ввели как к Вам обращаться</p>";}

$parol = $_POST['parol'];//передает значение из поля в переменную
$parol=trim($parol);//убирает пробелы из начала и конца поля
$parol=htmlspecialchars($parol);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение

if($parol==''){echo"<p>Не ввели пароль</p>";}

$parol=sha1($parol);// зашифровка пароля 
       
$parol1 = $_POST['parol1'];//передает значение из поля в переменную
$parol1=trim($parol1);//убирает пробелы из начала и конца поля
$parol1=htmlspecialchars($parol1);//переводит некоторые спецсимволы, которые могут использоваться для кода в другое обозначение
$parol1=sha1($parol1);// зашифровка пароля 
          
if($parol!=$parol1){echo"<p>Введенные пароли не равны</p>";}
                                                                 
$login = $_POST['login'];//передает значение из поля в переменную
$login=trim($login);//убирает пробелы из начала и конца поля
$login=htmlspecialchars($login);

if($login==''){echo"<p>Логин не введен</p>";}
$login=base64_encode($login);//шифрование
                                                                      
 $ip = $_SERVER['REMOTE_ADDR'];//ip пользователя
$ip=htmlspecialchars($ip);

//количество совпавших логина  пользователя
$login_proverka=$pdo->prepare("SELECT COUNT(login) FROM regi WHERE login=?");
$login_proverka->execute(array($login));
$login_proverenniy=$login_proverka->fetchColumn();

$ne_robot=$_POST['ne_robot'];

if(!$_POST['ne_robot']){
echo"<p>Вы не поставили отметку 'Я не робот' </p>";
}

if($login_proverenniy>0){
echo"<h3>Вы уже зарегистрировались </h3><a href='index.php'>На главную</a>";
}
else if(($login_proverenniy=='0')&&($ne_robot=='nerobo')&&($parol==$parol1)){
//вставить новые данные пользователя
$login_reg=$pdo->prepare("INSERT INTO regi (nomer,login,parol,name,vrepar,ip,data) VALUES (NULL,?,?,?,'нету','$ip',NOW())");//количество совпавших логина  пользователя
$login_reg->execute(array($login,$parol,$imya));

session_start();
$_SESSION['login']=$login;


$kontrol=rand();
 
$kontrol_proverka=$pdo->exec("UPDATE regi SET vrepar='$kontrol' WHERE login='$login'");
$_SESSION['kontrol']=$kontrol;









echo"<h3>Вы зарегистрировались </h3><a href='index.php'>Далее</a>";

}
else {
echo"<h3>Вы не зарегистрировались</h3><a href='kabi.php'>Попробовать еще раз</a><a href='index.php'>На главную</a>";
}

?>
</div>
</body>
</html>

   

