// javascript-код голосования из примера

function ajax_vsego() {




    // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var statusElem = document.getElementsByName('vsego_1')[0]     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                statusElem.value=req.responseText;
            } } 
    }
      


 req.open('GET', 'ajax_vsego.php', true);
    req.send(null);  // отослать запрос
}
