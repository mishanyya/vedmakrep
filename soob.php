<head>
<script src="ajax.js" type="text/javascript"></script>

<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
</head>

Сообщения между пользователями и администратором<br/>

<?php

include "config.php";//присоединить файл для подключения к серверу



session_start();
$login=$_SESSION['login'];//из сессии логин пользователя
if($login==''){
header("location:vhodi.php");
}

$a=name_from_login($login,$pdo);

echo"- $login - <br/>";

//выбор и вывод сообщений
$sms_in=$pdo->query("SELECT * FROM soobsh WHERE login='$login' AND komu='admin_or' UNION SELECT * FROM soobsh WHERE login='admin_or' AND komu='$login' ORDER BY nomer ASC");
while($line=$sms_in->fetch(PDO::FETCH_LAZY))
{//начало 1
if(($line->login)==$login){//начало 2
$otkogo=name_from_login($login,$pdo);
echo"/от  $otkogo / &nbsp; ";
}
else{echo"* от админа * &nbsp;";
}//конец 2
echo"$line->sms &nbsp";
echo"$line->data <br/>";
}//конец 1

//обозначение сообщений - как прочитанных - меняем 0 на 1

$sms_read=$pdo->exec("UPDATE soobsh SET proch='1' WHERE komu='$login' AND proch='0'");



?>





<form action="soob1.php" method="POST">

<textarea name="textarea"></textarea>
<input type="submit" value="Отправить" name="submit_sms">

</form>





Отправить фотографию<br/>






Размер загружаемого файла должен быть до 3 Мб <br/>
  <form  enctype="multipart/form-data" action="soob2.php"  method="post">
  <input  type="hidden" name="MAX_FILE_SIZE" value="3145728"  />
  <input  type="file" name="uploadFile" accept="image/jpeg,image/png,image/gif"/>
  <input  type="submit" name="upload" value="Загрузить"/>
  </form>















<a href="index.php">на главную</a>