//许愿墙显示部分

//删除函数
function deltianyamessage(n)
{
	var tianyamessageid = 'Layer' + n;
	document.getElementById(tianyamessageid).style.visibility = 'hidden';
	//document.getElementById(tianyamessageid).removeNode(true);
}

//查询函数
function searchmessage(a,b)
{
	if (b == "bNull")
		var b = document.getElementById("intID").value;
	if (a+1 > b && b > a - 99)
	{
		for (i = 0; i < 99; i++) {
			if (ArrayMessage[i][0] == b)
			{
				b = i;
				showmessage(b);
				break;
			}
		}
	}
	else if (b < a - 98)
		document.getElementById("slink").src="default_more.asp?intID=" + b;
	else
		alert("漂峄沜 nguy锚n c峄 b岷 t矛m ki岷縨 ch瓢a c贸");
}

//动态显示纸条
function showmessage(n) {
	if (ArrayMessage[n] != undefined){
	document.getElementById("olink").innerHTML="<div id=\"Layer"+ArrayMessage[n][0]+"\" name=\"Layer"+ArrayMessage[n][0]+"\" style=\"position:absolute; left:380px; top:210px; z-index:999999; width: 260px;CURSOR: move\" onmousedown=\"movetianyamessage(this, event)\"><table width=\"260\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> <tr><td height=\"41\" valign=\"top\" style=\"background-image:url(wish/images/"+ArrayMessage[n][6]+"_01.gif)\"><table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"8%\" valign=\"bottom\" >&nbsp;</td><td width=\"43%\" height=\"34\" valign=\"bottom\" class=\""+ArrayMessage[n][6]+"_kline\" style=\"padding-left:5px\">"+ArrayMessage[n][0]+"</td><td width=\"44%\" align=\"right\" valign=\"bottom\" class=\""+ArrayMessage[n][6]+"_kline\" style=\"padding-right:7px\">"+ArrayMessage[n][3]+"</td><td width=\"5%\" align=\"right\" valign=\"bottom\" onclick=\"deltianyamessage('"+ArrayMessage[n][0]+"')\" style=\"cursor: pointer;\">&nbsp;</td></tr></table></td> </tr> <tr><td style=\"background-image:url(wish/images/"+ArrayMessage[n][6]+"_02.gif)\"><table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\""+ArrayMessage[n][6]+"_kline\" style=\"margin-bottom:3px\"> <tr><td width=\"10\">&nbsp;</td><td style=\"padding:3px\" height=\"80\" valign=\"top\"><span id=\"ReceiverName\" name=\"ReceiverName\" style=\"word-wrap: break-word; word-break: break-all;\">"+ArrayMessage[n][5]+"</span><span id=\"oContent\" name=\"oContent\" style=\"word-wrap: break-word; word-break: break-all;\" >"+ArrayMessage[n][2]+"</span></td></tr></table></td></tr> <tr><td height=\"53\" valign=\"top\" style=\"background-image:url(wish/images/"+ArrayMessage[n][6]+"_04.gif)\"> <table width=\"78%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"> <tr><td width=\"45%\" valign=\"top\"><img src=\"wish/images/wp_"+ArrayMessage[n][7]+".gif\" width=\"30\" height=\"28\" /><br /><span class=\""+ArrayMessage[n][6]+"_ty\">tianya.cn</span></td><td width=\"55%\" align=\"right\" valign=\"top\">"+ArrayMessage[n][1]+"<br />"+ArrayMessage[n][4]+"</td></tr> </table></td></tr></table></div>"
	s = setTimeout("GrayRun("+n+")",1000);
	}
}

//暗淡其他的图片函数
function GrayRun(n)
{
	if(document.all){
	document.getElementById("olink").innerHTML="<div id=\"Layer888888\" name=\"Layer888888\" style=\"position:absolute; left:0px; top:0px; z-index:888888;width: 1000px;height: 680px;\" class=\"trans\" onclick=\"stoprun()\"><table width=\"1000\" height=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"trans\" bgcolor=\"#808040\"> <tr><td></td></tr></table></div>"
	}
	else{
	document.getElementById("olink").innerHTML="<div id=\"Layer888888\" name=\"Layer888888\" style=\"position:absolute; left:0px; top:0px; z-index:888888;width: 1000px;height: 680px;\" class=\"trans\" onclick=\"stoprun()\"><table width=\"1000\" height=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"background-image:url(wish/images/bg.jpg)\" class=\"trans\"> <tr><td></td></tr></table></div>"
	}
	o = setTimeout("run("+n+")",1000);
	//clearTimeout(o);
}

