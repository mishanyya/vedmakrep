<html>
<head>
<link rel="stylesheet" type="text/css" href="style_pol.css"/>
<link rel="icon" type="image/png" href="/favicon.png" />
<link href='https://fonts.googleapis.com/css?family=Marck+Script|Bad+Script&subset=cyrillic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Philosopher|Jura|Playfair+Display+SC|Andika|Rubik+One|Yeseva+One|Kurale&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<script src="voyti.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="ajax_vsego.js" type="text/javascript"></script>
<script src="fileUploadButton.js" type="text/javascript"></script>
<script src="ajax_soobsheniya.js" type="text/javascript"></script>


<script src="ajax_dogruzka_sms.js" type="text/javascript"></script>
<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<script src="soob1.js" type="text/javascript"></script>
<script src="zamena-sveta.js" type="text/javascript"></script>


<?php
include "config.php";//присоединить файл для подключения к серверу
session_start();
$imya_gada=$pdo->query("SELECT h1 FROM admregi_to limit 1");
while($imya_gadalki_line=$imya_gada->fetch(PDO::FETCH_LAZY))
{
$imya_gadalk=$imya_gadalki_line->h1;//Имя гадалки
$imya_gadalki_ex=explode(" ",$imya_gadalk);
$imya_gadalki=$imya_gadalki_ex[0];
}
$_SESSION['imya_gadalki']=$imya_gadalki;//имя гадалки

if(!isset($_SESSION['login'])){$_SESSION['login']='';}

$login=$_SESSION['login'];//из сессии логин пользователя

if(!isset($_SESSION['kontrol'])){$_SESSION['kontrol']='';}

$kontrol=$_SESSION['kontrol'];//контрольное число для входа
$kontrol_entrance=$pdo->prepare("SELECT COUNT(login) FROM regi WHERE login='$login' AND vrepar=?");
$kontrol_entrance->execute(array($kontrol));
$kontrol_entrance_count=$kontrol_entrance->fetchColumn();
$kolvo_sms=$pdo->prepare("SELECT COUNT(sms) FROM soobsh WHERE login=? OR komu=?");
$kolvo_sms->execute(array($login,$login));
$kolvo_sms_count=$kolvo_sms->fetchColumn();//количество имеющихся сообщений
$dannye=$pdo->query("SELECT * FROM admregi_to ORDER BY nomer ASC limit 1");
while($dannye_line=$dannye->fetch(PDO::FETCH_LAZY))
{
$email=$dannye_line->email;
$h1=$dannye_line->h1;
$h2=$dannye_line->h2;
$koordinaty=$dannye_line->koordinaty;
$title=$dannye_line->title;
}
echo"<title>$title</title>";
?>
</head>
<body onload='ajax_soobsheniya()'>
<script>setInterval('ajax_soobsheniya()',1000);</script>
<?php
echo"<div id='line_1'>";
echo"<div id='ee_imya'>";
echo"<h1>$h1</h1>";
echo"<h2>$h2</h2>";
echo"<h3>$koordinaty</h3>";
echo"<br/><p>e-mail:$email</p>";
echo"</div>";
?>

<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>

</div>
<div id='line_2'>
<div id='column_1'>
<?php
if($kontrol_entrance_count=='0'){
?>
<div id='voyti'>
<form action="vhodi1.php" method="POST" class="autoriz">
<h3>Задайте вопрос</h3>

<p>Если Вы здесь в первый раз, прошу пройти по <a href='kabi.php' title='пройдите по ссылке'>ссылке</a></p>
<p>Еслы Вы здесь повторно</p>
<p>Введите Логин:</p>
<input required name='login'/>
<p>Введите Пароль:</p>
<input type="password" required name="parol"/>
<input type="submit"  value="Войти">

<a href='vhodi2.php'>Вспомнить пароль</a>
</form>
</div>
<?php
}
 else if($kontrol_entrance_count>0){
$name_from_login=name_from_login($login,$pdo);
echo"<p>Вход под именем $name_from_login</p><br/>";
echo"<a href='vyiti.php' class='vyiti'>Выйти из диалога</a>";
}
?>
</div>
<div id='column_2'>
<?php
if($kontrol_entrance_count=='0'){//начало 4
?>
<input type='button'  class='autorizatcia_sms' name='autorizatcia_sms_button' value='Обращайтесь' onclick='voyti()' title='Нажмите для общения'/>

<p id='online' class='online'>Я на связи</p>

<?php
}// конец 4
?>
<script>setInterval('ajax_vsego()',1000);</script>
 <?php
