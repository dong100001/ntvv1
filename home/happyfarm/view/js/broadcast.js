(function() {
	var msgViewer = document.getElementById('msg_viewer'),
		_timer,
		_msgs = [
			{
				text : 'Hướng dẫn chơi game nông trại vui vẻ!!',
				href : 'http://www.gohooh.com/forum/thread-4231-1-1.html'
			},
			{
				text : 'Cần tuyển flash design việt hóa game',
				href : 'http://www.gohooh.com/forum/thread-4230-1-1.html'
			},
			{
				text : 'Share code game nông trại vui vẻ',
				href : 'http://gohooh.com/forum/thread-4213-1-1.html'
			},
			{
				text : 'Ảnh đẹp',
				href : 'http://www.gohooh.com/anhdep/'
			},
			{
				text : 'Mặt cười cho blog',
				href : 'http://www.gohooh.com/matcuoi'
			},
			{
				text : 'Xem phim cực hot',
				href : 'http://www.gohooh.com/yeuphim/'
			},
			{
				text : 'Forum thân thiện',
				href : 'http://www.gohooh.com/forum/'
			},
			{
				text : 'Gửi ước mơ',
				href : 'http://www.gohooh.com/sky/'
			},
			{
				text : 'Trang chủ GoHooH.CoM',
				href : 'http://www.gohooh.com/'
			},
			{
				text : 'Pet gamme vui nhộn',
				href : 'http://www.pet.gohooh.com/'
			},
			{
				text : 'Clan x4teen',
				href : 'http://www,gohooh.com/x4teen/'
			},
			{
				text : 'Tin tức cập nhật liên tục',
				href : 'http://www.gohooh.com/tintuc/'
			},
			
			{
				text : 'Tool hay',
				href : 'http://www.gohooh.com/tool/'
			}
		],
		_curIndex = 0,
		DELAY = 5000;
	var playMsg = function() {
		//当游戏信息大于一条的时候
		if(_msgs.length > 1) {
			clearInterval(_timer);
			msgViewer.innerHTML = _msgs[_curIndex].text;
			msgViewer.target = '_blank';
			_timer = setInterval(function() {
				msgViewer.innerHTML = _msgs[_curIndex].text;
				msgViewer.target = '_blank';
				msgViewer.href = _msgs[_curIndex].href;
				if(++_curIndex == _msgs.length) {
					_curIndex = 0;
				}
			}, 5000);
		}
		else {
			msgViewer.innerHTML = _msgs[0].text;
			msgViewer.target = '_blank';
			msgViewer.href = _msgs[0].href;
		}
	}
	if(typeof(msgViewer) != 'undefined' && msgViewer){
		playMsg();
	}
})();