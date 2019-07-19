<html>	
<head>

<title>Гадания, пророчества,привороты</title>

<link rel="stylesheet" type="text/css" href="style_o_ney.css"/>	
</head>
<body>

<div class='info_lichnoe'>

<h2>Род деятельности</h2>
<p>
<?php
include "config.php";//присоединить файл для подключения к серверу
session_start();

$dannye=$pdo->query("SELECT rod_zanyatiy FROM admregi_to ORDER BY nomer ASC limit 1");

while($line_dannye=$dannye->fetch(PDO::FETCH_LAZY)){

$rod_zanyatiy=nl2br($line_dannye->rod_zanyatiy);//вывод с переносом строк
echo"$rod_zanyatiy";
}
?>
</p>
<br/><a href='index.php'>На главную</a>
</div>
</body>
</html>