if(($kontrol_entrance_count>0)&&($kolvo_sms_count>5)){http://vesti-ukr.com/
echo"<input type='button' value='Еще'  id='dogruzka_sms_button' onClick='dogruzka_sms()' />";
}
?>
<input type='hidden' id='scr_val' />
<div id='soobsheniya'>
<?php

if($kontrol_entrance_count>0){
$a=name_from_login($login,$pdo);
//для limita данные

//подсчет результата запроса
$sms_number=$pdo->prepare("SELECT COUNT(*) FROM soobsh WHERE (login=? AND komu='admin_or') OR (login='admin_or' AND komu=?)");
$sms_number->execute(array($login,$login));
$vsego=$sms_number->fetchColumn();///сколько строк в результате запроса

if(isset($_GET['skolko'])){
$skolko=$_GET['skolko'];
$skolko=trim($skolko);//убирает пробелы из начала и конца поля
$skolko=htmlspecialchars($skolko);
}
else {$skolko=5;}

$skakogo=$vsego-$skolko;//с какого вывод производить
if($skakogo<0){$skakogo=0;}
if($skolko<0){$skolko=0;}
//выбор и вывод сообщений
$sms_in=$pdo->prepare("SELECT * FROM soobsh WHERE login=? AND komu='admin_or' UNION SELECT * FROM soobsh WHERE login='admin_or' AND komu=? ORDER BY nomer ASC limit $skakogo,$skolko");
$sms_in->execute(array($login,$login));
echo"<br/>";
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{//начало 1
if(($line->login)==$login){//начало 2
$otkogo=name_from_login($login,$pdo);
echo"<p class='sms'><b class='adresat'>$otkogo</b>  &nbsp; <br/>";
}
else{echo"<p class='sms'>$imya_gadalki &nbsp;<br/>";
}//конец 2
echo"&nbsp; <b> $line->sms </b>&nbsp;";
echo"<i>$line->data</i> </p>";
}//конец 1
//обозначение сообщений - как прочитанных - меняем 0 на 1
$sms_read=$pdo->prepare("UPDATE soobsh SET proch='1' WHERE komu=? AND proch='0'");
$sms_read->execute(array($login));
}

else{
echo"<p>ОТЗЫВЫ</p>";
echo"<table>";
$dannye=$pdo->query("SELECT * FROM otzyvy ");
while($line_dannye=$dannye->fetch(PDO::FETCH_LAZY)){
echo"<tr><td class='td1'>$line_dannye->otkogo</td>";
echo"<td class='td2'>$line_dannye->otzyv</td></tr>";
}
echo"</table>";}

?>
</div>

<div id='soobsheniya_written'>
<?php
if($kontrol_entrance_count>0){//начало 3
?>
<form action="soob1.php" method="POST">
<input hidden name='skakogo' value='<?php echo $skakogo;?> '/>
<input hidden name='skolko' value='<?php echo $skolko;?> '/>
<input hidden name='vsego' value='<?php echo $vsego;?> '/>
<input hidden name='vsego_1' value=''/>
<textarea cols="70" rows="5" name="textarea"></textarea>
<input type="button" value="Отправить сообщение" class="submit_smski" name="submit_sms" onClick='ajax_soob_1()'>
</form>
<p>Отправить фотографию до 10 Мб</p>
  <form  enctype="multipart/form-data" action="soob2.php" class='sms_form' method="post">
  <input  type="hidden" name="MAX_FILE_SIZE" value="10485760"  />
  <input  type="file"  name="uploadFile" class="submit_file"  accept="image/jpeg,image/png,image/gif" onchange="fileUploadButton()"/>
  <br/><input  type="submit" name="upload"  class="submit_file"  value="Отправить" style="visibility:hidden"/>
  </form>
<?php
}// конец 3
?>
</div>
</div>
<div id='column_3'>
<?php
$dannye=$pdo->query("SELECT * FROM admregi_to ORDER BY nomer ASC limit 1");
while($dannye_foto=$dannye->fetch(PDO::FETCH_LAZY)){
$foto_admina=$dannye_foto->foto;
}

if(($foto_admina=='')){$foto_admina='foto_for_site.png';}

echo"<img src='foto_admin/$foto_admina' class='img_foto'  title='такая фотография' alt='фотография гадалки'/>";

?>
<div id='opisanie_uslug'>
<a href='biografia.php'>Биография</a><br/>
<a href='rod_zanyatiy.php'>Род деятельности</a><br/>
<?php
if($kontrol_entrance_count!='0'){
echo"<a href='otzyv.php'>Отзывы</a>";
}
?>

</div>
</div>
</div>


<script>setInterval('zamena_sveta()',2000);</script>
</body>
</html>