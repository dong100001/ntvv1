<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vn" lang="vn"><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>Ao cá vui vẻ trên mạng xã hội Nhà Tui - GoHooH.CoM</title><link type="text/css" rel="stylesheet" href="view//qf_default/images/style.css" /></head><body><script type="text/javascript" src="script.php?squery&common"></script><div id="wrap"><div id="info" class="clearfix"><div id="info1"><a href="#" target="_blank" id='msg_viewer'>Không sử dụng phần mềm của bên thứ ba, để công bằng trò chơi.</a></div><script type="text/javascript">$.DomReady(function() {var _msgs = eval('<?php echo qf_jsonCode($_NOTICE[main]); ?>');var _timer, _curIndex = 0, _viewer = $('#msg_viewer');var playMsg = function() {if(_msgs.length > 1) {clearInterval(_timer);_viewer.innerHTML = _msgs[_curIndex].text;_viewer.target = '_blank';_timer = setInterval(function() {_viewer.innerHTML = _msgs[_curIndex].text;_viewer.href = _msgs[_curIndex].href;if(++_curIndex == _msgs.length) {_curIndex = 0;}_viewer.target = '_blank';}, 5000);}else {_viewer.innerHTML = _msgs[0].text;_viewer.href = _msgs[0].href;_viewer.target = '_blank';}};if(typeof(_viewer) != 'undefined' && _viewer) {playMsg();}});</script><div id="info2"><?php $credit = qf_userCredit(0); ?><?php list($money, $yb) = qf_getMoney(0); ?>Tài sản:&nbsp;&nbsp;Điểm:<b id="qfcredit"><?php echo $credit; ?></b>&nbsp;&nbsp;Vàng:<b id="qfmoney"><?php echo $money; ?></b>&nbsp;&nbsp; Xu Y:<b id="qfyb"><?php echo $yb; ?></b>&nbsp;</div></div>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"id="kaixinyutang" width="100%" height="653px"codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab"><param name="movie" value="module/kaixinyutang.swf?v=15" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="flashVars" value="uId=<?php echo $_HFG['uid']; ?>&vkey=<?php echo $uikey; ?>&h=1&flashRevision=15" /> <embed src="module/kaixinyutang.swf?v=15" quality="high" bgcolor="#ffffff"width="100%" height="653px" name="kaixinyutang" align="middle"play="true"loop="false"quality="high"allowScriptAccess="sameDomain"type="application/x-shockwave-flash"pluginspage="http://www.adobe.com/go/getflashplayer"></embed></object></div><script type="text/javascript">//尝试更新父窗口参数try {//版本号$('#qfversion', window.parent.document).style.display = 'block';$('#qfversion', window.parent.document).innerHTML = 'HappyFish <?php echo FISH_VERSION; ?> <a href="http://www.gohooh.com/" target="blank">GoHooH</a>';//播放器var viewPlayer = "<?php echo $_HSC['view']['player']; ?>";if(viewPlayer > 0) {$('#qfplayer', window.parent.document).style.display = 'block';}} catch(e) {}</script></body></html>
