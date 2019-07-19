<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="ajax.js" type="text/javascript"></script>
<script src="fileUploadButton.js" type="text/javascript"></script>
<script src="ajax_admin_sms.js" type="text/javascript"></script>
<script src="ajax_neproch_sms.js" type="text/javascript"></script>

<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
</head>
<body>
<h3>Регистрация админа</h3>

<?php

include "config.php";//присоединить файл для подключения к серверу



$login_a=$_POST['login_a'];
$login_a=trim($login_a);//убирает пробелы из начала и конца поля
$login_a=htmlspecialchars($login_a);



$parol_a=$_POST['parol_a'];
$parol_a=trim($parol_a);//убирает пробелы из начала и конца поля
$parol_a=htmlspecialchars($parol_a);
$parol_a=sha1($parol_a);// зашифровка пароля 

$rand_adm=rand();//создание временного пароля
session_start();
$_SESSION['login_a']=$login_a;//в сессию мой логин 
$_SESSION['rand_adm']=$rand_adm;

$reg=$pdo->prepare("INSERT INTO admregi(nomer,login,parol,vrepar) VALUES(NULL,?,?,?)");
$reg->execute(array($login_a,$parol_a,$rand_adm));


$reg_a=$pdo->prepare("INSERT INTO admregi_to(nomer,login) VALUES(NULL,?)");
$reg_a->execute(array($login_a));



header("location:adm_vhod2.php");
?>






</body>