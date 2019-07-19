<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Гадания, пророчества,привороты</title>
<?php
include "config.php";//присоединить файл для подключения к серверу
$rand=rand();//создание временного пароля

session_start();
$login_a=$_SESSION['login_a'];//из сессии мой логин 
$ran=$pdo->prepare("UPDATE admregi SET vrepar=? WHERE login=?");
$ran->execute(array($rand,$login_a));

$m=$pdo->prepare("SELECT email FROM admregi_to  WHERE login=?");
$m->execute(array($login_a));
while($ma=$m->fetch(PDO::FETCH_LAZY))
{
$login_rem=$ma->email;
}

$title ='Временный пароль для входа';

// $to - кому отправляем
$to=trim($login_rem);
// $from - от кого

$from=$login_rem;




// функция, которая отправляет наше письмо.
$mail=mail($to, $title, $rand, 'From:'.$from);


if($mail=='1'){echo"<p>Вам отправлено сообщение</p><a href='adm_vhod5.php'>Далее</a>";}
else{echo"<p>Сообщение не отправлено из-за проблем на сервере</p><a href='adm_vhod.php'>Далее</a>";}







?>