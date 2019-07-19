<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="ajax.js" type="text/javascript"></script>
<script src="fileUploadButton.js" type="text/javascript"></script>
<script src="ajax_admin_sms.js" type="text/javascript"></script>
<script src="ajax_neproch_sms.js" type="text/javascript"></script>
<script src="admin_soob1.js" type="text/javascript"></script>



<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
</head>
<body>
<h3>Сообщения между пользователями и мной</h3>

<?php

include "config.php";//присоединить файл для подключения к серверу

session_start();
if(isset($_SESSION['login_a'])){$login_a=$_SESSION['login_a'];}//из сессии мой логин 
if(isset($_SESSION['rand_adm'])){$rand_adm=$_SESSION['rand_adm'];}//из сессии пароль
if(!isset($login_a)&&(!isset($rand_adm))){exit("<a href='adm_vhod.php'>Войти</a>");}
zash_vhod_admin($login_a,$rand_adm,$pdo);

if(isset($_GET['a'])){$login_sms=$_GET['a'];
$login_sms=trim($login_sms);//убирает пробелы из начала и конца поля
$login_sms=htmlspecialchars($login_sms);
$_SESSION['login_sms']=$login_sms;//в сессию логин адресата
}
else if(isset($_SESSION['login_sms'])){$login_sms=$_SESSION['login_sms'];}//из сессии логин адресата
else {echo"<p><b>адресат не выбран</b></p>";} 



if($login_a==''){
header("location:adm_vhod.php");
}

//внесение он-лайн
online($login_a,$pdo);

if(isset($login_sms))
{
$login_sms_name=name_from_login($login_sms,$pdo);
}
if(isset($login_sms_name)){
echo"<br/><p>Вы общаетесь с &nbsp; <span>$login_sms_name</span></p><br/>";
}
echo"<br/><p>Адресаты:</p><br/>";

$adresat=$pdo->query("SELECT komu FROM soobsh WHERE login='admin_or' UNION SELECT login FROM soobsh WHERE komu='admin_or'");
while($line=$adresat->fetch(PDO::FETCH_LAZY))
{
$line_name=name_from_login($line[0],$pdo);
echo"<a href='adm_vhod2.php?a=$line[0]'><p><b class='adm_sms_adresat'>$line_name</b></p></a>";
$login=base64_decode($line[0]);//дешифрование
echo"&nbsp;e-mail: &nbsp;<i class='em_pol'>$login</i><br/>";//скрипт поиска email
echo"<br/>";}

echo"<input type='hidden' id='scr_val' >";

echo"<div id='column_1_admin'>";
echo"<p>Сообщения:</p>";

echo"<div id='admin_sms'>";
//вывод сообщений

if(isset($login_sms))
{//начало блока условия  1

$sms_in=$pdo->query("SELECT * FROM soobsh WHERE login='admin_or' AND komu='$login_sms' UNION SELECT * FROM soobsh WHERE login='$login_sms' AND komu='admin_or'   ORDER BY nomer ASC ");
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{
$imya_no_read=name_from_login($line->login,$pdo);
echo"<p class='sms'><b class='adresat'>$imya_no_read</b><br/>";
if($line->login=='admin_or'){echo"Мое сообщение<br/>";}
echo"&nbsp; <b> $line->sms </b>&nbsp;";
echo"<i>$line->data</i> </p>";}
//обозначение сообщений - как прочитанных - меняем 0 на 1
$sms_read=$pdo->exec("UPDATE soobsh SET proch='1' WHERE komu='admin_or' AND login='$login_sms' AND proch='0'");

}//конец блока условия  1
echo"</div>";

if(isset($login_sms))
{//начало блока условия  2

echo"<form class='form_admin_sms' action='adm_vhod3.php' method='POST'>";

echo"<textarea name='textarea_a' cols='70' rows='4' wrap='hard'></textarea>";

echo"<input type='button' value='Отправить сообщение' class='submit_smski' name='submit_sms_a' onClick='admin_ajax_soob_1()'>";


echo"</form>";
}//конец блока условия  2

?>
</div>

<div id='redakt_admin'>
<?php

//вывод непрочитанных сообщений
echo"<div id='neproch_sms'>";

echo"</div>";


echo"<form name='admin_reg_to' method='POST' action='adm_vhod9.php'>";

//вывод данных из таблицы админа
$dannye_admina=$pdo->prepare("SELECT * FROM admregi_to WHERE login=?");
$dannye_admina->execute(array($login_a));


while($dannye_admina_data=$dannye_admina->fetch(PDO::FETCH_LAZY))
{
echo"<br/><p>РЕДАКТИРОВАТЬ БИОГРАФИЮ</p><br/><textarea name='admina_biografia' cols='50' rows='8'>$dannye_admina_data->biografia</textarea>";
echo"<br/><p>РЕДАКТИРОВАТЬ РОД ЗАНЯТИЙ</p><br/><textarea name='admina_rod_zanyatiy' cols='50' rows='8'>$dannye_admina_data->rod_zanyatiy</textarea>";
}
echo"<br/><input type='submit' value='Заменить личную информацию' class='submit_smski'  name='admina_lichnoe_update'/>";
?>

</form>

<form name='admin_reg_to' method='POST' action='adm_vhod7.php'>
<?php
//вывод данных из таблицы админа
$dannye_admina=$pdo->prepare("SELECT * FROM admregi_to WHERE login=?");