//显示扩大纸条的函数
function run(m)
{
	var strWriterIDLink = 'strWriter' + ArrayMessage[m][0];
	var strReceiverLink = 'strReceiver' + ArrayMessage[m][0];
	document.getElementById("olink").innerHTML=document.getElementById("olink").innerHTML+"<div id=\"Layer999999\" name=\"Layer999999\" style=\"position:absolute; left:340px; top:170px; z-index:999999; width: 260px;CURSOR: move\" onmousedown=\"movetianyamessage(this, event)\" onclick=\"stoprun()\"><table width=\"360\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> <tr><td valign=\"top\" height=\"57\" style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_01.gif)\"> <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"8%\" valign=\"bottom\" >&nbsp;</td><td width=\"43%\" valign=\"bottom\"  height=\"50\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"padding-left:12px;font-size:14px;\">"+ArrayMessage[m][0]+"</td><td width=\"44%\" align=\"right\" valign=\"bottom\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"font-size:14px;padding-right:12px\">"+ArrayMessage[m][3]+"</td><td width=\"5%\" align=\"right\" valign=\"bottom\" onclick=\"deltianyamessage(999999)\" style=\"cursor: pointer;\">&nbsp;</td></tr></table></td> </tr> <tr><td style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_02.gif)\"><table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"margin-bottom:3px\"> <tr><td width=\"10\">&nbsp;</td><td style=\"padding:6px\" valign=\"top\" height=\"120\"><span id=\"ReceiverName\" name=\"ReceiverName\" style=\"word-wrap: break-word; word-break: break-all;font-size:14px;\">"+ArrayMessage[m][5]+"</span><span id=\"oContent\" name=\"oContent\" style=\"word-wrap: break-word; word-break: break-all;font-size:14px;\" >"+ArrayMessage[m][2]+"</span></td></tr></table></td></tr> <tr><td valign=\"top\" height=\"73\" style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_04.gif)\"> <table width=\"78%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"> <tr><td width=\"45%\" valign=\"top\"><img src=\"wish/images/wp_"+ArrayMessage[m][7]+".gif\" width=\"30\" style=\"padding-left:12px;\"/><br /><span class=\""+ArrayMessage[m][6]+"_ty\" style=\"padding-left:12px;\">tianya.cn</span></td><td width=\"55%\" align=\"right\" valign=\"top\"><span style=\"font-size:14px;\">"+ArrayMessage[m][1]+"</span><br />"+ArrayMessage[m][4]+"</td></tr> </table></td></tr></table></div>"
	document.getElementById("signatory").style.fontSize = '14px';
	try{
		document.getElementById(strWriterIDLink).style.fontSize = '14px';
		document.getElementById(strReceiverLink).style.fontSize = '14px';
	}catch(e){}
}

