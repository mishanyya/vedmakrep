function fileUploadButton(){ 
var qq=document.getElementsByName('uploadFile')[0].value;

if(qq.length>0){document.getElementsByName('upload')[0].style.visibility='visible';}
else{document.getElementsByName('upload')[0].style.visibility='hidden';alert('Файл не выбран');}

}


