<link rel="stylesheet" type="text/css" href="style_pol.css"/>
<title>Гадания, пророчества,привороты</title>
<?php

include "config.php";//присоединить файл для подключения к серверу


$login_rem_coding=$_POST['login_rem_coding'];//email
$login_rem_coding=trim($login_rem_coding);//убирает пробелы из начала и конца поля
$login_rem_coding=htmlspecialchars($login_rem_coding);


$vrepar=$_POST['vrepar'];
$vrepar=trim($vrepar);//убирает пробелы из начала и конца поля
$vrepar=htmlspecialchars($vrepar);

$par1=$_POST['par1'];
$par1=trim($par1);//убирает пробелы из начала и конца поля
$par1=htmlspecialchars($par1);
$par_null=$par1;
$par1=sha1($par1);// зашифровка пароля

$par2=$_POST['par2'];
$par2=trim($par2);//убирает пробелы из начала и конца поля
$par2=htmlspecialchars($par2);
$par2=sha1($par2);// зашифровка пароля

$zamena_logina=$pdo->prepare("SELECT COUNT(vrepar) FROM regi WHERE login='$login_rem_coding' AND vrepar=?");
$zamena_logina->execute(array($vrepar));

$zamena_logina_par_num=$zamena_logina->fetchColumn();


if($login_rem_coding==''){//если email пустой
exit("<p>Не введен email</p><a href='index.php'>На главную</a>");

}



if(($zamena_logina_par_num=='1')&&($par1==$par2)&&($par_null!='')){
$login_update=$pdo->exec("UPDATE regi SET parol='$par1'");
echo"<p>Пароль изменен</p><a href='index.php'>Далее</a>";
}
else {
echo"<p>Пароль не изменен(возможен некорректный ввод временного пароля)</p><a href='index.php'>Назад</a>";
}


?>