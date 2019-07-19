var em_pol=document.getElementsByClassName('em_pol');
for(var i=0;i<em_pol.length;i++){
if(~em_pol[i].innerHTML.indexOf('@')){
document.getElementsByClassName('em_pol')[i].innerHTML=em_pol[i].innerHTML;
}
else {document.getElementsByClassName('em_pol')[i].innerHTML='не указан';}
}