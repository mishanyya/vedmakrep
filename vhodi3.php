<link rel="stylesheet" type="text/css" href="style_pol.css"/>
<title>Гадания, пророчества,привороты</title>
<?php
include "config.php";//присоединить файл для подключения к серверу
$rand=rand();//создание временного пароля
$login_rem=$_POST['login_p'];
$login_rem=trim($login_rem);//убирает пробелы из начала и конца поля
$login_rem=htmlspecialchars($login_rem);
if($login_rem==''){
exit("<p>Вы не ввели email<a href='index.php'><span>На главную</span></a></p>");
}
$login_rem;//незашифрованный логин-e-mail
$login_rem_coding=base64_encode($login_rem);//зашифрованный логин



$login_rem_sel=$pdo->query("SELECT COUNT(login) FROM regi WHERE login='$login_rem_coding'");
$login_rem_sel_num=$login_rem_sel->fetchColumn();
if($login_rem_sel_num=='1')
{

$login_rem_up=$pdo->exec("UPDATE regi SET vrepar='$rand' WHERE login='$login_rem_coding'");

$title ='Замена пароля';

// $to - кому отправляем
$to = $login_rem;
// $from - от кого

$adres=$pdo->query("SELECT email FROM admregi_to ORDER BY nomer ASC");

while($adres_1=$adres->fetch(PDO::FETCH_LAZY))
{
$from=$adres_1->email;
}



// функция, которая отправляет наше письмо.
mail($to, $title, $rand, 'From:'.$from);


echo"<form action='vhodi4.php' method='POST' class='autoriz'>";

echo "<p>Спасибо! Ваше запрос отправлен.Ответ придет вам в течение некоторого времени.Если письмо не пришло- посмотрите его в папке Спам</p>"; 

echo"<input type='hidden' value='$login_rem_coding' required name='login_rem_coding'>";
echo"<p>Введите временный пароль, полученный по почте (если письмо не пришло прошу зарегистрироваться снова)</p><input type='text'  required  name='vrepar'>";
echo"<p>Введите новый пароль</p><input type='text' required  name='par1'>";
echo"<p>Введите новый пароль повторно</p><input type='text' name='par2'>";
echo"<input type='submit' value='Отправить'>";
echo"</form>";



}




else{
echo"<p>Не найден такой электронный адрес<a href='index.php'><span>На главную</span></a></p>";
//header("location:index.php");
}


?>