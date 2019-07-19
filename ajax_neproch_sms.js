
function ajax_neproch_sms() {

    // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var statusElem = document.getElementById('neproch_sms')     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                statusElem.innerHTML=req.responseText;
            } } 
    }
      


 req.open('GET', 'ajax_neproch_sms.php',true);
    req.send(null);  // отослать запрос 
    


}
