/*
function  voyti() {
document.getElementById('voyti').style.visibility="visible";
document.getElementById('voyti').style.left="0";   
document.getElementsByName('autorizatcia_sms_button')[0].style.visibility="hidden"; 
}
*/
//через jquery
function  voyti() {
$("#voyti").css("visibility","visible");
$("#voyti").css("left","0"); 
$('input[name="autorizatcia_sms_button"]').css("visibility","hidden");
}