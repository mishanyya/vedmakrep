<html>	
<head>

<title>Гадания, пророчества,привороты</title>

<link rel="stylesheet" type="text/css" href="style_o_ney.css"/>	


<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>



</head>
<body>




<div class='info_lichnoe'>

<h2>Отзывы</h2>
<table>
<?php
include "config.php";//присоединить файл для подключения к серверу
session_start();
$dannye=$pdo->query("SELECT * FROM otzyvy ");
while($line_dannye=$dannye->fetch(PDO::FETCH_LAZY)){

echo"<tr><td class='td1'>$line_dannye->otkogo</td>";
echo"<td class='td2'>$line_dannye->otzyv</td></tr>";
}
?>
</table>
<br/><a href='index.php'>На главную</a>
</div>



</body>
</html>