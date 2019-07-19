function admin_ajax_soob_1() {
            

  // (1) создать объект для запроса к серверу

    var req = getXmlHttp()       
       

    var textarea_a=document.getElementsByName('textarea_a')[0].value;     

    req.onreadystatechange = function() {        

        if (req.readyState == 4) {        
          

           if(req.status == 200) {

                 // если статус 200 (ОК) - выдать ответ пользователю

                
            } } 
    }
    


 req.open('GET', 'adm_vhod3.php?textarea_a='+textarea_a, true);
    req.send(null);  // отослать запрос 

document.getElementsByName('textarea_a')[0].value='';

}
