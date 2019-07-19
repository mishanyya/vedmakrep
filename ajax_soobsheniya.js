

function ajax_soobsheniya() {

var skakogo=document.getElementsByName('skakogo')[0].value;
skakogo=parseInt(skakogo, 10);//перевод из строки в число с основанием 10

var skolko=document.getElementsByName('skolko')[0].value;
skolko=parseInt(skolko, 10);//перевод из строки в число с основанием 10

var vsego=document.getElementsByName('vsego')[0].value;
vsego=parseInt(vsego, 10);//перевод из строки в число с основанием 10
 
var vsego_1=document.getElementsByName('vsego_1')[0].value;
vsego_1=parseInt(vsego_1, 10);//перевод из строки в число с основанием 10
if(vsego_1==''){
vsego_1='0';
vsego_1=parseInt(vsego_1, 10);//перевод из строки в число с основанием 10
}

if(vsego_1>vsego){
var raznitca=vsego_1-vsego;
skakogo=skakogo+raznitca;
skakogo=parseInt(skakogo, 10);//перевод из строки в число с основанием 10

}


    // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var statusElem = document.getElementById('soobsheniya')     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                statusElem.innerHTML=req.responseText;
            } } 
    }
      


 req.open('GET', 'ajax_soobsheniya.php?skakogo='+skakogo+'&skolko='+skolko+'&vsego='+vsego, true);
    req.send(null);  // отослать запрос 
    


//var soobsheniya=document.getElementById('soobsheniya').scrollHeight;//scroll внизу
//soobsheniya+=1000;
//document.getElementById('soobsheniya').scrollTop=soobsheniya;


var scr_val=document.getElementById('scr_val').value;

var height=document.getElementById('soobsheniya').scrollHeight;

if(height>scr_val)
{
document.getElementById('scr_val').value=document.getElementById('soobsheniya').scrollHeight;//scroll внизу

document.getElementById('soobsheniya').scrollTop=document.getElementById('scr_val').value;

}

}
