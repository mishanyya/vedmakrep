
function dogruzka_sms() {
var skakogo=document.getElementsByName('skakogo')[0].value;
skakogo=parseInt(skakogo, 10);//перевод из строки в число с основанием 10

var skolko=document.getElementsByName('skolko')[0].value;
skolko=parseInt(skolko, 10);//перевод из строки в число с основанием 10

var vsego=document.getElementsByName('vsego')[0].value;
vsego=parseInt(vsego, 10);//перевод из строки в число с основанием 10

skolko=skolko+5;
skakogo=vsego-skolko;

if(skakogo<=0){document.getElementById('dogruzka_sms_button').style.visibility='hidden';}

document.getElementsByName('skolko')[0].value=skolko;

document.getElementsByName('skakogo')[0].value=skakogo;

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






}

