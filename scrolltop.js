
//var soobsheniya=document.getElementById('soobsheniya').scrollHeight;
//soobsheniya+=1000;
//document.getElementById('soobsheniya').scrollTop=soobsheniya;


var scr_val=document.getElementById('scr_val').value;
var height=document.getElementById('soobsheniya').scrollHeight;
if(height>scr_val){
document.getElementById('scr_val').value=document.getElementById('soobsheniya').scrollHeight;//scroll внизу
document.getElementById('soobsheniya').scrollTop=height;
}