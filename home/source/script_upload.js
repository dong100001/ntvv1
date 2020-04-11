/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: script_upload.js 13226 2009-08-24 02:39:06Z zhengqingpeng $
*/

var attachexts = new Array();
var attachwh = new Array();

var insertType = 1;
var thumbwidth = parseInt(60);
var thumbheight = parseInt(60);
var extensions = 'jpg,jpeg,gif,png';
var forms;
var nowUid = 0;
var albumid = 0;
var uploadStat = 0;
var picid = 0;
var aid = 0;
var topicid = 0;
var mainForm;
var successState = false;
var ieVersion = userAgent.substr(userAgent.indexOf('msie') + 5, 3);

function delAttach(id) {
	$('attachbody').removeChild($('attach_' + id).parentNode.parentNode.parentNode);
	if($('attachbody').innerHTML == '') {
		addAttach();
	}
	$('localimgpreview_' + id + '_menu') ? document.body.removeChild($('localimgpreview_' + id + '_menu')) : null;
}

function addAttach() {
	newnode = $('attachbodyhidden').rows[0].cloneNode(true);
	var id = aid;
	var tags;
	tags = newnode.getElementsByTagName('form');
	for(i in tags) {
		if(tags[i].id == 'upload') {
			tags[i].id = 'upload_' + id;
		}
	}
	tags = newnode.getElementsByTagName('input');
	for(i in tags) {
		if(tags[i].name == 'attach') {
			tags[i].id = 'attach_' + id;
			tags[i].name = 'attach';
			tags[i].onchange = function() {insertAttach(id)};
			tags[i].unselectable = 'on';
		}
		if(tags[i].id == 'albumid') {
			tags[i].id = 'albumid_' + id;
		}
		if(tags[i].id == 'topicid') {
			tags[i].id = 'topicid_' + id;
		}
	}
	tags = newnode.getElementsByTagName('span');
	for(i in tags) {
		if(tags[i].id == 'localfile') {
			tags[i].id = 'localfile_' + id;
		}
	}
	aid++;

	$('attachbody').appendChild(newnode);
}

addAttach();

function insertAttach(id) {
	var localimgpreview = '';
	var path = $('attach_' + id).value;
	var ext = getExt(path);
	var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
	var localfile = $('attach_' + id).value.substr($('attach_' + id).value.replace(/\\/g, '/').lastIndexOf('/') + 1);

	if(path == '') {
		return;
	}
	if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
		alert('Sorry, This file format not supported');
		return;
	}
	attachexts[id] = inArray(ext, ['gif', 'jpg', 'jpeg', 'png']) ? 2 : 1;

	var inhtml = '<div class="borderbox"><table cellspacing="0" cellpadding="0" border="0"><tr>';
	if(is_ie || userAgent.indexOf('firefox') >= 1) {
		var picPath = getPath($('attach_' + id));
		var imgCache = new Image();
		imgCache.src = picPath;
		inhtml += '<td><img src="' + picPath +'" width="60" height="80">&nbsp;</td>';
	}
	if(is_ie && typeof no_insert=='undefined' || insertType==0) {
		localfile += '&nbsp;<a href="javascript:;" title="µã»÷ÕâÀï²åÈëÄÚÈİÖĞµ±Ç°¹â±êµÄÎ»ÖÃ" onclick="insertAttachimgTag(' + id + ');return false;">[²åÈë]</a>';
	}
	localfile += '&nbsp;<span id="showmsg' + id + '"><a href="javascript:;" onclick="delAttach(' + id + ')">[É¾³ı]</a></span>';
	inhtml += '<td>' + localfile +'<br/>';
	inhtml += 'Image Description:<br/><textarea name="pic_title" cols="40" rows="2"></textarea>';
	inhtml += '</td></tr></table></div>';
	
	$('localfile_' + id).innerHTML = inhtml;
	$('attach_' + id).style.display = 'none';

	addAttach();
}

