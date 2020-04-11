//³õÊ¼»¯Ëæ»úÑ¡Ôñ±³¾°ºÍ×óÏÂ½ÇÍ¼Æ¬
var chars = ['a','b','c','d','e','f'];
ChoiceColor(generateMixed(1, 5));

chars = ['1', '2', '3', '4', '5', '6', '7', '8'];
ChoiceImage(generateMixed(1, 7));


function generateMixed(n, leng) {
    var res = "";
    for(var i = 0; i < n ; i ++) {
        var id = Math.ceil(Math.random() * leng);
        res += chars[id];
    }
    return res;
}

//ĞŞ¸Ä±³¾°ÑÕÉ«º¯Êı
function ChoiceColor(n){
	var bgColor1 = "url(wish/images/"+n+"_01.gif)";
	var bgColor2 = "url(wish/images/"+n+"_02.gif)";
	var bgColor3 = "url(wish/images/"+n+"_04.gif)";
	var bgColor4 = n + "_kline";
	var bgColor5 = n + "_kline";
	//var bgColor6 = n + "_ty";
	$("BGColor1").style.backgroundImage = bgColor1;
	$("BGColor2").style.backgroundImage = bgColor2;
	$("BGColor3").style.backgroundImage = bgColor3;
	$("BGColor4").className = bgColor4;
	$("BGColor5").className = bgColor5;
	//$("BGColor6").className = bgColor6;
	$("strBGColor").value = n;
}
//ĞŞ¸Ä×óÏÂÍ¼Æ¬º¯Êı
function ChoiceImage(n){
	var strImage = "wish/images/wp_"+n+".gif";
	$("image").src = strImage;
	$("strImage").value = n;	
}
//×Ô¶¯ĞŞ¸ÄÊ±¼ä
ChangeTime()
function ChangeTime(){	
	var strDate = new Date();
	var strTime;
	strTime = strDate.getFullYear() + "-";
	strTime += strDate.getMonth()+1 + "-";
	strTime += strDate.getDate() + " ";
	strTime += strDate.getHours() + ":";
	strTime += strDate.getMinutes();

	$("oTime").innerHTML = strTime;
}
//ĞŞ¸ÄÄÚÈİ
function ChangeContent(){
	var c = $("oSource").value;
	c = c.replace(/&/g, '&amp').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
	var d = c.length; 
	var e = new RegExp("\n", "gm");
	var f = c.match(e);
	var g = 0;
	var h = $("oContent").innerHTML;
	var i = 0;
	if (f){
		g = f.length;
	}
	if (g > 3){	
		d = d + (g * 6);
		alert("Báº¡n Ä‘Ã£ bá» qua 3 cÆ¡ há»™i. Báº¡n sáº½ khÃ´ng cÃ³ cÆ¡ há»™i ná»¯a...");
		$("oSource").value = h;
	}else{
		d = d + (g * 6);
		if (d<81){
			$("oContent").innerHTML = c;
			$("freeLength").value = 80 - d;
		}else{
			//alert("VÆ°á»£t quÃ¡ 80 kÃ½ tá»± rá»“i");
			i = 80 - (g * 6);
			c = c.substring(0,i);
			$("oContent").innerHTML = c;
			$("oSource").value = c;
		}
	}
}
Change();
ChangeSenderOK();
//·¢ËÍÕßµÄIDÊÇ·ñÒş²Ø
function ChangeSenderOK()
{
	var strSender = $("strSenderID").innerHTML;
	var strOKvalue = $("oCheckbox").checked;
	//alert($("oCheckbox").checked);
	if (strOKvalue == true){
		$("oName").innerHTML = "ÄäÃû";
		$("strSendName").value = "ÄäÃû";
	}else{
		$("oName").innerHTML = strSender;
		$("strSendName").value = strSender;
	}
	Change();
	ChangeContent();
}
//Ñ¡ÔñºÃÓÑ
function selectFriend(friend){
	var str;
	if(friend.length > 1){
		str = friend.split(",");
		$("strReceiverName").value = str[1];
	}else{
		$("strReceiverName").value = '';
	}
	Change();
	ChangeContent();
}
//¶ÔÄ³ÈËĞíÔ¸µÄÄÚÈİ¸Ä±ä 
function Change(){
	var strSender = $("strSenderID").innerHTML;
	var strOKvalue = $("oCheckbox").checked;
	var strReceiver = $("strReceiverName").value;
	if (strOKvalue == true){
		if (strReceiver == "")
			$("ReceiverName").innerHTML = "";
		else
			$("ReceiverName").innerHTML = "Ai Ä‘Ã³ Æ°á»›c cho" +strReceiver+ ":";
	}else{
		if (strReceiver == "")
			$("ReceiverName").innerHTML = "";
		else
			$("ReceiverName").innerHTML = strSender+ "Æ°á»›c cho" +strReceiver+ ":";
	}
	ChangeContent();
}
//Ñ¡ÔñºÃÓÑ
function ChoiceFriend(){
	var strOKvalue = $("oCheckbox_friend").checked;
	if (strOKvalue == true){
		//Ñ¡ÖĞµÚÒ»Ïî
		var t=$('selectfriend');
		t.selectedIndex=0;
		
		$('myFriend').style.display = '';
		$('myReceiver').style.display = 'none';		
		$('myMsg').style.display = '';
		$('strReceiverName').value = '';
		Change();
	}else{
		$('myFriend').style.display = 'none';
		$('myMsg').style.display = 'none';
		$('myReceiver').style.display = '';
		$('strReceiverName').value = '';
		Change();
	}
	ChangeContent();
}



