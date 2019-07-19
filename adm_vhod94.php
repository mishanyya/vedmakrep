
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Гадания, пророчества,привороты</title>

<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
$login_a=$_SESSION['login_a'];//из сессии мой логин 

$rand=rand();//врем пароль

$ran=$pdo->prepare("UPDATE admregi SET vrepar=? WHERE login=?");
$ran->execute(array($rand,$login_a));



$m=$pdo->query("SELECT email FROM admregi_to  WHERE login='$login_a'");
while($ma=$m->fetch(PDO::FETCH_LAZY))
{
$to=$ma->email;
}
//$to от кого
// $from - от кого
$adres=$pdo->query("SELECT email FROM admregi_to  WHERE login='$login_a'");
while($adres_1=$adres->fetch(PDO::FETCH_LAZY))
{
$from=$adres_1->email;
}

$to='admin@vmesteprosto.info';
$title ='Замена пароля';
$randsms='password'.$rand;
$from='admin@vmesteprosto.info';

// функция, которая отправляет наше письмо.
$mail=mail($to, $title, $randsms, 'From:'.$from);


if($mail=='1'){echo"<p>Вам отправлено сообщение</p><a href='adm_vhod5.php'>Далее</a>";}
else{echo"<p>Сообщение не отправлено из-за проблем на сервере</p><a href='adm_vhod.php'>Далее</a>";}


?>
