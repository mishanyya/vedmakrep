
function ajax_admin_sms() {
    // (1) создать объект для запроса к серверу
    var req = getXmlHttp()       
       
    var statusElem = document.getElementById('admin_sms')     
    req.onreadystatechange = function() {        
        if (req.readyState == 4) {        
                     if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
                statusElem.innerHTML=req.responseText;
            } } 
    }
       req.open('GET', 'ajax_admin_sms.php',true);
    req.send(null);  // отослать запрос 
    



//var scroll_admin_sms=document.getElementById('admin_sms').scrollHeight;//scroll внизу
//document.getElementById('admin_sms').scrollTop=scroll_admin_sms;

var scr_val=document.getElementById('scr_val').value;
var height=document.getElementById('admin_sms').scrollHeight;
if(height>scr_val){
document.getElementById('scr_val').value=document.getElementById('admin_sms').scrollHeight;//scroll внизу
document.getElementById('admin_sms').scrollTop=height;
}

}
