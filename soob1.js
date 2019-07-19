function ajax_soob_1() {
            

  // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var textarea=document.getElementsByName('textarea')[0].value;     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                
            } } 
    }
    



 req.open('GET', 'soob1.php?textarea='+textarea, true);
    req.send(null);  // отослать запрос 

document.getElementsByName('textarea')[0].value='';

}
