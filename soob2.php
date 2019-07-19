<html>
<head>
<link rel="stylesheet" type="text/css" href="style_pol.css"/>
<title>Гадания, пророчества,привороты</title>
</head>
<body>
<?php          
include "config.php";//присоединить файл для подключения к серверу
session_start();//инициируем сессию  
$login=$_SESSION['login'];
if(isset($_FILES['uploadFile'])){     //проверка на существование uploadFile
//if($_FILES['uploadFile']['error']=='0') {echo"ошибок нет<br>";}
//if($_FILES['uploadFile']['error']=='1') {echo"большой размер файла<br>";}
//if($_FILES['uploadFile']['error']=='2') {echo" размер  файла превышает 10 Мб<br>";}
//if($_FILES['uploadFile']['error']=='3') {echo"не загружен из-за соединения<br>";}
//if($_FILES['uploadFile']['error']=='4') {echo"файл не выбран<br>";}
$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
  foreach ($blacklist as $item)
    if(preg_match("/$item\$/i", $_FILES['uploadFile']['name'])) {echo"<b class='danger'> файл опасен выберите другой файл- этот не подходит для системы</b><a class='danger' href='index.php'>На главную</a>"; 
exit;}
  $type = $_FILES['uploadFile']['type'];
  if (($type != "image/jpg") && ($type != "image/jpeg")&& ($type != "image/png")&& ($type != "image/gif")) 
{
exit;}
// имя файла должно быть на латинице
//Узнаем тип файла
$k_imeni=time();//получение времени в секундах
if ($_FILES['uploadFile']['type'] == 'image/jpeg')
{
$imyafaila=$k_imeni.$login.".jpg";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === jpeg";
}
else if ($_FILES['uploadFile']['type'] == 'image/png')
{
$imyafaila=$k_imeni.$login.".png";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === png";
}
else if ($_FILES['uploadFile']['type'] == 'image/gif')
{
$imyafaila=$k_imeni.$login.".gif";
$_FILES['uploadFile']['name']=$imyafaila;// переименование файла при загрузке время и логин
//echo" тип === gif";
}
else
{
//echo" тип === неизвестен";
exit("<a class='danger' href='index.php'>Тип файла неизвестен.На главную</a>");
}
//проверка загружаемых файлов
$types = array('image/jpg','image/jpeg','image/gif','image/png');//тип файла
$size = 10485760;//размер файла в байтах 10 мб
// Проверяем тип файла
if (!in_array($_FILES['uploadFile']['type'], $types)) //проверка значений в массиве
die("<b class='danger'>Запрещённый тип файла</b><a class='danger' href='index.php'>На главную</a>");
// Проверяем размер файла
if ($_FILES['uploadFile']['size'] > $size)
die("<b class='danger'>Слишком большой размер файла</b><a class='danger' href='index.php'>На главную</a>");
if(isset($_POST['upload']))
{
$upload=$_POST['upload'];
$upload=htmlspecialchars($upload);

$uploadedFile = $folder.basename($_FILES['uploadFile']['name']); //.basename возвращает имя файла
  if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
{
  if(move_uploaded_file($_FILES['uploadFile']['tmp_name'],    $uploadedFile)) //(из какого места, в какое место =пути)
  {
     echo"<p class='danger'> Файл отправлен</p><a class='danger' href='index.php'>На главную</a>";
  }
  else
  {
     echo "<p class='danger'> Во  время отправки файла произошла ошибка</p><a class='danger' href='index.php'>На главную</a>";
  }
  }
  else
  {
   echo "<p class='danger'>Файл не  отправлен</p><a class='danger' href='index.php'>На главную</a>";
  }
  }
// получаем массив, содержащий размеры изображения 
$size = getimagesize ($folder.basename($_FILES['uploadFile']['name'])); 
// Значение флага,  
// возвращаемого функцией getimagesize() под индексом 2 
// после определения размера изображения 
$flag = array(1=>'GIF', 
             2=>'JPG', 
             3=>'PNG', 
             4=>'SWF', 
             5=>'PSD', 
             6=>'BMP', 
             7=>'TIFF(байтовый порядок intel)', 
             8=>'TIFF(байтовый порядок motorola)', 
             9=>'JPC', 
             10=>'JP2', 
             11=>'JPX'); 
//echo "Тип изображения: " . $flag[$size[2]] .'<br>'; 
//echo "Ширина и Высота: " . $size[3] .'<br>'; 
if (!isset($quality)){
$quality = 75;}
// Cоздаём исходное изображение на основе исходного файла
if ($_FILES['uploadFile']['type'] == 'image/jpeg')
$source = imagecreatefromjpeg($folder.basename($_FILES['uploadFile']['name']));
else if ($_FILES['uploadFile']['type'] == 'image/png')
$source = imagecreatefrompng($folder.basename($_FILES['uploadFile']['name']));
else if ($_FILES['uploadFile']['type'] == 'image/gif')
$source = imagecreatefromgif($folder.basename($_FILES['uploadFile']['name']));
else
return false;
// Поворачиваем изображение
if ((isset($rotate))&&($rotate != null)){
$src = imagerotate($source, $rotate, 0);}
else
$src = $source;
// Определяем ширину и высоту изображения
$w_src = imagesx($src);
$h_src = imagesy($src);
// В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
// Если ширина больше заданной
// Вычисление пропорций
if($h_src>$w_src){
$w_dest=300;  //новая ширина
$h_dest=$w_dest*$h_src/$w_src; //новая высота
}
else if($h_src<=$w_src){
$h_dest=300;  //новая ширина
$w_dest=$h_dest*$w_src/$h_src; //новая высота
}
// Создаём пустую картинку
$dest = imagecreatetruecolor($w_dest, $h_dest);
// Копируем старое изображение в новое с изменением параметров
imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);//копирует и изменяет размеры части изображения
// Вывод картинки и очистка памяти
imagejpeg($dest,$folder.basename($_FILES['uploadFile']['name']), $quality);
imagedestroy($dest);//очистка памяти
imagedestroy($src);//очистка памяти
  /*
  $x_o и $y_o - координаты левого верхнего угла выходного изображения на исходном
  $w_o и h_o - ширина и высота выходного изображения
  */
  function crop($image, $x_o, $y_o, $w_o, $h_o) 
{
    if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0))     
    {
     // echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // функция list($,$,$) сразу из массива значения в переменные заносит.Получаем размеры и тип изображения (число)
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения   "."для соединения в одно слово используется
      $img_i = $func($image); // Создаём дескриптор / копию для работы с исходным изображением
              } 
     else {
     // echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
      return false;
           }
    if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
    if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения с размерами конечного изображения
    imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное
    $func = 'image'.$ext; // Получаем функция для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
}
$koor_w=0;//координаты начала нового рисунка
$koor_h=0;
if($h_dest>$w_dest){ $koor_h=($koor_h+$h_dest)/2-($w_dest/2);}
else if($w_dest>=$h_dest){ $koor_w=($koor_w+$w_dest)/2-($h_dest/2);}
if($w_dest<$h_dest){$h_dest=$w_dest;}
 else if($h_dest<=$w_dest){$w_dest=$h_dest;}
  crop($folder.basename($_FILES['uploadFile']['name']), $koor_w, $koor_h, $w_dest,$h_dest); // Вызываем функцию обрезать изображение по центру
// переименовать файл в индивидуальное имя
$adres_in=$pdo->exec("INSERT INTO fotog (nomer,login,foto) VALUES(NULL,'$login','$imyafaila')");//ввод адреса фотографии в базу данных
//unset($_POST['upload']);
//header("location:index.php");
}//проверка на существование uploadFile
else{"<p class='danger'>Файл пока не загружается</p>";}
?>
</body>
</html>


