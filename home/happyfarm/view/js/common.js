/*!
 * common.js
 * create by http://www.gohooh.com/
 */

//向服务器请求数据
function request(url, msgOId, data, secFn) {
	var msgObj = msgOId && SQuery('#'+msgOId);
	var msgFuc = function(msg, sec) {
		if(msgObj) {
			msgObj.innerHTML = msg;
			if(sec > 0) {
				setTimeout(function() {msgObj.innerHTML = '';}, sec * 1000);
			}
		}
	};
	SQuery.ajax({
		url: url, data: data,
		type: data ? 'POST' : 'GET',
		start: function() {
			msgFuc("Kết nối máy chủ GoHooH.CoM.", 0);
		},
		success: function(data) {
			data = data.indexOf('|&|') > 0 ? data.split('|&|') : ['-1','Máy chủ trả lời bất thường.']; 
			if(data[2] && data[2] != 'null') {
				data[2] == "refresh" ? location.assign(location) : location.assign(data[2]);
			}
			msgFuc(data[1], 3);
			secFn && secFn(data);//二级回调函数
		},
		error: function() {
			msgFuc("Máy chủ lỗi.", 5);
		}
	});
}
