$(document).ready(function()
{
	$("input[name='parol1']").keyup(function()
	{
		var znachenie=$("input[name='parol']").val();
		var znachenie1=$("input[name='parol1']").val();
		var count= znachenie.length;
var count1= znachenie1.length;
		if(znachenie.length==znachenie1.length){
var rez_tat="<b style='color:green'>Количество символов совпало</b>";
			$("#podschet_simvolov").html(rez_tat);
			}

else if(znachenie.length!=znachenie1.length){
var rez_tat="<b style='color:red'>Количество символов не совпадает</b>";
			$("#podschet_simvolov").html(rez_tat);
			}		
		return false;
	});

});