function getPath(obj){
	if (obj) {
		if (is_ie) {
			obj.select();
			// IEÏÂÈ¡µÃÍ¼Æ¬µÄ±¾µØÂ·¾¶
			return document.selection.createRange().text;
			
		} else if(is_moz) {
				if (obj.files) {
					// FirefoxÏÂÈ¡µÃµÄÊÇÍ¼Æ¬µÄÊı¾İ
					return obj.files.item(0).getAsDataURL();
				}
				return obj.value;
		}
		return obj.value;
	}
}
function inArray(needle, haystack) {
	if(typeof needle == 'string') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function insertAttachimgTag(id) {
	if(insertType == 0) {
		insertImage(id);
	} else if(is_ie) {
		var picPath = getPath($('attach_' + id));
		var imgCache = new Image();
		imgCache.src = picPath;
		edit_insert('<img id="_uchome_localimg_' + id + '" src="' + picPath + '">');
	} else {
		alert('Sorry, use the following function for IE browser,');
	}
}

function uploadSubmit(obj) {
	obj.disabled = true;
	mainForm = obj.form;
	forms = $('attachbody').getElementsByTagName("FORM");
	albumid = $('uploadalbum').value;
	upload();
}

//ÉÏ´«Ò³Ãæ
function start_upload() {
	$('btnupload').disabled = true;
	mainForm = $('albumresultform');
	forms = $('attachbody').getElementsByTagName("FORM");
	upload();
}

function upload() {
	if(typeof(forms[nowUid]) == 'undefined') return false;
	var nid = forms[nowUid].id.split('_');
	nid = nid[1];
	if(nowUid>0) {
		var upobj = $('showmsg'+aid);
		if(uploadStat==1) {
			upobj.innerHTML = 'Upload Sucessful';
			successState = true;
			var InputNode;
			//Á½ÖÖÉú³É·½Ê½£¬½â¾öä¯ÀÀÆ÷Ö®¼äµÄ¼æÈİĞÔÎÊÌâ
			try {
				//IEÄ£Ê½ÏÂµÄ´´½¨·½Ê½,½â¾ö³£¹æsetAttributeÉèÖÃÊôĞÔ´øÀ´µÄÒ»Ğ©Î´ÖªµÄ´íÎó
				var InputNode = document.createElement("<input type=\"hidden\" id=\"picid_" + picid + "\" value=\""+ aid +"\" name=\"picids["+picid+"]\">");
			} catch(e) {
				//·ÇIEÄ£Ê½ÔòĞëÒªÓÃÏÂÁĞµÄ³£¹æsetAttributeÉèÖÃÊôĞÔ£¬·ñÔòÉú³ÉµÄ½á¹û²»ÄÜÕı³£³õÊ¼»¯
				var InputNode = document.createElement("input");
				InputNode.setAttribute("name", "picids["+picid+"]");
				InputNode.setAttribute("type", "hidden");
				InputNode.setAttribute("id", "picid_" + picid);
				InputNode.setAttribute("value", aid);
			}
			mainForm.appendChild(InputNode);

		} else {
			upobj.style.color = "#f00";
			upobj.innerHTML = 'Upload Failed '+uploadStat;
		}
	}
	if($('showmsg'+nid) != null) {
		$('showmsg'+nid).innerHTML = 'Äang upload, vui lÃ²ng Ä‘á»£i...KhÃ´ng Ä‘Æ°á»£c Ä‘Ã³ng cá»­a sá»• (<a href="javascript:;" onclick="forms[nowUid].submit();">Thá»­ láº¡i</a>)';
		$('albumid_'+nid).value = albumid;
		if($('topicid_'+nid)) $('topicid_'+nid).value = topicid;
		forms[nowUid].submit();
	} else if(nowUid+1 == forms.length) {
		if(typeof (no_insert) != 'undefined') {
			var albumidcheck = parseInt(parent.albumid);
			$('opalbumid').value = isNaN(albumidcheck)? 0 : albumid;
			$('optopicid').value = topicid;
			if(!successState) return false;
		}
		mainForm.submit();
	}
	aid = nid;
	nowUid++;
	uploadStat = 0;
}