$dannye_admina->execute(array($login_a));

while($dannye_admina_data=$dannye_admina->fetch(PDO::FETCH_LAZY))
{

echo"<br/><p>РЕДАКТИРОВАТЬ</p><br/><p>E-mail</p><br/><textarea name='admina_email' cols='50' rows='1'>$dannye_admina_data->email</textarea>";

echo"<br/><p>Имя </p><br/><textarea name='admina_h1' cols='50' rows='1'>$dannye_admina_data->h1</textarea>";
echo"<br/><p>Профессия</p><br/><textarea name='admina_h2' cols='50' rows='1'>$dannye_admina_data->h2</textarea>";
echo"<br/><p>Координаты</p><br/><textarea name='admina_koordinaty' cols='50' rows='2'>$dannye_admina_data->koordinaty</textarea>";
echo"<br/><p>Ключевое описание</p><br/><textarea name='admina_title' cols='50' rows='1'>$dannye_admina_data->title</textarea>";
}
echo"<br/><input type='submit' value='Заменить' class='submit_smski' name='admina_update'/>";
?>

</form>

<form name='admin_reg_login' method='POST' action='adm_vhod8.php'>
<?php
//вывод данных из таблицы админа имеется выше
$dannye_admina=$pdo->prepare("SELECT * FROM admregi_to WHERE login=?");

$dannye_admina->execute(array($login_a));
while($dannye_admina_login=$dannye_admina->fetch(PDO::FETCH_LAZY))
{
echo"<br/><p>РЕДАКТИРОВАТЬ ЛОГИН</p><br/><input type='text' name='admina_login' value='$dannye_admina_login->login'/>";
echo"<br/><input type='submit' value='Заменить' class='submit_smski'  name='admina_update_login'/>";
}
?>

</form>

<?php
$dannye=$pdo->query("SELECT * FROM admregi_to ORDER BY nomer ASC limit 1");
while($dannye_foto=$dannye->fetch(PDO::FETCH_LAZY)){
$foto_admina=$dannye_foto->foto;
}

if(($foto_admina=='')){$foto_admina='foto_for_site.png';}

echo"<img src='foto_admin/$foto_admina' class='img_foto'  title='такая фотография' alt='фотография гадалки'/>";
?>

<p>УСТАНОВИТЬ ГЛАВНОЕ ФОТО размером до 10 Мб</p>

  <form  enctype="multipart/form-data" action="adm_foto.php" class='sms_form' method="post">
  <input  type="hidden" name="MAX_FILE_SIZE" value="10485760"  />
 <p> <input  type="file" name="uploadFile" accept="image/jpeg,image/png,image/gif" onchange="fileUploadButton()"/></p>
  <input  type="submit" name="upload"  value="Загрузить" style="visibility:hidden"/>

  </form>
<p>ДОБАВИТЬ ОТЗЫВ</p>
<form class="form_otzyv" action="adm_vhod10.php" method="POST">

<br/><p>От кого</p><br/><textarea required name='otzyv_otkogo' cols='50' rows='1'></textarea>

<br/><p>Отзыв</p><br/><textarea  required name="otzyv_text" cols='50' rows='4'></textarea>
<input type="submit" class='submit_smski'  value="Добавить отзыв" name="otzyv">

</form>

<p>УДАЛИТЬ ОТЗЫВ</p>
<form class="form_otzyv-delete" action="adm_vhod11.php" method="POST">
<table>
<?php
$otzyvy_massiv=$pdo->query("SELECT * FROM otzyvy");//Выбирает все отзывы
while($otzyvy_massiv_line=$otzyvy_massiv->fetch(PDO::FETCH_LAZY)){
echo"<tr><td><input type='radio' value='$otzyvy_massiv_line->nomer' name='otzyvy_massiv_radio'/></td>";

echo"<td>$otzyvy_massiv_line->otkogo</td>";
echo"<td>$otzyvy_massiv_line->otzyv</td>";
echo"<td>$otzyvy_massiv_line->data</td></tr>";
}
?>
</table>
<input type="submit" value="Удалить отзыв" class='submit_smski'  name="otzyv_delete">

</form>

</div>

<div id='fotki_polzovateley'>

<?php
//количество фотографий от пользователей


if(isset($login_sms))
{//начало блока условия  3

$foto_co=$pdo->query("SELECT COUNT(foto) FROM fotog WHERE login='$login_sms'");
$foto_count=$foto_co->fetchColumn();
if($foto_count>0){echo"<p>Фотографии от пользователя</p><br/>";}

$foto_out=$pdo->query("SELECT foto FROM fotog WHERE login='$login_sms'");
while($line_foto=$foto_out->fetch(PDO::FETCH_LAZY)){
echo"<img class='ot_polzovatelya' src='fotografii/$line_foto->foto'/>";
}


}//конец блока условия  3
?>
</div>

<script src="equ_email.js" type="text/javascript" defer> </script>
<script>setInterval('ajax_neproch_sms()',10000);</script>
<script>setInterval('ajax_admin_sms()',1000);</script>
<script>
var scroll_admin_sms=document.getElementById('admin_sms').scrollHeight;//scroll внизу
document.getElementById('admin_sms').scrollTop=scroll_admin_sms;
</script>

<a href="index.php" style="background-color:white">На главную страницу сайта для пользователей</a>


</body>