//双击纸条扩大函数
function dbrun(m)
{	
	var strWriterIDLink = 'strWriter' + ArrayMessage[m][0];
	var strReceiverLink = 'strReceiver' + ArrayMessage[m][0];
	var tianyamessageid = 'Layer' + ArrayMessage[m][0];
	var intLeft = document.getElementById(tianyamessageid).style.left;
	var intTop = document.getElementById(tianyamessageid).style.top;
	intLeft = intLeft.substring(0,intLeft.length-2) - 40;
	intTop = intTop.substring(0,intTop.length-2) - 40;
	document.getElementById("olink").innerHTML="<div id=\"Layer999999\" name=\"Layer999999\" style=\"position:absolute; left:"+intLeft+"px; top:"+intTop+"px; z-index:999999; width: 260px;CURSOR: move\" onmousedown=\"movetianyamessage(this, event)\" ondblclick=\"stoprun()\"><table width=\"360\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> <tr><td valign=\"top\" height=\"57\" style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_01.gif)\"> <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"8%\" valign=\"bottom\" >&nbsp;</td><td width=\"43%\" valign=\"bottom\"  height=\"50\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"padding-left:12px;font-size:14px;\">"+ArrayMessage[m][0]+"</td><td width=\"44%\" align=\"right\" valign=\"bottom\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"font-size:14px;padding-right:12px\">"+ArrayMessage[m][3]+"</td><td width=\"5%\" align=\"right\" valign=\"bottom\" onclick=\"deltianyamessage(999999)\" style=\"cursor: pointer;\">&nbsp;</td></tr></table></td> </tr> <tr><td style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_02.gif)\"><table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\""+ArrayMessage[m][6]+"_kline\" style=\"margin-bottom:3px\"> <tr><td width=\"10\">&nbsp;</td><td style=\"padding:6px\" valign=\"top\" height=\"120\"><span id=\"ReceiverName\" name=\"ReceiverName\" style=\"word-wrap: break-word; word-break: break-all;font-size:14px;\">"+ArrayMessage[m][5]+"</span><span id=\"oContent\" name=\"oContent\" style=\"word-wrap: break-word; word-break: break-all;font-size:14px;\" >"+ArrayMessage[m][2]+"</span></td></tr></table></td></tr> <tr><td valign=\"top\" height=\"73\" style=\"background-image:url(wish/images/"+ArrayMessage[m][6]+"1_04.gif)\"> <table width=\"78%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"> <tr><td width=\"45%\" valign=\"top\"><img src=\"wish/images/wp_"+ArrayMessage[m][7]+".gif\" width=\"30\" style=\"padding-left:12px;\"/><br /><span class=\""+ArrayMessage[m][6]+"_ty\" style=\"padding-left:12px;\">tianya.cn</span></td><td width=\"55%\" align=\"right\" valign=\"top\"><span style=\"font-size:14px;\">"+ArrayMessage[m][1]+"</span><br />"+ArrayMessage[m][4]+"</td></tr> </table></td></tr></table></div>"
	document.getElementById("signatory").style.fontSize = '14px';
	try{
		document.getElementById(strWriterIDLink).style.fontSize = '14px';
		document.getElementById(strReceiverLink).style.fontSize = '14px';
	}catch(e){}
}
//停止扩大函数
function stoprun()
{
	document.getElementById("olink").innerHTML="";
}
//***************************移动函数,只在ie,firefox下有用*********************************
var tianyamessage = ''
var iLayerMaxNum = 999;

document.onmouseup = movetianyamessageend;
document.onmousemove = movetianyamessagestart;
var tianyamessagepixefX;
var tianyamessagepixefY;

function movetianyamessage(Object, event)
{
	tianyamessage = Object.id;
	if(document.all)
	{
		document.getElementById(tianyamessage).setCapture();
		tianyamessagepixefX = event.x - document.getElementById(tianyamessage).style.pixelLeft;
		tianyamessagepixefY = event.y - document.getElementById(tianyamessage).style.pixelTop;
	}
	else if(window.captureEvents)
	{
		window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
		tianyamessagepixefX = event.layerX;
		tianyamessagepixefY = event.layerY;
	}
	document.getElementById(tianyamessage).style.zIndex = iLayerMaxNum;   

	iLayerMaxNum = iLayerMaxNum + 1;	
}

function movetianyamessagestart(evt)
{
	if(tianyamessage!=''){
		if(document.all)
		{
			document.getElementById(tianyamessage).style.left = event.x - tianyamessagepixefX;
			document.getElementById(tianyamessage).style.top = event.y - tianyamessagepixefY;
		}
		else if(window.captureEvents)
		{
			document.getElementById(tianyamessage).style.left = (evt.clientX - tianyamessagepixefX) + "px";
			document.getElementById(tianyamessage).style.top = (evt.clientY - tianyamessagepixefY) + "px";
		}
	 }
}

function movetianyamessageend(evt){
	if(tianyamessage!=''){
		if(document.all)
		{
			document.getElementById(tianyamessage).releaseCapture();
			tianyamessage='';
		}
		else if(window.captureEvents){
			window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
			tianyamessage='';
		}
	 }
}
//***************************移动函数,只在ie,firefox下有用*********************************