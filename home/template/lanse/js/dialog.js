$(document).ready(function(){var b=location.hash;if(b=="#login"){var a={width:360,height:245,title:"\u767b\u5f55",type:"frame",url:"login.aspx"};Dialog.show(a)}if(b=="#loginToManager"){var a={width:360,height:245,title:"\u767b\u5f55",type:"frame",url:"login.aspx?ul=/manager"};Dialog.show(a)}LoginBoxInit()});function LoginBoxInit(){$(".feikelogin").each(function(){this.onclick=function(){var a="login.aspx";if($(this).attr("href")!=undefined&&$(this).attr("href")!=""){a=$(this).attr("href")}var b={width:375,height:245,title:"\u767b\u5f55",type:"frame",url:a};Dialog.show(b);return false}})}$.extend({WindowsHeight:function(){if($.browser.msie&&$.browser.version<7){var b=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight);var a=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight);if(b<a){return $(window).height()}else{return b}}else{return $(document).height()}},WindowsWidth:function(){if($.browser.msie&&$.browser.version<7){var a=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth);var b=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth);if(a<b){return $(window).width()}else{return a}}else{return $(document).width()}}});$(window).resize(function(){});var iframeurl="";var Dialog={show:function(e){var k=$('<div class="dialog_backlayer"/>').height($.WindowsHeight()).width($.WindowsWidth()).css({filter:"alpha(opacity=60)",opacity:"0.6"}).appendTo($("body"));var a=($(window).height()-e.height)/2;var f=navigator.appName;var i=navigator.appVersion;var h=i.split(";");var b=h[1].replace(/[ ]/g,"");if(f=="Microsoft Internet Explorer"&&b=="MSIE6.0"){a+=$(window).scrollTop()}var c=$('<div class="dialog_framelayer"/>').css({top:a,left:($(window).width()-e.width)/2,width:e.width}).appendTo($("body"));var d=$('<table class="dialog_topbar" cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td class="dialog_topbar_left"></td><td class="dialog_topbar_middel"><span class="dialog_topbar_title">'+e.title+'</span><span class="dialog_topbar_close"><img src="/img/w_close.gif" border=0></span></td><td class="dialog_topbar_right"></td></tr></table>').appendTo(c);var j;iframeurl=e.url;if(e.type=="html"){j=e.html}else{if(e.type=="frame"){j='<iframe width="100%" height="100%" name="I1" id="I1" src="'+e.url+'" scrolling="no" border="0" frameborder="0" onload="iframeonloaded(this.src)"></iframe>'}else{j=""}}j+='<div id="newdiv" style="position: absolute;display:none; z-index: 9999; width: 99%; height: 80px; top: 235px; left: 0px;"><div align="center"><a style="font-size: 12px; color: rgb(49, 95, 132);" href="javascript:forgetpwd()" onclick="wa_regIdCount(100060);" >忘记密码</a> <span style="font-size: 12px;">|</span> <a style="font-size: 12px; color: rgb(49, 95, 132);" href="javascript:parent.location.href=\'http://www.fetion.com.cn/account/register/\'" onclick="wa_regIdCount(100061);">注册</a></div></div>';var g=$('<div class="dialog_content"/>').css({height:e.height}).html(j).appendTo(c);var d=$('<table class="dialog_bottom" cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td class="dialog_bottom_left"></td><td class="dialog_bottom_middel">&nbsp;</td><td class="dialog_bottom_right"></td></tr></table>').appendTo(c);$(".dialog_topbar").mousedown(function(){c.draggable({handle:".dialog_topbar"})});$(".dialog_topbar_close").click(function(){Dialog.close(this.isReload)});$("select").each(function(){$(this).css("visibility","hidden")});$(window).resize(function(){Dialog.setMarkPosition();Dialog.setFramelayerPostion(e)})},close:function(b){var a=b||this.isReload;$(".dialog_backlayer").remove();$(".dialog_framelayer").remove();$("select").each(function(){$(this).css("visibility","visible")});if(a){location.reload()}return false},setMarkPosition:function(){if($(".dialog_backlayer")){$(".dialog_backlayer").height($.WindowsHeight()).width($.WindowsWidth())}},setFramelayerPostion:function(a){if($(".dialog_framelayer")){$(".dialog_framelayer").css({top:($(window).height()-a.height)/2,left:($(window).width()-a.width)/2,width:a.width})}},isReload:false};function iframeonloaded(){var a=iframeurl.split("login.aspx");if(a.length>1){$("#newdiv").show()}else{$("#newdiv").hide()}}function forgetpwd(){iframeurl="http://www.fetion.com.cn/channel/forgetpass/";$("#I1").attr("src","http://www.fetion.com.cn/channel/forgetpass/");setcaption("忘记密码")}function reg(){iframeurl="http://www.fetion.com.cn/Iframe/Member/FetionReg.aspx";$("#I1").attr("src","http://www.fetion.com.cn/Iframe/Member/FetionReg.aspx");setcaption("注册")}function setcaption(a){$(".dialog_topbar_title").text(a)}var SpaceDialog={show:function(c){var g=$(document).height();var n=$(document).width();if($.browser.msie&&$.browser.version==6){g=g-21;n=n-21}$("body").append('<div class="mask_bg"></div><iframe id="maskIfame" style="width:'+n+"px;height:"+g+'px;z-index:1;position:absolute;top:0;left:0;border:0;filter:Alpha(Opacity=0);"></iframe>');$(".mask_bg").css({width:n,height:g});$("body").append('<div class="favorites_layer"><div class="inbox_bg"><div class="layer_tit lay_bg01" style="cursor:move"><h6>'+c.title+'</h6><div class="close"></div></div><div class="layer_center"></div></div></div>');$(".favorites_layer").width(c.width);$(".favorites_layer").height(c.height);$(".favorites_layer .layer_center").html("<div style='text-align:center'>正在加载，请稍后...</div>");var d=objValue("favorites_layer");var e=d.split("|")[0]+"px";var l=d.split("|")[1]+"px";$(".favorites_layer").css({top:e,left:l,display:"block",position:"absolute","z-index":"9999"});var m="";if(c.type=="html"){var j="";if(c.icon=="none"||c.icon=="undifined"){j=""}else{if(c.icon=="warning"){j='<div class="pop_img"><div class="pop_bg"/></div>'}}var k='<div class="pop_content">'+j+'<div class="pop_text">'+c.text+"</div></div>";var a='<div class="layer_bot">';for(var i in c.button){var f=1;if(c.button[i].type=="cancel"){f=4}a+='<input type="button" value="'+c.button[i].text+'" name="button" class="layerbutton01 l_join0'+f+'" id="layer_button_'+i+'"/>'}m=k+a}else{m='<iframe width="100%" height="100%" name="layeriframe" id="layeriframe" src="'+c.url+'" scrolling="no" border="0" frameborder="0"></iframe>'}var h=$(".favorites_layer .layer_center").css({height:c.height}).html(m);$(".layer_tit").mousedown(function(){$(".favorites_layer").draggable({handle:".layer_tit"})});$(".favorites_layer .close").click(function(){SpaceDialog.close(false);if(c.close){c.close()}});for(var i in c.button){$("#layer_button_"+i).click(c.button[i].click);$("#layer_button_"+i).click(function(){SpaceDialog.close(false)})}$(window).resize(function(){SpaceDialog.setMarkPosition();SpaceDialog.setFramelayerPostion(c)})},close:function(a){$(".mask_bg").remove();$("#maskIfame").remove();$(".favorites_layer").remove();if(a){location.reload()}return false},setMarkPosition:function(){if($(".mask_bg")){var b=$(document).height();var a=$(document).width();if($.browser.msie&&$.browser.version==6){b=b-21;a=a-21}$(".mask_bg").css({width:a,height:b})}},setFramelayerPostion:function(a){if($(".favorites_layer")){$(".favorites_layer").width(a.width);$(".favorites_layer").height(a.height)}}};var SpaceTip2={show:function(a,c,g){$(".open_fir01").remove();$("body").append('<div class="open_fir01">'+c+"</div>");$(".open_fir01").width(a);var d=objValue("open_fir01");var h=d.split("|")[0]+"px";var e=d.split("|")[1]+"px";$(".open_fir01").css({top:h,left:e,display:"block",position:"absolute"});if($.browser.msie&&$.browser.version==6){var b=$(".open_fir01").height()+2+"px";var f=$(".open_fir01").width()+2+"px";$(".open_fir01").append("<div id='ifisie6'><iframe style='filter:alpha(opacity=0);position:absolute;z-index:-1; top:2px; left:-1px; width:"+f+"; height:"+b+"'></iframe></div>")}$(".open_fir01").fadeIn("slow",function(){setId=setInterval(closeDiv,5000)})},close:function(){clearInterval(setId);$(".open_fir01").remove()}};var SpaceTip={show:function(a,c){$(".send_con").remove();$("body").append('<div class="send_con"><div class="send_left s_icon01"/><div class="send_text">'+c+'</div><div class="send_right s_icon01"/></div>');var d=objValue("send_con");var g=d.split("|")[0]+"px";var e=d.split("|")[1]+"px";$(".send_con").css({top:g,left:e,display:"block",position:"absolute"});if($.browser.msie&&$.browser.version==6){var b=$(".send_con").height()+2+"px";var f=$(".send_con").width()+2+"px";$(".send_con").append("<div id='ifisie6'><iframe style='filter:alpha(opacity=0);position:absolute;z-index:-1; top:2px; left:-1px; width:"+f+"; height:"+b+"'></iframe></div>")}$(".send_con").fadeIn("slow",function(){setId=setInterval("SpaceTip.close()",5000)})},close:function(){clearInterval(setId);$(".send_con").remove()}};var SpaceFriendGroupLayer={show:function(){$("body").append('<div class="open_fir03 lay_bg01" style="width: 169px; height: 220px;background:#ffffff; position: absolute; left: 200px; top: 200px;"><h6>选择飞信好友分组</h6><ul><li><b>√</b>我的高中同学</li><li><b>√</b>同事</li></ul>')},close:function(){$(".open_fir03").remove()}};function objValue(f){var i=document.documentElement.scrollTop;var c=document.documentElement.scrollLeft;var a=document.documentElement.clientHeight||document.documentElement.offsetHeight;var e=document.documentElement.clientWidth||document.documentElement.offsetWidth;var d=$("."+f).height();var g=$("."+f).width();var h=Number(i)+(Number(a)-Number(d))/2;var b=Number(c)+(Number(e)-Number(g))/2;return h+"|"+b};