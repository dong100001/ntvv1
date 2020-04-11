/*!
 * Light Box Dialog
 * Code by seaif@zealv.net
 */

//注册构造函数
var DialogBox = function() { this.initialize.apply(this, arguments); };

//添加核心属性
DialogBox.prototype = {
	initialize: function(Config) {
		//初始化参数
		this.CFG = this.Extend({
			Boxid: 'dlBox',//显示层ID
			Layid: 'dlLay',//背景层ID
			zIndex: 1986,//背景层层叠顺序
			Opacity: 60,//背景层透明度[0,100]
			bgColor: '#000000'//背景层颜色
		}, Config || {});
		this.CFG.zIndex = parseInt(this.CFG.zIndex);
		this.CFG.Opacity = parseInt(this.CFG.Opacity);
		//初始化显示层
		this.Box = document.getElementById(this.CFG.Boxid) || this.CreateEl('div', this.CFG.Boxid);
		with(this.Box.style) {
			display = 'none'; position = 'fixed'; zIndex = this.CFG.zIndex + 1;
		}
		//初始化背景层
		this.Lay = document.getElementById(this.CFG.Layid) || this.CreateEl('div', this.CFG.Layid);
		with(this.Lay.style) {
			left = top = 0; width = height = '100%';
			display = 'none'; position = 'fixed'; zIndex = this.CFG.zIndex;
		}
		if(this.isIE6) {
			//修正显示层不支持fixed定位的问题
			this.Box.style.position = 'absolute';
			this._scroll = this.Bind(this, function() {
				with(this.Box.style) {
					left = (this.docEl.clientWidth - this.Box.clientWidth)/2 + this.docEl.scrollLeft + 'px';
					top = (this.docEl.clientHeight - this.Box.clientHeight)/2 + this.docEl.scrollTop + 'px';
				}
			});
			//修正背景层宽和高不支持100%的问题
			this.Lay.style.position = 'absolute';
			this._resize = this.Bind(this, function() {
				with(this.Lay.style) {
					width = Math.max(this.docEl.scrollWidth, this.docEl.clientWidth) + 'px';
					height = Math.max(this.docEl.scrollHeight, this.docEl.clientHeight) + 'px';
				}
			});
		}
	},
	Show: function(Content) {
		//显示层内容
		if(Content) this.Box.innerHTML = Content;
		//加载显示层
		with(this.Box.style) {
			display = 'block';
			left = (this.docEl.clientWidth - this.Box.clientWidth)/2 + 'px';
			top = (this.docEl.clientHeight - this.Box.clientHeight)/2 + 'px';
		}
		//加载背景层
		with(this.Lay.style) {
			display = 'block'; backgroundColor = this.CFG.bgColor;
			this.isIE ? filter = 'alpha(opacity:'+this.CFG.Opacity+')' : opacity = this.CFG.Opacity/100;
		}
		//修正IE6显示效果
		if(this.isIE6) {
			this._scroll(); window.attachEvent('onscroll', this._scroll);
			this._resize(); window.attachEvent('onresize', this._resize);
			//遮盖页面的select标签
			this.Lay.innerHTML = '<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;filter:alpha(opacity=0);"></iframe>';
		}
	},
	Close: function() {
		this.Box.style.display = 'none';
		this.Lay.style.display = 'none';
		if(this.isIE6) {
			window.detachEvent('onscroll', this._scroll);
			window.detachEvent('onresize', this._resize);
		}
	},
	//通用函数
	CreateEl: function(tag, id) {
		var el = document.createElement(tag);
		if(typeof id == 'string') el.id = id;
		var body = document.body || document.documentElement;
		body.insertBefore(el, body.firstChild);
		return el;
	},
	Extend: function(destination, source) {
		for(var property in source) {
			if(source[property]) destination[property] = source[property];
		}
		return destination;
	},
	Bind: function(object, func) {
		return function() { return func.apply(object, arguments); }
	},
	//简明定义
	isIE: document.all ? true : false,
	isIE6: document.all && [/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6,
	docEl: document.documentElement
};


/*!
 * 功能: DOM元素拖拽支持
 * 参数:
 *   o: 拖拽Handle[必选,type=object]
 *   oRoot: 被拖拽element[可选,type=object]
 */
DialogBox.prototype.Drag = function(obj, oRoot) {
	obj = document.getElementById(obj);
	obj.root = oRoot ? document.getElementById(oRoot) : obj;
	if(isNaN(parseInt(obj.root.style.left))) obj.root.style.left = "0px";
	if(isNaN(parseInt(obj.root.style.top))) obj.root.style.top = "0px";
	obj.onmousedown = function(e) {
		if(e === undefined) e = window.event;
		//得到被拖拽元素,即o
		DialogBox.DragObj = this;
		DialogBox.DragObj.lastMouseX = e.clientX;
		DialogBox.DragObj.lastMouseY = e.clientY;
		//比较关键的挂载
		document.onmousemove = function(e) {
			if(e === undefined) e = window.event;
			var ex = e.clientX, ey = e.clientY, obj = DialogBox.DragObj;
			var nx = parseInt(obj.root.style.left) + (ex - obj.lastMouseX);
			var ny = parseInt(obj.root.style.top) + (ey - obj.lastMouseY);
			DialogBox.DragObj.root.style.left = nx + "px";
			DialogBox.DragObj.root.style.top = ny + "px";
			DialogBox.DragObj.lastMouseX = ex;
			DialogBox.DragObj.lastMouseY = ey;
		};
		document.onmouseup = function() {
			document.onmousemove = null;
			document.onmouseup = null;
			DialogBox.DragObj = null;
		};
	};
};
