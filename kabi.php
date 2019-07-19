<html>	
<head>

<title>Гадания, пророчества,привороты</title>
<link rel="stylesheet" type="text/css" href="style_pol.css"/>


<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<script src="podschet_simvolov.js" type="text/javascript"></script>	
</head>
<body>

<form action="kabi1.php" method="POST"  autocomplete="off"  class="autoriz">

<h3>Введите для получения ответа:</h3>

<p>Как к вам обращаться:</p>


<input type='text' name="imya" required/>

<p>Логин<br/>(Для возможности восстановления или замены пароля вводите e-mail):</p>

<input type='text' name="login" required/>

<p>Пароль:</p>

<input type="password" name="parol" required/>


<p>Пароль повторно:</p>

<input type="password" name="parol1" required/>

<div id='podschet_simvolov'></div>

<input type="checkbox" value="nerobo" name="ne_robot"/><b>Поставьте галочку,что Вы не робот</b>

<br/><i style='color:red'>Все поля обязательны для заполнения</i>
<input type="submit"  value="Войти"/>


<a href="index.php">На главную</a>

</form>

</body>
</html>