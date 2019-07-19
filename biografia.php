<html>	
<head>

<title>Гадания, пророчества,привороты</title>

<link rel="stylesheet" type="text/css" href="style_o_ney.css"/>	


<script src="jquery-1.11.3.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>



</head>
<body>




<div class='info_lichnoe'>

<h2>Биография</h2>
<p>
<?php
include "config.php";//присоединить файл для подключения к серверу
session_start();
$dannye=$pdo->query("SELECT biografia FROM admregi_to ORDER BY nomer ASC limit 1");
while($line_dannye=$dannye->fetch(PDO::FETCH_LAZY)){
$biografia=nl2br($line_dannye->biografia);
echo"$biografia";

}
?>
</p>
<br/><a href='index.php'>На главную</a>
</div>



</body>
</html>