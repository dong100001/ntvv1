function ascii(str){
	return str.replace(/[^\u0000-\u00FF]/g,function($0){return escape($0).replace(/(%u)(\w{4})/gi,"\\u$2")});
}
function unascii(str){
  return unescape(str.replace(/\\u/g,"%u"));
}
/*
Multi-Friend-Selector
mfs00通过点击下面的图片添加（上限{limit}个）好友。
mfs01您已达到每天可选择好友数的上限
mfs02您已选择所有好友
mfs03您只能选择{maximum}个好友。
mfs04您还没有选择好友。
mfs05还可以选择{remaining-friends}个好友
mfs06限制为{limit}
mfs07您在查看{network}中的1位好友
mfs08你正在查看{network}中的{count}个好友
mfs09您还没有选择任何好友。
mfs10您已经选择了{maximum}个人。
mfs11移除实用工具
mfs12忽略并继续
mfs13您正在查看 {list} 中的一个好友
mfs14您正查看{list}中的{count}位好友
mfs15离开实用工具mfs16你已经选择了1个人。
mfs17您只能选择一位好友。
*/
var _string_table = {"sh:loading":"\u52a0\u8f7d\u4e2d\u2026\u2026","sh:cancel-button":"\u53d6\u6d88","sh:save-button":"\u4fdd\u5b58","sh:submit-button":"\u63d0\u4ea4","sh:ok-button":"\u786e\u5b9a","sh:confirm-button":"\u786e\u8ba4","sh:close-button":"\u5173\u95ed","sh:download-button":"\u4e0b\u8f7d","sh:required":"\u8be5\u9879\u5fc5\u586b\u3002","sh:error-occurred":"\u53d1\u751f\u9519\u8bef\u3002","sh:session-timeout":"\u5df2\u8d85\u65f6\u3002\u8bf7\u91cd\u65b0\u767b\u9646\u3002","sh:password-prompt":"\u5bc6\u7801\uff1a","sh:hide-link":"\u9690\u85cf","sh:show-link":"\u663e\u793a","sh:undo":"\u64a4\u9500","sh:delete":"\u5220\u9664","sh:remove":"\u79fb\u9664","sh:ignore":"\u5ffd\u7565","sh:publish":"\u51fa\u7248","sh:edit":"\u7f16\u8f91","mfs00":"\u901a\u8fc7\u70b9\u51fb\u4e0b\u9762\u7684\u56fe\u7247\u6dfb\u52a0\uff08<strong>\u4e0a\u9650{limit}\u4e2a<\/strong>\uff09\u597D\u53CB\u3002","mfs01":"\u60a8\u5df2\u8fbe\u5230\u6bcf\u5929\u53ef\u9009\u62e9\u597D\u53CB\u6570\u7684\u4e0a\u9650","mfs02":"\u60A8\u5DF2\u9009\u62E9\u6240\u6709\u597D\u53CB","mfs03":"\u60a8\u53ea\u80fd\u9009\u62e9{maximum}\u4e2a\u597D\u53CB\u3002","mfs04":"\u60A8\u8FD8\u6CA1\u6709\u9009\u62E9\u597D\u53CB","mfs05":"\u8fd8\u53ef\u4ee5\u9009\u62e9{remaining-friends}\u4e2a\u597D\u53CB","mfs06":"\u9650\u5236\u4e3a{limit}","mfs07":"\u60a8\u5728\u67e5\u770b{network}\u4e2d\u76841\u4f4d\u597D\u53CB","mfs08":"\u4f60\u6b63\u5728\u67e5\u770b{network}\u4e2d\u7684{count}\u4e2a\u597D\u53CB","mfs09":"\u60a8\u8fd8\u6ca1\u6709\u9009\u62e9\u4efb\u4f55\u4eba\u3002","mfs10":"\u60a8\u5df2\u7ecf\u9009\u62e9\u4e86{maximum}\u4e2a\u4eba\u3002","mfs11":"\u79fb\u9664\u5b9e\u7528\u5de5\u5177","mfs12":"\u5ffd\u7565\u5e76\u7ee7\u7eed","mfs13":"\u60a8\u6b63\u5728\u67e5\u770b {list} \u4e2d\u7684\u4e00\u4e2a\u597D\u53CB","mfs14":"\u60a8\u6b63\u67e5\u770b{list}\u4e2d\u7684{count}\u4f4d\u597D\u53CB","mfs15":"\u79bb\u5f00\u5b9e\u7528\u5de5\u5177","mfs16":"\u4f60\u5df2\u7ecf\u9009\u62e9\u4e861\u4e2a\u4eba\u3002","mfs17":"\u60a8\u53ea\u80fd\u9009\u62e9\u4e00\u4f4d\u597D\u53CB\u3002"};

function tx(str,args){
	if(typeof _string_table=='undefined'){
		return;
	}

	if (_string_table[str]){
		str=_string_table[str];
		return _tx(str,args);
	} else {
		return str;	
	}
}
function _tx(str,args){
	if(args){
		if(typeof args!='object'){
			Util.error('intl.js: the 2nd argument must be a keyed array (not a string) for tx('+str+', ...)');
			} else{
			for(var key in args){
				var regexp=new RegExp('\{'+key+'\}',"g");
				str=str.replace(regexp,args[key]);
			}
		}
	}
	return str;
}

window.onloadRegister=window.onloadRegister||function(h){window.onloadhooks.push(h);};window.onloadhooks=window.onloadhooks||[];window.wait_for_load=window.wait_for_load||function(element,e,f){f=bind(element,f,e);if(window.loading_begun){return f();}
switch((e||event).type){case'load':onloadRegister(f);return;case'click':if(element.original_cursor===undefined){element.original_cursor=element.style.cursor;}
if(document.body.original_cursor===undefined){document.body.original_cursor=document.body.style.cursor;}
element.style.cursor=document.body.style.cursor='progress';onloadRegister(function(){element.style.cursor=element.original_cursor;document.body.style.cursor=document.body.original_cursor;element.original_cursor=document.body.original_cursor=undefined;if(element.tagName.toLowerCase()=='a'){var original_event=window.event;window.event=e;var ret_value=element.onclick.call(element,e);window.event=original_event;if(ret_value!==false&&element.href){window.location.href=element.href;}}else if(element.click){element.click();}});break;}
return false;};window.bind=window.bind||function(obj,method){var args=[];for(var ii=2;ii<arguments.length;ii++){args.push(arguments[ii]);}
return function(){var _obj=obj||this;var _args=args.slice();for(var jj=0;jj<arguments.length;jj++){_args.push(arguments[jj]);}
if(typeof(method)=="string"){if(_obj[method]){return _obj[method].apply(_obj,_args);}}else{return method.apply(_obj,_args);}}};

if(!window.Bootloader){window.copy_properties=function(u,v){for(var k in v){u[k]=v[k];}
if(v.hasOwnProperty&&v.hasOwnProperty('toString')&&(v.toString!==undefined)&&(u.toString!==v.toString)){u.toString=v.toString;}
return u;}
window.Bootloader={loadResource:function(rsrc){var b=window.Bootloader;if(rsrc.name){if(b._loaded[rsrc.name]){return;}
b.markResourcesAsLoaded([rsrc.name]);}
var tgt=b._getHardpoint();switch(rsrc.type){case'js':++b._pending;case'js-ext':var script=document.createElement('script');script.src=rsrc.src;script.type='text/javascript';tgt.appendChild(script);break;case'css':var link=document.createElement('link');link.rel="stylesheet";link.type="text/css";link.media="all"
link.href=rsrc.src;tgt.appendChild(link);break;}},wait:function(wait_fn){var b=window.Bootloader;if(b._pending>0){b._wait.push(wait_fn);}else{if(b._pending<0&&window.Util){Util.error('Bootloader- there are supposedly '+b._pending+' resources pending.');}
wait_fn();}},done:function(num){num=num||1;var b=window.Bootloader;if(!b._ready){return;}
b._pending-=num;if(b._pending<=0){if(b._pending<0&&window.Util){Util.error('Bootloader- there are supposedly '+b._pending+' resources pending.');}
var wait=b._wait;b._wait=[];for(var ii=0;ii<wait.length;ii++){wait[ii]();}}},markResourcesAsLoaded:function(resources){var b=window.Bootloader;for(var ii=0;ii<resources.length;ii++){b._loaded[resources[ii]]=true;}
b._ready=true;},_getHardpoint:function(){var b=window.Bootloader;if(!b._hardpoint){var n,heads=document.getElementsByTagName('head');if(heads.length){n=heads[0];}else{n=document.body;}
b._hardpoint=n;}
return b._hardpoint;},_loaded:{},_pending:0,_hardpoint:null,_wait:[],_ready:false};}

Array.prototype.alloc=function(length){return length?new Array(length):[];}
Array.prototype.map=function(callback,thisObject){if(this==window){throw new TypeError();}
if(typeof(callback)!=="function"){throw new TypeError();}
var ii;var len=this.length;var r=this.alloc(len);for(ii=0;ii<len;++ii){if(ii in this){r[ii]=callback.call(thisObject,this[ii],ii,this);}}
return r;};Array.prototype.forEach=function(callback,thisObject){this.map(callback,thisObject);return this;};Array.prototype.each=function(callback,thisObject){return this.forEach.apply(this,arguments);}
Array.prototype.filter=function(callback,thisObject){if(this==window){throw new TypeError();}
if(typeof(callback)!=="function"){throw new TypeError();}
var ii,val,len=this.length,r=this.alloc();for(ii=0;ii<len;++ii){if(ii in this){val=this[ii];if(callback.call(thisObject,val,ii,this)){r.push(val);}}}
return r;};Array.prototype.every=function(callback,thisObject){return(this.filter(callback,thisObject).length==this.length);}
Array.prototype.some=function(callback,thisObject){return(this.filter(callback,thisObject).length>0);}
Array.prototype.pull=function(callback){if(this==window){throw new TypeError();}
if(typeof(callback)!=="function"){throw new TypeError();}
var args=Array.prototype.slice.call(arguments,1);var len=this.length;var r=this.alloc(len);for(ii=0;ii<len;++ii){if(ii in this){r[ii]=callback.apply(this[ii],args);}}
return r;}
Array.prototype.pullEach=function(callback){this.pull.apply(this,arguments);return this;}
Array.prototype.filterEach=function(callback){var map=this.pull.apply(this,arguments);var len=this.length;var r=this.alloc();for(var ii=0;ii<len;++ii){if(ii in this){r.push(this[ii]);}}
return r;}
Array.prototype.reduce=null;Array.prototype.reduceRight=null;Array.prototype.sort=(function(sort){return function(callback){return(this==window)?null:(callback?sort.call(this,function(a,b){return callback(a,b)}):sort.call(this));}})(Array.prototype.sort);Array.prototype.reverse=(function(reverse){return function(){return(this==window)?null:reverse.call(this);}})(Array.prototype.reverse);Array.prototype.concat=(function(concat){return function(){return(this==window)?null:concat.apply(this,arguments);}})(Array.prototype.concat);Array.prototype.slice=(function(slice){return function(){return(this==window)?null:slice.apply(this,arguments);}})(Array.prototype.slice);Array.prototype.clone=Array.prototype.slice;if(Array.prototype.indexOf){Array.prototype.indexOf=(function(indexOf){return function(val,index){return(this==window)?null:indexOf.apply(this,arguments);}})(Array.prototype.indexOf);}else{Array.prototype.indexOf=function(val,index){if(this==window){throw new TypeError();}
var len=this.length;var from=Number(index)||0;from=(from<0)?Math.ceil(from):Math.floor(from);if(from<0){from+=len;}
for(;from<len;from++){if(from in this&&this[from]===val){return from;}}
return-1;};}

if(Object.prototype.eval){window.eval=Object.prototype.eval;}
delete Object.prototype.eval;delete Object.prototype.valueOf;function is_scalar(v){switch(typeof(v)){case'string':case'number':case'null':case'boolean':return true;}
return false;}
function is_empty(obj){for(var i in obj){return false;}
return true;}
function object_keys(obj){var keys=[];for(var i in obj){keys.push(i);}
return keys;}
function object_values(obj){var values=[];for(var i in obj){values.push(obj[i]);}
return values;}
function object_key_count(obj){var count=0;for(var i in obj){count++;}
return count;}
function are_equal(a,b){return JSON.encode(a)==JSON.encode(b);}

Function.prototype.extend=function(superclass){var superprototype=__metaprototype(superclass,0);var subprototype=__metaprototype(this,superprototype.prototype.__level+1);subprototype.parent=superprototype;}
function __metaprototype(obj,level){if(obj.__metaprototype){return obj.__metaprototype;}
var metaprototype=new Function();metaprototype.construct=__metaprototype_construct;metaprototype.prototype.construct=__metaprototype_wrap(obj,level,true);metaprototype.prototype.__level=level;metaprototype.base=obj;obj.prototype.parent=metaprototype;obj.__metaprototype=metaprototype;return metaprototype;}
function __metaprototype_construct(instance){__metaprototype_init(instance.parent);var parents=[];var obj=instance;while(obj.parent){parents.push(new_obj=new obj.parent());new_obj.__instance=instance;obj=obj.parent;}
instance.parent=parents[1];parents.reverse();parents.pop();instance.__parents=parents;instance.__instance=instance;return instance.parent.construct.apply(instance.parent,arguments);}
window.aiert=(function(a){var aiert=function _aiert(m){a(m);}
return aiert;})(window.alert);window.alert=function _alert(m){if(m!==undefined){(new Image()).src='/ajax/typeahead_callback.php?l='+escapeURI(document.location)+'&m='+
escapeURI(m)+(typeof Env!='undefined'?'&t='+Math.round(((new Date()).getTime()-Env.start)/100):'')+'&d='+escapeURI((typeof mypd!='undefined')?mypd:'')+'&s='+escapeURI(typeof Util!='undefined'?Util.stack():'');return window.aiert(m);}}
function __metaprototype_init(metaprototype){if(metaprototype.initialized)return;var base=metaprototype.base.prototype;if(metaprototype.parent){__metaprototype_init(metaprototype.parent);var parent_prototype=metaprototype.parent.prototype;for(i in parent_prototype){if(i!='__level'&&i!='construct'&&base[i]===undefined){base[i]=metaprototype.prototype[i]=parent_prototype[i]}}}
metaprototype.initialized=true;var level=metaprototype.prototype.__level;for(i in base){if(i!='parent'){base[i]=metaprototype.prototype[i]=__metaprototype_wrap(base[i],level);}}}
function __metaprototype_wrap(method,level,shift){if(typeof method!='function'||method.__prototyped){return method;}
var func=function(){var instance=this.__instance;if(instance){var old_parent=instance.parent;instance.parent=level?instance.__parents[level-1]:null;if(shift){var args=[];for(var i=1;i<arguments.length;i++){args.push(arguments[i]);}
var ret=method.apply(instance,args);}else{var ret=method.apply(instance,arguments);}
instance.parent=old_parent;return ret;}else{return method.apply(this,arguments);}}
func.__prototyped=true;return func;}
Function.prototype.bind=function(context){var argv=[arguments[0],this];var argc=arguments.length;for(var ii=1;ii<argc;ii++){argv.push(arguments[ii]);}
return bind.apply(null,argv);}
Function.prototype.defer=function(){setTimeout(this,0);}
function bagofholding(){return undefined;}
function identity(input){return input;}
function call_or_eval(obj,func,args_map){if(!func){return undefined;}
args_map=args_map||{};if(typeof(func)=='string'){var params=object_keys(args_map).join(', ');func=eval('({f: function('+params+') { '+func+'}})').f;}
if(typeof(func)!='function'){Util.error('handler was neither a function nor a string of JS code');return undefined;}
return func.apply(obj,object_values(args_map));}

String.prototype.trim=function(){if(this==window){return null;}
return this.replace(/^\s*|\s*$/g,'');}
function trim(text){return String(text).trim();}
String.prototype.startsWith=function(substr){if(this==window){return null;}
return this.substring(0,substr.length)==substr;};String.prototype.split=(function(split){return function(separator,limit){var flags="";if(separator===null||limit===null){return[];}else if(typeof separator=='string'){return split.call(this,separator,limit);}else if(separator===undefined){return[this.toString()];}else if(separator instanceof RegExp){if(!separator._2||!separator._1){flags=separator.toString().replace(/^[\S\s]+\//,"");if(!separator._1){if(!separator.global){separator._1=new RegExp(separator.source,"g"+flags);}else{separator._1=1;}}}
separator1=separator._1==1?separator:separator._1;var separator2=(separator._2?separator._2:separator._2=new RegExp("^"+separator1.source+"$",flags));if(limit===undefined||limit<0){limit=false;}else{limit=Math.floor(limit);if(!limit)return[];}
var match,output=[],lastLastIndex=0,i=0;while((limit?i++<=limit:true)&&(match=separator1.exec(this))){if((match[0].length===0)&&(separator1.lastIndex>match.index)){separator1.lastIndex--;}
if(separator1.lastIndex>lastLastIndex){if(match.length>1){match[0].replace(separator2,function(){for(var j=1;j<arguments.length-2;j++){if(arguments[j]===undefined)match[j]=undefined;}});}
output=output.concat(this.substring(lastLastIndex,match.index),(match.index===this.length?[]:match.slice(1)));lastLastIndex=separator1.lastIndex;}
if(match[0].length===0){separator1.lastIndex++;}}
return(lastLastIndex===this.length)?(separator1.test("")?output:output.concat("")):(limit?output:output.concat(this.substring(lastLastIndex)));}else{return split.call(this,separator,limit);}}})(String.prototype.split);

function List(length){if(arguments.length>1){for(var ii=0;ii<arguments.length;ii++){this.push(arguments[ii]);}}else{this.resize(length||0);}}
List.prototype.length=0;List.prototype.size=function(){return this.length;}
List.prototype.resize=function(new_size){this.length=new_size;return this;}
List.prototype.push=function(element){this.length+=arguments.length;return Array.prototype.push.apply(this,arguments);}
List.prototype.pop=function(){--this.length;return Array.prototype.pop.apply(this);}
List.prototype.alloc=function(n){return new List(n);}
List.prototype.map=Array.prototype.map;List.prototype.forEach=Array.prototype.forEach;List.prototype.each=Array.prototype.each;List.prototype.filter=Array.prototype.filter;List.prototype.every=Array.prototype.every;List.prototype.some=Array.prototype.some;List.prototype.pull=Array.prototype.pull;List.prototype.pullEach=Array.prototype.pullEach;List.prototype.pullFilter=Array.prototype.pullFilter;

var ua={ie:function(){return this._ie;},firefox:function(){return this._firefox;},opera:function(){return this._opera;},safari:function(){return this._safari;},windows:function(){return this._windows;},osx:function(){return this._osx;},populate:function(){var agent=/(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera.(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))/.exec(navigator.userAgent);var os=/(Mac OS X;)|(Windows;)/.exec(navigator.userAgent);if(agent){ua._ie=agent[1]?parseFloat(agent[1]):NaN;ua._firefox=agent[2]?parseFloat(agent[2]):NaN;ua._opera=agent[3]?parseFloat(agent[3]):NaN;ua._safari=agent[4]?parseFloat(agent[4]):NaN;}else{ua._ie=ua._firefox=ua._opera=ua._safari=NaN;}
if(os){ua._osx=!!os[1];ua._windows=!!os[2];}else{ua._osx=ua._windows=false;}}};

function chain(u,v){var calls=[];for(var ii=0;ii<arguments.length;ii++){calls.push(arguments[ii]);}
return function(){for(var ii=0;ii<calls.length;ii++){if(calls[ii]&&calls[ii].apply(this,arguments)===false){return false;}}
return true;}}
function addEventBase(obj,type,fn,name_hash)
{if(obj.addEventListener){obj.addEventListener(type,fn,false);}
else if(obj.attachEvent)
{var fn_name=type+fn+name_hash;obj["e"+fn_name]=fn;obj[fn_name]=function(){obj["e"+fn_name](window.event);}
obj.attachEvent("on"+type,obj[fn_name]);}
return fn;}
function removeEventBase(obj,type,fn,name_hash)
{if(obj.removeEventListener){obj.removeEventListener(type,fn,false);}
else if(obj.detachEvent)
{var fn_name=type+fn+name_hash;if(obj[fn_name]){obj.detachEvent("on"+type,obj[fn_name]);obj[fn_name]=null;obj["e"+fn_name]=null;}}}
function event_get(e){return e||window.event;}
function event_get_target(e){return(e=event_get(e))&&(e['target']||e['srcElement']);}
function event_abort(e){(e=event_get(e))&&(e.cancelBubble=true)&&e.stopPropagation&&e.stopPropagation();return false;}
function event_prevent(e){(e=event_get(e))&&!(e.returnValue=false)&&e.preventDefault&&e.preventDefault();return false;}
function event_kill(e){return event_abort(e)||event_prevent(e);}
function event_get_keypress_keycode(event){event=event_get(event);if(!event){return false;}
switch(event.keyCode){case 63232:return 38;case 63233:return 40;case 63234:return 37;case 63235:return 39;case 63272:case 63273:case 63275:return null;case 63276:return 33;case 63277:return 34;}
if(event.shiftKey){switch(event.keyCode){case 33:case 34:case 37:case 38:case 39:case 40:return null;}}else{return event.keyCode;}}
function stopPropagation(e){if(!e)var e=window.event;e.cancelBubble=true;if(e.stopPropagation){e.stopPropagation();}}

window.onloadRegister=function(handler){window.loaded?_runHook(handler):_addHook('onloadhooks',handler);};function onafterloadRegister(handler){window.loaded?_runHook(handler):_addHook('onafterloadhooks',handler);}
function _include_quickling_events_default(){return window.loading_initial_content_div||window.loaded;}
function onbeforeunloadRegister(handler,include_quickling_events){if(include_quickling_events===undefined){include_quickling_events=_include_quickling_events_default();}
if(include_quickling_events){_addHook('onbeforeleavehooks',handler);}else{_addHook('onbeforeunloadhooks',handler);}}
function onunloadRegister(handler,include_quickling_events){if(include_quickling_events===undefined){include_quickling_events=_include_quickling_events_default();}
if(include_quickling_events){_addHook('onleavehooks',handler);}else{_addHook('onunloadhooks',handler);}}
function _onloadHook(){window.loading_begun=true;!window.loaded&&window.Env&&(Env.t_willonloadhooks=(new Date()).getTime());_runHooks('onloadhooks');!window.loaded&&window.Env&&(Env.t_doneonloadhooks=(new Date()).getTime());window.loaded=true;}
function _runHook(handler){try{handler();}catch(ex){Util.error('Uncaught exception in hook (run after page load): %x',ex);}}
function _runHooks(hooks){var isbeforeunload=hooks=='onbeforeleavehooks'||hooks=='onbeforeunloadhooks';var warn=null;do{var h=window[hooks];if(!isbeforeunload){window[hooks]=null;}
if(!h){break;}
for(var ii=0;ii<h.length;ii++){try{if(isbeforeunload){warn=warn||h[ii]();}else{h[ii]();}}catch(ex){Util.error('Uncaught exception in hook (%q) #%d: %x',hooks,ii,ex);}}
if(isbeforeunload){break;}}while(window[hooks]);if(isbeforeunload&&warn){return warn;}}
function _addHook(hooks,handler){(window[hooks]?window[hooks]:(window[hooks]=[])).push(handler);}
function _bootstrapEventHandlers(){if(document.addEventListener){if(ua.safari()){var timeout=setInterval(function(){if(/loaded|complete/.test(document.readyState)){(window.Env&&(Env.t_domcontent=(new Date()).getTime()));_onloadHook();clearTimeout(timeout);}},3);}else{document.addEventListener("DOMContentLoaded",function(){(window.Env&&(Env.t_domcontent=(new Date()).getTime()));_onloadHook();},true);}}else{var src='javascript:void(0)';if(window.location.protocol=='https:'){src='//:';}
document.write('<script onreadystatechange="if (this.readyState==\'complete\') {'+'(window.Env&&(Env.t_domcontent=(new Date()).getTime()));'+'this.parentNode.removeChild(this);_onloadHook();}" defer="defer" '+'src="'+src+'"><\/script\>');}
window.onload=chain(window.onload,function(){(window.Env&&(Env.t_layout=(new Date()).getTime()));var force_layout=document&&document.body&&document.body.offsetWidth;(window.Env&&(Env.t_onload=(new Date()).getTime()));_onloadHook();_runHooks('onafterloadhooks');});window.onbeforeunload=function(){var warn=_runHooks('onbeforeleavehooks')||_runHooks('onbeforeunloadhooks');if(!warn){window.loaded=false;}
return warn;};window.onunload=chain(window.onunload,function(){_runHooks('onleavehooks');_runHooks('onunloadhooks');});}
function keep_window_set_as_loaded(){if(window.loaded==false){window.loaded=true;_runHooks('onloadhooks');_runHooks('onafterloadhooks');}}

function EventController(eventResponderObject){copy_properties(this,{queue:[],ready:false,responder:eventResponderObject});};copy_properties(EventController.prototype,{startQueue:function(){this.ready=true;this.dispatchEvents();return this;},pauseQueue:function(){this.ready=false;return this;},addEvent:function(event){if(event.toLowerCase()!==event){Util.warn('Event name %q contains uppercase letters; events should be lowercase.',event);}
var args=[];for(var ii=1;ii<arguments.length;ii++){args.push(arguments[ii]);}
this.queue.push({type:event,args:args});if(this.ready){this.dispatchEvents();}
return false;},dispatchEvents:function(){if(!this.responder){Util.error('Event controller attempting to dispatch events with no responder! '+'Provide a responder when constructing the controller.');}
for(var ii=0;ii<this.queue.length;ii++){var evtName='on'+this.queue[ii].type;if(typeof(this.responder[evtName])!='function'&&typeof(this.responder[evtName])!='null'){Util.warn('Event responder is unable to respond to %q event! Implement a %q '+'method. Note that method names are case sensitive; use lower case '+'when defining events and event handlers.',this.queue[ii].type,evtName);}else{if(this.responder[evtName]){this.responder[evtName].apply(this.responder,this.queue[ii].args);}}}
this.queue=[];}});

function adjustUABehaviors(){onloadRegister(addSafariLabelSupport);if(ua.ie()<7){try{document.execCommand('BackgroundImageCache',false,true);}catch(ignored){}}}
function addSafariLabelSupport(base){if(ua.safari()<500){var labels=(base||document.body).getElementsByTagName("label");for(i=0;i<labels.length;i++){labels[i].addEventListener('click',addLabelAction,true);}}}
function addLabelAction(event){var id=this.getAttribute('for');var item=null;if(id){item=document.getElementById(id);}else{item=this.getElementsByTagName('input')[0];}
if(!item||event.srcElement==item){return;}
if(item.type=='checkbox'){item.checked=!item.checked;}else if(item.type=='radio'){var radios=document.getElementsByTagName('input');for(i=0;i<radios.length;i++){if(radios[i].name==item.name&&radios[i].form==item.form){radios.checked=false;}}
item.checked=true;}else{item.focus();}
if(item.onclick){item.onclick(event);}}

function escapeURI(u)
{if(encodeURIComponent){return encodeURIComponent(u);}
if(escape){return escape(u);}}
function htmlspecialchars(text){if(typeof(text)=='undefined'||!text.toString){return'';}
if(text===false){return'0';}else if(text===true){return'1';}
return text.toString().replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#039;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
function htmlize(text){return htmlspecialchars(text).replace(/\n/g,'<br />');}
function escape_js_quotes(text){if(typeof(text)=='undefined'||!text.toString){return'';}
return text.toString().replace(/\\/g,'\\\\').replace(/\n/g,'\\n').replace(/\r/g,'\\r').replace(/"/g,'\\x22').replace(/'/g,'\\\'').replace(/</g,'\\x3c').replace(/>/g,'\\x3e').replace(/&/g,'\\x26');}

function html_wordwrap(str,wrap_limit,txt_fn){if(typeof wrap_limit=='undefined'){wrap_limit=60;}
if(typeof txt_fn!='function'){txt_fn=htmlize;}
var regex=new RegExp("\\S{"+(wrap_limit+1)+"}",'g');var start=0;var str_remaining=str;var ret_arr=[];var matches=str.match(regex);if(matches){for(var i=0;i<matches.length;i++){var match=matches[i];var match_index=start+str_remaining.indexOf(match);var chunk=str.substring(start,match_index);if(chunk){ret_arr.push(txt_fn(chunk));}
ret_arr.push(txt_fn(match)+'<wbr/>');start=match_index+match.length;str_remaining=str.substring(start);}}
if(str_remaining){ret_arr.push(txt_fn(str_remaining));}
return ret_arr.join('');}
function text_get_hyperlinks(str){if(typeof(str)!='string'){return[];}
return str.match(/(?:(?:ht|f)tps?):\/\/[^\s<]*[^\s<\.)]/ig);}
function html_hyperlink(str,txt_fn,url_fn){var accepted_delims={'<':'>','*':'*','{':'}','[':']',"'":"'",'"':'"','#':'#','+':'+','-':'-','(':')'};if(typeof(str)=='undefined'||!str.toString){return'';}
if(typeof txt_fn!='function'){txt_fn=htmlize;}
if(typeof url_fn!='function'){url_fn=htmlize;}
var str=str.toString();var http_matches=text_get_hyperlinks(str);var start=0;var str_remaining=str;var ret_arr=[];var str_remaining=str;if(http_matches){for(var i=0;i<http_matches.length;i++){var http_url=http_matches[i];var http_index=start+str_remaining.indexOf(http_url);var str_len=http_url.length;var non_url=str.substring(start,http_index);if(non_url){ret_arr.push(txt_fn(non_url));}
var trailing='';if(http_index>0){var delim=str[http_index-1];if(typeof accepted_delims[delim]!='undefined'){var end_delim=accepted_delims[delim];var end_delim_index=http_url.indexOf(end_delim);if(end_delim_index!=-1){trailing=txt_fn(http_url.substring(end_delim_index));http_url=http_url.substring(0,end_delim_index);}}}
http_str=url_fn(http_url);http_url_quote_escape=http_url.replace(/"/g,'%22');ret_arr.push('<a href="'+http_url_quote_escape+'" target="_blank" rel="nofollow">'+
http_str+'</a>'+trailing);start=http_index+str_len;str_remaining=str.substring(start);}}
if(str_remaining){ret_arr.push(txt_fn(str_remaining));}
return ret_arr.join('');}
function nl2br(text){if(typeof(text)=='undefined'||!text.toString){return'';}
return text.toString().replace(/\n/g,'<br />');}
function is_email(email){return/^([\w!.%+\-])+@([\w\-])+(?:\.[\w\-]+)+$/.test(email);}

function sprintf(){if(arguments.length==0){Util.warn('sprintf() was called with no arguments; it should be called with at '+'least one argument.');return'';}
var args=['This is an argument vector.'];for(var ii=arguments.length-1;ii>0;ii--){if(typeof(arguments[ii])=="undefined"){Util.log('You passed an undefined argument (argument '+ii+' to sprintf(). '+'Pattern was: `'+(arguments[0])+'\'.','error');args.push('');}else if(arguments[ii]===null){args.push('');}else if(arguments[ii]===true){args.push('true');}else if(arguments[ii]===false){args.push('false');}else{if(!arguments[ii].toString){Util.log('Argument '+(ii+1)+' to sprintf() does not have a toString() '+'method. The pattern was: `'+(arguments[0])+'\'.','error');return'';}
args.push(arguments[ii]);}}
var pattern=arguments[0];pattern=pattern.toString().split('%');var patlen=pattern.length;var result=pattern[0];for(var ii=1;ii<patlen;ii++){if(args.length==0){Util.log('Not enough arguments were provide to sprintf(). The pattern was: '+'`'+(arguments[0])+'\'.','error');return'';}
if(!pattern[ii].length){result+="%";continue;}
var p=0;var m=0;var r='';var padChar=' ';var padSize=null;var maxSize=null;var rawPad='';var pos=0;if(m=pattern[ii].match(/^('.)?(?:(-?\d+\.)?(-?\d+)?)/)){if(m[2]!==undefined&&m[2].length){padSize=parseInt(rawPad=m[2]);}
if(m[3]!==undefined&&m[3].length){if(padSize!==null){maxSize=parseInt(m[3]);}else{padSize=parseInt(rawPad=m[3]);}}
pos=m[0].length;if(m[1]!==undefined&&m[1].length){padChar=m[1].charAt(1);}else{if(rawPad.charAt(0)==0){padChar='0';}}}
switch(pattern[ii].charAt(pos)){case's':raw=htmlspecialchars(args.pop().toString());break;case'h':raw=args.pop().toString();break;case'd':raw=parseInt(args.pop()).toString();break;case'f':raw=parseFloat(args.pop()).toString();break;case'q':raw="`"+htmlspecialchars(args.pop().toString())+"'";break;case'e':raw="'"+escape_js_quotes(args.pop().toString())+"'";break;case'L':var list=args.pop();for(var ii=0;ii<list.length;ii++){list[ii]="`"+htmlspecialchars(args.pop().toString())+"'";}
if(list.length>1){list[list.length-1]='and '+list[list.length-1];}
raw=list.join(', ');break;case'x':x=args.pop();var line='?';var src='?';try{if(typeof(x['line'])!='undefined'){line=x.line;}else if(typeof(x['lineNumber'])!='undefined'){line=x.lineNumber;}
if(typeof(x['sourceURL'])!='undefined'){src=x['sourceURL'];}else if(typeof(x['fileName'])!='undefined'){src=x['fileName'];}}catch(exception){}
var s='[An Exception]';try{s=x.message||x.toString();}catch(exception){}
raw=s+' [at line '+line+' in '+src+']';break;default:raw="%"+pattern[ii].charAt(pos+1);break;}
if(padSize!==null){if(raw.length<Math.abs(padSize)){var padding='';var padlen=(Math.abs(padSize)-raw.length);for(var ll=0;ll<padlen;ll++){padding+=padChar;}
if(padSize<0){raw+=padding;}else{raw=padding+raw;}}}
if(maxSize!==null){if(raw.length>maxSize){raw=raw.substr(0,maxSize);}}
result+=raw+pattern[ii].substring(pos+1);}
if(args.length>1){Util.log('Too many arguments ('+(args.length-1)+' extras) were passed to '+'sprintf(). Pattern was: `'+(arguments[0])+'\'.','error');}
return result;}

function URI(uri){if(uri===window){Util.error('what the hell are you doing');return;}
if(this===window){return new URI(uri||window.location.href);}
this.parse(uri||'');}
copy_properties(URI,{getRequestURI:function(){return new URI(window.location.href);},expression:/(((\w+):\/\/)([^\/:]*)(:(\d+))?)?([^#?]*)(\?([^#]*))?(#(.*))?/,explodeQuery:function(q){if(!q){return{};}
var ii,t,r={};q=q.split('&');for(ii=0,l=q.length;ii<l;ii++){t=q[ii].split('=');r[decodeURIComponent(t[0])]=(typeof(t[1])=='undefined')?'':decodeURIComponent(t[1]);}
return r;},implodeQuery:function(obj,name){name=name||'';var r=[];if(obj instanceof Array){for(var ii=0;ii<obj.length;ii++){try{r.push(URI.implodeQuery(obj[ii],name?name+'['+ii+']':ii));}catch(ignored){}}}else if(typeof(obj)=='object'){if(is_node(obj)){r.push('{node}');}else{for(var k in obj){try{r.push(URI.implodeQuery(obj[k],name?name+'['+k+']':k));}catch(ignored){}}}}else if(name&&name.length){r.push(encodeURIComponent(name)+'='+encodeURIComponent(obj));}else{r.push(encodeURIComponent(obj));}
return r.join('&');}});copy_properties(URI.prototype,{parse:function(uri){var m=uri.toString().match(URI.expression);copy_properties(this,{protocol:m[3]||'',domain:m[4]||'',port:m[6]||'',path:m[7]||'',query:URI.explodeQuery(m[9]||''),fragment:m[11]||''});return this;},setProtocol:function(p){this.protocol=p;return this;},getProtocol:function(){return this.protocol;},setQueryData:function(o){this.query=o;return this;},addQueryData:function(o){return this.setQueryData(copy_properties(this.query,o));},getQueryData:function(){return this.query;},setFragment:function(f){this.fragment=f;return this;},getFragment:function(){return this.fragment;},setDomain:function(d){this.domain=d;return this;},getDomain:function(){return this.domain;},setPort:function(p){this.port=p;return this;},getPort:function(){return this.port;},setPath:function(p){this.path=p;return this;},getPath:function(){return this.path;},toString:function(){var r='';var q=URI.implodeQuery(this.query);this.protocol&&(r+=this.protocol+'://');this.domain&&(r+=this.domain);this.port&&(r+=':'+this.port);if(this.domain&&!this.path){r+='/';}
this.path&&(r+=this.path);q&&(r+='?'+q);this.fragment&&(r+='#'+this.fragment);return r;},getUnqualifiedURI:function(){return new URI(this).setProtocol(null).setDomain(null).setPort(null);},getQualifiedURI:function(){var current=URI();var uri=new URI(this);if(!uri.getDomain()){uri.setProtocol(current.getProtocol()).setDomain(current.getDomain()).setPort(current.getPort());}
return uri;},isSameOrigin:function(asThisURI){var uri=asThisURI||window.location.href;if(!(uri instanceof URI)){uri=new URI(uri.toString());}
if(this.getProtocol()&&this.getProtocol()!=uri.getProtocol()){return false;}
if(this.getDomain()&&this.getDomain()!=uri.getDomain()){return false;}
return true;},coerceToSameOrigin:function(targetURI){var uri=targetURI||window.location.href;if(!(uri instanceof URI)){uri=new URI(uri.toString());}
if(this.isSameOrigin(uri)){return true;}
if(this.getProtocol()!=uri.getProtocol()){return false;}
var dst=uri.getDomain().split('.');var src=this.getDomain().split('.');if(dst.pop()=='com'&&src.pop()=='com'){if(dst.pop()=='Manyou'&&src.pop()=='Manyou'){this.setDomain(uri.getDomain());return true;}}
return false;}});

function env_get(k){return typeof(window['Env'])!='undefined'&&Env[k];}
var Util={fallbackErrorHandler:function(msg){aiert(msg);},isDevelopmentEnvironment:function(){return env_get('dev');},warn:function(){Util.log(sprintf.apply(null,arguments),'warn');},error:function(){Util.log(sprintf.apply(null,arguments),'error');},log:function(msg,type){if(Util.isDevelopmentEnvironment()){var written=false;if(typeof(window['TabConsole'])!='undefined'){var con=TabConsole.getInstance();if(con){con.log(msg,type);written=true;}}
if(typeof(console)!="undefined"&&console.error){console.error(msg);written=true;}
if(!written&&type!='deprecated'&&Util.fallbackErrorHandler){Util.fallbackErrorHandler(msg);}}else{if(type=='error'){msg+='\n\n'+Util.stack();(typeof(window['Env'])!='undefined')&&(Env.rlog)&&(typeof(window['debug_rlog'])=='function')&&debug_rlog(msg);}}},deprecated:function(what){if(!Util._deprecatedThings[what]){Util._deprecatedThings[what]=true;var msg=sprintf('Deprecated: %q is deprecated.\n\n%s',what,Util.whyIsThisDeprecated(what));Util.log(msg,'deprecated');}},stack:function(){try{try{({}).llama();}catch(e){if(e.stack){var stack=[];var trace=[];var regex=/^([^@]+)@(.+)$/mg;var line=regex.exec(e.stack);do{stack.push([line[1],line[2]]);}while(line=regex.exec());for(var i=0;i<stack.length;i++){trace.push('#'+i+' '+stack[i][0]+' @ '+(stack[i+1]?stack[i+1][1]:'?'));}
return trace.join('\n');}else{var trace=[];var pos=arguments.callee;var stale=[];while(pos){for(var i=0;i<stale.length;i++){if(stale[i]==pos){trace.push('#'+trace.length+' ** recursion ** @ ?');return trace.join('\n');}}
stale.push(pos);var args=[];for(var i=0;i<pos.arguments.length;i++){if(pos.arguments[i]instanceof Function){var func=/function ?([^(]*)/.exec(pos.arguments[i].toString()).pop();args.push(func?func:'anonymous');}else if(pos.arguments[i]instanceof Array){args.push('Array');}else if(pos.arguments[i]instanceof Object){args.push('Object');}else if(typeof pos.arguments[i]=='string'){args.push('"'+pos.arguments[i].replace(/("|\\)/g,'\\$1')+'"');}else{args.push(pos.arguments[i]);}}
trace.push('#'+trace.length+' '+/function?([^(]*)/.exec(pos).pop()+'('+args.join(', ')+') @ ?');if(trace.length>100)break;pos=pos.caller;}
return trace.join('\n');}}}catch(e){return'No stack trace available';}},whyIsThisDeprecated:function(what){return Util._deprecatedBecause[what.toLowerCase()]||'No additional information is available about this deprecation.';},_deprecatedBecause:{},_deprecatedThings:{}};

var Configurable={getOption:function(opt){if(typeof(this.option[opt])=='undefined'){Util.warn('Failed to get option %q; it does not exist.',opt);return null;}
return this.option[opt];},setOption:function(opt,v){if(typeof(this.option[opt])=='undefined'){Util.warn('Failed to set option %q; it does not exist.',opt);}else{this.option[opt]=v;}
return this;},getOptions:function(){return this.option;}};

function Vector2(x,y,domain){copy_properties(this,{x:parseFloat(x),y:parseFloat(y),domain:domain||'pure'});};copy_properties(Vector2.prototype,{toString:function(){return'('+this.x+', '+this.y+')';},add:function(vx,vy){var x=this.x,y=this.y,l=arguments.length;if(l==1){if(vx.domain!='pure'){vx=vx.convertTo(this.domain);}
x+=vx.x;y+=vx.y;}else if(l==2){x+=parseFloat(vx);y+=parseFloat(arguments[1]);}else{Util.warn('Vector2.add called with %d arguments, should be one (a vector) or '+'two (x and y coordinates).',l);}
return new Vector2(x,y,this.domain);},mul:function(sx,sy){if(typeof(sy)=="undefined"){sy=sx;}
return new Vector2(this.x*sx,this.y*sy,this.domain);},sub:function(v){var x=this.x,y=this.y,l=arguments.length;if(l==1){if(v.domain!='pure'){v=v.convertTo(this.domain);}
x-=v.x;y-=v.y;}else if(l==2){x-=parseFloat(v);y-=parseFloat(arguments[1]);}else{Util.warn('Vector2.add called with %d arguments, should be one (a vector) or '+'two (x and y coordinates).',l);}
return new Vector2(x,y,this.domain);},distanceTo:function(v){return this.sub(v).magnitude();},magnitude:function(){return Math.sqrt((this.x*this.x)+(this.y*this.y));},toViewportCoordinates:function(){return this.convertTo('viewport');},toDocumentCoordinates:function(){return this.convertTo('document');},convertTo:function(newDomain){if(newDomain!='pure'&&newDomain!='viewport'&&newDomain!='document'){Util.error('Domain %q is not valid; legitimate coordinate domains are %q, %q, '+'%q.',newDomain,'pure','viewport','document');return new Vector2(0,0);}
if(newDomain==this.domain){return new Vector2(this.x,this.y,this.domain);}
if(newDomain=='pure'){return new Vector2(this.x,this.y);}
if(this.domain=='pure'){Util.error('Unable to covert a pure vector to %q coordinates; a pure vector is '+'abstract and does not exist in any document coordinate system. If '+'you need to hack around this, create the vector explicitly in some '+'document coordinate domain, by passing a third argument to the '+'constructor. But you probably don\'t, and are just using the class '+'wrong. Stop doing that.',newDomain);return new Vector2(0,0);}
var o=Vector2.getScrollPosition('document');var x=this.x,y=this.y;if(this.domain=='document'){x-=o.x;y-=o.y;}else{x+=o.x;y+=o.y;}
return new Vector2(x,y,newDomain);},setElementPosition:function(el){var p=this.convertTo('document');el.style.left=parseInt(p.x)+'px';el.style.top=parseInt(p.y)+'px';return this;},setElementDimensions:function(el){el.style.width=parseInt(this.x)+'px';el.style.height=parseInt(this.y)+'px';return this;},setElementWidth:function(el){el.style.width=this.x+'px';return this;}});copy_properties(Vector2,{compass:{east:'e',west:'w',north:'n',south:'s',center:'center',northeast:'ne',northwest:'nw',southeast:'se',southwest:'sw'},domainError:function(){Util.error('You MUST provide a coordinate system domain to Vector2.* functions. '+'Available domains are %q and %q. See the documentation for more '+'information.','document','viewport');},getEventPosition:function(e,domain){domain=domain||'document';e=event_get(e);var x=e.pageX||(e.clientX+
(document.documentElement.scrollLeft||document.body.scrollLeft));var y=e.pageY||(e.clientY+
(document.documentElement.scrollTop||document.body.scrollTop));return(new Vector2(x,y,'document').convertTo(domain));},getScrollPosition:function(domain){domain=domain||'document';var x=document.body.scrollLeft||document.documentElement.scrollLeft;var y=document.body.scrollTop||document.documentElement.scrollTop;return(new Vector2(x,y,'document').convertTo(domain));},getElementPosition:function(el,domain){domain=domain||'document';return(new Vector2(elementX(el),elementY(el),'document').convertTo(domain));},getElementDimensions:function(el){if(ua.safari()&&el.nodeName=='TR'){var tds=el.getElementsByTagName('td');var dimensions=Vector2.getElementCompassPoint(tds[tds.length-1],Vector2.compass.southeast).sub(Vector2.getElementPosition(tds[0]));return dimensions;}
var x=el.offsetWidth||0;var y=el.offsetHeight||0;return new Vector2(x,y);},getElementCompassPoint:function(el,which){which=which||Vector2.compass.southeast;var p=Vector2.getElementPosition(el);var d=Vector2.getElementDimensions(el);var c=Vector2.compass;switch(which){case c.east:return p.add(d.x,d.y*.5);case c.west:return p.add(0,d.y*.5);case c.north:return p.add(d.x*.5,0);case c.south:return p.add(d.x*.5,d.y);case c.center:return p.add(d.mul(.5));case c.northwest:return p;case c.northeast:return p.add(d.x,0);case c.southwest:return p.add(0,d.y);case c.southeast:return p.add(d);}
Util.error('Unknown compass point %s.',which);return p;},getViewportDimensions:function(){var x=(window&&window.innerWidth)||(document&&document.documentElement&&document.documentElement.clientWidth)||(document&&document.body&&document.body.clientWidth)||0;var y=(window&&window.innerHeight)||(document&&document.documentElement&&document.documentElement.clientHeight)||(document&&document.body&&document.body.clientHeight)||0;return new Vector2(x,y);},getDocumentDimensions:function(){var x=(document&&document.body&&document.body.scrollWidth)||(document&&document.documentElement&&document.documentElement.scrollWidth)||0;var y=(document&&document.body&&document.body.scrollHeight)||(document&&document.documentElement&&document.documentElement.scrollHeight)||0;return new Vector2(x,y);},scrollTo:function(v){if(!(v instanceof Vector2)){v=new Vector2(Vector2.getScrollPosition().x,Vector2.getElementPosition($(v)).y,'document');}
v=v.toDocumentCoordinates();if(window.scrollTo){window.scrollTo(v.x,v.y);}}});var mouseX=function(e){return Vector2.getEventPosition(e).x;}
var mouseY=function(e){return Vector2.getEventPosition(e).y;}
var pageScrollX=function(){return Vector2.getScrollPosition().x;}
var pageScrollY=function(){return Vector2.getScrollPosition().y;}
var getViewportWidth=function(){return Vector2.getViewportDimensions().x;}
var getViewportHeight=function(){return Vector2.getViewportDimensions().y;}
var operaIgnoreScroll={'table':true,'inline-table':true,'inline':true};function elementX(obj){if(ua.safari()<500&&obj.tagName=='TR'){obj=obj.firstChild;}
var left=obj.offsetLeft;var op=obj.offsetParent;while(obj.parentNode&&document.body!=obj.parentNode){obj=obj.parentNode;if(!(ua.opera()<9.50)||!operaIgnoreScroll[window.getComputedStyle(obj,'').getPropertyValue('display')]){left-=obj.scrollLeft;}
if(op==obj){if(ua.safari()<500&&obj.tagName=='TR'){left+=obj.firstChild.offsetLeft;}else{left+=obj.offsetLeft;}
op=obj.offsetParent;}}
return left;}
function elementY(obj){if(ua.safari()<500&&obj.tagName=='TR'){obj=obj.firstChild;}
var top=obj.offsetTop;var op=obj.offsetParent;while(obj.parentNode&&document.body!=obj.parentNode){obj=obj.parentNode;if(!isNaN(obj.scrollTop)){if(!(ua.opera()<9.50)||!operaIgnoreScroll[window.getComputedStyle(obj,'').getPropertyValue('display')]){top-=obj.scrollTop;}}
if(op==obj){if(ua.safari()<500&&obj.tagName=='TR'){top+=obj.firstChild.offsetTop;}else{top+=obj.offsetTop;}
op=obj.offsetParent;}}
return top;}

function Rect(t,r,b,l,domain){copy_properties(this,{t:t,r:r,b:b,l:l,domain:domain||'pure'});};copy_properties(Rect.prototype,{w:function(){return this.r-this.l;},h:function(){return this.b-this.t;},area:function(){return this.w()*this.h();},toString:function(){return'(('+this.l+', '+this.t+'), ('+this.r+', '+this.b+'))';},intersects:function(v){v=v.convertTo(this.domain);var u=this;if(u.l>v.r||v.l>u.r||u.t>v.b||v.t>u.b){return false;}
return true;},intersectingArea:function(v){v=v.convertTo(this.domain);var u=this;if(!this.intersects(v)){return null;}
return new Rect(Math.max(u.t,v.t),Math.min(u.r,v.r),Math.min(u.b,v.b),Math.max(u.l,v.l)).area();},contains:function(v){v=v.convertTo(this.domain);var u=this;if(v instanceof Vector2){return(u.l<=v.x&&u.r>=v.x&&u.t<=v.y&&u.b>=v.y);}else{return(u.l<=v.l&&u.r>=u.r&&u.t<=v.t&&u.b>=v.b);}},canContain:function(v){v=v.convertTo(this.domain);return(v.h()<=this.h())&&(v.w()<=this.w());},forceBelow:function(v,min){min=min||0;v=v.convertTo(this.domain);if(v.b>this.t){return this.offset(0,(v.b-this.t)+min);}
return this;},offset:function(x,y){return new Rect(this.t+y,this.r+x,this.b+y,this.l+x,this.domain);},expand:function(x,y){return new Rect(this.t,this.r+x,this.b+y,this.l,this.domain);},scale:function(x,y){y=y||x;return new Rect(this.t,this.l+(this.w()*x),this.t+(this.h()*y),this.l,this.domain);},setDimensions:function(x,y){return new Rect(this.t,this.l+x,this.t+y,this.l,this.domain);},setPosition:function(x,y){return new Rect(x,this.w(),this.h(),y,this.domain);},boundWithin:function(v){if(v.contains(this)||!v.canContain(this)){return this;}
var x=0,y=0;if(this.l<v.l){x=v.l-this.l;}else if(this.r>v.r){x=v.r-this.r;}
if(this.t<v.t){y=v.t-this.t;}else if(this.b>v.b){y=v.b-this.b;}
return this.offset(x,y);},setElementBounds:function(el){this.getPositionVector().setElementPosition(el);this.getDimensionVector().setElementDimensions(el);return this;},getPositionVector:function(){return new Vector2(this.l,this.t,this.domain);},getDimensionVector:function(){return new Vector2(this.w(),this.h(),'pure');},convertTo:function(newDomain){if(this.domain==newDomain){return this;}
if(newDomain=='pure'){return new Rect(this.t,this.r,this.b,this.l,'pure');}
if(this.domain=='pure'){Util.error('Unable to convert a pure rect to %q coordinates.',newDomain);return new Rect(0,0,0,0);}
var p=new Vector2(this.l,this.t,this.domain).convertTo(newDomain);return new Rect(p.y,p.x+this.w(),p.y+this.h(),p.x,newDomain);},constrict:function(x,y){if(typeof(y)=='undefined'){y=x;}
x=x||0;return new Rect(this.t+y,this.r-x,this.b-y,this.l+x,this.domain);},expandX:function(){return new Rect(this.t,Number.POSITIVE_INFINITY,this.b,Number.NEGATIVE_INFINITY);},expandY:function(){return new Rect(number.NEGATIVE_INFINITY,this.r,Number.POSITIVE_INFINITY,this.l);}});copy_properties(Rect,{newFromVectors:function(pos,dim){return new Rect(pos.y,pos.x+dim.x,pos.y+dim.y,pos.x,pos.domain);},getElementBounds:function(el){return Rect.newFromVectors(Vector2.getElementPosition(el),Vector2.getElementDimensions(el));},getViewportBounds:function(){return Rect.newFromVectors(Vector2.getScrollPosition(),Vector2.getViewportDimensions());},getDocumentBounds:function(){return Rect.newFromVectors(new Vector2(0,0,'document'),Vector2.getDocumentDimensions());}});

function rand32(){return Math.floor(Math.random()*4294967295);}

try{if(window.myJavascriptLibrariesHaveLoaded){Util.error('You have double-included base.js and possibly other Javascript files; '+'it may be in a package. This will cause you great unhappiness. Each '+'file should be included at most once.');}
window.myJavascriptLibrariesHaveLoaded=true;}catch(ignored){}
function gen_unique(){return++gen_unique._counter;}
gen_unique._counter=0;function close_more_list(){var list_expander=ge('expandable_more');if(list_expander){list_expander.style.display='none';removeEventBase(document,'click',list_expander.offclick,list_expander.id);}
var sponsor=ge('ssponsor');if(sponsor){sponsor.style.position='';}
var link_obj=ge('more_link');if(link_obj){link_obj.innerHTML=tx('base01');link_obj.className='expand_link more_apps';}}
function expand_more_list(){var list_expander=ge('expandable_more');var more_link=ge('more_section');if(more_link){remove_css_class_name(more_link,'highlight_more_link');}
if(list_expander){list_expander.style.display='block';list_expander.offclick=function(e){if(!is_descendent(event_get_target(e),'sidebar_content')){close_more_list();}}.bind(list_expander);addEventBase(document,'click',list_expander.offclick,list_expander.id);}
var sponsor=ge('ssponsor');if(sponsor){sponsor.style.position='static';}
var link_obj=ge('more_link');if(link_obj){link_obj.innerHTML=tx('base02');link_obj.className='expand_link less_apps';}}
function create_hidden_input(name,value){return $N('input',{name:name,id:name,value:value,type:'hidden'});}
var KEYS={BACKSPACE:8,TAB:9,RETURN:13,ESC:27,SPACE:32,LEFT:37,UP:38,RIGHT:39,DOWN:40,DELETE:46};var KeyCodes={Up:63232,Down:63233,Left:63234,Right:63235};function optional_drop_down_menu(arrow,link,menu,event,arrow_class,arrow_old_class,on_click_callback,off_click_callback,offset_el,offset_info)
{if(menu.style.display=='none'){menu.style.display='block';if(offset_el&&offset_info){for(prop in offset_info){switch(prop){case'top':menu.style.top=(offset_el.offsetTop
+offset_info[prop])
+'px';break;case'left':menu.style.left=(offset_el.offsetLeft
+offset_info[prop])
+'px';break;case'right':menu.style.left=(offset_el.offsetLeft
+offset_el.offsetWidth
-offset_info[prop]
-menu.offsetWidth)
+'px';break;case'bottom':menu.style.top=(offset_el.offsetTop
+offset_el.offsetHeight
-offset_info[prop]
-menu.offsetHeight)
+'px';break;}}}
if(arrow){var old_arrow_classname=arrow_old_class?arrow_old_class:arrow.className;}
if(link){link.className='active';}
if(arrow){arrow.className=arrow_class?arrow_class:'global_menu_arrow_active';}
var justChanged=true;var shim=ge(menu.id+'_iframe');if(shim){shim.style.top=menu.style.top;shim.style.right=menu.style.right;shim.style.display='block';shim.style.width=(menu.offsetWidth+2)+'px';shim.style.height=(menu.offsetHeight+2)+'px';}
menu.offclick=function(e){if(!justChanged){hide(this);if(link){link.className='';}
if(arrow){arrow.className=old_arrow_classname;}
var shim=ge(menu.id+'_iframe');if(shim){shim.style.display='none';shim.style.width=menu.offsetWidth+'px';shim.style.height=menu.offsetHeight+'px';}
if(off_click_callback){off_click_callback(e);}
removeEventBase(document,'click',this.offclick,menu.id);}else{justChanged=false;}}.bind(menu);if(on_click_callback){on_click_callback();}
addEventBase(document,'click',menu.offclick,menu.id);onunloadRegister(menu.offclick,true);}
return false;}
function position_app_switcher(){var switcher=ge('app_switcher');var menu=ge('app_switcher_menu');menu.style.top=(switcher.offsetHeight-1)+'px';menu.style.right='0px';}
function hover_tooltip(object,hover_link,hover_class,offsetX,offsetY){if(object.tooltip){var tooltip=object.previousSibling;tooltip.style.display='block';return;}else{object.parentNode.style.position="relative";var tooltip=document.createElement('div');tooltip.className="tooltip_pro "+hover_class;tooltip.style.left=-9999+'px';tooltip.style.display='block';tooltip.innerHTML='<div class="tooltip_text"><span>'+hover_link+'</span></div>'+'<div class="tooltip_pointer"></div>';object.parentNode.insertBefore(tooltip,object);while(tooltip.firstChild.firstChild.offsetWidth<=0){1;}
var TOOLTIP_PADDING=16;var offsetWidth=tooltip.firstChild.firstChild.offsetWidth+TOOLTIP_PADDING;tooltip.style.width=offsetWidth+'px';tooltip.style.display='none';tooltip.style.left=offsetX+object.offsetLeft-((offsetWidth-6-object.offsetWidth)/2)+'px';tooltip.style.top=offsetY+'px';tooltip.style.display='block';object.tooltip=true;object.onmouseout=function(e){hover_clear_tooltip(object)};}}
function hover_clear_tooltip(object){var tooltip=object.previousSibling;tooltip.style.display='none';}
function goURI(href){window.location.href=href;}
function getTableRowShownDisplayProperty(){if(ua.ie()){return'inline';}else{return'table-row';}}
function showTableRow()
{for(var i=0;i<arguments.length;i++){var element=ge(arguments[i]);if(element&&element.style)element.style.display=getTableRowShownDisplayProperty();}
return false;}
function getParentRow(el){el=ge(el);while(el.tagName&&el.tagName!="TR"){el=el.parentNode;}
return el;}
function show_standard_status(status){s=ge('standard_status');if(s){var header=s.firstChild;header.innerHTML=status;show('standard_status');}}
function hide_standard_status(){s=ge('standard_status');if(s){hide('standard_status');}}
function adjustImage(obj,stop_word,max){var block=obj.parentNode;while(get_style(block,'display')!='block'&&block.parentNode){block=block.parentNode;}
var width=block.offsetWidth;if(obj.offsetWidth>width){try{if(ua.ie()){var img_div=document.createElement('div');img_div.style.filter='progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'+obj.src.replace('"','%22')+'", sizingMethod="scale")';img_div.style.width=width+'px';img_div.style.height=Math.floor(((width/obj.offsetWidth)*obj.offsetHeight))+'px';if(obj.parentNode.tagName=='A'){img_div.style.cursor='pointer';}
obj.parentNode.insertBefore(img_div,obj);obj.parentNode.removeChild(obj);}else{throw 1;}}catch(e){obj.style.width=width+'px';}}
remove_css_class_name(obj,'img_loading');}
function imageConstrainSize(src,maxX,maxY,placeholderid){var image=new Image();image.onload=function(){if(image.width>0&&image.height>0){var width=image.width;var height=image.height;if(width>maxX||height>maxY){var desired_ratio=maxY/maxX;var actual_ratio=height/width;if(actual_ratio>desired_ratio){width=width*(maxY/height);height=maxY;}else{height=height*(maxX/width);width=maxX;}}
var placeholder=ge(placeholderid);var newimage=document.createElement('img');newimage.src=src;newimage.width=width;newimage.height=height;placeholder.parentNode.insertBefore(newimage,placeholder);placeholder.parentNode.removeChild(placeholder);}}
image.src=src;}
function login_form_change(){var persistent=ge('persistent');if(persistent){persistent.checked=false;}}
function require_password_confirmation(onsuccess,oncancel){if((!getCookie('sid')||getCookie('sid')=='0')||getCookie('pk')){onsuccess();return;}
require_password_confirmation.onsuccess=onsuccess;require_password_confirmation.oncancel=oncancel;(new pop_dialog()).show_ajax_dialog('/ajax/password_check_dialog.php');}
function search_validate(search_input_id){var search_input=$(search_input_id);if(search_input.value!=""&&search_input.value!=search_input.getAttribute('placeholder')){return true;}else{search_input.focus();return false;}}
function abTest(data,inline)
{AsyncRequest.pingURI('/ajax/abtest.php',{data:data,"post_form_id":null},true);if(!inline){return true;}}
function ac(metadata)
{AsyncRequest.pingURI('/ajax/ac.php',{'meta':metadata},true);return true;}
function alc(metadata)
{AsyncRequest.pingURI('/ajax/alc.php',{'meta':metadata},true);return true;}
function scribe_log(category,message){AsyncRequest.pingURI('/ajax/scribe_log.php',{'category':category,'message':message,'post_form_id':null},true);}
function play_sound(path,loop){loop=loop||false;var s=ge('sound');if(!s){s=document.createElement('span');s.setAttribute('id','sound');document.body.appendChild(s);}
s.innerHTML='<embed src="'+path+'" autostart="true" hidden="true" '+'loop="'+(loop?"true":"false")+'" />';}
function image_has_loaded(obj){try{if((obj.mimeType!=null&&obj.complete&&obj.mimeType!='')||(obj.naturalHeight!=null&&obj.complete&&obj.naturalHeight!=0)){return true;}else if(ua.safari()<3){var new_image=new Image();new_image.src=obj.src;if(new_image.complete==true){return true;}
delete new_image;}}catch(exception){return true;}}
function image_has_failed(obj){if((obj.complete==null&&obj.width==20&&obj.height==20)||(obj.mimeType!=null&&obj.complete&&obj.mimeType=='')||(obj.naturalHeight!=null&&obj.complete&&obj.naturalHeight==0)){return true;}}
function cavalry_log(cohort,server_time){if(!window.Env){return;}
window.scrollBy(0,1);var t=[server_time,___tcss,___tjs+___tcss,___thtml+___tcss+___tjs,parseInt(Env.t_domcontent-Env.start,10),parseInt(Env.t_onload-Env.start,10),parseInt(Env.t_layout-Env.start,10),parseInt(((new Date()).getTime())-Env.start,10),parseInt(Env.t_doneonloadhooks-Env.t_willonloadhooks,10)];(new Image()).src="/common/instrument_endpoint.php?"
+"g="+cohort
+"&uri="+encodeURIComponent(window.location)
+"&t="+t.join(',')
+"&"+parseInt(Math.random()*10000,10);}
function show_search_profile(user_id){var async=new AsyncRequest().setURI('/ajax/search_profile.php').setData({id:user_id}).setMethod('GET').setReadOnly(true);new Dialog().setAsync(async).setButtons(Dialog.CLOSE).setContentWidth(490).show();}
function _search_profile_link_handler(link){var uri=new URI(link.href);if(uri.getPath()=='/s.php'){var query=uri.getQueryData();if(query.k==100000080){show_search_profile(query.id);return false;}}}
onloadRegister(function(){LinkController.registerHandler(_search_profile_link_handler);});function warn_if_unsaved(form_id){var form=ge(form_id);if(!form){Util.error("warn_if_unsaved couldn't find form in order to save its "
+"original state.  This is probably because you called "
+"render_start_form_with_unsaved_warning to render a form, "
+"but then didn't echo it into page.  To get around this, you "
+"can call render_start_form, and then call warn_if_unsaved "
+"yourself once you've caused the form to appear.");return;}
if(!_unsaved_forms_to_check_for){_unsaved_forms_to_check_for={};LinkController.registerHandler(_check_for_unsaved_forms);}
form.original_state=serialize_form(form);_unsaved_forms_to_check_for[form_id]=true;}
function _check_for_unsaved_forms(link){for(var form_id in _unsaved_forms_to_check_for){var form=ge(form_id);if(form&&form.original_state&&!are_equal(form.original_state,serialize_form(form))){var href=link.href;var submit=_find_first_submit_button(form);var buttons=[];if(submit){buttons.push({name:'save',label:tx('sh:save-button'),handler:bind(submit,'click')});}
buttons.push({name:'dont_save',label:tx('uw:dont-save'),handler:function(){window.location.href=href;}});buttons.push(Dialog.CANCEL);new Dialog().setTitle(tx('uw:title')).setBody(tx('uw:body')).setButtons(buttons).setModal().show();return false;}}}
function _find_first_submit_button(root_element){var inputs=root_element.getElementsByTagName('input');for(var i=0;i<inputs.length;++i){if(inputs[i].type.toUpperCase()=='SUBMIT'){return inputs[i];}}
return null;}
_unsaved_forms_to_check_for=undefined;ua.populate();_bootstrapEventHandlers();adjustUABehaviors();if(navigator&&navigator.userAgent&&!(parseInt((/Gecko\/([0-9]+)/.exec(navigator.userAgent)||[]).pop())<=20060508)){}

var DOM={tryElement:function(id){if(typeof(id)=='undefined'){Util.error('Tried to get "undefined" element!');return null;}
var obj;if(typeof(id)=='string'){obj=document.getElementById(id);if(!(ua.ie()>=7)){return obj;}
if(!obj){return null;}else if(typeof(obj.id)=='string'&&obj.id==id){return obj;}else{var candidates=document.getElementsByName(id);if(!candidates||!candidates.length){return null;}
var maybe=[];for(var ii=0;ii<candidates.length;ii++){var c=candidates[ii];if(!c.id&&id){continue;}
if(typeof(c.id)=='string'&&c.id!=id){continue;}
maybe.push(candidates[ii]);}
if(!maybe.length){return null;}
return maybe[0];}}
return id;},getElement:function(id){var el=DOM.tryElement.apply(null,arguments);if(!el){Util.warn('Tried to get element %q, but it is not present in the page. (Use '+'ge() to test for the presence of an element.)',arguments[0]);}
return el;},setText:function(el,text){if(ua.firefox()){el.textContent=text;}else{el.innerText=text;}},getText:function(el){if(ua.firefox()){return el.textContent;}else{return el.innerText;}},setContent:function(el,content){if(ua.ie()){for(var ii=el.childNodes.length-1;ii>=0;--ii){DOM.remove(el.childNodes[ii]);}}else{el.innerHTML='';}
if(content instanceof HTML){set_inner_html(el,content.toString());}else if(is_scalar(content)){content=document.createTextNode(content);el.appendChild(content);}else if(is_node(content)){el.appendChild(content);}else if(content instanceof Array){for(var ii=0;ii<content.length;ii++){var node=content[ii];if(!is_node(node)){node=document.createTextNode(node);}
el.appendChild(node);}}else{Util.error('No way to set content %q.',content);}},remove:function(element){element=$(element);if(element.removeNode){element.removeNode(true);}else{for(var ii=element.childNodes.length-1;ii>=0;--ii){DOM.remove(element.childNodes[ii]);}
element.parentNode.removeChild(element);}},create:function(element,attributes,children){element=document.createElement(element);if(attributes){attributes=copy_properties({},attributes);if(attributes.style){copy_properties(element.style,attributes.style);delete attributes.style;}
copy_properties(element,attributes);}
if(children!=undefined){DOM.setContent(element,children);}
return element;},scry:function(element,pattern){pattern=pattern.split('.');var tag=pattern[0]||null;if(!tag){return[];}
var cls=pattern[1]||null;var candidates=element.getElementsByTagName(tag);if(cls!==null){var satisfy=[];for(var ii=0;ii<candidates.length;ii++){if(CSS.hasClass(candidates[ii],cls)){satisfy.push(candidates[ii]);}}
candidates=satisfy;}
return candidates;},prependChild:function(parent,child){parent=$(parent);if(parent.firstChild){parent.insertBefore(child,parent.firstChild);}else{parent.appendChild(child);}},getCaretPosition:function(element){element=$(element);if(!is_node(element,['input','textarea'])){return{start:undefined,end:undefined};}
if(!document.selection){return{start:element.selectionStart,end:element.selectionEnd};}
if(is_node(element,'input')){var range=document.selection.createRange();return{start:-range.moveStart('character',-element.value.length),end:-range.moveEnd('character',-element.value.length)};}else{var range=document.selection.createRange();var range2=range.duplicate();range2.moveToElementText(element);range2.setEndPoint('StartToEnd',range);var end=element.value.length-range2.text.length;range2.setEndPoint('StartToStart',range);return{start:element.value.length-range2.text.length,end:end};}},addEvent:function(element,type,func,name_hash){return addEventBase(element,type,func,name_hash);}};var $N=DOM.create;var ge=DOM.tryElement;var $$=function _$$(rules){var args=[document].concat(Array.prototype.slice.apply(arguments));return DOM.scry.apply(null,args);}
var $=DOM.getElement;var remove_node=DOM.remove;var prependChild=DOM.prependChild;var get_caret_position=DOM.getCaretPosition;function is_node(o,of_type){if(typeof(Node)=='undefined'){Node=null;}
try{if(!o||!((Node!=undefined&&o instanceof Node)||o.nodeName)){return false;}}catch(ignored){return false;}
if(typeof(of_type)!=="undefined"){if(!(of_type instanceof Array)){of_type=[of_type];}
var name;try{name=new String(o.nodeName).toUpperCase();}catch(ignored){return false;}
for(var ii=0;ii<of_type.length;ii++){try{if(name==of_type[ii].toUpperCase()){return true;}}catch(ignored){}}
return false;}
return true;}
function is_descendent(base_obj,target_id){var target_obj=ge(target_id);if(base_obj==null)return;while(base_obj!=target_obj){if(base_obj.parentNode){base_obj=base_obj.parentNode;}else{return false;}}
return true;}
function iterTraverseDom(root,visitCb){var c=root,n=null;var it=0;do{n=c.firstChild;if(!n){if(visitCb(c)==false)
return;n=c.nextSibling;}
if(!n){var tmp=c;do{n=tmp.parentNode;if(n==root)
break;if(visitCb(n)==false)
return;tmp=n;n=n.nextSibling;}
while(!n);}
c=n;}
while(c!=root);}
function insertAfter(parent,child,elem){if(parent!=child.parentNode){Util.error('child is not really a child of parent - wtf, seriously.');}
if(child.nextSibling){var ret=parent.insertBefore(elem,child.nextSibling);}else{var ret=parent.appendChild(elem);}
if(!ret){return null;}
return elem;}
function set_caret_position(obj,start,end){if(document.selection){if(obj.tagName=='TEXTAREA'){var i=obj.value.indexOf("\r",0);while(i!=-1&&i<end){end--;if(i<start){start--;}
i=obj.value.indexOf("\r",i+1);}}
var range=obj.createTextRange();range.collapse(true);range.moveStart('character',start);if(end!=undefined){range.moveEnd('character',end-start);}
range.select();}else{obj.selectionStart=start;var sel_end=end==undefined?start:end;obj.selectionEnd=Math.min(sel_end,obj.value.length);obj.focus();}}

var CSS={hasClass:function(element,className){if(element&&className&&element.className){return new RegExp('\\b'+trim(className)+'\\b').test(element.className);}
return false;},addClass:function(element,className){if(element&&className){if(!CSS.hasClass(element,className)){if(element.className){element.className+=' '+trim(className);}else{element.className=trim(className);}}}
return this;},removeClass:function(element,className){if(element&&className&&element.className){className=trim(className);var regexp=new RegExp('\\b'+className+'\\b','g');element.className=element.className.replace(regexp,'');}
return this;},conditionClass:function(element,className,shouldShow){if(shouldShow){CSS.addClass(element,className);}else{CSS.removeClass(element,className);}},setClass:function(element,className){element.className=className;return this;},toggleClass:function(element,className){if(CSS.hasClass(element,className)){return CSS.removeClass(element,className);}else{return CSS.addClass(element,className);}},getStyle:function(element,property){element=$(element);function hyphenate(property){return property.replace(/[A-Z]/g,function(match){return'-'+match.toLowerCase();});}
if(window.getComputedStyle){return window.getComputedStyle(element,null).getPropertyValue(hyphenate(property));}
if(document.defaultView&&document.defaultView.getComputedStyle){var computedStyle=document.defaultView.getComputedStyle(element,null);if(computedStyle)
return computedStyle.getPropertyValue(hyphenate(property));if(property=="display")
return"none";Util.error("Can't retrieve requested style %q due to a bug in Safari",property);}
if(element.currentStyle){return element.currentStyle[property];}
return element.style[property];},setOpacity:function(element,opacity){var opaque=(opacity==1);try{element.style.opacity=(opaque?'':''+opacity);}catch(ignored){}
try{element.style.filter=(opaque?'':'alpha(opacity='+(opacity*100)+')');}catch(ignored){}},getOpacity:function(element){var opacity=get_style(element,'filter');var val=null;if(opacity&&(val=/(\d+(?:\.\d+)?)/.exec(opacity))){return parseFloat(val.pop())/100;}else if(opacity=get_style(element,'opacity')){return parseFloat(opacity);}else{return 1.0;}},Cursor:{kGrabbable:'grabbable',kGrabbing:'grabbing',kEditable:'editable',set:function(element,name){element=element||document.body;switch(name){case CSS.Cursor.kEditable:name='text';break;case CSS.Cursor.kGrabbable:if(ua.firefox()){name='-moz-grab';}else{name='move';}
break;case CSS.Cursor.kGrabbing:if(ua.firefox()){name='-moz-grabbing';}else{name='move';}
break;}
element.style.cursor=name;}}};var has_css_class_name=CSS.hasClass;var add_css_class_name=CSS.addClass;var remove_css_class_name=CSS.removeClass;var toggle_css_class_name=CSS.toggleClass;var get_style=CSS.getStyle;var set_opacity=CSS.setOpacity;var get_opacity=CSS.getOpacity;

function getRadioFormValue(obj){for(i=0;i<obj.length;i++){if(obj[i].checked){return obj[i].value;}}
return null;}
function getElementsByTagNames(list,obj){if(!obj)var obj=document;var tagNames=list.split(',');var resultArray=new Array();for(var i=0;i<tagNames.length;i++){var tags=obj.getElementsByTagName(tagNames[i]);for(var j=0;j<tags.length;j++){resultArray.push(tags[j]);}}
var testNode=resultArray[0];if(!testNode)return[];if(testNode.sourceIndex){resultArray.sort(function(a,b){return a.sourceIndex-b.sourceIndex;});}
else if(testNode.compareDocumentPosition){resultArray.sort(function(a,b){return 3-(a.compareDocumentPosition(b)&6);});}
return resultArray;}
function get_all_form_inputs(root_element){if(!root_element){root_element=document;}
return getElementsByTagNames('input,select,textarea,button',root_element);}
function get_form_select_value(select){return select.options[select.selectedIndex].value;}
function set_form_select_value(select,value){for(var i=0;i<select.options.length;++i){if(select.options[i].value==value){select.selectedIndex=i;break;}}}
function get_form_attr(form,attr){var val=form[attr];if(typeof val=='object'&&val.tagName=='INPUT'){var pn=val.parentNode,ns=val.nextSibling,node=val;pn.removeChild(node);val=form[attr];ns?pn.insertBefore(node,ns):pn.appendChild(node);}
return val;}
function serialize_form_helper(data,name,value){var match=/([^\]]+)\[([^\]]*)\](.*)/.exec(name);if(match){data[match[1]]=data[match[1]]||{};if(match[2]==''){var i=0;while(data[match[1]][i]!=undefined){i++;}}else{i=match[2];}
if(match[3]==''){data[match[1]][i]=value;}else{serialize_form_helper(data[match[1]],i.concat(match[3]),value);}}else{data[name]=value;}}
function serialize_form_fix(data){var keys=[];for(var i in data){if(data instanceof Object){data[i]=serialize_form_fix(data[i]);}
keys.push(i);}
var j=0,is_array=true;keys.sort().each(function(i){if(i!=j++){is_array=false;}});if(is_array){var ret={};keys.each(function(i){ret[i]=data[i];});return ret;}else{return data;}}
function serialize_form(obj){var data={};var elements=obj.tagName=='FORM'?obj.elements:get_all_form_inputs(obj);for(var i=elements.length-1;i>=0;i--){if(elements[i].name&&!elements[i].disabled){if(!elements[i].type||((elements[i].type=='radio'||elements[i].type=='checkbox')&&elements[i].checked)||elements[i].type=='text'||elements[i].type=='password'||elements[i].type=='hidden'||elements[i].tagName=='TEXTAREA'||elements[i].tagName=='SELECT'){serialize_form_helper(data,elements[i].name,elements[i].value);}}}
return serialize_form_fix(data);}
function is_button(element){var tagName=element.tagName.toUpperCase();if(tagName=='BUTTON'){return true;}
if(tagName=='INPUT'&&element.type){var type=element.type.toUpperCase();return type=='BUTTON'||type=='SUBMIT';}
return false;}
function do_post(url){var pieces=/(^([^?])+)\??(.*)$/.exec(url);var form=document.createElement('form');form.action=pieces[1];form.method='post';form.style.display='none';var sparam=/([\w]+)(?:=([^&]+)|&|$)/g;var param=null;if(ge('post_form_id'))
pieces[3]+='&post_form_id='+$('post_form_id').value;while(param=sparam.exec(pieces[3])){var input=document.createElement('input');input.type='hidden';input.name=decodeURIComponent(param[1]);input.value=decodeURIComponent(param[2]);form.appendChild(input);}
document.body.appendChild(form);form.submit();return false;}
function dynamic_post(url,params){var form=document.createElement('form');form.action=url;form.method='POST';form.style.display='none';if(ge('post_form_id')){params['post_form_id']=$('post_form_id').value;}
for(var param in params){var input=document.createElement('input');input.type='hidden';input.name=param;input.value=params[param];form.appendChild(input);}
document.body.appendChild(form);form.submit();return false;}

function HTML(content){if(this===window){return new HTML(content);}
this.content=content;return this;}
copy_properties(HTML.prototype,{toString:function(){return this.content;}});

function show(){for(var i=0;i<arguments.length;i++){var element=ge(arguments[i]);if(element&&element.style)element.style.display='';}
return false;}
function hide(){for(var i=0;i<arguments.length;i++){var element=ge(arguments[i]);if(element&&element.style)element.style.display='none';}
return false;}
function shown(el){el=ge(el);return(el.style.display!='none'&&!(el.style.display==''&&el.offsetWidth==0));}
function toggle(){for(var i=0;i<arguments.length;i++){var element=$(arguments[i]);element.style.display=get_style(element,"display")=='block'?'none':'block';}
return false;}
function set_inner_html(obj,html,defer_js_execution){var dummy='<span style="display:none">&nbsp</span>';html=html.replace('<style',dummy+'<style');html=html.replace('<STYLE',dummy+'<STYLE');html=html.replace('<script',dummy+'<script');html=html.replace('<SCRIPT',dummy+'<SCRIPT');obj.innerHTML=html;if(defer_js_execution){eval_inner_js.bind(null,obj).defer();}else{eval_inner_js(obj);}
addSafariLabelSupport(obj);(function(){LinkController.bindLinks(obj);}).defer();}
function eval_inner_js(obj){var scripts=obj.getElementsByTagName('script');for(var i=0;i<scripts.length;i++){if(scripts[i].src){var script=document.createElement('script');script.type='text/javascript';script.src=scripts[i].src;document.body.appendChild(script);}else{try{eval_global(scripts[i].innerHTML);}catch(e){if(typeof console!='undefined'){console.error(e);}}}}}
function eval_global(js){var obj=document.createElement('script');obj.type='text/javascript';try{obj.innerHTML=js;}catch(e){obj.text=js;}
document.body.appendChild(obj);}

function DOMControl(root){copy_properties(this,{root:root&&$(root),updating:false});if(root){root.getControl=identity.bind(null,this);}}
copy_properties(DOMControl.prototype,{getRoot:function(){return this.root;},beginUpdate:function(){if(this.updating){return false;}
this.updating=true;return true;},endUpdate:function(){this.updating=false;},update:function(){if(!this.beginUpdate()){return this;}
this.onupdate();this.endUpdate();}});

function TextInputControl(textinput){this.parent.construct(this,textinput);copy_properties(this,{placeholderText:null,maxLength:this.getRoot().maxLength||null,radio:null,focused:false,nativePlaceholder:false});var r=this.getRoot();if((String(r.type).toLowerCase()=='search')&&ua.safari()){this.nativePlaceholder=true;this.setPlaceholderText(r.getAttribute('placeholder'));}
DOM.addEvent(r,'focus',this.setFocused.bind(this,true));DOM.addEvent(r,'blur',this.setFocused.bind(this,false));var up=this.update.bind(this);DOM.addEvent(r,'keydown',up);DOM.addEvent(r,'keyup',up);DOM.addEvent(r,'keypress',up);setInterval(up,150);this.setFocused(false);}
TextInputControl.extend(DOMControl);copy_properties(TextInputControl.prototype,{associateWithRadioButton:function(element){this.radio=element&&$(element);return this;},setMaxLength:function(maxlength){this.maxLength=maxlength;this.getRoot().maxLength=this.maxLength||null;return this;},getValue:function(){if(this.getRoot().value==this.placeholderText){return null;}
return this.getRoot().value;},isEmpty:function(){var v=this.getValue();return(v===null||v=='');},setValue:function(value){this.getRoot().value=value;this.update();return this;},clear:function(){return this.setValue('');},isFocused:function(){return this.focused;},setFocused:function(focused){this.focused=focused;if(this.placeholderText&&!this.nativePlaceholder){var r=this.getRoot();var v=r.value;if(this.focused){CSS.removeClass(r,'DOMControl_placeholder');if(this.isEmpty()){this.clear();}}else if(this.isEmpty()){CSS.addClass(r,'DOMControl_placeholder');this.setValue(this.placeholderText);}}
this.update();return this;},setPlaceholderText:function(text){this.placeholderText=text;if(this.nativePlaceholder){this.getRoot().setAttribute('placeholder',text);}
return this.setFocused(this.isFocused());},onupdate:function(){if(this.radio){if(this.focused){this.radio.checked=true;}}
var r=this.getRoot();if(this.maxLength>0){if(r.value.length>this.maxLength){r.value=r.value.substring(0,this.maxLength);}}}});function placeholderSetup(id){if(!ge(id)){Util.warn('Setting up a placeholder for an element which does not exist: %q.',id);return;}
if(!$(id).getAttribute('placeholder')){Util.warn('Setting up a placeholder for an element with no placeholder text: %q.',id);return;}
return new TextInputControl($(id)).setPlaceholderText($(id).getAttribute('placeholder'));}

function TextAreaControl(textarea){copy_properties(this,{autogrow:false,shadow:null,originalHeight:null,metricsValue:null});this.parent.construct(this,textarea);};TextAreaControl.extend(TextInputControl);copy_properties(TextAreaControl.prototype,{setAutogrow:function(autogrow){this.autogrow=autogrow;this.refreshShadow();return this;},onupdate:function(){this.parent.onupdate();var r=this.getRoot();if(this.autogrow&&r.value!=this.metricsValue){this.metricsValue=r.value;copy_properties(this.shadow.style,{fontSize:parseInt(CSS.getStyle(r,'fontSize'),10)+'px',fontFamily:CSS.getStyle(r,'fontFamily')+'px',width:(Vector2.getElementDimensions(r).x-8)+'px'});DOM.setContent(this.shadow,HTML(htmlize(r.value)));r.style.height=Math.max(this.originalHeight,Vector2.getElementDimensions(this.shadow).y+15)+'px';}},refreshShadow:function(){if(this.autogrow){this.shadow=$N('div',{className:'DOMControl_shadow'});document.body.appendChild(this.shadow);var r=this.getRoot();this.originalHeight=parseInt(CSS.getStyle(r,'height'))||Vector2.getElementDimensions(this.getRoot()).y;}else{if(this.shadow){DOM.remove(this.shadow);}
this.shadow=null;}}});function autogrow_textarea(element){element=$(element);if(!element._hascontrol){element._hascontrol=true;new TextAreaControl(element).setAutogrow(true);}}
function textarea_maxlength(element,length){element=$(element);if(!element._hascontrol){element._hascontrol=true;new TextAreaControl(element).setMaxLength(length);}}

function KeyEventController(){copy_properties(this,{handlers:{}});document.onkeyup=this.onkeyevent.bind(this,'onkeyup');document.onkeydown=this.onkeyevent.bind(this,'onkeydown');document.onkeypress=this.onkeyevent.bind(this,'onkeypress');}
copy_properties(KeyEventController,{instance:null,getInstance:function(){return KeyEventController.instance||(KeyEventController.instance=new KeyEventController());},defaultFilter:function(event,type){event=event_get(event);return KeyEventController.filterEventTypes(event,type)&&KeyEventController.filterEventTargets(event,type)&&KeyEventController.filterEventModifiers(event,type);},filterEventTypes:function(event,type){if(type==='onkeydown'){return true;}
return false;},filterEventTargets:function(event,type){var target=event_get_target(event);if(target!==document.body&&target!==document.documentElement){if(!ua.ie()){return false;}
if(is_node(target,['input','select','textarea','object','embed'])){return false;}}
return true;},filterEventModifiers:function(event,type){if(event.ctrlKey||event.altKey||event.metaKey||event.repeat){return false;}
return true;},registerKey:function(key,callback,filter_callback){if(filter_callback===undefined){filter_callback=KeyEventController.defaultFilter;}
var ctl=KeyEventController.getInstance();var eqv=ctl.mapKey(key);for(var ii=0;ii<eqv.length;ii++){key=eqv[ii];if(!ctl.handlers[key]){ctl.handlers[key]=[];}
ctl.handlers[key].push({callback:callback,filter:filter_callback});}},bindToAccessKeys:function(){var ii,k;var links=document.getElementsByTagName('a');for(ii=0;ii<links.length;ii++){if(links[ii].accessKey){if(k){KeyEventController.registerKey(k,bind(KeyEventController,'accessLink',links[ii]));}}}
var inputs=document.getElementsByTagName('input');for(ii=0;ii<inputs.length;ii++){if(inputs[ii].accessKey){if(k){KeyEventController.registerKey(k,bind(KeyEventController,'accessInput',inputs[ii]));}}}
var areas=document.getElementsByTagName('textarea');for(ii=0;ii<areas.length;ii++){if(areas[ii].accessKey){if(k){KeyEventController.registerKey(k,bind(KeyEventController,'accessInput',areas[ii]));}}}},accessLink:function(l,e){if(l.onclick){return l.onclick(e);}
if(l.href){window.location.href=l.href;}},accessInput:function(i,e){Vector2.scrollTo(i);i.focus(e);if(i.type=='submit'){i.form.submit();}},keyCodeMap:{'[':[219],']':[221],'`':[192],'LEFT':[KEYS.LEFT,KeyCodes.Left],'RIGHT':[KEYS.RIGHT,KeyCodes.Right],'RETURN':[KEYS.RETURN],'TAB':[KEYS.TAB],'DOWN':[KEYS.DOWN,KeyCodes.Down],'UP':[KEYS.UP,KeyCodes.Up],'ESCAPE':[KEYS.ESC]}});copy_properties(KeyEventController.prototype,{mapKey:function(k){if(typeof(k)=='number'){return[k];}
if(KeyEventController.keyCodeMap[k.toUpperCase()]){return KeyEventController.keyCodeMap[k.toUpperCase()];}
var l=k.charCodeAt(0);var u=k.toUpperCase().charCodeAt(0);if(l!=u){return[l,u];}
return[l];},onkeyevent:function(type,e){e=event_get(e);var evt=null;var handlers=this.handlers[e.keyCode];var callback,filter,abort;if(handlers){for(var ii=0;ii<handlers.length;ii++){callback=handlers[ii].callback;filter=handlers[ii].filter;try{if(!filter||filter(e,type)){abort=callback(e,type);if(abort===false){return event_abort(e)||event_prevent(e);}}}catch(exception){Util.error('Uncaught exception in key handler: %x',exception);}}}
return true;}});

function editor_two_level_change(selector,subtypes_array,sublabels_array)
{selector=ge(selector);if(selector.getAttribute("typefor"))
subselector=ge(selector.getAttribute("typefor"));if(selector&&subselector){subselector.options.length=1;type_value=selector.options[selector.selectedIndex].value;if(type_value==""){type_value=-1;}
index=1;suboptions=subtypes_array[type_value];if(typeof(suboptions)!="undefined"){for(var key=0;key<suboptions.length;key++){if(typeof(suboptions[key])!="undefined"){subselector.options[index++]=new Option(suboptions[key],key);}}}
if(sublabels_array){if(sublabels_array[type_value]){subselector.options[0]=new Option(sublabels_array[type_value],"");subselector.options[0].selected=true;}else{subselector.options[0]=new Option("---","");subselector.options[0].selected=true;}}
subselector.disabled=subselector.options.length<=1;}}
function editor_two_level_set_subselector(subselector,value)
{subselector=ge(subselector);if(subselector){opts=subselector.options;for(var index=0;index<opts.length;index++){if((opts[index].value==value)||(value===null&&opts[index].value=='')){subselector.selectedIndex=index;}}}}
function editor_network_change(selector,prefix,orig_value){selector=ge(selector);if(selector&&selector.value>0){show('display_network_message');}else{hide('display_network_message');}}
function editor_rel_change(selector,prefix,orig_value)
{selector=ge(selector);for(var rel_type=2;rel_type<=6;rel_type++){if(rel_type==selector.value){show(prefix+'_new_partner_'+rel_type);}else{hide(prefix+'_new_partner_'+rel_type);}}
if(selector&&ge(prefix+'_new_partner')){if(selector.value>1){show(prefix+'_new_partner');}else{hide(prefix+'_new_partner');}}
if(selector&&ge(prefix+'_rel_uncancel')){if(selector.value>1)
editor_rel_uncancel(selector,prefix,selector.value);else
editor_rel_cancel(selector,prefix);}
editor_rel_toggle_awaiting(selector,prefix,orig_value);}
function rel_typeahead_onsubmit(){return false;}
function rel_typeahead_onselect(friend){if(!friend)
return;$('new_partner').value=friend.i;}
function editor_rel_toggle_awaiting(selector,prefix,orig_value)
{selector=ge(selector);if(selector&&ge(prefix+'_rel_required')){if(selector.value==orig_value){hide(prefix+'_rel_required');show(prefix+'_rel_awaiting');}
else{show(prefix+'_rel_required');hide(prefix+'_rel_awaiting');}}}
function editor_rel_cancel(selector,prefix)
{if(ge(prefix+'_rel_uncancel'))
show(prefix+'_rel_uncancel');if(ge(prefix+'_rel_cancel'))
hide(prefix+'_rel_cancel');selector=ge(selector);if(ge(selector)&&$(selector).selectedIndex>1)
editor_rel_set_value(selector,1);}
function editor_rel_uncancel(selector,prefix,rel_value)
{if(ge(prefix+'_rel_uncancel'))
hide(prefix+'_rel_uncancel');if(ge(prefix+'_rel_cancel'))
show(prefix+'_rel_cancel');if(rel_value==4||rel_value==5){hide(prefix+'_rel_with');show(prefix+'_rel_to');}else if(rel_value>1){show(prefix+'_rel_with');hide(prefix+'_rel_to');}
if(ge(selector)&&$(selector).selectedIndex<=1)
editor_rel_set_value(selector,rel_value);editor_rel_toggle_awaiting(selector,prefix,rel_value);}
function editor_autocomplete_onselect(result){var hidden=ge(/(.*)_/.exec(this.obj.name)[1]+'_id');if(result){hidden.value=result.i==null?result.t:result.i;}
else{hidden.value=-1;}}
function editor_rel_set_value(selector,value)
{selector=ge(selector);if(selector){opts=selector.options;opts_length=opts.length;for(var index=0;index<opts_length;index++){if((opts[index].value==value)||(value===null&&opts[index].value=='')){selector.selectedIndex=index;}}}}
function enableDisable(gainFocus,loseFocus){loseFocus=ge(loseFocus);if(loseFocus){if(loseFocus.value)loseFocus.value="";if(loseFocus.selectedIndex)loseFocus.selectedIndex=0;}}
function show_editor_error(error_text,exp_text)
{$('editor_error_text').innerHTML=error_text;$('editor_error_explanation').innerHTML=exp_text;show('error');}
function make_explanation_list(list,num,type){var exp='';if(type=='missing'){if(num==1){exp=tx('el01',{'thing-1':list[0]});}else if(num==2){exp=tx('el02',{'thing-1':list[0],'thing-2':list[1]});}else if(num==3){exp=tx('el03',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2]});}else if(num==4){exp=tx('el04',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2],'thing-4':list[3]});}else if(num>4){exp=tx('el05',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2],'num':num-3});}}else if(type=='bad'){if(num==1){exp=tx('el06',{'thing-1':list[0]});}else if(num==2){exp=tx('el07',{'thing-1':list[0],'thing-2':list[1]});}else if(num==3){exp=tx('el08',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2]});}else if(num==4){exp=tx('el09',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2],'thing-4':list[3]});}else if(num>4){exp=tx('el10',{'thing-1':list[0],'thing-2':list[1],'thing-3':list[2],'num':num-3});}}
return exp;}
function TimeSpan(start_prefix,end_prefix,span,auto){this.get_start_ts=function(){return _get_date_time_ts(_start_month,_start_day,_start_year,_start_hour,_start_min,_start_ampm);}
this.get_end_ts=function(){var start_ts=_get_date_time_ts(_start_month,_start_day,_start_year,_start_hour,_start_min,_start_ampm);var end_ts=_get_date_time_ts(_end_month,_end_day,_end_year,_end_hour,_end_min,_end_ampm);if(start_ts>end_ts&&!(_start_year&&_end_year)){var future_date=new Date();future_date.setTime(end_ts);future_date.setFullYear(future_date.getFullYear()+1);return future_date.getTime();}else{return end_ts;}}
var _start_month=ge(start_prefix+'_month');var _start_day=ge(start_prefix+'_day');var _start_hour=ge(start_prefix+'_hour');var _start_year=ge(start_prefix+'_year');var _start_min=ge(start_prefix+'_min');var _start_ampm=ge(start_prefix+'_ampm');var _end_month=ge(end_prefix+'_month');var _end_day=ge(end_prefix+'_day');var _end_year=ge(end_prefix+'_year');var _end_hour=ge(end_prefix+'_hour');var _end_min=ge(end_prefix+'_min');var _end_ampm=ge(end_prefix+'_ampm');var _bottom_touched;if(auto){_bottom_touched=false;}else{_bottom_touched=true;}
var _start_touched=function(){if(!_bottom_touched){_propogate_time_span(_start_month,_start_day,_start_year,_start_hour,_start_min,_start_ampm);}}
var _end_touched=function(){_bottom_touched=true;}
var _propogate_time_span=function(){var start_ts=_get_date_time_ts(_start_month,_start_day,_start_year,_start_hour,_start_min,_start_ampm);var end_ts=start_ts+span*60000;_set_date_time_from_ts(end_ts,_end_month,_end_day,_end_year,_end_hour,_end_min,_end_ampm);}
var _get_date_time_ts=function(m,d,y,h,min,ampm){var this_date=new Date();var date_this_day=this_date.getDate();var date_this_month=this_date.getMonth();var date_this_year=this_date.getFullYear();var month=m.value-1;var date=d.value;var hour;var minutes=min.value;var year;hour=parseInt(h.value);if(ampm.value!=''){if(hour==12)hour=0;if(ampm.value=='pm'){hour=hour+12;}}
if(!y){if(month<date_this_month){year=date_this_year+1;}else{if(month==date_this_month&&date<date_this_day){year=date_this_year+1;}else{year=date_this_year;}}}else{year=y.value;}
var new_date=new Date(year,month,date,hour,minutes,0,0);var ts=new_date.getTime();return ts;}
var _set_date_time_from_ts=function(ts,m,d,y,h,min,ampm){var new_date=new Date();new_date.setTime(ts);var old_month=m.value;var new_month=new_date.getMonth()+1;var new_day=new_date.getDate();var new_hour=new_date.getHours();var new_minutes=new_date.getMinutes();var new_year=new_date.getFullYear();var new_ampm;if(ampm.value!=''){if(new_hour>11){new_ampm='pm';if(new_hour>12){new_hour=new_hour-12;}}else{if(new_hour==0)new_hour=12;new_ampm='am';}}else{new_ampm='';}
if(new_minutes<10){new_minutes="0"+new_minutes;}
m.value=new_month;d.value=new_day;if(y){y.value=new_year;}
h.value=new_hour;min.value=new_minutes;ampm.value=new_ampm;if(old_month!=new_month){editor_date_month_change(m,d,y?y:false);}}
var _start_month_touched=function(){_start_touched();editor_date_month_change(_start_month,_start_day,_start_year?_start_year:false);}
var _end_month_touched=function(){_end_touched();editor_date_month_change(_end_month,_end_day,_end_year?_end_year:false);}
_start_month.onchange=_start_month_touched;_start_day.onchange=_start_touched;if(_start_year){_start_year.onchange=_start_touched;}
_start_hour.onchange=_start_touched;_start_min.onchange=_start_touched;_start_ampm.onchange=_start_touched;_end_month.onchange=_end_month_touched;_end_day.onchange=_end_touched;if(_end_year){_end_year.onchange=_end_touched;}
_end_hour.onchange=_end_touched;_end_min.onchange=_end_touched;_end_ampm.onchange=_end_touched;}
function editor_date_month_change(month_el,day_el,year_el){var month_el=ge(month_el);var day_el=ge(day_el);var year_el=year_el?ge(year_el):false;var new_num_days=month_get_num_days(month_el.value,year_el.value&&year_el.value!=-1?year_el.value:false);var b=day_el.options[0].value==-1?1:0;for(var i=day_el.options.length;i>new_num_days+b;i--){remove_node(day_el.options[i-1]);}
for(var i=day_el.options.length;i<new_num_days+b;i++){day_el.options[i]=new Option(i+(b?0:1));}}
function editor_date_year_change(month,day,year){editor_date_month_change(month,day,year);}
function month_get_num_days(month,year){var temp_date;if(month==-1){return 31;}
temp_date=new Date(year?year:1912,month,0);return temp_date.getDate();}
function toggleEndWorkSpan(prefix){if(shown(prefix+'_endspan')){hide(prefix+'_endspan');show(prefix+'_present');}else{show(prefix+'_endspan');hide(prefix+'_present');}}
function regionCountryChange(label_id,country_id,region_id,label_prefix){switch(country_id){case'326':show(region_id);$(label_id).innerHTML=label_prefix+tx('el13');break;case'398':show(region_id);$(label_id).innerHTML=label_prefix+tx('el12');break;default:$(label_id).innerHTML=label_prefix+tx('el11');hide(region_id);break;}}
function regionCountryChange_twoLabels(country_label_id,region_label_id,country_id,region_id,label_prefix){show(country_label_id);$(country_label_id).innerHTML=label_prefix+tx('el11');switch(country_id){case'326':show(region_id);show(region_label_id);$(region_label_id).innerHTML=label_prefix+tx('el13');break;case'':case'398':show(region_id);show(region_label_id);$(region_label_id).innerHTML=label_prefix+tx('el12');break;default:$(region_label_id).innerHTML=label_prefix+tx('el12');$(region_id).disabled=true;break;}}
function regionCountyChange_setUSifStateChosen(country_select_id,region_select_id){region_select=ge(region_select_id);country_select=ge(country_select_id);if(region_select.value!=''&&country_select.value==''){country_select.value=398;}}
function regionCountryChange_restrictions(country_select_id,region_select_id){country_select=ge(country_select_id);if(country_select.value==398){country_select.value='';}else if(country_select.value==326){region_select=ge(region_select_id);if(region_select.value){country_select.value='';}}}
function textLimit(ta,count){var text=ge(ta);if(text.value.length>count){text.value=text.value.substring(0,count);if(arguments.length>2){$(arguments[2]).style.display='block';}}}
function textLimitStrict(text_id,limit,message_id,count_id,submit_id){var text=ge(text_id);var len=text.value.length;var diff=len-limit;if(diff>0){if(diff>25000){text.value=text.value.substring(0,limit+25000);diff=25000;}
$(message_id).style.display='block';$(count_id).innerHTML=diff;$(submit_id).disabled=true;}else if(len==0){$(message_id).style.display='none';$(submit_id).disabled=true;$(count_id).innerHTML=1;}else{if($(count_id).innerHTML!=0){$(count_id).innerHTML=0;$(message_id).style.display='none';$(submit_id).disabled=false;}}}
function calcAge(month_el,day_el,year_el){bYear=parseInt($(year_el).value);bMonth=parseInt($(month_el).value);bDay=parseInt($(day_el).value);theDate=new Date();year=theDate.getFullYear();month=theDate.getMonth()+1;day=theDate.getDate();age=year-bYear;if((bMonth>month)||(bMonth==month&&day<bDay))age--;return age;}
function mobile_phone_nag(words,obj,anchor){var nagged=false;var callback=function(){if(nagged){return;}
for(var i=0;i<words.length;i++){if((new RegExp('\\b'+words[i]+'\\b','i')).test(obj.value)){nagged=true;(new AsyncRequest()).setURI('/ajax/mobile_phone_nag.php').setHandler(function(async){var html=async.getPayload();if(html){var div=document.createElement('div');div.innerHTML=html;div.className='mobile_nag';div.style.display='none';anchor.parentNode.insertBefore(div,anchor);animation(div).blind().show().from('height',0).to('height','auto').go();}}).setReadOnly(true).setOption('suppressErrorHandlerWarning',true).send();break;}}}
addEventBase(obj,'keyup',callback);addEventBase(obj,'change',callback);}
function mobile_phone_nag_hide(obj){while(obj.parentNode&&obj.className!='mobile_nag'){obj=obj.parentNode;}
obj.parentNode.removeChild(obj);}

function tz_calculate(timestamp){var d=new Date();var raw_offset=d.getTimezoneOffset()/30;var time_sec=d.getTime()/1000;var time_diff=Math.round((timestamp-time_sec)/1800);var rounded_offset=Math.round(raw_offset+time_diff)%48;if(rounded_offset==0){return 0;}else if(rounded_offset>24){rounded_offset-=Math.ceil(rounded_offset/48)*48;}else if(rounded_offset<-28){rounded_offset+=Math.ceil(rounded_offset/-48)*48;}
return rounded_offset*30;}
function ajax_tz_set(tzForm){var timestamp=tzForm.time.value;var gmt_off=-tz_calculate(timestamp);var cur_gmt_off=tzForm.tz_gmt_off.value;if(gmt_off!=cur_gmt_off){var ajaxUrl='/ajax/autoset_timezone_ajax.php';new AsyncSignal(ajaxUrl,{user:tzForm.user.value,post_form_id:tzForm.post_form_id.value,gmt_off:gmt_off}).send();}}
function tz_autoset(){var tz_form=ge('tz_autoset_form');if(tz_form)
ajax_tz_set(tz_form);}

function typeaheadpro(obj,source,properties){if(!typeaheadpro.hacks){typeaheadpro.should_check_missing_events=ua.safari()<500;typeaheadpro.should_use_iframe=typeaheadpro.should_simulate_keypress=ua.ie()||(ua.safari()>500&&ua.safari()<523||ua.safari()>=525);typeaheadpro.should_use_overflow=ua.opera()<9.5||ua.safari()<500;if(ua.firefox()){this.poll_handle=setInterval(this.check_value.bind(this),100);this.deactivate_poll_on_blur=false;}
typeaheadpro.hacks=true;}
typeaheadpro.instances=(typeaheadpro.instances||[]);typeaheadpro.instances.push(this);this.instance=typeaheadpro.instances.length-1;copy_properties(this,properties||{});this.obj=obj;this.obj.typeahead=this;this.obj.onfocus=this._onfocus.bind(this);this.obj.onblur=chain(this.obj.onblur,this._onblur.bind(this));this.obj.onchange=this._onchange.bind(this);this.obj.onkeyup=function(event){return this._onkeyup(event||window.event);}.bind(this);this.obj.onkeydown=function(event){return this._onkeydown(event||window.event);}.bind(this);this.obj.onkeypress=function(event){return this._onkeypress(event||window.event);}.bind(this);this.want_icon_list=false;this.showing_icon_list=false;this.stop_suggestion_select=false;if(this.typeahead_icon_class&&this.typeahead_icon_get_return){this.typeahead_icon=document.createElement('div');this.typeahead_icon.className='typeahead_list_icon '+this.typeahead_icon_class;this.typeahead_icon.innerHTML='&nbsp;';this.setup_typeahead_icon();setTimeout(function(){this.focus();}.bind(this),50);this.typeahead_icon.onmousedown=function(event){return this.typeahead_icon_onclick(event||window.event);}.bind(this);}
this.focused=this.obj.offsetWidth?true:false;this.anchor=this.setup_anchor();this.dropdown=document.createElement('div');this.dropdown.className='typeahead_list';if(!this.focused){this.dropdown.style.display='none';}
this.anchor_block=this.anchor_block||this.anchor.tagName.toLowerCase()=='div';if(this.should_use_absolute){document.body.appendChild(this.dropdown);this.dropdown.className+=' typeahead_list_absolute';}else{var us=this.anchor;var parent=us.parentNode;if(parent.id=='qsearch_wrapper'){us=parent;parent=parent.parentNode;}
if(us.nextSibling){parent.insertBefore(this.dropdown,us.nextSibling);}else{parent.appendChild(this.dropdown);}
if(!this.anchor_block){parent.insertBefore(document.createElement('br'),this.dropdown);}}
this.dropdown.appendChild(this.list=document.createElement('div'));this.dropdown.onmousedown=function(event){return this.dropdown_onmousedown(event||window.event);}.bind(this);if(typeaheadpro.should_use_iframe&&!typeaheadpro.iframe){typeaheadpro.iframe=document.createElement('iframe');typeaheadpro.iframe.src="/common/blank.html";typeaheadpro.iframe.className='typeahead_iframe';typeaheadpro.iframe.style.display='none';typeaheadpro.iframe.frameBorder=0;document.body.appendChild(typeaheadpro.iframe);}
if(typeaheadpro.should_use_iframe&&typeaheadpro.iframe){typeaheadpro.iframe.style.zIndex=parseInt(get_style(this.dropdown,'zIndex'))-1;}
this.results_text='';this.last_key_suggestion=0;this.status=typeaheadpro.STATUS_BLOCK_ON_SOURCE_BOOTSTRAP;this.clear_placeholder();if(source){this.set_source(source);}
if(this.source){this.selectedindex=-1;if(this.focused){this.show();this._onkeyup();this.set_class('');this.capture_submit();}}else{this.hide();}}
typeaheadpro.prototype.enumerate=false;typeaheadpro.prototype.interactive=false;typeaheadpro.prototype.changed=false;typeaheadpro.prototype.render_block_size=50;typeaheadpro.prototype.typeahead_icon_class=false;typeaheadpro.prototype.typeahead_icon_get_return=false;typeaheadpro.prototype.old_value="";typeaheadpro.prototype.poll_handle=null;typeaheadpro.prototype.deactivate_poll_on_blur=true;typeaheadpro.prototype.suggestion_count=0;typeaheadpro.STATUS_IDLE=0;typeaheadpro.STATUS_WAITING_ON_SOURCE=1;typeaheadpro.STATUS_BLOCK_ON_SOURCE_BOOTSTRAP=2;typeaheadpro.prototype.should_use_absolute=false;typeaheadpro.prototype.max_results=0;typeaheadpro.prototype.max_display=10;typeaheadpro.prototype.allow_placeholders=true;typeaheadpro.prototype.auto_select=true;typeaheadpro.prototype.set_source=function(source){this.source=source;this.source.set_owner(this);this.status=typeaheadpro.STATUS_IDLE;this.cache={};this.last_search=0;this.suggestions=[];}
typeaheadpro.prototype.setup_anchor=function(){return this.obj;}
typeaheadpro.prototype.destroy=function(){if(this.typeahead_icon){this.typeahead_icon.parentNode.removeChild(this.typeahead_icon);this.toggle_icon_list=function(){};}
this.clear_render_timeouts();if(!this.anchor_block&&this.anchor.nextSibling.tagName.toLowerCase()=='br'){this.anchor.parentNode.removeChild(this.anchor.nextSibling);}
if(this.dropdown){this.dropdown.parentNode.removeChild(this.dropdown);}
this.obj.onfocus=this.obj.onblur=this.obj.onkeyup=this.obj.onkeydown=this.obj.onkeypress=null;this.obj.parentNode.removeChild(this.obj);this.anchor=this.obj=this.obj.typeahead=this.dropdown=null;delete typeaheadpro.instances[this.instance];}
typeaheadpro.prototype.check_value=function(){if(this.obj){var new_value=this.obj.value;if(new_value!=this.old_value){this.dirty_results();this.old_value=new_value;}}}
typeaheadpro.prototype._onkeyup=function(e){this.last_key=e?e.keyCode:-1;if(this.key_down==this.last_key){this.key_down=0;}
switch(this.last_key){case 27:this.selectedindex=-1;this._onselect(false);this.hide();break;}}
typeaheadpro.prototype._onkeydown=function(e){this.key_down=this.last_key=e?e.keyCode:-1;this.interactive=true;switch(this.last_key){case 33:case 34:case 38:case 40:if(typeaheadpro.should_simulate_keypress){this._onkeypress({keyCode:this.last_key});}
return false;case 9:this.select_suggestion(this.selectedindex);this.advance_focus();break;case 13:if(this.select_suggestion(this.selectedindex)){this.hide();}
if(typeof(this.submit_keydown_return)!='undefined'){this.submit_keydown_return=this._onsubmit(this.get_current_selection());}
return this.submit_keydown_return;case 229:if(!this.poll_handle){this.poll_handle=setInterval(this.check_value.bind(this),100);}
break;default:setTimeout(bind(this,'check_value'),10);}}
typeaheadpro.prototype._onkeypress=function(e){var multiplier=1;this.last_key=e?event_get_keypress_keycode(e):-1;this.interactive=true;switch(this.last_key){case 33:multiplier=this.max_display;case 38:this.set_suggestion(multiplier>1&&this.selectedindex>0&&this.selectedindex<multiplier?0:this.selectedindex-multiplier);this.last_key_suggestion=(new Date()).getTime();return false;case 34:multiplier=this.max_display;case 40:if(trim(this.get_value())==''&&!this.enumerate){this.enumerate=true;this.results_text=null;this.dirty_results();}else{this.set_suggestion(this.suggestions.length<=this.selectedindex+multiplier?this.suggestions.length-1:this.selectedindex+multiplier);this.last_key_suggestion=(new Date()).getTime();}
return false;case 13:var ret=null;if(typeof(this.submit_keydown_return)=='undefined'){ret=this.submit_keydown_return=this._onsubmit(this.get_current_selection());}else{ret=this.submit_keydown_return;delete this.submit_keydown_return;}
return ret;default:setTimeout(bind(this,'check_value'),10);break;}
return true;}
typeaheadpro.prototype._onchange=function(){this.changed=true;}
typeaheadpro.prototype._onfound=function(obj){return this.onfound?this.onfound.call(this,obj):true;}
typeaheadpro.prototype._onsubmit=function(obj){if(this.onsubmit){var ret=this.onsubmit.call(this,obj);if(ret&&this.obj.form){if(!this.obj.form.onsubmit||this.obj.form.onsubmit()){this.obj.form.submit();}
return false;}
return ret;}else{this.advance_focus();return false;}}
typeaheadpro.prototype._onselect=function(obj){if(this.onselect){this.onselect.call(this,obj);}}
typeaheadpro.prototype._onfocus=function(){if(this.last_dropdown_mouse>(new Date()).getTime()-10||this.focused){return;}
this.focused=true;this.changed=false;this.clear_placeholder();this.results_text='';this.set_class('');this.dirty_results();this.show();this.capture_submit();if(this.typeahead_icon){show(this.typeahead_icon);}}
typeaheadpro.prototype._onblur=function(event){if(!this.stop_hiding){if(this.showing_icon_list){this.toggle_icon_list(true);}}else{this.focus();return false;}
if(this.last_dropdown_mouse&&this.last_dropdown_mouse>(new Date()).getTime()-10){event_prevent(event);setTimeout(function(){this.focus()}.bind(this.obj),0);return false;}
this.focused=false;if(this.changed&&!this.interactive){this.dirty_results();this.changed=false;return;}
if(!this.suggestions){this._onselect(false);}else if(this.selectedindex>=0){this.select_suggestion(this.selectedindex);}
this.hide();this.update_class();if(!this.get_value()){var noinput=this.allow_placeholders?'':this.source.gen_noinput();this.set_value(noinput?noinput:'');this.set_class('typeahead_placeholder')}
if(this.poll_handle&&this.deactivate_poll_on_blur){clearInterval(this.poll_handle);this.poll_handle=null;}}
typeaheadpro.prototype.typeahead_icon_onclick=function(event){this.stop_hiding=true;this.focus();setTimeout(function(){this.toggle_icon_list();}.bind(this),50);event_abort(event);return false;}
typeaheadpro.prototype.dropdown_onmousedown=function(event){this.last_dropdown_mouse=(new Date()).getTime();}
typeaheadpro.prototype.setup_typeahead_icon=function(){this.typeahead_parent=document.createElement('div');this.typeahead_parent.className='typeahead_parent';this.typeahead_parent.appendChild(this.typeahead_icon);this.obj.parentNode.insertBefore(this.typeahead_parent,this.obj);}
typeaheadpro.prototype.mouse_set_suggestion=function(index){if(!this.visible){return;}
if((new Date()).getTime()-this.last_key_suggestion>50){this.set_suggestion(index);}}
typeaheadpro.prototype.capture_submit=function(){if(!typeaheadpro.should_check_missing_events)return;if((!this.captured_form||this.captured_substitute!=this.captured_form.onsubmit)&&this.obj.form){this.captured_form=this.obj.form;this.captured_event=this.obj.form.onsubmit;this.captured_substitute=this.obj.form.onsubmit=function(){return((this.key_down&&this.key_down!=13&&this.key_down!=9)?this.submit_keydown_return:(this.captured_event?this.captured_event.apply(arguments,this.captured_form):true))?true:false;}.bind(this);}}
typeaheadpro.prototype.set_suggestion=function(index){this.stop_suggestion_select=false;if(!this.suggestions||this.suggestions.length<=index){return}
var old_node=this.get_suggestion_node(this.selectedindex);this.selectedindex=(index<=-1)?-1:index;var cur_node=this.get_suggestion_node(this.selectedindex);if(old_node){old_node.className=old_node.className.replace(/\btypeahead_selected\b/,'typeahead_not_selected');}
if(cur_node){cur_node.className=cur_node.className.replace(/\btypeahead_not_selected\b/,'typeahead_selected');}
this.recalc_scroll();this._onfound(this.get_current_selection());}
typeaheadpro.prototype.get_suggestion_node=function(index){var nodes=this.list.childNodes;return index==-1?null:nodes[Math.floor(index/this.render_block_size)].childNodes[index%this.render_block_size];}
typeaheadpro.prototype.get_current_selection=function(){return this.selectedindex==-1?false:this.suggestions[this.selectedindex];}
typeaheadpro.prototype.update_class=function(){if(this.suggestions&&this.selectedindex!=-1&&typeahead_source.flatten_string(this.get_current_selection().t)==typeahead_source.flatten_string(this.get_value())){this.set_class('typeahead_found');}else{this.set_class('');}}
typeaheadpro.prototype.select_suggestion=function(index){if(!this.stop_suggestion_select&&this.current_selecting!=index){this.current_selecting=index;}
if(!this.suggestions||index==undefined||index===false||this.suggestions.length<=index||index<0){this._onfound(false);this._onselect(false);this.selectedindex=-1;this.set_class('');}else{this.selectedindex=index;this.set_value(this.suggestions[index].t);this.set_class('typeahead_found');this._onfound(this.suggestions[this.selectedindex]);this._onselect(this.suggestions[this.selectedindex]);}
if(!this.interactive){this.hide();this.blur();}
this.current_selecting=null;return true;}
typeaheadpro.prototype.set_value=function(value){this.obj.value=value;}
typeaheadpro.prototype.get_value=function(){if(this.showing_icon_list&&this.old_typeahead_value!=this.obj.value){this.toggle_icon_list();}
if(this.want_icon_list){return this.typeahead_icon_get_return;}else{if(this.showing_icon_list){this.toggle_icon_list();}}
return this.obj.value;}
typeaheadpro.prototype.found_suggestions=function(suggestions,text,fake_data){if(!suggestions){suggestions=[];}
this.suggestion_count=suggestions.length;if(!fake_data){this.status=typeaheadpro.STATUS_IDLE;this.add_cache(text,suggestions);}
this.clear_render_timeouts();if(this.get_value()==this.results_text){return;}else if(!fake_data){this.results_text=typeahead_source.flatten_string(text);if(this.enumerate&&trim(this.results_text)!=''){this.enumerate=false;}}
var current_selection=-1;if(this.selectedindex!=-1){var selected_id=this.suggestions[this.selectedindex].i;for(var i=0,l=suggestions.length;i<l;i++){if(suggestions[i].i==selected_id){current_selection=i;break;}}}
if(current_selection==-1&&this.auto_select&&suggestions.length){current_selection=0;this._onfound(suggestions[0]);}
this.selectedindex=current_selection;this.suggestions=suggestions;if(!fake_data){this.real_suggestions=suggestions;}
if(suggestions.length){var html=[],blocks=Math.ceil(suggestions.length/this.render_block_size),must_render={},firstblock,samplenode=null;this.list.innerHTML='';for(var i=0;i<blocks;i++){this.list.appendChild(document.createElement('div'));}
if(current_selection>-1){firstblock=Math.floor(current_selection/this.render_block_size);must_render[firstblock]=true;if(current_selection%this.render_block_size>this.render_block_size/2){must_render[firstblock+1]=true;}else if(firstblock!=0){must_render[firstblock-1]=true;}}else{must_render[0]=true;}
for(var node in must_render){this.render_block(node);sample=this.list.childNodes[node].firstChild;}
this.show();if(blocks){var suggestion_height=sample.offsetHeight;this.render_timeouts=[];for(var i=1;i<blocks;i++){if(!must_render[i]){this.list.childNodes[i].style.height=suggestion_height*Math.min(this.render_block_size,suggestions.length-i*this.render_block_size)+'px';this.list.childNodes[i].style.width='1px';this.render_timeouts.push(setTimeout(this.render_block.bind(this,i),700+i*50));}}}}else{this.selectedindex=-1;this.set_message(this.status==typeaheadpro.STATUS_IDLE?this.source.gen_nomatch():this.source.gen_loading());this._onfound(false);}
this.recalc_scroll();if(!fake_data&&this.results_text!=typeahead_source.flatten_string(this.get_value())){this.dirty_results();}}
typeaheadpro.prototype.render_block=function(block,stack){var suggestions=this.suggestions,selectedindex=this.selectedindex,text=this.get_value(),instance=this.instance,html=[],node=this.list.childNodes[block];for(var i=block*this.render_block_size,l=Math.min(suggestions.length,(block+1)*this.render_block_size);i<l;i++){html.push('<div class="');if(selectedindex==i){html.push('typeahead_suggestion typeahead_selected');}else{html.push('typeahead_suggestion typeahead_not_selected');}
html.push('" onmouseover="typeaheadpro.instances[',instance,'].mouse_set_suggestion(',i,')" ','onmousedown="typeaheadpro.instances[',instance,'].select_suggestion(',i,'); event_abort(event);">',this.source.gen_html(suggestions[i],text),'</div>');}
node.innerHTML=html.join('');node.style.height='auto';node.style.width='auto';}
typeaheadpro.prototype.clear_render_timeouts=function(){if(this.render_timeouts){for(var i=0;i<this.render_timeouts.length;i++){clearTimeout(this.render_timeouts[i]);}
this.render_timeouts=null;}}
typeaheadpro.prototype.recalc_scroll=function(){var cn=this.list.firstChild;if(!cn){return;}
if(cn.childNodes.length>this.max_display){var last_child=cn.childNodes[this.max_display-1];var height=last_child.offsetTop+last_child.offsetHeight;this.dropdown.style.height=height+'px';var selected=this.get_suggestion_node(this.selectedindex);if(selected){var scrollTop=this.dropdown.scrollTop;if(selected.offsetTop<scrollTop){this.dropdown.scrollTop=selected.offsetTop;}else if(selected.offsetTop+selected.offsetHeight>height+scrollTop){this.dropdown.scrollTop=selected.offsetTop+selected.offsetHeight-height;}}
if(!typeaheadpro.should_use_overflow){this.dropdown.style.overflowY='scroll';this.dropdown.style.overflowX='hidden';}}else{this.dropdown.style.height='auto';if(!typeaheadpro.should_use_overflow){this.dropdown.style.overflowY='hidden';}}}
typeaheadpro.prototype.search_cache=function(text){return this.cache[typeahead_source.flatten_string(text)];}
typeaheadpro.prototype.add_cache=function(text,results){if(this.source.cache_results){this.cache[typeahead_source.flatten_string(text)]=results;}}
typeaheadpro.prototype.update_status=function(status){this.status=status;this.dirty_results();}
typeaheadpro.prototype.set_class=function(name){this.obj.className=(this.obj.className.replace(/typeahead_[^\s]+/g,'')+' '+name).replace(/ {2,}/g,' ');}
typeaheadpro.prototype.dirty_results=function(){if(!this.enumerate&&trim(this.get_value())==''){this.results_text='';this.set_message(this.source.gen_placeholder());this.suggestions=[];this.selectedindex=-1;return;}else if(this.results_text==typeahead_source.flatten_string(this.get_value())){return;}else if(this.status==typeaheadpro.STATUS_BLOCK_ON_SOURCE_BOOTSTRAP){this.set_message(this.source.gen_loading());return;}
var time=(new Date).getTime();var updated=false;if(this.last_search<=(time-this.source.search_limit)&&this.status==typeaheadpro.STATUS_IDLE){updated=this.perform_search();}else{if(this.status==typeaheadpro.STATUS_IDLE){if(!this.search_timeout){this.search_timeout=setTimeout(function(){this.search_timeout=false;if(this.status==typeaheadpro.STATUS_IDLE){this.dirty_results();}}.bind(this),this.source.search_limit-(time-this.last_search));}}}
if(this.source.allow_fake_results&&this.real_suggestions&&!updated){var ttext=typeahead_source.tokenize(this.get_value()).sort(typeahead_source._sort);var fake_results=[];for(var i=0;i<this.real_suggestions.length;i++){if(typeahead_source.check_match(ttext,this.real_suggestions[i].t+' '+this.real_suggestions[i].n)){fake_results.push(this.real_suggestions[i]);}}
if(fake_results.length){this.found_suggestions(fake_results,this.get_value(),true);}else{this.selectedindex=-1;this.set_message(this.source.gen_loading());}}}
typeaheadpro.prototype.perform_search=function(){if(this.get_value()==this.results_text){return true;}
var results;if((results=this.search_cache(this.get_value()))===undefined&&!(results=this.source.search_value(this.get_value()))){this.status=typeaheadpro.STATUS_WAITING_ON_SOURCE;this.last_search=(new Date).getTime();return false;}
this.found_suggestions(results,this.get_value(),false);return true;}
typeaheadpro.prototype.set_message=function(text){this.clear_render_timeouts();if(text){this.list.innerHTML='<div class="typeahead_message">'+text+'</div>';this.reset_iframe();}else{this.hide();}
this.recalc_scroll();}
typeaheadpro.prototype.reset_iframe=function(){if(!typeaheadpro.should_use_iframe){return}
if(this.should_use_absolute){typeaheadpro.iframe.style.top=this.dropdown.style.top;typeaheadpro.iframe.style.left=this.dropdown.style.left;}else{typeaheadpro.iframe.style.top=elementY(this.dropdown)+'px';typeaheadpro.iframe.style.left=elementX(this.dropdown)+'px';}
typeaheadpro.iframe.style.width=this.dropdown.offsetWidth+'px';typeaheadpro.iframe.style.height=this.dropdown.offsetHeight+'px';typeaheadpro.iframe.style.display='';}
typeaheadpro.prototype.advance_focus=function(){var inputs=this.obj.form?get_all_form_inputs(this.obj.form):get_all_form_inputs();var next_inputs=false;for(var i=0;i<inputs.length;i++){if(next_inputs){if(inputs[i].type!='hidden'&&inputs[i].tabIndex!=-1&&inputs[i].offsetParent){next_inputs.push(inputs[i]);}}else if(inputs[i]==this.obj){next_inputs=[];}}
setTimeout(function(){for(var i=0;i<this.length;i++){try{if(this[i].offsetParent){this[i].focus();setTimeout(function(){try{this.focus();}catch(e){}}.bind(this[i]),0);return;}}catch(e){}}}.bind(next_inputs?next_inputs:[]),0);}
typeaheadpro.prototype.clear_placeholder=function(){if(this.obj.className.indexOf('typeahead_placeholder')!=-1){this.set_value('');this.set_class('');}}
typeaheadpro.prototype.clear=function(){this.set_value('');this.set_class('');this.selectedindex=-1;this.enumerate=false;this.dirty_results();}
typeaheadpro.prototype.hide=function(){if(this.stop_hiding){return;}
this.visible=false;if(this.should_use_absolute){this.dropdown.style.display='none';}else{this.dropdown.style.visibility='hidden';}
this.clear_render_timeouts();if(typeaheadpro.should_use_iframe){typeaheadpro.iframe.style.display='none';}}
typeaheadpro.prototype.show=function(){this.visible=true;if(this.focused){if(this.should_use_absolute){this.dropdown.style.top=elementY(this.anchor)+this.anchor.offsetHeight+'px';this.dropdown.style.left=elementX(this.anchor)+'px';}
this.dropdown.style.width=(this.anchor.offsetWidth-2)+'px';this.dropdown.style[this.should_use_absolute?'display':'visibility']='';if(typeaheadpro.should_use_iframe){typeaheadpro.iframe.style.display='';this.reset_iframe();}}}
typeaheadpro.prototype.toggle_icon_list=function(no_focus){if(this.showing_icon_list){this.showing_icon_list=false;this.source.showing_icon_list=false;if(!no_focus){this.focus();}
remove_css_class_name(this.typeahead_icon,'on_selected');this.want_icon_list=false;this.showing_icon_list=false;this.stop_suggestion_select=true;if(this.obj){this.dirty_results();}}else{this.source.showing_icon_list=true;this.old_typeahead_value=this.obj.value;this.stop_suggestion_select=true;this.want_icon_list=true;this.dirty_results();this.focus();add_css_class_name(this.typeahead_icon,'on_selected');this.show();this.set_suggestion(-1);this.showing_icon_list=true;}
setTimeout(function(){this.stop_hiding=false;}.bind(this),100)}
typeaheadpro.prototype.focus=function(){this.obj.focus();}
typeaheadpro.prototype.blur=function(){this.obj.blur();}
typeaheadpro.kill_typeahead=function(obj){if(obj.typeahead){if(!this.should_use_absolute&&!this.anchor_block){obj.parentNode.removeChild(obj.nextSibling);}
obj.parentNode.removeChild(obj.nextSibling);if(obj.typeahead.source){obj.typeahead.source=obj.typeahead.source.owner=null;}
obj.onfocus=obj.onblur=obj.onkeypress=obj.onkeyup=obj.onkeydown=obj.typeahead=null;}}
function tokenizer(obj,typeahead_source,nofocus,max_selections,properties){if(ua.safari()<500){tokenizer.valid_arrow_count=0;tokenizer.valid_arrow_event=function(){return tokenizer.valid_arrow_count++%2==0};}else{tokenizer.valid_arrow_event=function(){return true};}
this.obj=obj;this.obj.tokenizer=this;this.typeahead_source=typeahead_source;while(!/\btokenizer\b/.test(this.obj.className)){this.obj=this.obj.parentNode;}
this.tab_stop=this.obj.getElementsByTagName('input')[0];this.inputs=[];this.obj.onmousedown=function(event){return this._onmousedown(event?event:window.event)}.bind(this);this.tab_stop.onfocus=function(event){return this._onfocus(event?event:window.event)}.bind(this);this.tab_stop.onblur=function(event){return this.tab_stop_onblur(event?event:window.event)}.bind(this);this.tab_stop.onkeydown=function(event){return this.tab_stop_onkeydown(event?event:window.event)}.bind(this);if(!nofocus&&elementY(this.obj)>0&&this.obj.offsetWidth){this._onfocus();}
this.max_selections=max_selections;copy_properties(this,properties||{});this.properties=properties;}
tokenizer.is_empty=function(obj){if(has_css_class_name(obj,'tokenizer_locked')){return obj.getElementsByTagName('input').length==0;}else{return(!obj.tokenizer||obj.tokenizer.count_names()==0);}}
tokenizer.prototype.get_token_values=function(){var r=[];var inputs=this.obj.getElementsByTagName('input');for(var i=0;i<inputs.length;++i){if(inputs[i].name&&inputs[i].value){r.push(inputs[i].value);}}
return r;}
tokenizer.prototype.get_token_strings=function(){var r=[];var tokens=this.obj.getElementsByTagName('a');for(var i=0;i<tokens.length;++i){if(typeof tokens[i].token!='undefined'){r.push(tokens[i].token.text);}}
return r;}
tokenizer.prototype.clear=function(){var tokens=this.obj.getElementsByTagName('a');for(var i=tokens.length-1;i>=0;--i){if(typeof tokens[i].token!='undefined'){tokens[i].token.remove();}}}
tokenizer.prototype._onmousedown=function(event){if(this.onfocus){this.onfocus();}
setTimeout(function(){if(!this.inputs.length){if(this.max_selections>this.count_names()){new tokenizer_input(this);}else{var tokens=this.obj.getElementsByTagName('a');for(var i=tokens.length-1;i>=0;i--){if(typeof tokens[i].token!='undefined'){tokens[i].token.select();break;}}}}else{this.inputs[0].focus();}}.bind(this),0);event?event.cancelBubble=true:false;return false;}
tokenizer.prototype._onfocus=function(event){if(this.tab_stop_ignore_focus){this.tab_stop_ignore_focus=false;return;}
this._onmousedown();}
tokenizer.prototype.tab_stop_onblur=function(event){this.selected_token?this.selected_token.deselect():false;}
tokenizer.prototype.tab_stop_onkeydown=function(event){if(!event.keyCode||!this.selected_token){return;}
switch(event.keyCode){case 8:case 46:var tok=this.selected_token;var prev=tok.element.previousSibling;if(prev&&prev.input){prev.input.element.focus();}else{new tokenizer_input(this,tok.element);}
tok.remove();return false;case 37:if(!tokenizer.valid_arrow_event()){break;}
var tok=this.selected_token;var prev=tok.element.previousSibling;if(prev&&prev.input){prev.input.element.focus();}else if(this.max_selections>this.count_names()){new tokenizer_input(this,tok.element);}else{return false;}
tok.deselect();return false;case 39:if(!tokenizer.valid_arrow_event()){break;}
var tok=this.selected_token;var next=tok.element.nextSibling;if(next&&next.input){next.input.focus();}else if(this.max_selections>this.count_names()){new tokenizer_input(this,tok.element.nextSibling);}else{return false;}
tok.deselect();return false;}}
tokenizer.prototype.count_names=function(plus){var inputs=this.obj.getElementsByTagName('input');var uniq={};var count=0;for(var i=0;i<inputs.length;i++){if(inputs[i].type=='hidden'&&!uniq[inputs[i].value]){uniq[inputs[i].value]=true;++count;}}
if(plus){for(var j=0;j<plus.length;j++){if(!uniq[plus[j]]){uniq[plus[j]]=true;++count;}}}
return count;}
tokenizer.prototype.disable=function(){this.tab_stop.parentNode.removeChild(this.tab_stop);this.obj.className+=' tokenizer_locked';}
function tokenizer_input(tokenizer,caret){if(!tokenizer_input.hacks){tokenizer_input.should_use_borderless_hack=ua.safari();tokenizer_input.should_use_shadow_hack=ua.ie()||ua.opera();tokenizer_input.hacks=true;}
this.tokenizer=tokenizer;this.obj=document.createElement('input');this.obj.input=this;this.obj.tabIndex=-1;this.obj.size=1;this.obj.onmousedown=function(event){(event?event:window.event).cancelBubble=true}.bind(this);this.shadow=document.createElement('span');this.shadow.className='tokenizer_input_shadow';this.element=document.createElement('div');this.element.className='tokenizer_input'+(tokenizer_input.should_use_borderless_hack?' tokenizer_input_borderless':'');this.element.appendChild(document.createElement('div'));this.element.firstChild.appendChild(this.obj);(tokenizer_input.should_use_shadow_hack?document.body:this.element.firstChild).appendChild(this.shadow);caret?tokenizer.obj.insertBefore(this.element,caret):tokenizer.obj.appendChild(this.element);this.tokenizer.tab_stop.disabled=true;this.update_shadow();this.update_shadow=this.update_shadow.bind(this);this.tokenizer.inputs.push(this);this.parent.construct(this,this.obj,this.tokenizer.typeahead_source);if(this.focused){this.focus();this.obj.select();}
copy_properties(this,tokenizer.properties||{});setInterval(this.update_shadow.bind(this),100);}
tokenizer_input.extend(typeaheadpro);tokenizer_input.prototype.gen_nomatch=tokenizer_input.prototype.gen_loading=tokenizer_input.prototype.gen_placeholder=tokenizer_input.prototype.gen_noinput='';tokenizer_input.prototype.max_display=8;tokenizer_input.prototype.setup_anchor=function(){return this.tokenizer.obj;}
tokenizer_input.prototype.update_shadow=function(){try{var val=this.obj.value;}catch(e){return};if(this.shadow_input!=val){this.shadow.innerHTML=htmlspecialchars((this.shadow_input=val)+'^_^');if(tokenizer_input.should_use_shadow_hack){this.obj.style.width=this.shadow.offsetWidth+'px';this.obj.value=val;}}}
tokenizer_input.prototype._onblur=function(){if(this.parent._onblur()===false){return false;}
if(this.changed&&!this.interactive){this.dirty_results();this.changed=false;return;}
if(this.changed||this.interactive){this.select_suggestion(this.selectedindex);}
setTimeout(function(){this.disabled=false}.bind(this.tokenizer.tab_stop),1000);tokenizerToDestroy=this;setTimeout(function(){tokenizerToDestroy.destroy();},0);}
tokenizer_input.prototype._onfocus=function(){this.tokenizer.tab_stop.disabled=true;this.parent._onfocus();return true;}
tokenizer_input.prototype._onkeydown=function(event){switch(event.keyCode){case 13:break;case 37:case 8:if(this.get_selection_start()!=0||this.obj.value!=''){break;}
var prev=this.element.previousSibling;if(prev&&prev.token){setTimeout(prev.token.select.bind(prev.token),0);}
break;case 39:case 46:if(this.get_selection_start()!=this.obj.value.length){break;}
var next=this.element.nextSibling;if(next&&next.token){setTimeout(next.token.select.bind(next.token),0);}
break;case 188:this._onkeydown({keyCode:13});return false;case 9:if(this.obj.value){this.advance_focus();this._onkeydown({keyCode:13});return false;}else if(!event.shiftKey){this.advance_focus();this.parent._onkeydown(event);return false;}
break;}
return this.parent._onkeydown(event);}
tokenizer_input.prototype._onkeypress=function(event){switch(event.keyCode){case 9:return false;}
setTimeout(this.update_shadow,0);return this.parent._onkeypress(event);}
tokenizer_input.prototype.select_suggestion=function(index){if(this.suggestions&&index>=0&&this.suggestions.length>index){var inputs=this.tokenizer.obj.getElementsByTagName('input');var id=this.suggestions[index].i;for(i=0;i<inputs.length;i++){if(inputs[i].name=='ids[]'&&inputs[i].value==id){return false;}}}
return this.parent.select_suggestion(index);}
tokenizer_input.prototype.get_selection_start=function(){if(this.obj.selectionStart!=undefined){return this.obj.selectionStart;}else{return Math.abs(document.selection.createRange().moveStart('character',-1024));}}
tokenizer_input.prototype.onselect=function(obj){if(obj){var inputs=this.tokenizer.obj.getElementsByTagName('input');for(i=0;i<inputs.length;i++){if(inputs[i].name=='ids[]'&&inputs[i].value==obj.i){return false;}}
new token(obj,this.tokenizer,this.element);if(this.tokenizer.max_selections>this.tokenizer.count_names()){this.clear();}else{this.destroy();this.hide=function(){};return false;}}
if(obj){this.tokenizer._ontokenadded(obj);}
this.tokenizer.typeahead_source.onselect_not_found.call(this);return false;}
tokenizer.prototype._ontokenadded=function(obj){if(this.ontokenadded){this.ontokenadded.call(this,obj);}}
tokenizer.prototype._ontokenremoved=function(obj){if(this.ontokenremoved){this.ontokenremoved.call(this,obj);}}
tokenizer.prototype._ontokennotfound=function(text){if(this.ontokennotfound){this.ontokennotfound.call(this,text);}}
tokenizer_input.prototype._onsubmit=function(){return false;}
tokenizer_input.prototype.capture_submit=function(){return false;}
tokenizer_input.prototype.clear=function(){this.parent.clear();this.update_shadow();}
tokenizer_input.prototype.destroy=function(){if(tokenizer_input.should_use_shadow_hack){this.shadow.parentNode.removeChild(this.shadow);}
this.element.parentNode.removeChild(this.element);this.element=null;var index=this.tokenizer.inputs.indexOf(this);if(index!=-1){this.tokenizer.inputs.splice(index,1);}
this.tokenizer=this.element=this.shadow=null;this.parent.destroy();return null;}
function token(obj,tokenizer,caret){if(obj.is&&(tokenizer.count_names(obj.is)>tokenizer.max_selections)){(new contextual_dialog).set_context(tokenizer.obj).show_prompt(tx('ta12'),tx('ta13')).fade_out(500,1500);return null;}
this.tokenizer=tokenizer;this.element=document.createElement('a');this.element.className='token';this.element.href='#';this.element.tabIndex=-1;this.element.onclick=function(event){return this._onclick(event?event:window.event)}.bind(this);this.element.onmousedown=function(event){(event?event:window.event).cancelBubble=true;return false};this.render_obj(obj);this.obj=obj;this.element.token=this;caret?this.tokenizer.obj.insertBefore(this.element,caret):this.tokenizer.obj.appendChild(this.element);}
token.prototype.render_obj=function(obj){var inputs='';if(obj.np){var my_protected='';}else{var my_protected='my_protected="true" ';}
if(obj.e){inputs=['<input type="hidden" ',my_protected,'name="emails[]" value="',obj.e,'" />'].join('');}else if(obj.i){inputs=['<input type="hidden" ',my_protected,'name="',this.tokenizer.obj.id,'[]" value="',obj.i,'" />'].join('');}else if(obj.is){for(var i=0,il=obj.is.length;i<il;i++){inputs+=['<input type="hidden" ',my_protected,'name="',this.tokenizer.obj.id,'[]" value="',obj.is[i],'" />'].join('');}
this.explodable=true;this.n=obj.n;}
this.text=obj.t;this.element.innerHTML=['<span><span><span><span>',inputs,htmlspecialchars(obj.t),'<span onclick="this.parentNode.parentNode.parentNode.parentNode.parentNode.token.remove(true); event.cancelBubble=true; return false;" ','onmouseover="this.className=\'x_hover\'" onmouseout="this.className=\'x\'" class="x">&nbsp;</span>','</span></span></span></span>'].join('');}
token.prototype._onclick=function(event){var this_select_time=(new Date()).getTime();if(this.explodable&&this.tokenizer.last_select_time&&(this_select_time-this.tokenizer.last_select_time<1400)){var to_add=this.n;this.remove();var inputs=this.tokenizer.obj.getElementsByTagName('input');var already_ids={};for(var i=0;i<inputs.length;++i){if(inputs[i].name=='ids[]'){already_ids[inputs[i].value]=true;}}
for(var id in to_add){if(!already_ids[id]){new token({'t':to_add[id],'i':id},this.tokenizer);}}}else{this.select();}
this.tokenizer.last_select_time=this_select_time;event.cancelBubble=true;return false;}
token.prototype.select=function(again){if(this.tokenizer.selected_token&&!again){this.tokenizer.selected_token.deselect();}
this.element.className=trim(this.element.className.replace('token_selected',''))+' token_selected';this.tokenizer.tab_stop_ignore_focus=true;if(this.tokenizer.tab_stop.disabled){this.tokenizer.tab_stop.disabled=false;}
this.tokenizer.tab_stop.focus();this.tokenizer.selected_token=this;if(again!==true){setTimeout(function(){this.select(true)}.bind(this),0);}else{setTimeout(function(){this.tab_stop_ignore_focus=false}.bind(this.tokenizer),0);}}
token.prototype.remove=function(focus){this.element.parentNode.removeChild(this.element);this.element.token=null;this.tokenizer.selected_token=null;if(focus){this.tokenizer._onmousedown();}
if(this.obj){this.tokenizer._ontokenremoved(this.obj);}}
token.prototype.deselect=function(){this.element.className=trim(this.element.className.replace('token_selected',''));this.tokenizer.selected_token=null;}
function typeahead_source(){}
typeahead_source.prototype.cache_results=false;typeahead_source.prototype.enumerable=false;typeahead_source.prototype.allow_fake_results=false;typeahead_source.prototype.search_limit=10;typeahead_source.check_match=function(search,value){value=typeahead_source.tokenize(value);for(var i=0,il=search.length;i<il;i++){if(search[i].length){var found=false;for(var j=0,jl=value.length;j<jl;j++){if(value[j].length>=search[i].length&&value[j].substring(0,search[i].length)==search[i]){found=true;value[j]='';break;}}
if(!found){return false;}}}
return true;}
typeahead_source.tokenize=function(text,capture,noflatten){return(noflatten?text:typeahead_source.flatten_string(text)).split(capture?typeahead_source.normalizer_regex_capture:typeahead_source.normalizer_regex);}
typeahead_source.normalizer_regex_str='(?:(?:^| +)["\'.\\-]+ *)|(?: *[\'".\\-]+(?: +|$)|@| +)';typeahead_source.normalizer_regex=new RegExp(typeahead_source.normalizer_regex_str,'g');typeahead_source.normalizer_regex_capture=new RegExp('('+typeahead_source.normalizer_regex_str+')','g');typeahead_source.flatten_string=function(text){if(!typeahead_source.accents){typeahead_source.accents={a:/à|á|â|ã|ä|å/g,c:/ç/g,d:/ð/g,e:/è|é|ê|ë/g,i:/ì|í|î|ï/g,n:/ñ/g,o:/ø|ö|õ|ô|ó|ò/g,u:/ü|û|ú|ù/g,y:/ÿ|ý/g,ae:/æ/g,oe:/œ/g}}
text=text.toLowerCase();for(var i in typeahead_source.accents){text=text.replace(typeahead_source.accents[i],i);}
return text;}
typeahead_source.prototype.set_owner=function(obj){this.owner=obj;if(this.is_ready){this.owner.update_status(typeaheadpro.STATUS_IDLE);}}
typeahead_source.prototype.ready=function(){if(this.owner&&!this.is_ready){this.is_ready=true;this.owner.update_status(typeaheadpro.STATUS_IDLE);}else{this.is_ready=true;}}
typeahead_source.highlight_found=function(result,search){var html=[];resultv=typeahead_source.tokenize(result,true,true);result=typeahead_source.tokenize(result,true);search=typeahead_source.tokenize(search);search.sort(typeahead_source._sort);for(var i=0,il=resultv.length;i<il;i++){var found=false;for(var j=0,jl=search.length;j<jl;j++){if(search[j]&&result[i].lastIndexOf(search[j],0)!=-1){html.push('<em>',htmlspecialchars(resultv[i].substring(0,search[j].length)),'</em>',htmlspecialchars(resultv[i].substring(search[j].length,resultv[i].length)));found=true;break;}}
if(!found){html.push(htmlspecialchars(resultv[i]));}}
return html.join('');}
typeahead_source._sort=function(a,b){return b.length-a.length;}
typeahead_source.prototype.gen_nomatch=function(){return this.text_nomatch!=null?this.text_nomatch:tx('ta01');}
typeahead_source.prototype.gen_loading=function(){return this.text_loading!=null?this.text_loading:tx('ta02');}
typeahead_source.prototype.gen_placeholder=function(){return this.text_placeholder!=null?this.text_placeholder:tx('ta03');}
typeahead_source.prototype.gen_noinput=function(){return this.text_noinput!=null?this.text_noinput:tx('ta03');}
typeahead_source.prototype.onselect_not_found=function(){if(typeof this.tokenizer._ontokennotfound!='undefined'){this.tokenizer._ontokennotfound(this.obj.value);}
if(typeof this.tokenizer.onselect!='undefined'){return this.tokenizer.onselect();}}
function static_source(){this.values=null;this.index=null;this.index_includes_hints=false;this.exclude_ids={};this.parent.construct(this);}
static_source.extend(typeahead_source);static_source.prototype.enumerable=true;static_source.prototype.build_index=function(no_defer){var index=[];var values=this.values;var gen_id=values.length&&typeof values[0].i=='undefined';for(var i=0,il=values.length;i<il;i++){var tokens=typeahead_source.tokenize(values[i].t);for(var j=0,jl=tokens.length;j<jl;j++){index.push({t:tokens[j],o:values[i]});}
if(this.index_includes_hints&&values[i].s){var tokens=typeahead_source.tokenize(values[i].s);for(var j=0,jl=tokens.length;j<jl;j++){index.push({t:tokens[j],o:values[i]});}}
if(gen_id){values[i].i=i;}}
var index_sort_and_ready=function(){index.sort(function(a,b){return(a.t==b.t)?0:(a.t<b.t?-1:1)});this.index=index;this.ready();}.bind(this);if(no_defer){index_sort_and_ready();}else{index_sort_and_ready.defer();}}
static_source.prototype._sort_text_obj=function(a,b){if(a.e&&!b.e){return 1;}
if(!a.e&&b.e){return-1;}
if(a.t==b.t){return 0;}
return a.t<b.t?-1:1}
static_source.prototype.search_value=function(text){if(!this.is_ready){return;}
var results;if(text==''){results=this.values;}else{var ttext=typeahead_source.tokenize(text).sort(typeahead_source._sort);var index=this.index;var lo=0;var hi=this.index.length-1;var p=Math.floor(hi/2);while(lo<=hi){if(index[p].t>=ttext[0]){hi=p-1;}else{lo=p+1;}
p=Math.floor(lo+((hi-lo)/2));}
var results=[];var stale_keys={};var check_ignore=typeof _ignoreList!='undefined';for(var i=lo;i<index.length&&index[i].t.lastIndexOf(ttext[0],0)!=-1;i++){var elem_id=index[i].o.flid?index[i].o.flid:index[i].o.i;if(typeof stale_keys[elem_id]!='undefined'){continue;}else{stale_keys[elem_id]=true;}
if((!check_ignore||!_ignoreList[elem_id])&&!this.exclude_ids[elem_id]&&(ttext.length==1||typeahead_source.check_match(ttext,index[i].o.t))){results.push(index[i].o);}}}
results.sort(this._sort_text_obj);if(this.owner.max_results){results=results.slice(0,this.owner.max_results);}
return results;}
static_source.prototype.set_exclude_ids=function(ids){this.exclude_ids=ids;}
function friend_source(get_param){this.parent.construct(this);if(friend_source.friends[get_param]){this.values=friend_source.friends[get_param];this.index=friend_source.friends_index[get_param];this.ready();}else{new AsyncRequest().setMethod('GET').setReadOnly(true).setURI('/ajax/typeahead_friends.php?'+get_param).setHandler(function(response){friend_source.friends[get_param]=this.values=response.getPayload().friends;this.build_index();friend_source.friends_index[get_param]=this.index;}.bind(this)).send();}}
friend_source.extend(static_source);friend_source.prototype.text_noinput=friend_source.prototype.text_placeholder=tx('ta04');friend_source.friends={};friend_source.friends_index={};friend_source.prototype.cache_results=true;friend_source.prototype.gen_html=function(friend,highlight){var text=friend.n;if(friend.n===false){text=tx('ta16');}else if(typeof(friend.n)=="object"){var names=[];for(var k in friend.n){names.push(friend.n[k]);}
if(names.length>3){text=tx('ta15',{name1:names[0],name2:names[1],count:names.length-2});}else if(names.length){text=names.join(', ');}else{text=tx('ta16');}}
return['<div>',typeahead_source.highlight_found(friend.t,highlight),'</div><div><small>',text,'</small></div>'].join('');}
friend_source.prototype.search_value=function(text){if(text=='\x5e\x5f\x5e'){return[{t:text,n:'\x6b\x65\x6b\x65',i:10,it:'http://static.ak.Manyou.com/pics/t_default.jpg'}];}
return this.parent.search_value(text);}
function friendlist_source(get_param){this.parent.construct(this,get_param);}
friendlist_source.extend(friend_source);friendlist_source.prototype.friend_lists=false;friendlist_source.prototype.text_placeholder=tx('ta18');friendlist_source.prototype.return_friend_lists=function(){if(!this.friend_lists||(this.friend_lists&&this.friend_lists.length==0)){this.friend_lists=[];var index=this.index;var results=[];var pushed=[];if(!index.length||!(index.length>=1)){return;}
for(var i=0;i<index.length;i++){if(index[i].o.flid&&!pushed[index[i].o.flid]){pushed[index[i].o.flid]=true;results.push(index[i].o);}}
var results_sorted=results.sort(function(a,b){if(a.t>b.t)return 1;else if(a.t<b.t)return-1;else return 0;});this.friend_lists=results_sorted;}
return this.friend_lists;}
friendlist_source.prototype.search_value=function(text){if(text=='**FRIENDLISTS**'){return this.return_friend_lists();}
return this.parent.search_value(text);}
friendlist_source.prototype.gen_nomatch=function(){if(this.showing_icon_list){return tx('ta17');}else{return this.parent.gen_nomatch();}}
function friend_and_email_source(get_param){get_param=get_param?get_param+'&include_emails=1':'';this.parent.construct(this,get_param);}
friend_and_email_source.extend(friend_source);friend_and_email_source.prototype.text_noinput=friend_and_email_source.prototype.text_placeholder=tx('ta05');friend_and_email_source.prototype.text_nomatch=tx('ta06');friend_and_email_source.prototype.onselect_not_found=function(){emails=this.results_text.split(/[,; ]/);for(var i=0;i<emails.length;i++){var text=emails[i].replace(/^\s+|\s+$/g,'');var email_regex=/.*\@.*\.[a-z]+$/;if(!email_regex.test(text)){continue;}
var email_entry={t:text,e:text};var new_token=new token(email_entry,this.tokenizer,this.element);var async_params={email:text};new AsyncRequest().setMethod('GET').setReadOnly(true).setURI('/ajax/typeahead_email.php').setData(async_params).setHandler(function(response){if(response.getPayload()){this.render_obj(response.getPayload().token);}}.bind(new_token)).send();}
this.clear();}
function network_source(get_selected_type){this.get_selected_type=get_selected_type;this.parent.construct(this);this.ready();}
network_source.extend(typeahead_source);network_source.prototype.cache_results=true;network_source.prototype.search_limit=200;network_source.prototype.text_placeholder=network_source.prototype.text_noinput=tx('ta07');network_source.prototype.base_uri='';network_source.prototype.allow_fake_results=true;network_source.prototype.search_value=function(text){this.search_text=text;var async_params={q:text};if((type=typeof(this.get_selected_type))!='undefined'){async_params['t']=(type!='string')?JSON.encode(this.get_selected_type):this.get_selected_type;}
if((type=typeof(this.t))!='undefined'){async_params['t']=(type!='string')?JSON.encode(this.t):this.t;}
if(this.show_email){async_params['show_email']=1;}
if(this.show_network_type){async_params['show_network_type']=1;}
if(this.disable_school_status){async_params['disable_school_status']=1;}
new AsyncRequest().setReadOnly(true).setMethod('GET').setURI('/ajax/typeahead_networks.php').setData(async_params).setHandler(function(response){this.owner.found_suggestions(response.getPayload(),this.search_text);}.bind(this)).setErrorHandler(function(response){this.owner.found_suggestions(false,this.search_text);}.bind(this)).send();}
network_source.prototype.gen_html=function(result,highlight){return['<div>',typeahead_source.highlight_found(result.t,highlight),'</div><div><small>',typeahead_source.highlight_found(result.l,highlight),'</small></div>'].join('');}
function custom_source(options){this.parent.construct(this);if(options.length&&typeof(options[0])=="string"){for(var ii=0;ii<options.length;ii++){options[ii]={t:options[ii],i:options[ii]};}}
this.values=options;this.build_index();}
custom_source.extend(static_source);custom_source.prototype.text_placeholder=custom_source.prototype.text_noinput=false;custom_source.prototype.gen_html=function(result,highlight){var html=['<div>',typeahead_source.highlight_found(result.t,highlight),'</div>'];if(result.s){html.push('<div><small>',htmlspecialchars(result.s),'</small></div>');}
return html.join('');}
function concentration_source(get_network){this.parent.construct(this,[]);this.network=get_network;if(!concentration_source.networks){concentration_source.networks=[];}else{for(var i=0,il=concentration_source.networks.length;i<il;i++){if(concentration_source.networks[i].n==this.network){this.values=concentration_source.networks[i].v;this.index=concentration_source.networks[i].i;this.ready();return;}}}
new AsyncRequest().setURI('/ajax/typeahead_concentrations.php?n='+this.network).setHandler(function(response){this.values=response.getPayload();this.build_index();concentration_source.networks.push({n:this.network,v:this.values,i:this.index});this.ready();}.bind(this)).send();}
concentration_source.extend(custom_source);concentration_source.prototype.noinput=false;concentration_source.prototype.text_placeholder=tx('ta08');concentration_source.prototype.allow_fake_results=true;function language_source(){this.parent.construct(this,[]);if(!language_source.languages){language_source.languages=[];}else{for(var i=0,il=language_source.languages.length;i<il;i++){this.values=language_source.languages[i].v;this.index=language_source.languages[i].i;this.ready();return;}}
new AsyncRequest().setURI('/ajax/typeahead_languages.php').setHandler(function(response){this.values=response.getPayload();this.build_index();language_source.languages.push({v:this.values,i:this.index});this.ready();}.bind(this)).send();}
language_source.extend(custom_source);language_source.prototype.noinput=false;language_source.prototype.text_placeholder=tx('ta14');language_source.prototype.allow_fake_results=false;function keyword_source(get_category){this.parent.construct(this,[]);this.category=get_category;if(!keyword_source.categories){keyword_source.categories=[];}else{for(var i=0,il=keyword_source.categories.length;i<il;i++){if(keyword_source.categories[i].c==this.category){this.values=keyword_source.categories[i].v;this.index=keyword_source.categories[i].i;this.ready();return;}}}
new AsyncRequest().setURI('/ajax/typeahead_keywords.php').setData({c:this.category}).setMethod('GET').setReadOnly(true).setHandler(function(response){this.values=response.getPayload();this.build_index();keyword_source.categories.push({c:this.category,v:this.values,i:this.index});this.ready();}.bind(this)).send();}
keyword_source.extend(custom_source);keyword_source.prototype.noinput=false;keyword_source.prototype.text_placeholder=tx('ta09');function regions_source(get_iso2){this.parent.construct(this,[]);this.country=get_iso2;this.reload();}
regions_source.extend(custom_source);regions_source.prototype.noinput=false;regions_source.prototype.text_placeholder=tx('ta10');regions_source.prototype.reload=function(){new AsyncRequest().setMethod('GET').setReadOnly(true).setURI('/ajax/typeahead_regions.php').setData({c:this.country}).setHandler(function(response){this.values=response.getPayload();this.build_index();this.ready();}.bind(this)).send();}
function time_source(){this.status=0;this.parent.construct(this);}
time_source.extend(typeahead_source);time_source.prototype.cache_results=true;time_source.prototype.text_placeholder=time_source.prototype.text_noinput=tx('ta11');time_source.prototype.base_uri='';time_source.prototype.search_value=function(text){this.search_text=text;var async_params={q:text};new AsyncRequest().setURI('/ajax/typeahead_time.php').setMethod('GET').setReadOnly(true).setData(async_params).setHandler(function(response){this.owner.found_suggestions(response.getPayload(),this.search_text);}.bind(this)).setErrorHandler(function(response){this.owner.found_suggestions(false,this.search_text);}.bind(this)).send();}
time_source.prototype.gen_html=function(result,highlight){return['<div>',typeahead_source.highlight_found(result.t,highlight),'</div>'].join('');}
function dynamic_custom_source(async_url){this.async_url=async_url;this.parent.construct(this);}
dynamic_custom_source.extend(typeahead_source);dynamic_custom_source.cache_results=true;dynamic_custom_source.prototype.search_value=function(text){this.search_text=text;var async_params={q:text};var r=new AsyncRequest().setURI(this.async_url).setData(async_params).setHandler(bind(this,function(r){this.owner.found_suggestions(r.getPayload(),this.search_text,false);})).setErrorHandler(bind(this,function(r){this.owner.found_suggestions(false,this.search_text,false);})).setReadOnly(true).send()}
dynamic_custom_source.prototype.gen_html=function(result,highlight){var html=['<div>',this.highlight_found(result.t,highlight),'</div>'];if(result.s){html.push('<div class="sub_result"><small>',result.s,'</small></div>');}
return html.join('');}
dynamic_custom_source.prototype.highlight_found=function(result,search){return typeahead_source.highlight_found(result,search);}
function ad_targeting_cluster_source(act){this.parent.construct(this,[]);if(!ad_targeting_cluster_source.clusters){ad_targeting_cluster_source.clusters=[];}else{for(var i=0,il=ad_targeting_cluster_source.clusters.length;i<il;i++){this.values=ad_targeting_cluster_source.clusters[i].v;this.index=ad_targeting_cluster_source.clusters[i].i;this.ready();return;}}
new AsyncRequest().setURI('/ads/ajax/typeahead_clusters.php').setData({'act':act}).setHandler(function(response){this.values=response.getPayload();this.build_index();ad_targeting_cluster_source.clusters.push({v:this.values,i:this.index});this.ready();}.bind(this)).send();}
ad_targeting_cluster_source.extend(custom_source);

function generic_dialog(className,modal){this.className=className;this.content=null;this.obj=null;this.popup=null;this.overlay=null;this.modal=null;this.iframe=null;this.hidden_objects=[];if(modal==true){this.modal=true;}}
generic_dialog.dialog_stack=null;generic_dialog.prototype.setClassName=function(className){this.className=className;};generic_dialog.hide_all=function(){if(generic_dialog.dialog_stack!==null){var stack=generic_dialog.dialog_stack.clone();generic_dialog.dialog_stack=null;for(var i=stack.length-1;i>=0;i--){stack[i].hide();}}};generic_dialog.prototype.should_hide_objects=!ua.windows();generic_dialog.prototype.should_use_iframe=ua.ie()<7||(ua.osx()&&ua.firefox());generic_dialog.prototype.show_dialog=function(html){if(generic_dialog.dialog_stack===null){onunloadRegister(generic_dialog.hide_all,true);}
if(!this.obj){this.build_dialog();}
set_inner_html(this.content,html);var imgs=this.content.getElementsByTagName('img');for(var i=0;i<imgs.length;i++){imgs[i].onload=chain(imgs[i].onload,this.hide_objects.bind(this));}
this.show();this.focus_first_textbox_or_button();this.on_show_callback&&this.on_show_callback();return this;}
generic_dialog.prototype.set_callback=function(callback){this.on_show_callback=callback;return this;}
generic_dialog.prototype.focus_first_textbox_or_button=function(){var INPUT_TYPES={'text':1,'button':1,'submit':1};function focus_textbox(node){var is_textbox=(node.tagName=="INPUT"&&INPUT_TYPES[node.type.toLowerCase()])||(node.tagName=="TEXTAREA");if(is_textbox){try{if(elementY(node)>0&&elementX(node)>0){node.focus();return false;}}catch(e){};}
return true;}
iterTraverseDom(this.content,focus_textbox)}
generic_dialog.prototype.set_top=function(top){return this;}
generic_dialog.prototype.make_modal=function(){if(this.modal){return;}
this.modal=true;if(ua.ie()==7){this.build_iframe();}
this.build_overlay();this.reset_iframe();}
generic_dialog.prototype.show_loading=function(loading_html){if(!loading_html){loading_html=tx('sh:loading');}
return this.show_dialog('<div class="dialog_loading">'+loading_html+'</div>');}
generic_dialog.prototype.show_ajax_dialog_custom_loader=function(html,src,post_vars){if(html){this.show_loading(html);}
var handler=function(response){this.show_dialog(response.getPayload().responseText);}.bind(this);var error_handler=function(response){ErrorDialog.showAsyncError(response);this.hide(false);}.bind(this);var async=new AsyncRequest().setOption('suppressEvaluation',true).setURI(src).setData(post_vars||{}).setHandler(handler).setErrorHandler(error_handler).setTransportErrorHandler(error_handler);if(!post_vars){async.setMethod('GET').setReadOnly(true);}
async.send();return this;}
generic_dialog.prototype.show_ajax_dialog=function(src,post_vars){post_vars=post_vars||false;var load=tx('sh:loading');return this.show_ajax_dialog_custom_loader(load,src,post_vars);}
generic_dialog.prototype.show_prompt=function(title,content){return this.show_dialog('<h2><span>'+title+'</span></h2><div class="dialog_content">'+content+'</div>');}
generic_dialog.prototype.show_message=function(title,content,button){if(button==null){button=tx('sh:ok-button');}
return this.show_choice(title,content,button,function(){generic_dialog.get_dialog(this).fade_out(100)});}
generic_dialog.prototype.show_choice=function(title,content,button1,button1js,button2,button2js,buttons_msg,button3,button3js){var buttons='<div class="dialog_buttons" id="dialog_buttons">';if(typeof(buttons_msg)!='undefined'){buttons+='<div class="dialog_buttons_msg">';buttons+=buttons_msg;buttons+='</div>';}
buttons+='<input class="inputsubmit" type="button" value="'+button1+'" id="dialog_button1" />';if(button2){var button2_class='inputsubmit';if(button2==tx('sh:cancel-button')){button2_class+=' inputaux';}
buttons+='<input class="'+button2_class+'" type="button" value="'+button2+'" id="dialog_button2" />';}
if(button3){var button3_class='inputsubmit';if(button3==tx('sh:cancel-button')){button3_class+=' inputaux';}
buttons+='<input class="'+button3_class+'" type="button" value="'+button3+'" id="dialog_button3" />';}
this.show_prompt(title,this.content_to_markup(content)+buttons);var inputs=this.obj.getElementsByTagName('input');if(button3){button1obj=inputs[inputs.length-3];button2obj=inputs[inputs.length-2];button3obj=inputs[inputs.length-1];}else if(button2){button1obj=inputs[inputs.length-2];button2obj=inputs[inputs.length-1];}else{button1obj=inputs[inputs.length-1];}
if(button1js&&button1){if(typeof button1js=='string'){eval('button1js = function() {'+button1js+'}');}
button1obj.onclick=button1js;}
if(button2js&&button2){if(typeof button2js=='string'){eval('button2js = function() {'+button2js+'}');}
button2obj.onclick=button2js;}
if(button3js&&button3){if(typeof button3js=='string'){eval('button3js = function() {'+button3js+'}');}
button3obj.onclick=button3js;}
if(!this.modal){document.onkeyup=function(e){var keycode=(e&&e.which)?e.which:event.keyCode;var btn2_exists=(typeof button2obj!='undefined');var btn3_exists=(typeof button3obj!='undefined');var is_webkit=ua.safari();if(is_webkit&&keycode==13){button1obj.click();}
if(keycode==27){if(btn3_exists){button3obj.click();}else if(btn2_exists){button2obj.click();}else{button1obj.click();}}
document.onkeyup=function(){}}
this.button_to_focus=button1obj;button1obj.offsetWidth&&button1obj.focus();}
return this;}
generic_dialog.prototype.show_choice_ajax=function(title,content_src,button1,button1js,button2,button2js,buttons_msg,button3,button3js,readonly){this.show_loading(tx('sh:loading'));var handler=function(response){this.show_choice(title,response.getPayload(),button1,button1js,button2,button2js,buttons_msg,button3,button3js);}.bind(this);var error_handler=function(response){ErrorDialog.showAsyncError(response);this.hide(false);}.bind(this);var req=new AsyncRequest().setURI(content_src).setHandler(handler).setErrorHandler(error_handler).setTransportErrorHandler(error_handler);if(readonly==true){req.setReadOnly(true);}
req.send();return this;}
generic_dialog.prototype.show_form_ajax=function(title,src,button,reload_page_on_success){this.show_loading(tx('sh:loading'));var form_id='dialog_ajax_form__'+gen_unique();var preSubmitErrorHandler=function(dialog,response){if(response.getError()!=true){dialog.hide();ErrorDialog.showAsyncError(response);}else{dialog.show_choice(title,response.getPayload(),'Okay',function(){dialog.fade_out(200);});}}.bind(null,this);var preSubmitHandler=function(dialog,response){var contents='<form id="'+form_id+'" onsubmit="return false;">'+response.getPayload()+'</form>';dialog.show_choice(title,contents,button,submitHandler,tx('sh:cancel-button'),function(){dialog.fade_out(200);});}.bind(null,this);var submitHandler=function(){new AsyncRequest().setURI(src).setData(serialize_form(ge(form_id))).setHandler(postSubmitHandler).setErrorHandler(postSubmitErrorHandler).send();};var postSubmitHandler=function(dialog,response){dialog.show_choice(title,response.getPayload(),'Okay',function(){dialog.fade_out(200);});if(reload_page_on_success){window.location.reload();}else{setTimeout(function(){dialog.fade_out(500);},750);}}.bind(null,this);var postSubmitErrorHandler=function(dialog,response){if(response.getError()==1346001){preSubmitHandler(response);}else if(response.getError()!=true){ErrorDialog.showAsyncError(response);}else{preSubmitErrorHandler(response);}}.bind(null,this);new AsyncRequest().setURI(src).setReadOnly(true).setHandler(preSubmitHandler).setErrorHandler(preSubmitErrorHandler).send();return this;}
generic_dialog.prototype.show_form=function(title,content,button,target,submit_callback){content='<form action="'+target+'" method="post">'+this.content_to_markup(content);var post_form_id=ge('post_form_id');if(post_form_id){content+='<input type="hidden" name="post_form_id" value="'+post_form_id.value+'" />';}
content+='<div class="dialog_buttons" id="dialog_buttons"><input class="inputsubmit" id="dialog_confirm" name="dialog_confirm" type="submit" value="'+button+'" />';content+='<input type="hidden" name="next" value="'+htmlspecialchars(document.location.href)+'"/>';content+='<input class="inputsubmit inputaux" type="button" value="'+tx('sh:cancel-button')+'" onclick="generic_dialog.get_dialog(this).fade_out(100)" /></form>';this.show_prompt(title,content);var submitButton=ge('dialog_confirm');submitButton.onclick=function(){window[submit_callback]&&window[submit_callback]();}
return this;}
generic_dialog.prototype.content_to_markup=function(content){return(typeof content=='string')?'<div class="dialog_body">'+content+'</div>':'<div class="dialog_summary">'+content.summary+'</div><div class="dialog_body">'+content.body+'</div>';}
generic_dialog.prototype.hide=function(temporary){if(this.obj){this.obj.style.display='none';}
if(this.iframe){this.iframe.style.display='none';}
if(this.overlay){this.overlay.style.display='none';}
if(this.timeout){clearTimeout(this.timeout);this.timeout=null;return;}
if(this.hidden_objects.length){for(var i=0,il=this.hidden_objects.length;i<il;i++){this.hidden_objects[i].style.visibility='';}
this.hidden_objects=[];}
clearInterval(this.active_hiding);if(!temporary){if(generic_dialog.dialog_stack){var stack=generic_dialog.dialog_stack;for(var i=stack.length-1;i>=0;i--){if(stack[i]==this){stack.splice(i,1);}}
if(stack.length){stack[stack.length-1].show();}}
if(this.obj){this.obj.parentNode.removeChild(this.obj);this.obj=null;}
if(this.close_handler){this.close_handler();}}
return this;}
generic_dialog.prototype.fade_out=function(interval,timeout,callback){if(!this.popup){return this;}
animation(this.obj).duration(timeout?timeout:0).checkpoint().to('opacity',0).hide().duration(interval?interval:350).ondone(function(){callback&&callback();this.hide();}.bind(this,{callback:callback})).go();return this;}
generic_dialog.prototype.show=function(){if(this.obj&&this.obj.style.display){this.obj.style.visibility='hidden';this.obj.style.display='';this.reset_dialog();this.obj.style.visibility='';this.obj.dialog=this;}else{this.reset_dialog();}
this.hide_objects();clearInterval(this.active_hiding);this.active_hiding=setInterval(this.active_resize.bind(this),500);var stack=generic_dialog.dialog_stack?generic_dialog.dialog_stack:generic_dialog.dialog_stack=[];if(stack.length){var current_dialog=stack[stack.length-1];if(current_dialog!=this&&!current_dialog.is_stackable){current_dialog.hide();}}
for(var i=stack.length-1;i>=0;i--){if(stack[i]==this){stack.splice(i,1);}else{stack[i].hide(true);}}
stack.push(this);return this;}
generic_dialog.prototype.enable_buttons=function(enable){var inputs=this.obj.getElementsByTagName('input');for(var i=0;i<inputs.length;i++){if(inputs[i].type=='button'||inputs[i].type=='submit'){inputs[i].disabled=!enable;}}}
generic_dialog.prototype.active_resize=function(){if(this.last_offset_height!=this.content.offsetHeight){this.hide_objects();this.last_offset_height=this.content.offsetHeight;}}
generic_dialog.prototype.hide_objects=function(){var hide=[],objects=[];var ad_locs=['',0,1,2,4,5,9,3];for(var i=0;i<ad_locs.length;i++){var ad_div=ge('ad_'+ad_locs[i]);if(ad_div!=null){hide.push(ad_div);}}
var rect={x:elementX(this.content),y:elementY(this.content),w:this.content.offsetWidth,h:this.content.offsetHeight};if(this.should_hide_objects){var iframes=document.getElementsByTagName('iframe');for(var i=0;i<iframes.length;i++){if(iframes[i].className.indexOf('share_hide_on_dialog')!=-1){objects.push(iframes[i]);}}}
var swfs=getElementsByTagNames('embed,object');for(var i=0;i<swfs.length;i++){if((swfs[i].getAttribute('wmode')||'').toLowerCase()!='transparent'||this.should_hide_objects){objects.push(swfs[i]);}}
for(var i=0;i<objects.length;i++){var node=objects[i].offsetHeight?objects[i]:objects[i].parentNode;swf_rect={x:elementX(node),y:elementY(node),w:node.offsetWidth,h:node.offsetHeight};if(!is_descendent(objects[i],this.content)&&rect.y+rect.h>swf_rect.y&&swf_rect.y+swf_rect.h>rect.y&&rect.x+rect.w>swf_rect.x&&swf_rect.x+swf_rect.w>rect.w&&this.hidden_objects.indexOf(node)==-1){hide.push(node);}}
for(var i=0;i<hide.length;i++){this.hidden_objects.push(hide[i]);hide[i].style.visibility='hidden';}}
generic_dialog.prototype.build_dialog=function(){if(!this.obj){this.obj=document.createElement('div');}
this.obj.className='generic_dialog'+(this.className?' '+this.className:'');this.obj.style.display='none';onloadRegister(function(){document.body.appendChild(this.obj);}.bind(this));if(this.should_use_iframe||(this.modal&&ua.ie()==7)){this.build_iframe();}
if(!this.popup){this.popup=document.createElement('div');this.popup.className='generic_dialog_popup';}
this.popup.style.left=this.popup.style.top='';this.obj.appendChild(this.popup);if(this.modal){this.build_overlay();}}
generic_dialog.prototype.build_iframe=function(){if(!this.iframe&&!(this.iframe=ge('generic_dialog_iframe'))){this.iframe=document.createElement('iframe');this.iframe.id='generic_dialog_iframe';this.iframe.src="/common/blank.html";}
this.iframe.frameBorder='0';onloadRegister(function(){document.body.appendChild(this.iframe);}.bind(this));}
generic_dialog.prototype.build_overlay=function(){this.overlay=document.createElement('div');this.overlay.id='generic_dialog_overlay';if(document.body.clientHeight>document.documentElement.clientHeight){this.overlay.style.height=document.body.clientHeight+'px';}else{this.overlay.style.height=document.documentElement.clientHeight+'px';}
onloadRegister(function(){document.body.appendChild(this.overlay);}.bind(this));}
generic_dialog.prototype.reset_dialog=function(){if(!this.popup){return;}
onloadRegister(function(){this.reset_dialog_obj();this.reset_iframe();}.bind(this));}
generic_dialog.prototype.reset_iframe=function(){if(!this.should_use_iframe&&!(this.modal&&ua.ie()==7)){return;}
if(this.modal){this.iframe.style.left='0px';this.iframe.style.top='0px';this.iframe.style.width='100%';if((document.body.clientHeight>document.documentElement.clientHeight)&&(document.body.clientHeight<10000)){this.iframe.style.height=document.body.clientHeight+'px';}else if((document.body.clientHeight<document.documentElement.clientHeight)&&(document.documentElement.clientHeight<10000)){this.iframe.style.height=document.documentElement.clientHeight+'px';}else{this.iframe.style.height='10000px';}}else{this.iframe.style.left=elementX(this.frame)+'px';this.iframe.style.top=elementY(this.frame)+'px';this.iframe.style.width=this.frame.offsetWidth+'px';this.iframe.style.height=this.frame.offsetHeight+'px';}
this.iframe.style.display='';}
generic_dialog.prototype.reset_dialog_obj=function(){}
generic_dialog.get_dialog=function(obj){while(!obj.dialog&&obj.parentNode){obj=obj.parentNode;}
return obj.dialog?obj.dialog:false;}
function pop_dialog(className,callback_function,modal){this.top=125;this.parent.construct(this,className,modal);this.on_show_callback=callback_function;}
pop_dialog.extend(generic_dialog);pop_dialog.prototype.do_expand_animation=false;pop_dialog.prototype.kill_expand_animation=true;pop_dialog.prototype.show_ajax_dialog=function(src,post_vars,title){post_vars=post_vars||false;if(this.do_expand_animation&&!this.kill_expand_animation){var load=null;this.show_loading_title(title);}else{var load=tx('sh:loading');}
return this.show_ajax_dialog_custom_loader(load,src,post_vars);}
pop_dialog.prototype.show_message=function(title,content,button){if(this.do_expand_animation&&!this.kill_expand_animation){this.show_loading_title(title);}else{this.show_loading();}
return this.parent.show_message(title,content,button);}
pop_dialog.prototype.show_dialog=function(html,prevent_expand_animation){var new_dialog=this.parent.show_dialog(html);if(this.do_expand_animation&&!prevent_expand_animation&&!this.kill_expand_animation){function check_done_loading_title(callback,i){var i=(i?i:0);if(this.done_loading_title!=true&&i<10){i++;setTimeout(check_done_loading_title.bind(this,callback,i),50);}else{callback&&callback();}}
function check_for_complete_images(content,callback,attempt){var complete_images=0;var images=content.getElementsByTagName('img');var safari2=ua.safari()<3;for(var i=0;i<images.length;i++){var imageobj=images[i];if(image_has_loaded(imageobj)){complete_images++;}}
if(complete_images!=images.length){if(attempt<20){attempt++;setTimeout(function(){check_for_complete_images(content,callback,attempt);},100);}else{callback();}}else{callback();}}
var divs=this.content.getElementsByTagName('div');for(var i=0;i<divs.length;i++){if(divs[i].className=='dialog_content'){expand_animation_div=divs[i];break;}}
var container_div=document.createElement('div');container_div.style.padding='0px';container_div.style.margin='0px';container_div.style.overflow='visible';expand_animation_div.parentNode.insertBefore(container_div,expand_animation_div);container_div.appendChild(expand_animation_div);expand_animation_div.style.overflow='hidden';check_for_complete_images(expand_animation_div,function(){check_done_loading_title.bind(this,function(){this.content.getElementsByTagName('h2')[0].className='';animation(expand_animation_div).to('height','auto').from(0).from('opacity',0).to(1).ease(animation.ease.both).show().duration(200).ondone(function(){container_div.parentNode.insertBefore(expand_animation_div,container_div);container_div.parentNode.removeChild(container_div);if(!this.button_to_focus){var inputs=this.obj.getElementsByTagName('input');for(var i=0;i<inputs.length;i++){if(inputs[i].type=='button'&&inputs[i].id=='dialog_button1'){this.button_to_focus=inputs[i];break;}}}
if(this.button_to_focus){setTimeout(function(){this.button_to_focus.focus();}.bind(this),50);}
expand_animation_div.style.overflow='visible'
this.do_expand_animation=false;this.show();}.bind(this,{expand_animation_div:expand_animation_div,container_div:container_div})).go();}.bind(this))();}.bind(this,{expand_animation_div:expand_animation_div}),0);}
return new_dialog;}
pop_dialog.prototype.build_dialog=function(){this.parent.build_dialog();this.obj.className+=' pop_dialog';this.popup.innerHTML='<table id="pop_dialog_table" class="pop_dialog_table">'+'<tr><td class="pop_topleft"></td><td class="pop_border"></td><td class="pop_topright"></td></tr>'+'<tr><td class="pop_border"></td><td class="pop_content" id="pop_content"></td><td class="pop_border"></td></tr>'+'<tr><td class="pop_bottomleft"></td><td class="pop_border"></td><td class="pop_bottomright"></td></tr>'+'</table>';this.frame=this.popup.getElementsByTagName('tbody')[0];this.content=this.popup.getElementsByTagName('td')[4];}
pop_dialog.prototype.reset_dialog_obj=function(){this.popup.style.top=(document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)+this.top+'px';}
pop_dialog.prototype.set_top=function(top){this.top=top;}
pop_dialog.prototype.show_prompt=function(title,content){if(!this.do_expand_animation||this.kill_expand_animation){return this.show_dialog('<h2><span>'+title+'</span></h2><div class="dialog_content">'+content+'</div>');}
return this.show_dialog('<h2 class="dialog_loading"><span>'+title+'</span></h2><div class="dialog_content" style="display:none;">'+content+'</div>');}
pop_dialog.prototype.show_loading_title=function(title){if(!this.kill_expand_animation){this.do_expand_animation=true;this.show_dialog('<h2 class="dialog_loading"><span>'+title+'</span></h2>',true);setTimeout(function(){this.done_loading_title=true;}.bind(this),200);}else{this.show_loading();}}
function contextual_dialog(className){this.parent.construct(this,className);}
contextual_dialog.extend(generic_dialog);contextual_dialog.prototype.set_context=function(obj){this.context=obj;return this;}
contextual_dialog.prototype.build_dialog=function(){this.parent.build_dialog();this.obj.className+=' contextual_dialog';this.popup.innerHTML='<div class="contextual_arrow"><span>^_^keke1</span></div><div class="contextual_dialog_content"></div>';this.arrow=this.popup.getElementsByTagName('div')[0];this.content=this.frame=this.popup.getElementsByTagName('div')[1];}
contextual_dialog.prototype.reset_dialog_obj=function(){var x=elementX(this.context);var center=(document.body.offsetWidth-this.popup.offsetWidth)/2;if(x<document.body.offsetWidth/2){this.arrow.className='contextual_arrow_rev';var left=Math.min(center,x+this.context.offsetWidth-this.arrow_padding_x);var arrow=x-left+this.context.offsetWidth+this.arrow_padding_x;}else{this.arrow.className='contextual_arrow';var left=Math.max(center,x-this.popup.offsetWidth+this.arrow_padding_x);var arrow=x-left-this.arrow_padding_x-this.arrow_width;}
if(isNaN(left)){left=0;}
if(isNaN(arrow)){arrow=0;}
this.popup.style.top=(elementY(this.context)+this.context.offsetHeight-this.arrow.offsetHeight+this.arrow_padding_y)+'px';this.popup.style.left=left+'px';this.arrow.style.backgroundPosition=arrow+'px';}
contextual_dialog.prototype._remove_resize_events=function(){if(this._scroll_events){for(var i=0;i<this._scroll_events.length;i++){removeEventBase(this._scroll_events[i].obj,this._scroll_events[i].event,this._scroll_events[i].func);}}
this._scroll_events=[];}
contextual_dialog.prototype.show=function(){this._remove_resize_events();var obj=this.context;while(obj){if(obj.id!='content'&&(obj.scrollHeight&&obj.offsetHeight&&obj.scrollHeight!=obj.offsetHeight)||(obj.scrollWidth&&obj.offsetWidth&&obj.scrollWidth!=obj.offsetWidth)){var evt={obj:obj,event:'scroll',func:this.reset_dialog_obj.bind(this)};addEventBase(evt.obj,evt.event,evt.func);}
obj=obj.parentNode;}
var evt={obj:window,event:'resize',func:this.reset_dialog_obj.bind(this)};addEventBase(evt.obj,evt.event,evt.func);this.parent.show();}
contextual_dialog.prototype.hide=function(temp){this._remove_resize_events();this.parent.hide(temp);}
contextual_dialog.prototype.arrow_padding_x=5;contextual_dialog.prototype.arrow_padding_y=10;contextual_dialog.prototype.arrow_width=13;contextual_dialog.hide_all=function(callback){if(generic_dialog.dialog_stack){for(var i=0;i<generic_dialog.dialog_stack.length;i++){if(generic_dialog.dialog_stack[i].context&&generic_dialog.dialog_stack[i].arrow){generic_dialog.dialog_stack[i].hide();}}}
callback&&callback();}
function ErrorDialog(){this.parent.construct(this,'errorDialog',null,true);return this;};ErrorDialog.extend(pop_dialog);copy_properties(ErrorDialog.prototype,{showError:function(title,message){return this.show_message(title,message);}});copy_properties(ErrorDialog,{showAsyncError:function(response){try{return(new ErrorDialog()).showError(response.getErrorSummary(),response.getErrorDescription());}catch(ex){aiert(response);}}});

var Registry=[];var _registryIndex=0;var _lastKeyCode=-1;var _names;var _ids;var _images;var _networks;var TypeAhead=function(rootEl,formEl,textBoxEl,idEl,defaultOptions,instructions,useFilter,onSuccessHandler,onInputChangeHandler,onUpHandler,onDownHandler,onListElMouseDownHandler,placeholderText,showNoMatches,override_resize)
{this.resize=!override_resize;this.getMatchSingleTerm=function(term,document)
{var str="";var len=term.length;if(!document)return'';var curDocument=document;var index=0;index=curDocument.toUpperCase().indexOf(term.toUpperCase());if(index==-1)
{return str;}
var match=curDocument.substring(0,len);str+='<span class="suggest">'+match+'</span>';var moreMatches=0;curDocument=curDocument.substring(index+len);while((index=curDocument.toUpperCase().indexOf(term.toUpperCase()))!=-1)
{var pre=curDocument.substring(0,index);if(pre)
{str+=pre;}
var match=curDocument.substring(index,index+len);if(match)
{str+='<span class="suggest">'+match+'</span>';}
curDocument=curDocument.substring(index+len);moreMatches=1;}
if(moreMatches)
{str+=curDocument;}}
this.getMatchMultipleTerms=function(terms,document)
{if(!document)return'';var termsArr=terms.split(/\s+/);var docArr=document.split(/\s+/);var str="";for(var docIdx=0;docIdx<docArr.length;docIdx++)
{var matchFound=0;var doc=docArr[docIdx];for(var termIdx=0;termIdx<termsArr.length;termIdx++)
{var term=termsArr[termIdx];if(doc.toUpperCase().indexOf(term.toUpperCase())==0)
{matchFound=1;break;}}
if(docIdx>0)
{str+=' ';}
if(matchFound)
{var len=term.length;var pre=doc.substring(0,len);var suf=doc.substring(len);str+='<span class="suggest">'+pre+'</span>'+suf;}
else
{str+=doc;}}
return str;}
this.onListChange=function()
{this.selectedIndex=-1;if(!this.pEvent)
{this.idEl.value=0;}
var dropDownEl=this.dropDownEl;if(dropDownEl&&dropDownEl.childNodes)
{this.dropDownCount=dropDownEl.childNodes.length;}
this.lastTypedValue=this.currentInputValue;if(this.currentInputValue==""||this.dropDownCount==0||this.pEvent)
{this.dropDownEl.hide();}
else
{this.dropDownEl.show();this.defaultDropDownEl.show();}
var matchFound=false;if(this.currentInputValue.length>0)
{for(var i=0;i<this.dropDownCount;i++)
{if(!matchFound)
{matchFound=true;this.selectedIndex=i;this.selectedEl=this.dropDownEl.childNodes[i];}
var str=this.getMatchSingleTerm(this.currentInputValue,this.dropDownEl.childNodes[i]._value);if(!str)
{str=this.getMatchMultipleTerms(this.currentInputValue,this.dropDownEl.childNodes[i]._value);}
this.dropDownEl.childNodes[i].setName(str);str=this.getMatchSingleTerm(this.currentInputValue,this.dropDownEl.childNodes[i]._loc);if(!str)
{str=this.getMatchMultipleTerms(this.currentInputValue,this.dropDownEl.childNodes[i]._loc);}
this.dropDownEl.childNodes[i].setLoc(str);}
if(!matchFound)
{for(var i=0;i<this.defaultDropDownCount;i++)
{if(this.defaultDropDownEl.childNodes[i]._value.toUpperCase().indexOf(this.currentInputValue.toUpperCase())==0)
{matchFound=true;this.selectedIndex=i;this.selectedEl=this.defaultDropDownEl.childNodes[i];break;}}}}
var value=this.currentInputValue;var keyIgnore=false;switch(this.lastKeyCode)
{case 8:case 33:case 34:case 35:case 35:case 36:case 37:case 39:case 45:case 46:keyIgnore=true;break;case 27:keyIgnore=true;break;default:break;}
if(!keyIgnore&&matchFound&&!this.pEvent)
{this.selectedEl.select();}
else
{}
this._noMatches=false;if(this.dropDownCount==0)
{if(this.textBoxEl.value!=""&&this.textBoxEl.value!=this.textBoxEl.ph)
{this._noMatches=true;if(this.showNoMatches)
{this.defaultTextEl.setText(tx('typeahead_ns:no-matches'));}}
else
{this.defaultTextEl.setDefault();}
this.defaultDropDownEl.show();if(this.showNoMatches)
{this.defaultTextEl.show();}}
else
{this.defaultTextEl.hide();}
if(this.dropDownCount>=1&&this.selectedEl&&this.getUnselectedLength()==this.selectedEl._value.length)
{this.idEl.value=this.selectedEl._id;if(this.dropDownCount==1){this.onTypeAheadSuccess();}else{this.textBoxEl.style.background="#e1e9f6";}}
else
{this.onTypeAheadFailure();}
if(this.lastKeyCode==27)
{this.textBoxEl.blur();}
this.setFrame();this.pEvent=0;}
this.setFrame=function()
{if(this.goodFrame)
{this.goodFrame.style.height=(this.containerEl.offsetHeight)+"px";this.goodFrame.style.width=(this.textBoxEl.offsetWidth)+"px";}}
this.onTypeAheadSuccess=function()
{this.dropDownEl.hide();this.textBoxEl.style.background="#e1e9f6";if(this.onSuccess&&!this.pEvent)
{this.onSuccess(this);}}
this.onTypeAheadFailure=function()
{this.textBoxEl.style.background="#FFFFFF";}
this.refocus=function()
{this.reFocused=true;this.textBoxEl.blur();setTimeout("Registry["+this.registryIndex+"].focus();",10);}
this.focus=function()
{this.textBoxEl.focus();}
this.handleKeyUp=function(event)
{if(!event&&window.event)
{event=window.event;}
if(event.keyCode==40||event.keyCode==38)
{if(this.isSafari&&(this.fireCount++%2==1))
{}}
var value=this.textBoxEl.value;var sLen=this.getSelectedLength();var uLen=this.getUnselectedLength();if(sLen>0&&uLen!=-1)
{value=value.substring(0,uLen);}
this.currentInputValue=value;var keyIgnore=false;switch(this.lastKeyCode)
{case 13:case 9:keyIgnore=true;break;case 38:keyIgnore=true;if(this.onUp)
{this.onUp(this);}
break;case 40:keyIgnore=true;if(this.onDown)
{this.onDown(this);}
break;}
this.pEvent=0;if(event.pEvent)
{this.pEvent=event.pEvent;}
if(!keyIgnore&&this.onInputChange)
{this.onInputChange(this);}
if(this.lastKeyCode==13)
{this.lastKeyCode=-1;_lastKeyCode=-1;}
this.lastInputValue=this.currentInputValue;}
this.getSelectedLength=function()
{var el=this.textBoxEl;var len=-1;if(el.createTextRange)
{var selection=document.selection.createRange().duplicate();len=selection.text.length;}
else if(el.setSelectionRange)
{len=el.selectionEnd-el.selectionStart;}
return len;}
this.getUnselectedLength=function()
{var el=this.textBoxEl;var len=0;if(el.createTextRange)
{var selection=document.selection.createRange().duplicate();selection.moveEnd("textedit",1);len=el.value.length-selection.text.length;}
else if(el.setSelectionRange)
{len=el.selectionStart;}
else
{len=-1;}
return len;}
this.handleKeyDown=function(event)
{if(!event&&window.event)
{event=window.event;}
if(event)
{this.lastKeyCode=event.keyCode;_lastKeyCode=event.keyCode;}
switch(this.lastKeyCode)
{case 38:break;case 40:break;case 27:this.textBoxEl.value="";break;case 13:case 9:if(this.selectedIndex!=-1)
{this.textBoxEl.value=this.selectedEl._value;this.defaultTextEl.hide();this.onTypeAheadSuccess();}
this.dropDownEl.hide();this.defaultDropDownEl.hide();this.setFrame();break;case 3:this.dropDownEl.hide();this.defaultDropDownEl.hide();this.setFrame();break;}
switch(this.lastKeyCode)
{case 38:this.selectPrevDropDown();if(this.onUp)
{this.onUp(this);}
break;case 40:this.selectNextDropDown();if(this.onDown)
{this.onDown(this);}
break;}
if(event&&(event.keyCode==13||event.keyCode==38||event.keyCode==40))
{event.cancelBubble=true;event.returnValue=false;}}
this.selectPrevDropDown=function()
{this.selectDropDown(this.selectedIndex-1);}
this.selectNextDropDown=function()
{this.selectDropDown(this.selectedIndex+1);}
this.selectDropDown=function(index)
{this.textBoxEl.value=this.lastTypedValue;if((this.dropDownCount+this.defaultDropDownCount)<=0)
{return;}
if(this.dropDownCount>0)
{this.dropDownEl.show();this.defaultDropDownEl.show();}
else
{this.dropDownEl.hide();}
this.setFrame();var usingDefaultDropDown=false;if(index>=this.dropDownCount&&this.defaultDropDownCount>0)
{usingDefaultDropDown=true;}
if(index>=this.dropDownCount+this.defaultDropDownCount)
{index=this.dropDownCount+this.defaultDropDownCount-1;}
if(this.selectedIndex!=-1&&index!=this.selectedIndex)
{this.selectedIndex=-1;this.selectedEl.unselect();}
if(index<0)
{this.selectedIndex=-1;return;}
this.selectedIndex=index;if(usingDefaultDropDown)
{this.selectedEl=this.defaultDropDownEl.childNodes[index-this.dropDownCount];}
else
{this.selectedEl=this.dropDownEl.childNodes[index];}
this.selectedEl.select();this.textBoxEl.value=this.selectedEl._value;}
this.displaySuggestList=function(names,ids,locs)
{if(names.length!=ids.length)
{return false;}
var dropDownEl=this.dropDownEl;while(dropDownEl.childNodes.length>0)
{dropDownEl.removeChild(dropDownEl.childNodes[0]);}
if(this.selectedEl)
{this.selectedEl.unselect();}
var match_i=0;var termsArr;var term;var matchFound;var name;var match_id;var filter=this.currentInputValue.toUpperCase();filter=filter.replace(/^\s+|\s+$/,'');for(var i=0;i<names.length&&match_i<10;i++)
{name=names[i];if(this.useFilter)
{if(!filter)
{continue;}
match_id=ids[i];if(window._ignoreList&&_ignoreList[match_id]&&_ignoreList[match_id]==1)
{continue;}
matchFound=0;if(name.toUpperCase().indexOf(filter)==0)
{matchFound=1;}
if(!matchFound)
{termsArr=name.split(/\s+/);for(var termIdx=0;termIdx<termsArr.length;termIdx++)
{term=termsArr[termIdx];if(term.toUpperCase().indexOf(filter)==0)
{matchFound=1;break;}}}
if(!matchFound)
{continue;}
match_i++;}
var listEl=this.createListElement(name,ids[i],locs[i],i);dropDownEl.appendChild(listEl);}
for(var i=0;i<this.defaultDropDownEl.childNodes.length;i++)
{var listEl=this.defaultDropDownEl.childNodes[i];listEl._index=i+this.dropDownEl.childNodes.length;}
return true;}
this.createListElement=function(name,id,loc,index)
{var listEl=document.createElement("div");listEl._value=name;listEl._loc=loc;listEl._id=id;listEl._index=index;listEl.setName=function(name)
{this.nameEl.innerHTML=name;}
listEl.setLoc=function(loc)
{if(this.locEl)
this.locEl.innerHTML=loc;}
listEl.select=function()
{this.className="list_element_container_selected";this.nameEl.className="list_element_name_selected";if(this.locEl)
{this.locEl.className="list_element_loc_selected";}
if(oThis.idEl)
{oThis.idEl.value=this._id;}}
listEl.unselect=function()
{this.className="list_element_container";this.nameEl.className="list_element_name";if(this.locEl)
{this.locEl.className="list_element_loc";}
if(oThis.idEl)
{}
oThis.selectedIndex=-1;}
listEl.onmousedown=function()
{oThis.textBoxEl.value=this._value;if(oThis.idEl)
{oThis.idEl.value=this._id;}
oThis.onTypeAheadSuccess();if(oThis.formEl)
{}
if(oThis.onListElMouseDown)
{oThis.onListElMouseDown(oThis,this);}
oThis.setFrame();}
listEl.onmouseover=function()
{if(oThis.selectedEl)
{oThis.selectedEl.unselect();}
oThis.selectedEl=this;oThis.selectedIndex=this._index;this.select();}
listEl.onmouseout=function()
{this.unselect();}
listEl.style.zIndex="101";var dividerEl;if(index==-1)
{dividerEl=this.createDivider();listEl.appendChild(dividerEl);}
var nameEl=document.createElement("div");nameEl.className="list_element_name";nameEl.innerHTML=name;listEl.appendChild(nameEl);listEl.nameEl=nameEl;listEl.locEl=locEl;if(loc)
{var locEl=document.createElement("div");locEl.className="list_element_loc";locEl.innerHTML=loc;listEl.appendChild(locEl);listEl.locEl=locEl;}
dividerEl=this.createDivider();listEl.appendChild(dividerEl);listEl.unselect();return listEl;}
this.createDivider=function()
{var dividerEl=document.createElement("div");dividerEl.className="list_element_divider";return dividerEl;}
this.createDropDownContainer=function()
{var containerEl=document.createElement("div");containerEl.className="dropdown-container";this.containerEl=containerEl;this.positionDropDown();}
this.createDropDown=function()
{var dropDownEl=document.createElement("div");dropDownEl.className="dropdown";dropDownEl.style.display="none";dropDownEl.style.zIndex="101";dropDownEl.hide=function()
{this.style.display="none";}
dropDownEl.show=function()
{this.style.display="";oThis.positionDropDown();}
this.containerEl.appendChild(dropDownEl);this.dropDownEl=dropDownEl;}
this.createDefaultDropDown=function()
{var defaultDropDownHeaderEl=document.createElement("div");defaultDropDownHeaderEl.className="typeahead_header";defaultDropDownHeaderEl.style.display="none";defaultDropDownHeaderEl.innerHTML=tx('typeahead_ns:search-elsewhere');this.containerEl.appendChild(defaultDropDownHeaderEl);this.defaultDropDownHeaderEl=defaultDropDownHeaderEl;var defaultDropDownEl=document.createElement("div");defaultDropDownEl.style.display="none";defaultDropDownEl.show=function()
{if(oThis.defaultDropDownCount>0)
{this.style.display="";oThis.defaultDropDownHeaderEl.style.display="";}
else
{oThis.dropDownEl.style.borderBottom="1px solid #777";}}
defaultDropDownEl.hide=function()
{this.style.display="none";oThis.defaultDropDownHeaderEl.style.display="none";}
var index=0;for(var option in this.defaultOptions)
{var listEl=this.createListElement(option,this.defaultOptions[option],"",index);index++;defaultDropDownEl.appendChild(listEl);}
defaultDropDownEl.className="default-dropdown";defaultDropDownEl.hide();this.containerEl.appendChild(defaultDropDownEl);this.defaultDropDownEl=defaultDropDownEl;this.defaultDropDownCount=defaultDropDownEl.childNodes.length;}
this.createDefaultText=function()
{var defaultTextEl=document.createElement("div");defaultTextEl.className="default-text";defaultTextEl.style.display="none";defaultTextEl.hide=function()
{this.style.display="none";}
defaultTextEl.show=function()
{this.style.display="";if(oThis.defaultDropDownCount==0)
{this.style.borderBottom="1px solid #777";}}
defaultTextEl.setDefault=function()
{this.innerHTML=instructions;}
defaultTextEl.setText=function(text)
{this.innerHTML=text;}
defaultTextEl.setDefault();if(!this.defaultOptions)
{defaultTextEl.style.borderBottom="0px solid";}
this.containerEl.appendChild(defaultTextEl);this.defaultTextEl=defaultTextEl;}
this.positionDropDown=function()
{var containerEl=this.containerEl;if(containerEl)
{if(this.customOffsetElement){containerEl.style.left=elementX(this.textBoxEl)-elementX(this.customOffsetElement)+"px";containerEl.style.top=elementY(this.textBoxEl)-elementY(this.customOffsetElement)+this.textBoxEl.offsetHeight+"px";}
else if(this.resize){containerEl.style.left=elementX(this.textBoxEl)+"px";containerEl.style.top=elementY(this.textBoxEl)+this.textBoxEl.offsetHeight+"px";}
if(!this.isIE)
{containerEl.style.width=this.textBoxEl.offsetWidth+"px";}
else
{containerEl.style.width=this.textBoxEl.offsetWidth+"px";}}}
this.getText=function()
{return this.textBoxEl.value;}
this.getSelectedText=function()
{return this.selectedEl?this.selectedEl._value:'';}
this.noMatches=function()
{return this._noMatches;}
this.getID=function()
{return this.selectedEl?this.selectedEl._id:0;}
this.setText=function(q,reset)
{this.textBoxEl.setText(q,reset);}
this.init=function()
{this._noMatches=false;this.registryIndex=_registryIndex;Registry[_registryIndex++]=this;this.lastKeyCode=-1;this.currentInputValue=textBoxEl.value;this.lastTypedValue="";this.lastInputValue="";this.dropDownCount=0;this.defaultDropDownCount=0;this.customOffsetElement=null;this.selectedIndex=-1;this.selectedEl=null;this.reFocused=false;textBoxEl.setAttribute("placeholder",placeholderText);textBoxEl.style.color='#777';textBoxEl.ph=placeholderText;textBoxEl.oThis=this;textBoxEl.onblur=function()
{if(!oThis.reFocused)
{oThis.dropDownEl.hide();oThis.defaultTextEl.hide();oThis.defaultDropDownEl.hide();}
if(oThis.selectedIndex==-1)
{oThis.idEl.value=0;}
oThis.reFocused=false;var ph=this.getAttribute("placeholder");if(this.isFocused&&ph&&(this.value==""||this.value==ph))
{this.isFocused=0;this.value=ph;this.style.color='#777';}
oThis.setFrame();}
textBoxEl.onfocus=function()
{var oThis=this.oThis;if(!this.isFocused)
{this.isFocused=1;if(oThis.selectedIndex==-1&&this.value==this.getAttribute("placeholder"))
{this.value='';}}
if(oThis.dropDownCount>0||oThis.defaultTextEl.innerHTML!='')
{if(oThis.dropDownCount==0){oThis.defaultTextEl.show();}
if(this.createTextRange)
{var t=this.createTextRange();t.moveStart("character",0);t.select();}
else if(this.setSelectionRange)
{this.setSelectionRange(0,this.value.length);}
oThis.dropDownEl.show();oThis.defaultDropDownEl.show();oThis.positionDropDown();oThis.setFrame();}
this.style.color='#000';}
textBoxEl.onkeyup=function(event)
{oThis.handleKeyUp(event);}
textBoxEl.setText=function(q,reset)
{var ph=this.getAttribute("placeholder");this.isFocused=0;if(q)
{this.style.color='#000';this.value=q;var ev=new Object();ev.keyCode=0;ev.pEvent=1;oThis.handleKeyUp(ev);}
else if(ph&&ph!="")
{if(reset)
{this.value="";this.style.color='#000';}
else
{this.value=ph;this.style.color='#777';}
this.isFocused=0;oThis.textBoxEl.style.background="#FFFFFF";}
else
{this.value="";oThis.textBoxEl.style.background="#FFFFFF";}}
if(!formEl){formEl=textBoxEl.form;}
if(formEl)
{formEl.onsubmit=function()
{oThis.setFrame();if(_lastKeyCode==13)
{_lastKeyCode=-1;return false;}
if(oThis.selectedIndex!=-1&&oThis.selectedEl)
{oThis.idEl.value=oThis.selectedEl._id;}
return true;}}
this.formEl=formEl;this.textBoxEl=textBoxEl;this.idEl=idEl;this.onInputChange=onInputChangeHandler;this.onSuccess=onSuccessHandler;this.defaultOptions=defaultOptions;this.useFilter=useFilter;this.onUp=onUpHandler;this.onDown=onDownHandler;this.onListElMouseDown=onListElMouseDownHandler;this.showNoMatches=showNoMatches;this.fireCount=0;this.isIE=0;this.isSafari=0;if(navigator)
{this.browser=navigator.userAgent.toLowerCase();if(this.browser.indexOf("safari")!=-1)
{this.isSafari=1;}
if(this.browser.indexOf("msie")!=-1)
{this.isIE=1;}}
var blank_spot=rootEl;this.createDropDownContainer();this.createDropDown();this.createDefaultText();this.createDefaultDropDown();this.positionDropDown();var savior=document.createElement("div");savior.id="savior";this.containerEl.id="dropdown";this.goodFrame=null;if(rootEl)
{if(blank_spot&&this.isIE)
{rootEl.appendChild(savior);}
rootEl.appendChild(this.containerEl);}
if(blank_spot==rootEl&&this.isIE)
{var goodFrame=document.createElement('iframe');goodFrame.id="goodFrame";goodFrame.src="/common/blank.html";goodFrame.style.width="0px";goodFrame.style.height="0px";goodFrame.style.zIndex="98";blank_spot.insertBefore(goodFrame,blank_spot.firstChild);blank_spot.style.zIndex="99";this.goodFrame=goodFrame;}}
this.setCustomOffsetElement=function(el){this.customOffsetElement=el;}
var oThis=this;this.init();if(!window.onresize)
{window.onresize=function(event)
{for(var idx=0;idx<Registry.length;idx++)
{Registry[idx].positionDropDown();}}}
textBoxEl.onkeydown=function(event)
{oThis.handleKeyDown(event);}}
function debug(str)
{document.getElementById("debug").innerHTML+=str+"<BR>";}
function city_selector_onfound(input,obj){input.value=obj?obj.i:-1;}
function city_selector_onselect(success){if(window[success]){window[success]();}}

var Suggest=function(rootEl,q,formEl,textBoxEl,idEl,uri,param,successHandler,instructions,networkType,placeholderText,defaultOptions,showNoMatches,override_resize){this.onInputChange=function(){var currentInputValue=oThis.typeAheadObj.currentInputValue;var cache=oThis.getCache(currentInputValue);if(cache){oThis.onSuggestRequestDone(currentInputValue,cache[0],cache[1],cache[2]);}else{var typeStr="";var data={};data[oThis.suggestParam]=currentInputValue;if(oThis.networkType){data['t']=oThis.networkType;}
var asyncRequestGet=new AsyncRequest().setURI(oThis.suggestURI).setData(data).setHandler(function(response){var payload=response.payload;oThis.onSuggestRequestDone(currentInputValue,payload.suggestNames,payload.suggestIDs,payload.suggestLocs,oThis.typeAheadObj.pEvent);}).setErrorHandler(function(response){new Dialog().setTitle(tx('sh:error-occurred')).setBody(tx('su01')).setButtons(Dialog.OK).show();}).setMethod('GET').setReadOnly(true).send();}}
this.onSuggestRequestDone=function(key,names,ids,locs,pEvent){this.setCache(key,names,ids,locs);if(this.typeAheadObj.displaySuggestList(names,ids,locs)){this.typeAheadObj.pEvent=pEvent;this.typeAheadObj.onListChange();}}
this.getCache=function(key){return this.suggestCache[key.toUpperCase()];}
this.setCache=function(key,names,ids,locs){this.suggestCache[key.toUpperCase()]=new Array(names,ids,locs);}
this.init=function(){this.suggestURI=uri;this.suggestParam=param;this.suggestCache=[];this.networkType=networkType;if(!instructions){instructions=tx('su02');}
textBoxEl.value=q;this.typeAheadObj=new TypeAhead(rootEl,formEl,textBoxEl,idEl,defaultOptions,instructions,0,successHandler,this.onInputChange,null,null,null,placeholderText,showNoMatches,override_resize);}
var oThis=this;this.init();}
function debug(str){document.getElementById("debug").innerHTML+=str+"<BR>";}

var
noErr=0,kError_ErrorTool_BadErrorName=1337001,kError_ErrorTool_DuplicateErrorName=1337002,kError_ErrorTool_BadNamespaceName=1337003,kError_ErrorTool_BadErrorID=1337004,kError_ErrorTool_DuplicateNamespaceName=1337005,kError_ErrorTool_BadNamespaceID=1337006,kError_ErrorTool_WriteFailed=1337007,kError_ErrorTool_BadServiceName=1337008,kError_ErrorTool_RequestFailed=1337009,kError_ErrorTool_TempWriteFailed=1337010,kError_ErrorTool_LintFailed=1337011,kError_Account_IncorrectPassword=1340001,kError_Account_NotAuthenticated=1340002,kError_Account_MissingPassword=1340003,kError_Profile_InvalidAttribute=1341001,kError_Database_WriteFailed=1342001,kError_Account_NotLoggedIn=1340004,kError_Global_ValidationError=1346001,kError_Mobile_Error=1347001,kError_Login_DownError=1348001,kError_Login_ExternalLoginError=1348002,kError_Login_NoCookies=1348003,kError_Login_DeveloperLoginError=1348004,kError_Login_ZiddioContestMessage=1348005,kError_Login_OneTimeCodeMessage=1348006,kError_Login_MustLogInToSeeMessage=1348007,kError_Platform_NotLoggedIn=1349001,kError_Platform_NoAppInfoForAppID=1349002,kError_Platform_LoginError=1349003,kError_Login_ReactivateAccountMessage=1348008,kError_Login_GenericError=1348009,kError_Login_CreatorAccountError=1348010,kError_Login_NotComfirmedError=1348012,kError_Login_AccountDeactivatedError=1348013,kError_Login_AccountMergedError=1348014,kError_Login_AccountMergingError=1348015,kError_TPS_NoTicketId=1350001,kError_TPS_InvalidTicketStatus=1350002,kError_TPS_FailedUpdateTicketStatus=1350003,kError_TPS_FailedUpdateTicketSubject=1350004,kError_TPS_FailedUpdateTicketOwner=1350005,kError_TPS_FailedUpdateTicketQueue=1350006,kError_Login_IncorrectEmailOrPasswordError=1348016,kError_Login_PasswordsCaseSensitiveSubError=1348017,kError_TPS_FailedCorrespondOut=1350007,kError_TPS_EmptyCorrespondence=1350008,kError_TPS_FailedTicketRefresh=1350009,kError_Registration_LoginViaReg=1351001,kError_TPS_WarnUserFailedBadParams=1350010,kError_TPS_WarnUserFailedBadCall=1350011,kError_debategroups_alreadyVoted=1352001,kError_Payment_CardAlreadyDisabled=1353001,kError_Payment_PaymentException=1353002,kError_Payment_InvalidRequest=1353003,kError_TPS_UserHasTicket=1350013,kError_TPS_TicketAssociateBadParams=1350014,kError_TPS_TicketAssociateFailed=1350015,kError_TPS_EmailHasTicket=1350016,kError_Level1_NotEnabled=1354001,kError_Level1_CouldNotConnectToQueueDB=1354002,kError_Level1_QueueCommitFailed=1354003,kError_Level1_TransactionBeginFailed=1354004,kError_Level1_DirtyQueueSelectFailed=1354005,kError_Level1_NoDirtyKeys=1354006,kError_Level1_DispatchCreationFailed=1354007,kError_Level1_DirtyQueueUpdateFailed=1354008,kError_Level1_TransactionCommitFailed=1354009,kError_Level1_DispatchQueueSelectFailed=1354010,kError_Level1_NothingToDispatch=1354011,kError_TPS_FailedConfirmUser=1350017,kError_TPS_FailedResetPassword=1350018,kError_TPS_UnknownSimpleCommand=1350019,kError_TPS_NameChangeFailed=1350020,kError_TPS_InvalidBdayDate=1350021,kError_TPS_InvalidBdayUserTooYoung=1350022,kError_TPS_InvalidBdayUserTooOld=1350023,kError_TPS_BdayChangeGeneralFailure=1350024,kError_TPS_TicketAssociateMergeFailed=1350025,kError_TPS_TicketAssociateSimpleFailed=1350026,kError_TPS_TicketAssociateUnspecifiedError=1350027,kError_TPS_TicketAssociateRemoveUIDFailed=1350028,kError_TPS_VerificationScoreUpdateFailed=1350029,kError_TPS_AffilAddUseReAdd=1350030,kError_TPS_AffilAddEmailRequired=1350031,kError_TPS_AffilAddFailed=1350032,kError_TPS_AffilConfirmFailed=1350033,kError_TPS_AffilRemoveFailed=1350034,kError_TPS_AffilPendingFailed=1350035,kError_TPS_AffilReaddFailure=1350036,kError_TPS_AffilsUpdateError=1350037,kError_TPS_AffilWidgetUnknownAction=1350038,kError_TPS_AccountChangeFailedDark=1350039,kError_Chat_SendPermissions=1356001,kError_Chat_NotAvailable=1356002,kError_Chat_SendOtherNotAvailable=1356003,kError_Chat_Unknown=1356004,kError_Async_NotLoggedIn=1357001,kError_Async_NotInternUser=1357002,kError_TPS_TicketAttachBadParams=1350040,kError_TPS_TicketAttachGetPendingFailed=1350041,kError_Chat_MessageTooLong=1356005,kError_Payment_RefundExceedsAmount=1353004,kError_Payment_RefundAmountNotSupported=1353005,kError_Database_DatabaseDown=1342002,kError_TPS_AffilAddHSUserTooOld=1350042,kError_Admanager_ActionFailed=1359001,kError_Admanager_UpdateFailed=1359002,kError_Calendar_LackEditPermission=1360001,kError_Calendar_GenericError=1360002,kError_CSDC_Disabled=1361001,kError_Calendar_CannotJoinPrivate=1360003,kError_Reviews_WriteFailed=1362001,kError_Global_FailedCaptcha=1346002,kError_Payment_RefundMerchantCheck=1353006,kError_Video_TagExists=1363001,kError_Video_TagFailed=1363002,kError_Video_TagLimitReached=1363003,kError_Calendar_CannotSeeItem=1360004,kError_Calendar_PrivateCalendar=1360005,kError_Async_LoginChanged=1357003,kError_Calendar_CannotInviteOthers=1360006,kError_Mobile_CarrierInputDuplicate=1347002,kError_Mobile_NoData=1347003,kError_Ratings_MissingRequiredParams=1365001,kError_Ratings_InvalidContest=1365002,kError_Ratings_InvalidTarget=1365003,kError_Ratings_ContestNotRunning=1365004,kError_Ratings_NoTargetsFound=1365005,kError_Ratings_TargetTrojan=1365006,kError_Ratings_InvalidScore=1365007,kError_TPS_TicketAddCCFailed=1350043,kError_TPS_TicketRemoveCCFailed=1350044,kError_TPS_QueueAddCCFailed=1350045,kError_TPS_QueueRemoveCCFailed=1350046,kError_TPS_NoQueueId=1350047,kError_TPS_CCEditNoActionSpecified=1350048,kError_Global_ContentError=1346003,kError_Mobile_StatusUpdatesPrivacy=1347004,kError_Chat_MessageBlocked=1356006,kError_TPS_FailedChangeLanguage=1350049,kError_TPS_QueuePrefChangeFailed=1350050,kError_TPS_FailedChangePriority=1350051,kError_Chat_DownForMaintenance=1356007,kError_Async_CSRFCheckFailed=1357004,kError_Async_ParameterFailure=1357005,kError_Calendar_Blocked=1360007,kError_Video_AcceptedUploadAgreement=1363004,kError_Database_CannotConnect=1342003,kError_Photos_CommentFailed=1366001,kError_Async_BadPermissions=1357006,kError_Wall_PostFailure=1367001,kError_Example_DivisionByZero=1370001,kError_Typeahead_StaticSourceListEmpty=1371001,kError_Global_CantSee=1346004,kError_Chat_TooManyMessages=1356008,kError_Account_KarmaBlocked=1340005,kError_Platform_InvalidRequest=1349004,kError_Platform_AppNotOwnedByUser=1349005,kError_Platform_NoFriendsSelected=1349006,kError_Platform_CallbackValidationFailure=1349007,kError_Platform_ApplicationResponseInvalid=1349008,kError_Platform_TestConsoleKarmaWarned=1349009,kError_MYPages_TooManyAdded=1373001,kError_MYPages_AddFanStatusFailed=1373002,kError_MYPages_RemoveFanStatusFailed=1373003,kError_MYPages_EditSettingsFailed=1373004,kError_Minifeed_HideClickFail=1375001,kError_Group_NotGroupMember=1376001,kError_Group_UnableToJoin=1376002,kError_Group_NoPermission=1376003,kError_Group_EmptyOfficerTitle=1376004,kError_Group_UnableEditOfficer=1376005,kError_Notes_InvalidDeleteRequest=1377001,kError_Notes_DeleteFailed=1377002,kError_Notes_NoAccessRight=1377003,kError_Notes_FailToAddTag=1377004,kError_Notes_NoSuchNote=1377005,kError_Notes_UnknownAction=1377006,kError_Notes_NotebookUpdateFailed=1377007,kError_TPS_CRBadParams=1350052,kError_TPS_CRUnspecifiedAction=1350053,kError_TPS_CRUnspecifiedError=1350054,kError_TPS_CRInsuffPrivs=1350055,kError_TPS_CRDataFetchFailed=1350056,kError_TPS_CRCreateFailed=1350057,kError_TPS_CRCollectionCreateFailed=1350058,kError_TPS_CRUpdateFailed=1350059,kError_TPS_CRCollectionUpdateFailed=1350060,kError_TPS_CRBodyUpdateFailed=1350061,kError_TPS_CRRemoveBodyFailed=1350062,kError_Marketplace_MessageSendFailed=1378001,kError_TPS_CRFetchBodyFailed=1350063,kError_TPS_CRFetchBodyTypesFailed=1350064,kError_TPS_CRFetchFailed=1350065,kError_Notes_UnknownUploadCommand=1377008,kError_RichMediaContent_NoMoreMYML=1380001,kError_RichMediaContent_AddMYMLFailure=1380002,kError_RichMediaContent_GenericError=1380003,kError_TPS_TraccampBugCreationFailed=1350066,kError_TPS_NoTraccampProjectId=1350067,kError_PlatformRequests_NoSelection=1381001,kError_PlatformRequests_OutOfRequests=1381002,kError_RichMediaContent_NoMoreFlash=1380004,kError_RichMediaContent_AddFlashFailure=1380005,kError_Queues_UnknownCommand=1382001,kError_TPS_CRUpdateFrequentCollFailed=1350068,kError_TPS_CRDeleteFrequentCollFailed=1350069,kError_TPS_CRUpdateInitialCRFailed=1350070,kError_TPS_CRDeleteInitialCRFailed=1350071,kError_MYPages_BlockUserFailed=1373005,kError_Reviews_TooLong=1362003,kError_Reviews_MissingRequiredFields=1362004,kError_Reviews_DeleteFailed=1362005,kError_MYPayments_InvalidParamters=1383001,kError_MYPayments_UnableToCreateOrder=1383002,kError_TPS_CROrderUpdateFailed=1350072,kError_Maps_DeskDeleteFailure=1384001,kError_Maps_DeskAssignFailure=1384002,kError_Maps_DeskRotateFailure=1384003,kError_Maps_DeskCreateFailure=1384004,kError_Maps_DeskMoveFailure=1384005,kError_Mobile_InvalidIP=1347005,kError_Bookmarks_AddBookmarkFailed=1385001,kError_Bookmarks_RemoveBookmarkFailed=1385002,kError_TPS_CRDeleteFailed=1350073,kError_TPS_CRDeleteFailedSpecial=1350074,kError_TPS_CRDeleteCollectionFailed=1350075,kError_TPS_CRDeleteCollectionFailedSpecial=1350076;

function animation(obj){if(obj==undefined){Util.error("Creating animation on non-existant object");return;}
if(this==window){return new animation(obj);}else{this.obj=obj;this._reset_state();this.queue=[];this.last_attr=null;}}
animation.resolution=20;animation.offset=0;animation.prototype._reset_state=function(){this.state={attrs:{},duration:500}}
animation.prototype.stop=function(){this._reset_state();this.queue=[];return this;}
animation.prototype._build_container=function(){if(this.container_div){this._refresh_container();return;}
if(this.obj.firstChild&&this.obj.firstChild.__animation_refs){this.container_div=this.obj.firstChild;this.container_div.__animation_refs++;this._refresh_container();return;}
var container=document.createElement('div');container.style.padding='0px';container.style.margin='0px';container.style.border='0px';container.__animation_refs=1;var children=this.obj.childNodes;while(children.length){container.appendChild(children[0]);}
this.obj.appendChild(container);this.obj.style.overflow='hidden';this.container_div=container;this._refresh_container();}
animation.prototype._refresh_container=function(){this.container_div.style.height='auto';this.container_div.style.width='auto';this.container_div.style.height=this.container_div.offsetHeight+'px';this.container_div.style.width=this.container_div.offsetWidth+'px';}
animation.prototype._destroy_container=function(){if(!this.container_div){return;}
if(!--this.container_div.__animation_refs){var children=this.container_div.childNodes;while(children.length){this.obj.appendChild(children[0]);}
this.obj.removeChild(this.container_div);}
this.container_div=null;}
animation.ATTR_TO=1;animation.ATTR_BY=2;animation.ATTR_FROM=3;animation.prototype._attr=function(attr,value,mode){attr=attr.replace(/-[a-z]/gi,function(l){return l.substring(1).toUpperCase();});var auto=false;switch(attr){case'background':this._attr('backgroundColor',value,mode);return this;case'margin':value=animation.parse_group(value);this._attr('marginBottom',value[0],mode);this._attr('marginLeft',value[1],mode);this._attr('marginRight',value[2],mode);this._attr('marginTop',value[3],mode);return this;case'padding':value=animation.parse_group(value);this._attr('paddingBottom',value[0],mode);this._attr('paddingLeft',value[1],mode);this._attr('paddingRight',value[2],mode);this._attr('paddingTop',value[3],mode);return this;case'backgroundColor':case'borderColor':case'color':value=animation.parse_color(value);break;case'opacity':value=parseFloat(value,10);break;case'height':case'width':if(value=='auto'){auto=true;}else{value=parseInt(value,10);}
break;case'borderWidth':case'lineHeight':case'fontSize':case'marginBottom':case'marginLeft':case'marginRight':case'marginTop':case'paddingBottom':case'paddingLeft':case'paddingRight':case'paddingTop':case'bottom':case'left':case'right':case'top':case'scrollTop':case'scrollLeft':value=parseInt(value,10);break;default:throw new Error(attr+' is not a supported attribute!');}
if(this.state.attrs[attr]===undefined){this.state.attrs[attr]={};}
if(auto){this.state.attrs[attr].auto=true;}
switch(mode){case animation.ATTR_FROM:this.state.attrs[attr].start=value;break;case animation.ATTR_BY:this.state.attrs[attr].by=true;case animation.ATTR_TO:this.state.attrs[attr].value=value;break;}}
animation.prototype.to=function(attr,value){if(value===undefined){this._attr(this.last_attr,attr,animation.ATTR_TO);}else{this._attr(attr,value,animation.ATTR_TO);this.last_attr=attr;}
return this;}
animation.prototype.by=function(attr,value){if(value===undefined){this._attr(this.last_attr,attr,animation.ATTR_BY);}else{this._attr(attr,value,animation.ATTR_BY);this.last_attr=attr;}
return this;}
animation.prototype.from=function(attr,value){if(value===undefined){this._attr(this.last_attr,attr,animation.ATTR_FROM);}else{this._attr(attr,value,animation.ATTR_FROM);this.last_attr=attr;}
return this;}
animation.prototype.duration=function(duration){this.state.duration=duration?duration:0;return this;}
animation.prototype.checkpoint=function(distance,callback){if(distance===undefined){distance=1;}
this.state.checkpoint=distance;this.queue.push(this.state);this._reset_state();this.state.checkpointcb=callback;return this;}
animation.prototype.blind=function(){this.state.blind=true;return this;}
animation.prototype.hide=function(){this.state.hide=true;return this;}
animation.prototype.show=function(){this.state.show=true;return this;}
animation.prototype.ease=function(ease){this.state.ease=ease;return this;}
animation.prototype.go=function(){var time=(new Date()).getTime();this.queue.push(this.state);for(var i=0;i<this.queue.length;i++){this.queue[i].start=time-animation.offset;if(this.queue[i].checkpoint){time+=this.queue[i].checkpoint*this.queue[i].duration;}}
animation.push(this);return this;}
animation.prototype._frame=function(time){var done=true;var still_needs_container=false;var whacky_firefox=false;for(var i=0;i<this.queue.length;i++){var cur=this.queue[i];if(cur.start>time){done=false;continue;}
if(cur.checkpointcb){this._callback(cur.checkpointcb,time-cur.start);cur.checkpointcb=null;}
if(cur.started===undefined){if(cur.show){this.obj.style.display='block';}
for(var a in cur.attrs){if(cur.attrs[a].start!==undefined){continue;}
switch(a){case'backgroundColor':case'borderColor':case'color':var val=animation.parse_color(get_style(this.obj,a=='borderColor'?'borderLeftColor':a));if(cur.attrs[a].by){cur.attrs[a].value[0]=Math.min(255,Math.max(0,cur.attrs[a].value[0]+val[0]));cur.attrs[a].value[1]=Math.min(255,Math.max(0,cur.attrs[a].value[1]+val[1]));cur.attrs[a].value[2]=Math.min(255,Math.max(0,cur.attrs[a].value[2]+val[2]));}
break;case'opacity':var val=get_opacity(this.obj);if(cur.attrs[a].by){cur.attrs[a].value=Math.min(1,Math.max(0,cur.attrs[a].value+val));}
break;case'height':case'width':var val=animation['get_'+a](this.obj);if(cur.attrs[a].by){cur.attrs[a].value+=val;}
break;case'scrollLeft':case'scrollTop':var val=(this.obj==document.body)?(document.documentElement[a]||document.body[a]):this.obj[a];if(cur.attrs[a].by){cur.attrs[a].value+=val;}
cur['last'+a]=val;break;default:var val=parseInt(get_style(this.obj,a),10);if(cur.attrs[a].by){cur.attrs[a].value+=val;}
break;}
cur.attrs[a].start=val;}
if((cur.attrs.height&&cur.attrs.height.auto)||(cur.attrs.width&&cur.attrs.width.auto)){if(ua.firefox()<3){whacky_firefox=true;}
this._destroy_container();for(var a in{height:1,width:1,fontSize:1,borderLeftWidth:1,borderRightWidth:1,borderTopWidth:1,borderBottomWidth:1,paddingLeft:1,paddingRight:1,paddingTop:1,paddingBottom:1}){if(cur.attrs[a]){this.obj.style[a]=cur.attrs[a].value+(typeof cur.attrs[a].value=='number'?'px':'');}}
if(cur.attrs.height&&cur.attrs.height.auto){cur.attrs.height.value=animation.get_height(this.obj);}
if(cur.attrs.width&&cur.attrs.width.auto){cur.attrs.width.value=animation.get_width(this.obj);}}
cur.started=true;if(cur.blind){this._build_container();}}
var p=(time-cur.start)/cur.duration;if(p>=1){p=1;if(cur.hide){this.obj.style.display='none';}}else{done=false;}
var pc=cur.ease?cur.ease(p):p;if(!still_needs_container&&p!=1&&cur.blind){still_needs_container=true;}
if(whacky_firefox&&this.obj.parentNode){var parentNode=this.obj.parentNode;var nextChild=this.obj.nextSibling;parentNode.removeChild(this.obj);}
for(var a in cur.attrs){switch(a){case'backgroundColor':case'borderColor':case'color':this.obj.style[a]='rgb('+
animation.calc_tween(pc,cur.attrs[a].start[0],cur.attrs[a].value[0],true)+','+
animation.calc_tween(pc,cur.attrs[a].start[1],cur.attrs[a].value[1],true)+','+
animation.calc_tween(pc,cur.attrs[a].start[2],cur.attrs[a].value[2],true)+')';break;case'opacity':set_opacity(this.obj,animation.calc_tween(pc,cur.attrs[a].start,cur.attrs[a].value));break;case'height':case'width':this.obj.style[a]=pc==1&&cur.attrs[a].auto?'auto':animation.calc_tween(pc,cur.attrs[a].start,cur.attrs[a].value,true)+'px';break;case'scrollLeft':case'scrollTop':var val=(this.obj==document.body)?(document.documentElement[a]||document.body[a]):this.obj[a];if(cur['last'+a]!=val){delete cur.attrs[a];}else{var diff=animation.calc_tween(pc,cur.attrs[a].start,cur.attrs[a].value,true)-val;if(a=='scrollLeft'){window.scrollBy(diff,0);}else{window.scrollBy(0,diff);}
cur['last'+a]=diff+val;}
break;default:this.obj.style[a]=animation.calc_tween(pc,cur.attrs[a].start,cur.attrs[a].value,true)+'px';break;}}
if(p==1){this.queue.splice(i--,1);this._callback(cur.ondone,time-cur.start-cur.duration);}}
if(whacky_firefox){parentNode[nextChild?'insertBefore':'appendChild'](this.obj,nextChild);}
if(!still_needs_container&&this.container_div){this._destroy_container();}
return!done;}
animation.prototype.ondone=function(fn){this.state.ondone=fn;return this;}
animation.prototype._callback=function(callback,offset){if(callback){animation.offset=offset;callback.call(this);animation.offset=0;}}
animation.calc_tween=function(p,v1,v2,whole){return(whole?parseInt:parseFloat)((v2-v1)*p+v1,10);}
animation.parse_color=function(color){var hex=/^#([a-f0-9]{1,2})([a-f0-9]{1,2})([a-f0-9]{1,2})$/i.exec(color);if(hex){return[parseInt(hex[1].length==1?hex[1]+hex[1]:hex[1],16),parseInt(hex[2].length==1?hex[2]+hex[2]:hex[2],16),parseInt(hex[3].length==1?hex[3]+hex[3]:hex[3],16)];}else{var rgb=/^rgba? *\(([0-9]+), *([0-9]+), *([0-9]+)(?:, *([0-9]+))?\)$/.exec(color);if(rgb){if(rgb[4]==='0'){return[255,255,255];}else{return[parseInt(rgb[1],10),parseInt(rgb[2],10),parseInt(rgb[3],10)];}}else if(color=='transparent'){return[255,255,255];}else{throw'Named color attributes are not supported.';}}}
animation.parse_group=function(value){var value=trim(value).split(/ +/);if(value.length==4){return value;}else if(value.length==3){return[value[0],value[1],value[2],value[1]];}else if(value.length==2){return[value[0],value[1],value[0],value[1]];}else{return[value[0],value[0],value[0],value[0]];}}
animation.get_height=function(obj){var pT=parseInt(get_style(obj,'paddingTop'),10),pB=parseInt(get_style(obj,'paddingBottom'),10),bT=parseInt(get_style(obj,'borderTopWidth'),10),bW=parseInt(get_style(obj,'borderBottomWidth'),10);return obj.offsetHeight-(pT?pT:0)-(pB?pB:0)-(bT?bT:0)-(bW?bW:0);}
animation.get_width=function(obj){var pL=parseInt(get_style(obj,'paddingLeft'),10),pR=parseInt(get_style(obj,'paddingRight'),10),bL=parseInt(get_style(obj,'borderLeftWidth'),10),bR=parseInt(get_style(obj,'borderRightWidth'),10);return obj.offsetWidth-(pL?pL:0)-(pR?pR:0)-(bL?bL:0)-(bR?bR:0);}
animation.push=function(instance){if(!animation.active){animation.active=[];}
animation.active.push(instance);if(!animation.timeout){animation.timeout=setInterval(animation.animate.bind(animation),animation.resolution);}
animation.animate(true);}
animation.animate=function(last){var done=true;var time=(new Date()).getTime();for(var i=last===true?animation.active.length-1:0;i<animation.active.length;i++){if(animation.active[i]._frame(time)){done=false;}else{animation.active.splice(i--,1);}}
if(done){clearInterval(animation.timeout);animation.timeout=null;}}
animation.ease={}
animation.ease.begin=function(p){return p*p;}
animation.ease.end=function(p){p-=1;return-(p*p)+1;}
animation.ease.both=function(p){if(p<=0.5){return(p*p)*2;}else{p-=1;return(p*p)*-2+1;}}

function Dialog(){Dialog._setup();this._pd=new pop_dialog();this._pd._dialog_object=this;}
Dialog.OK={name:'ok',label:tx('sh:ok-button')};Dialog.CANCEL={name:'cancel',label:tx('sh:cancel-button'),className:'inputaux'};Dialog.CLOSE={name:'close',label:tx('sh:close-button')};Dialog.SAVE={name:'save',label:tx('sh:save-button')};Dialog.OK_AND_CANCEL=[Dialog.OK,Dialog.CANCEL];Dialog._STANDARD_BUTTONS=[Dialog.OK,Dialog.CANCEL,Dialog.CLOSE,Dialog.SAVE];Dialog.getCurrent=function(){var stack=generic_dialog.dialog_stack;if(stack.length==0){return null;}
return stack[stack.length-1]._dialog_object||null;};Dialog._basicMutator=function(private_key){return function(value){this[private_key]=value;this._dirty();return this;};};copy_properties(Dialog.prototype,{show:function(){this._showing=true;this._dirty();return this;},hide:function(){this._showing=false;if(this._autohide_timeout){clearTimeout(this._autohide_timeout);this._autohide_timeout=null;}
this._pd.fade_out(250);return this;},setTitle:Dialog._basicMutator('_title'),setBody:Dialog._basicMutator('_body'),setAutohide:function(autohide){if(autohide){if(this._showing){this._autohide_timeout=setTimeout(bind(this,'hide'),autohide);}else{this._autohide=autohide;}}else{this._autohide=null;if(this._autohide_timeout){clearTimeout(this._autohide_timeout);this._autohide_timeout=null;}}
return this;},setSummary:Dialog._basicMutator('_summary'),setButtons:function(buttons){if(!(buttons instanceof Array)){buttons=[buttons];}
for(var i=0;i<buttons.length;++i){if(typeof(buttons[i])=='string'){var button=Dialog._findButton(Dialog._STANDARD_BUTTONS,buttons[i]);if(!button){Util.error('Unknown button: '+buttons[i]);}
buttons[i]=button;}}
this._buttons=buttons;this._dirty();return this;},setButtonsMessage:Dialog._basicMutator('_buttons_message'),setStackable:Dialog._basicMutator('_is_stackable'),setHandler:function(handler){this._handler=handler;return this;},setPostURI:function(post_uri){this.setHandler(this._submitForm.bind(this,'POST',post_uri));return this;},setGetURI:function(get_uri){this.setHandler(this._submitForm.bind(this,'GET',get_uri));return this;},setModal:function(modal){if(modal===undefined){modal=true;}
if(this._showing&&this._modal&&!modal){Util.error("At the moment we don't support un-modal-ing a modal dialog");}
this._modal=modal;return this;},setContentWidth:function(width){this._content_width=width;this._dirty();return this;},setClassName:Dialog._basicMutator('_class_name'),setCloseHandler:function(close_handler){this._close_handler=call_or_eval.bind(null,null,close_handler);return this;},setAsync:function(async_request){var handler=function(response){if(this._async_request!=async_request){return;}
this._async_request=null;var payload=response.getPayload();if(typeof(payload)=='string'){this.setBody(payload);}else{for(var propertyName in payload){var mutator=this['set'+propertyName.substr(0,1).toUpperCase()
+propertyName.substr(1)];if(!mutator){Util.error("Unknown Dialog property: "+propertyName);}
mutator.call(this,payload[propertyName]);}}
this._dirty();}.bind(this);var hide=bind(this,'hide');async_request.setHandler(chain(async_request.getHandler(),handler)).setErrorHandler(chain(hide,async_request.getErrorHandler())).setTransportErrorHandler(chain(hide,async_request.getTransportErrorHandler())).send();this._async_request=async_request;this._dirty();return this;},_dirty:function(){if(!this._is_dirty){this._is_dirty=true;bind(this,'_update').defer();}},_update:function(){this._is_dirty=false;if(!this._showing){return;}
if(this._autohide&&!this._async_request&&!this._autohide_timeout){this._autohide_timeout=setTimeout(bind(this,'hide'),this._autohide);}
if(this._class_name){this._pd.setClassName(this._class_name);}
if(!this._async_request){var html=[];if(this._title){html.push('<h2><span>'+this._title+'</span></h2>');}
html.push('<div class="dialog_content">');if(this._summary){html.push('<div class="dialog_summary">');html.push(this._summary);html.push('</div>');}
html.push('<div class="dialog_body">');html.push(this._body);html.push('</div>');if(this._buttons||this._buttons_message){html.push('<div class="dialog_buttons">');if(this._buttons_message){html.push('<div class="dialog_buttons_msg">');html.push(this._buttons_message);html.push('</div>');}
if(this._buttons){this._buttons.forEach(function(button){html.push('<input class="inputsubmit '+(button.className||'')+'"'
+' type="button"'
+(button.name?(' name="'+button.name+'"'):'')
+' value="'+htmlspecialchars(button.label)+'"'
+' onclick="Dialog.getCurrent().handleButton(this.name);" />');},this);}
html.push('</div>');}
html.push('</div>');this._pd.show_dialog(html.join(''));}else{var title=this._title||tx('sh:loading');this._pd.show_loading_title(title);}
if(this._modal){this._pd.make_modal();}
if(this._content_width){this._pd.popup.childNodes[0].style.width=(this._content_width+42)+'px';}
this._pd.is_stackable=this._is_stackable;this._pd.close_handler=this._close_handler;},handleButton:function(button){if(typeof(button)=='string'){button=Dialog._findButton(this._buttons,button);}
if(!button){Util.error('Huh?  How did this button get here?');return;}
if(call_or_eval(button,button.handler)===false){return;}
if(button!=Dialog.CANCEL){if(call_or_eval(this,this._handler,{button:button})===false){return;}}
this.hide();},_submitForm:function(method,uri,button){var data=this._getFormData();data[button.name]=button.label;var async_request=new AsyncRequest().setURI(uri).setData(data).setMethod(method).setReadOnly(method=='GET');this.setAsync(async_request);return false;},_getFormData:function(){var dialog_content_divs=DOM.scry(this._pd.content,'div.dialog_content');if(dialog_content_divs.length!=1){Util.error(dialog_content_divs.length
+" dialog_content divs in this dialog?  Weird.");}
return serialize_form(dialog_content_divs[0]);}});Dialog._findButton=function(buttons,name){for(var i=0;i<buttons.length;++i){if(buttons[i].name==name){return buttons[i];}}
return null;};Dialog._setup=function(){if(Dialog._is_set_up){return;}
Dialog._is_set_up=true;var filter=function(event,type){return KeyEventController.filterEventTypes(event,type)&&KeyEventController.filterEventModifiers(event,type);};KeyEventController.registerKey('ESCAPE',Dialog._handleEscapeKey,filter);};Dialog._handleEscapeKey=function(event,type){var dialog=Dialog.getCurrent();if(!dialog){return true;}
var buttons=dialog._buttons;if(!buttons){return true;}
var cancel_button=Dialog._findButton(buttons,'cancel');if(cancel_button){var button_to_simulate=cancel_button;}else if(buttons.length==1){var button_to_simulate=buttons[0];}else{return true;}
dialog.handleButton(button_to_simulate);return false;}

var LinkController={ALL:1,ALL_LINK_TARGETS:2,ALL_KEY_MODIFIERS:4,registerHandler:function(callback,filters){LinkController._registerHandler(LinkController._handlers,callback,filters);},registerFallbackHandler:function(callback,filters){LinkController._registerHandler(LinkController._fallback_handlers,callback,filters);},bindLinks:function(root_element){var tabconsole=ge('tabconsole');if(tabconsole){if((root_element.id&&root_element.id.substring(0,8)=='cacheobs')||is_descendent(root_element,tabconsole)){return;}}
var should_insert=ua.firefox()&&!is_descendent(root_element,document.body);if(should_insert){var invisible_div=ge('an_invisible_div');if(!invisible_div){invisible_div=DOM.create('div',{id:'an_invisible_div'});invisible_div.style.display='none';document.body.appendChild(invisible_div);}
invisible_div.appendChild(root_element);}
var links=root_element.getElementsByTagName('a');try{for(var i=0;i<links.length;++i){if(links[i].onclick){links[i].onclick=chain(links[i].onclick,LinkController._onclick);}else{links[i].onclick=LinkController._onclick;}}}catch(ex){Util.error('Uncaught exception while chaining onclick handler for %s: %s',links[i],ex);}
if(should_insert){invisible_div.removeChild(root_element);}},_onclick:function(event){var link=this;event=event_get(event);var handlers=LinkController.getHandlers();for(var i=0;i<handlers.length;++i){var callback=handlers[i].callback;var filters=handlers[i].filters;try{if(LinkController._filter(filters,link,event)){var abort=callback(link,event);if(abort===false){return event_abort(event);}}}catch(exception){Util.error('Uncaught exception in link handler: %x',exception);}}},getHandlers:function(){return LinkController._handlers.concat(LinkController._fallback_handlers);},_init:function(){if(LinkController._initialized){return;}
LinkController._initialized=true;onloadRegister(function(){LinkController.bindLinks(document.body);});},_registerHandler:function(handler_array,callback,filters){LinkController._init();handler_array.push({callback:callback,filters:filters||0});},_filter:function(filters,link,event){if(filters&LinkController.ALL){return true;}
if(!(filters&LinkController.ALL_LINK_TARGETS)){if(link.target){return false;}}
if(!(filters&LinkController.ALL_KEY_MODIFIERS)){if(event.ctrlKey||event.shiftKey||event.altKey||event.metaKey){return false;}}
return true;},_handlers:[],_fallback_handlers:[]};var MYML=(function(){var _addEventListener;var invoked_dialogs=Array();var form_hidden_inputs=null;if(window.addEventListener){_addEventListener=function(obj,eventName,fun){obj.addEventListener(eventName,fun,false);}}else{_addEventListener=function(obj,eventName,fun){obj.attachEvent("on"+eventName,fun);}}
if(typeof typeaheadpro!='undefined'){function friendSelector(obj,source,properties){var idInput=document.createElement('INPUT');idInput.name=obj.getAttribute('idname');idInput.type='hidden';idInput.setAttribute('my_protected','true');idInput.typeahead=this;if(obj.form){obj.form.appendChild(idInput);}
this._idInput=idInput;return this.parent.construct(this,obj,source,properties);}
friendSelector.extend(typeaheadpro);friendSelector.prototype.destroy=function(){this._idInput.parentNode.removeChild(this._idInput);this._idInput.typeahead=null;this._idInput=null;this.parent.destroy();}
friendSelector.prototype._onselect=function(e){this.parent._onselect(e);if(e.i){this._idInput.value=e.i;}else if(e.is){this._idInput.value=e.is;}}}else{friendSelector=null;}
var Contexts=new Object();function err(msg){if(window.console){window.console.log('Manyou MYML Mock AJAX ERROR: '+msg);}
return false;}
function attachCurlFromObject(ajax_params,container,pre_fn,post_fn){if(!ajax_params['url']){return err("no input with id url in form");}
if(!ajax_params['my_sig_api_key']){return err("no input with id my_api_key in form");}
if(pre_fn){pre_fn();}
attachCurlFromFormValues(ajax_params,container,post_fn);}
function attachCurlFromFormValues(ajax_params,container,post_fn){new AsyncRequest().setURI('/myml/ajax/attach.php').setData(ajax_params).setMethod('POST').setHandler(function(response){if(post_fn){post_fn();}
if(!container.removed){set_inner_html(container,response.getPayload().html);}}.bind(this)).send();}
function attachFromPreview(context){if(context=='wall'){var attachments=wallAttachments;}else if(context=='message'){var attachments=inboxAttachments;}
if(attachments){var parent=ge(attachments.edit_id);var inputs=attachments.get_all_form_elements(parent);var params=Object();for(var i=0;i<inputs.length;i++){if(!(inputs[i].type=="radio"||inputs[i].type=="checkbox")||inputs[i].checked){params[inputs[i].name]=inputs[i].value;}}
params['context']=attachments.context;params['action']='edit';attachCurlFromFormValues(params,parent);}}
function clickRewriteAjax(app_id,loggedIn,targetId,url,formId,loadingHTML){this.requireLogin(app_id,function(){return _clickRewriteAjax(targetId,url,formId,loadingHTML);});return false;}
function _clickRewriteAjax(targetId,url,formId,loadingHTML){var target=ge(targetId);if(!target){return err("target "+targetId+" not found");}
var hContext=target.getAttribute("mycontext");var sContext=MYML.Contexts[hContext];var form=null;if(typeof formId=="string"){form=ge(formId);}else{form=formId;}
if(!form){return err("You must either specify a clickrewriteform (an id) or use the clickrewrite attribute inside a form");}
var owner_id=typeof this.PROFILE_OWNER_ID=='undefined'?0:this.PROFILE_OWNER_ID;addHiddenInputs(form);var post=serialize_form(form);post["my_mockajax_context"]=sContext;post["my_mockajax_context_hash"]=hContext;post["my_mockajax_url"]=url;post["my_target_id"]=owner_id;new AsyncRequest().setURI(MYML._mockAjaxProxyUrl).setMethod("POST").setMYMLForm().setData(post).setHandler(function(response){var ma=response.getPayload();if(ma.ok){set_inner_html(target,ma.html);}else{return err(ma["error_message"]);}
MYML.mockAjaxResponse=ma;return ma.ok;}.bind(this)).setErrorHandler(function(response){return err("Failed to successfully retrieve data from Manyou when making mock AJAX call to rewrite id "+targetId);}.bind(this)).send();if(loadingHTML){target.innerHTML=loadingHTML;}
return false;}
function clickToShow(targetId){return clickToSetDisplay(targetId,"");}
function clickToShowDialog(targetId){var dialog_elem=null;if(dialog_elem=ge(targetId)){var dialog_content=dialog_elem.parentNode.innerHTML;dialog_elem.id='dialog_invoked_'+dialog_elem.id;invoked_dialogs[dialog_elem.id]=dialog_elem.cloneNode(true);dialog_elem.innerHTML='';var dialog=new pop_dialog();dialog.is_stackable=true;dialog.show_dialog(dialog_content);}
return false;}
function closeDialogInvoked(obj){var hidden_dialog=null;for(dialog_id in invoked_dialogs){if(hidden_dialog=ge(dialog_id)){var old_id=hidden_dialog.id.replace('dialog_invoked_','');var old_elem=null;if(old_elem=ge(old_id)){old_elem.id='dialog_closed_'+old_id;}
var parent=hidden_dialog.parentNode;parent.innerHTML='';parent.appendChild(invoked_dialogs[dialog_id]);invoked_dialogs[dialog_id].id=old_id;}}
generic_dialog.get_dialog(obj).fade_out(100);}
function clickToHide(targetId){return clickToSetDisplay(targetId,"none");}
function clickToToggle(targetId){var target=ge(targetId);if(!target){return err("Could not find target "+targetId);}else{target.style.display=(target.style.display=="none")?'':'none';return false;}}
function clickToSetDisplay(targetId,disp){var target=ge(targetId);if(!target){return err("Could not find target "+targetId);}else{target.style.display=disp;return false;}}
function clickToEnable(targetId){return clickToSetDisabled(targetId,'');}
function clickToDisable(targetId){return clickToSetDisabled(targetId,'disabled');}
function clickToSetDisabled(targetId,disabled){var target=ge(targetId);if(!target){return err("Could not find target "+targetId);}else{target.disabled=disabled;return false;}}
function mymlLogin(app_id){new AsyncRequest().setURI('/ajax/api/tos.php').setData({app_id:app_id,grant_perm:1,profile_id:typeof PROFILE_OWNER_ID=='undefined'?0:PROFILE_OWNER_ID,api_key:$('api_key').value,auth_token:$('auth_token').value,save_login:$('save_login').checked==false?0:1}).setHandler(bind(this,function(response){if(response.getPayload()){form_hidden_inputs=response.getPayload();}
this.loginDialog&&this.loginDialog.fade_out(100);this.loginContinuation&&this.loginContinuation();this.loginCancellation=this.loginContinuation=this.loginDialog=null;})).send();}
function cancelLogin(){this.loginCancellation&&this.loginCancellation();this.loginDialog&&this.loginDialog.fade_out(100);this.loginContinuation=this.loginCancellation=this.loginDialog=null;}
function addHiddenInputs(form_obj){if(form_hidden_inputs){var i;for(i=form_obj.childNodes.length-1;i>=0;i--){if(form_obj.childNodes[i].name&&form_obj.childNodes[i].name.indexOf('my_sig')==0){form_obj.removeChild(form_obj.childNodes[i]);}}
for(keyVar in form_hidden_inputs){var newInput=document.createElement('input');newInput.name=keyVar;newInput.value=form_hidden_inputs[keyVar];newInput.type='hidden';form_obj.appendChild(newInput);}}}
function requireLogin(app_id,continuation,cancellation){if(this.loginDialog){return;}
this.loginDialog=new pop_dialog('api_confirmation');this.loginDialog.is_stackable=true;this.loginContinuation=continuation;this.loginCancellation=cancellation;new AsyncRequest().setURI('/ajax/api/tos.php').setData({app_id:app_id,profile_id:typeof PROFILE_OWNER_ID=='undefined'?0:PROFILE_OWNER_ID}).setReadOnly(true).setHandler(bind(this,function(continuation,response){if(response.getPayload()){this.loginDialog.show_dialog(response.getPayload());}else{continuation();this.loginCancellation=null;this.loginContinuation=null;this.loginDialog=null;}},continuation)).send();}
function attrBool(element,attr,defaultValue){if(!defaultValue){defaultValue=false;}
var el=ge(element);if(el.hasAttribute(attr)){var val=el.getAttribute(attr).toLowerCase();switch(val){case"false":case"no":case"0":return false;case"true":case"yes":return true;default:var intval=parseInt(val);if((intval<0)||(intval>0)){return true;}
return defaultValue;}}}
function sendRequest(request_form,app_id,request_type,invite,preview,is_multi,prefill){var message='';if(!preview){if(is_multi){request_form.onSubmit=fsth.captured_event;}
message=$('message').value;}
if(prefill){var ids=[];ids.push(prefill);}else{var inputs=request_form.getElementsByTagName('input');var ids=[];for(var i=0;i<inputs.length;i++){if(inputs[i].getAttribute('my_protected')=='true'&&(inputs[i].name=='ids[]'||inputs[i].name=='friend_selector_id')&&(inputs[i].type!='checkbox'||inputs[i].checked)){ids.push(inputs[i].value);}}}
var data={app_id:app_id,to_ids:ids,request_type:request_type,invite:invite,content:request_form.getAttribute('content'),preview:preview,is_multi:is_multi,form_id:request_form.id,prefill:(prefill>0),message:message,donot_send:ge('donotsend')?$('donotsend').checked:false};var async=new AsyncRequest().setURI('/ajax/confirm').setData(data);if(preview){new Dialog().setAsync(async).setStackable(true).show();}else{async.setHandler(function(result){request_form.submit();}).send();}
return false;}
function cancelDialog(elem){generic_dialog.get_dialog(elem).fade_out(100);}
function removeReqRecipient(userid,request_form,is_multi){if(is_multi){fs.unselect(userid);fs.force_reset();}else{var inputs=request_form.getElementsByTagName('input');for(var i=0;i<inputs.length;i++){if(inputs[i].getAttribute('my_protected')=='true'&&inputs[i].value==userid){if(inputs[i].name=='ids[]'){if(inputs[i].type=='checkbox'){if(inputs[i].checked){inputs[i].click();}}else{inputs[i].parentNode.parentNode.parentNode.parentNode.parentNode.token.remove(true);}}else if(inputs[i].name=='friend_selector_id'){inputs[i].typeahead.select_suggestion(false);inputs[i].typeahead.set_value('');inputs[i].value='';}}}}
var span=ge('sp'+userid);var recipients_list=span.parentNode;recipients_list.removeChild(span);for(var i=0;i<recipients_list.childNodes.length;i++){if(recipients_list.childNodes[i].nodeName=='SPAN'){return false;}}
generic_dialog.get_dialog(recipients_list).fade_out(100);return false;}
function showFeedConfirmed(next){hide($('feed_buttons'));set_inner_html($('feed_dialog'),'<div class="status"><h3>'+tx('myml:publish-story')+'</h3></div>');setTimeout(function(){document.location=next;},500);}
function showApplicationError(response){this.hide(false);var showError=function(showMsg){(new ErrorDialog()).showError(response.getPayload().errorTitle,showMsg?(response.getPayload().errorMessage):tx('myml:dialog-error'));}
var err=response.getError();if(err==kError_Platform_CallbackValidationFailure){showError(true);}else if(err==kError_Platform_ApplicationResponseInvalid){if(response.getPayload().showDebug){showError(true);}else{var next=response.getPayload().next;if(next){document.location=next;}else{showError(false);}}}else{ErrorDialog.showAsyncError(response);}}
function removeFeedRecipient(user){var to_ids=$('my_to_ids').value.split(',');var feed=$('my_feed').value;var next=$('my_next').value;var app_id=$('my_app_id').value;var new_to_ids=to_ids.filter(function(u){return u!=user});$('my_to_ids').value=new_to_ids.join(',');if(new_to_ids.length==0){document.location=next;}else{DOM.remove('fe'+user);}}
function confirmMultiFeed(feed){var to_ids=$('my_to_ids').value.split(',');var next=$('my_next').value;var app_id=$('my_app_id').value;var data={feed_info:feed,to_ids:to_ids,preview:false,multiFeed:true,app_id:app_id};var ajax_uri='/myml/ajax/prompt_feed.php';new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(showFeedConfirmed.bind(null,next)).setErrorHandler(function(err){aiert('error: '+err);}).send();}
function sendMultiFeed(multifeed_form,app_id,prefill){var ids=[];if(prefill){ids.push(prefill);}else{var inputs=multifeed_form.getElementsByTagName('input');for(var i=0;i<inputs.length;i++){if(inputs[i].getAttribute('my_protected')=='true'&&(inputs[i].name=='ids[]'||inputs[i].name=='friend_selector_id')&&(inputs[i].type!='checkbox'||inputs[i].checked)){ids.push(inputs[i].value);}}}
var data={app_id:app_id,to_ids:ids,callback:multifeed_form.action,preview:true,form_id:multifeed_form.id,next:multifeed_form.getAttribute('mynext'),prefill:(prefill>0),elements:serialize_form(multifeed_form),multiFeed:true};var ajax_uri='/myml/ajax/prompt_feed.php';var dialog=new pop_dialog('interaction_form');dialog.is_stackable=true;dialog.show_loading(tx('sh:loading'));new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(function(resp){dialog.show_dialog(resp.getPayload().content,true);}).setErrorHandler(showApplicationError.bind(dialog)).send();return false;}
function confirmFeed(feed,next,app_id){var data={feed_info:feed,next:next,preview:false,multiFeed:false,app_id:app_id};var ajax_uri='/myml/ajax/prompt_feed.php';new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(showFeedConfirmed.bind(null,next)).send();}
function sendFeed(feed_form,app_id){var data={app_id:app_id,preview:true,callback:feed_form.getAttribute('action'),elements:serialize_form(feed_form),multiFeed:false,next:feed_form.getAttribute('mynext')};var ajax_uri='/myml/ajax/prompt_feed.php';var dialog=new pop_dialog('interaction_form');dialog.is_stackable=true;dialog.show_loading(tx('sh:loading'));new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(function(resp){dialog.show_dialog(resp.getPayload().content,true);}).setErrorHandler(showApplicationError.bind(dialog)).send();return false;}
function createProfileBox(profile_form,app_id,callback,update){var dialog=new pop_dialog('profile_form');dialog.is_stackable=true;dialog.show_loading(tx('sh:loading'));var data={app_id:app_id,callback:callback,form_id:profile_form.id,elements:serialize_form(profile_form),update:update};var ajax_uri='/myml/ajax/fetch_profile_box.php';new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(function(resp){dialog.show_dialog(resp.getPayload().content,true);}).setErrorHandler(showApplicationError.bind(dialog)).send();}
function confirmProfileBox(profile_myml,profile){var next=$('my_next').value;var app_id=$('my_app_id').value;var data={profile_myml:profile_myml,app_id:app_id,next:next,confirm:true};var showBoxConfirmed=function(user){hide($('dialog_buttons'));set_inner_html($('dialog_body'),'<div id="status" class="status"><h3>'+tx('myml:confirm-box')+'</h3>'+tx('myml:redirect-prof')+'</div>');setTimeout(function(){document.location=profile;},1000);}
var ajax_uri='/myml/ajax/fetch_profile_box.php';new AsyncRequest().setURI(ajax_uri).setData(data).setHandler(showBoxConfirmed).send();}
var stripLinks=function(container){var links=container.getElementsByTagName('a');for(var i=0;i<links.length;i++){if(!links[i].getAttribute('flash')){addEventBase(links[i],'click',event_kill);}}
var forms=container.getElementsByTagName('form');for(var i=0;i<forms.length;i++){forms[i].onsubmit=function(){return false;};}}
return{friendSelector:friendSelector,Contexts:Contexts,attachCurlFromObject:attachCurlFromObject,attachFromPreview:attachFromPreview,clickRewriteAjax:clickRewriteAjax,clickToShow:clickToShow,clickToShowDialog:clickToShowDialog,clickToHide:clickToHide,clickToEnable:clickToEnable,clickToDisable:clickToDisable,clickToToggle:clickToToggle,closeDialogInvoked:closeDialogInvoked,confirmFeed:confirmFeed,sendFeed:sendFeed,sendRequest:sendRequest,removeReqRecipient:removeReqRecipient,confirmMultiFeed:confirmMultiFeed,confirmProfileBox:confirmProfileBox,cancelDialog:cancelDialog,sendMultiFeed:sendMultiFeed,removeFeedRecipient:removeFeedRecipient,addHiddenInputs:addHiddenInputs,mymlLogin:mymlLogin,cancelLogin:cancelLogin,requireLogin:requireLogin,createProfileBox:createProfileBox,stripLinks:stripLinks};})();function myjs_sandbox(appid){if(myjs_sandbox.instances['a'+appid]){return myjs_sandbox.instances['a'+appid];}
this.appid=appid;this.pending_bootstraps=[];this.bootstrapped=false;myjs_sandbox.instances['a'+appid]=this;}
myjs_sandbox.instances={};myjs_sandbox.prototype.bootstrap=function(){if(!this.bootstrapped){var appid=this.appid;var code=['a',appid,'_Math = new myjs_math();','a',appid,'_Date = myjs_date();','a',appid,'_String = new myjs_string();','a',appid,'_RegExp = new myjs_regexp();','a',appid,'_Ajax = myjs_ajax(',appid,');','a',appid,'_Dialog = myjs_dialog(',appid,');','a',appid,'_Manyou = new myjs_Manyou(',appid,');','a',appid,'_Animation = new myjs_animation();','a',appid,'_document = new myjs_main(',appid,');','a',appid,'_undefined = undefined;','a',appid,'_console = new myjs_console();','a',appid,'_setTimeout = myjs_sandbox.set_timeout;','a',appid,'_setInterval = myjs_sandbox.set_interval;','a',appid,'_escape = escapeURI;','a',appid,'_unescape = unescape;'];for(var i in{clearTimeout:1,clearInterval:1,parseFloat:1,parseInt:1,isNaN:1,isFinite:1}){code=code.concat(['a',appid,'_',i,'=',i,';']);}
eval(code.join(''));}
for(var i=0,il=this.pending_bootstraps.length;i<il;i++){eval_global(this.pending_bootstraps[i]);}
this.pending_bootstraps=[];this.bootstrapped=true;}
function ref(that){if(that==window){return null;}else if(that.ownerDocument==document){myjs_console.error('ref called with a DOM object!');return myjs_dom.get_instance(that);}else{return that;}}
function idx(b){return(b instanceof Object||myjs_blacklist_props[b])?'__unknown__':b;}
var myjs_blacklist_props={'caller':true}
function arg(args){var new_args=[];for(var i=0;i<args.length;i++){new_args.push(args[i]);}
return new_args;}
myjs_sandbox.safe_string=function(str){if(ua.safari()){delete String.prototype.replace;delete String.prototype.toLowerCase;}
return str+'';}
myjs_sandbox.set_timeout=function(js,timeout){if(typeof js!='function'){myjs_console.error('setTimeout may not be used with a string. Please enclose your event in an anonymous function.');}else{return setTimeout(js,timeout);}}
myjs_sandbox.set_interval=function(js,interval){if(typeof js!='function'){myjs_console.error('setInterval may not be used with a string. Please enclose your event in an anonymous function.');}else{return setInterval(js,interval);}}
function myjs_main(appid){myjs_private.get(this).appid=appid;}
myjs_main.allowed_elements={a:true,abbr:true,acronym:true,address:true,b:true,br:true,bdo:true,big:true,blockquote:true,caption:true,center:true,cite:true,code:true,del:true,dfn:true,div:true,dl:true,dd:true,dt:true,em:true,fieldset:true,font:true,form:true,h1:true,h2:true,h3:true,h4:true,h5:true,h6:true,hr:true,i:true,img:true,input:true,ins:true,iframe:true,kbd:true,label:true,legend:true,li:true,ol:true,option:true,optgroup:true,p:true,pre:true,q:true,s:true,samp:true,select:true,small:true,span:true,strike:true,strong:true,sub:true,sup:true,table:true,textarea:true,tbody:true,td:true,tfoot:true,th:true,thead:true,tr:true,tt:true,u:true,ul:true};myjs_main.allowed_editable={embed:true,object:true};myjs_main.allowed_events={focus:true,click:true,mousedown:true,mouseup:true,dblclick:true,change:true,reset:true,select:true,submit:true,keydown:true,keypress:true,keyup:true,blur:true,load:true,mouseover:true,mouseout:true,mousemove:true,selectstart:true};myjs_main.prototype.getElementById=function(id){var appid=myjs_private.get(this).appid;return myjs_dom.get_instance(document.getElementById('app'+appid+'_'+id),appid);}
myjs_main.prototype.getRootElement=function(){var appid=myjs_private.get(this).appid;return myjs_dom.get_instance(document.getElementById('app_content_'+appid).firstChild,appid);}
myjs_main.prototype.createElement=function(element){var mix=myjs_sandbox.safe_string(element.toLowerCase());if(myjs_main.allowed_elements[mix]){return myjs_dom.get_instance(document.createElement(mix),myjs_private.get(this).appid);}else{switch(mix){case'my:swf':return new myjs_myml_dom('my:swf',myjs_private.get(this).appid);break;default:myjs_console.error(mix+' is not an allowed DOM element');break;}}}
myjs_main.prototype.setLocation=function(url){url=myjs_sandbox.safe_string(url);if(myjs_dom.href_regex.test(url)){document.location.href=url;return this;}else{myjs_console.error(url+' is not a valid location');}}
function myjs_Manyou(appid){var priv=myjs_private.get(this);priv.sandbox=myjs_sandbox.instances['a'+appid];}
myjs_Manyou.prototype.getUser=function(){var priv=myjs_private.get(this);if(priv.sandbox.data.loggedin){return priv.sandbox.data.user;}else{return null;}}
myjs_Manyou.prototype.isApplicationAdded=function(){return myjs_private.get(this).sandbox.data.installed;}
myjs_Manyou.prototype.isLoggedIn=function(){return myjs_private.get(this).sandbox.data.loggedin;}
myjs_Manyou.prototype.urchinTracker=function(text){if(urchinTracker){urchinTracker(text);}else{myjs_console.error('There is no my:google-analytics tag on this page!');}}
function myjs_dom(obj,appid){this.__instance=myjs_dom.len;try{obj.myjs_instance=myjs_dom.len;}catch(e){}
myjs_dom[myjs_dom.len]={instance:this,obj:obj,events:{},appid:appid}
myjs_dom.len++;}
myjs_dom.len=0;myjs_dom.attr_setters={'href':'setHref','id':'setId','dir':'setDir','checked':'setChecked','action':'setAction','value':'setValue','target':'setTarget','src':'setSrc','class':'setClassName','dir':'setDir','title':'setTitle','tabIndex':'setTabIndex','name':'setName','cols':'setCols','rows':'setRows','accessKey':'setAccessKey','disabled':'setDisabled','readOnly':'setReadOnly','type':'setType','selectedIndex':'setSelectedIndex','selected':'setSelected'};myjs_dom.factory=function(obj,appid){if(!obj.tagName||((!myjs_main.allowed_elements[obj.tagName.toLowerCase()]&&!myjs_main.allowed_editable[obj.tagName.toLowerCase()])||has_css_class_name(obj,'__myml_tag')||(obj.tagName=='INPUT'&&(obj.name.substring(0,2)=='my'||obj.name=='post_form_id'))||obj.getAttribute('my_protected')=='true')){return null;}else{return new this(obj,appid);}}
myjs_dom.get_data=function(handle){if(handle.__instance instanceof Object){return null;}else{var data=myjs_dom[handle.__instance];return data.instance==handle?data:null;}}
myjs_dom.get_obj=function(handle){if(handle instanceof myjs_myml_dom){return myjs_myml_dom.get_obj(handle);}else{if(typeof handle.__instance=='number'){var data=myjs_dom[handle.__instance];if(data&&data.instance==handle){return data.obj;}else{throw('This DOM node is no longer valid.');}}else{throw('This DOM node is no longer valid.');}}}
myjs_dom.render=function(handle){if(handle instanceof myjs_myml_dom){myjs_myml_dom.render(handle);}}
myjs_dom.get_instance=function(obj,appid){if(!obj){return null;}
if(typeof obj.myjs_instance=='undefined'){return myjs_dom.factory(obj,appid);}else{return myjs_dom[obj.myjs_instance].instance;}}
myjs_dom.get_instance_list=function(list,appid){var objs=[];for(var i=0;i<list.length;i++){var obj=myjs_dom.get_instance(list[i],appid);if(obj){objs.push(obj);}}
return objs;}
myjs_dom.get_first_valid_instance=function(obj,next,appid){var ret=null;if(obj&&((obj.id&&obj.id.indexOf('app_content')!=-1)||(obj.tagName&&obj.tagName.toLowerCase()=='body'))){return null;}
while(obj&&(!(ret=myjs_dom.factory(obj,appid)))){if((obj.id&&obj.id.indexOf('app_content')!=-1)||(obj.tagName&&obj.tagName.toLowerCase()=='body')){return null;}
obj=obj[next];}
return ret;}
myjs_dom.clear_instances=function(obj,include){if(include&&obj.myjs_instance){delete myjs_dom[obj.myjs_instance].obj;delete myjs_dom[obj.myjs_instance].events;delete myjs_dom[obj.myjs_instance].instance;delete myjs_dom[obj.myjs_instance];obj.myjs_instance=undefined;}
var cn=obj.childNodes;for(var i=0;i<cn.length;i++){myjs_dom.clear_instances(cn[i],true);}}
myjs_dom.prototype.appendChild=function(child){myjs_dom.get_obj(this).appendChild(myjs_dom.get_obj(child));myjs_dom.render(child);return child;}
myjs_dom.prototype.insertBefore=function(child,caret){if(caret){myjs_dom.get_obj(this).insertBefore(myjs_dom.get_obj(child),myjs_dom.get_obj(caret));}else{myjs_dom.get_obj(this).appendChild(myjs_dom.get_obj(child));}
myjs_dom.render(child);return child;}
myjs_dom.prototype.removeChild=function(child){var child=myjs_dom.get_obj(child);myjs_dom.clear_instances(child,true);myjs_dom.get_obj(this).removeChild(child);return this;}
myjs_dom.prototype.replaceChild=function(newchild,oldchild){myjs_dom.clear_instances(oldchild,true);myjs_dom.get_obj(this).replaceChild(myjs_dom.get_obj(newchild),myjs_dom.get_obj(oldchild));return this;}
myjs_dom.prototype.cloneNode=function(tree){var data=myjs_dom.get_data(this);return myjs_dom.get_instance(data.obj.cloneNode(tree),data.appid);}
myjs_dom.prototype.getParentNode=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_first_valid_instance(data.obj.parentNode,'parentNode',data.appid);}
myjs_dom.prototype.getNextSibling=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_first_valid_instance(data.obj.nextSibling,'nextSibling',data.appid);}
myjs_dom.prototype.getPreviousSibling=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_first_valid_instance(data.obj.previousSibling,'previousSibling',data.appid);}
myjs_dom.prototype.getFirstChild=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_first_valid_instance(data.obj.firstChild,'nextSibling',data.appid);}
myjs_dom.prototype.getLastChild=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_first_valid_instance(data.obj.lastChild,'previousSibling',data.appid);}
myjs_dom.prototype.getChildNodes=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_instance_list(data.obj.childNodes,data.appid);}
myjs_dom.prototype.getElementsByTagName=function(tag){var data=myjs_dom.get_data(this);return myjs_dom.get_instance_list(data.obj.getElementsByTagName(tag),data.appid);}
myjs_dom.prototype.getOptions=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_instance_list(data.obj.options,data.appid);}
myjs_dom.prototype.getForm=function(){var data=myjs_dom.get_data(this);return myjs_dom.get_instance(data.obj.form,data.appid);}
myjs_dom.prototype.serialize=function(){var elements=myjs_dom.get_data(this).obj.elements;var data={};for(var i=elements.length-1;i>=0;i--){if(elements[i].name&&elements[i].name.substring(0,2)!='my'&&elements[i].name!='post_form_id'&&!elements[i].disabled){if(elements[i].tagName=='SELECT'){var name=elements[i].multiple?elements[i].name+'[]':elements[i].name;for(var j=0,jl=elements[i].options.length;j<jl;j++){if(elements[i].options[j].selected){serialize_form_helper(data,name,(elements[i].options[j].getAttribute('value')==null)?undefined:elements[i].options[j].value);}}}else if(!(elements[i].type=='radio'||elements[i].type=='checkbox')||elements[i].checked||(!elements[i].type||elements[i].type=='text'||elements[i].type=='password'||elements[i].type=='hidden'||elements[i].tagName=='TEXTAREA')){serialize_form_helper(data,elements[i].name,elements[i].value);}}}
return data;}
myjs_dom.prototype.setInnerXHTML=function(html){var data=myjs_dom.get_data(this);var sanitizer=new myjs_myml_sanitize(data.appid);var htmlElem=sanitizer.parseMYML(html);if(!htmlElem)return this;var obj=myjs_dom.get_obj(this);switch(obj.tagName){case'TEXTAREA':myjs_console.error('setInnerXHTML is not supported on textareas. Please use .value instead.');break;case'COL':case'COLGROUP':case'TABLE':case'TBODY':case'TFOOT':case'THEAD':case'TR':myjs_console.error('setInnerXHTML is not supported on this node.');break;default:myjs_dom.clear_instances(obj,false);obj.innerHTML='';this.appendChild(htmlElem);break;}
return this;}
myjs_dom.prototype.setInnerMYML=function(myml_ref){var html=myjs_private.get(myml_ref).htmlstring;var obj=myjs_dom.get_obj(this);switch(obj.tagName){case'TEXTAREA':myjs_console.error('setInnerMYML is not supported on textareas. Please use .value instead.');break;case'COL':case'COLGROUP':case'TABLE':case'TBODY':case'TFOOT':case'THEAD':case'TR':myjs_console.error('setInnerMYML is not supported on this node.');break;default:set_inner_html(obj,html);break;}
return this;}
myjs_dom.prototype.setTextValue=function(text){var obj=myjs_dom.get_obj(this);myjs_dom.clear_instances(obj,false);obj.innerHTML=htmlspecialchars(myjs_sandbox.safe_string(text));return this;}
myjs_dom.prototype.setValue=function(value){myjs_dom.get_obj(this).value=value;return this;}
myjs_dom.prototype.getValue=function(){var obj=myjs_dom.get_obj(this);if(obj.tagName=='SELECT'){var si=obj.selectedIndex;if(si==-1){return null;}else{if(obj.options[si].getAttribute('value')==null){return undefined;}else{return obj.value;}}}else{return myjs_dom.get_obj(this).value;}}
myjs_dom.prototype.getSelectedIndex=function(){return myjs_dom.get_obj(this).selectedIndex;}
myjs_dom.prototype.setSelectedIndex=function(si){myjs_dom.get_obj(this).selectedIndex=si;return this;}
myjs_dom.prototype.getChecked=function(){return myjs_dom.get_obj(this).checked;}
myjs_dom.prototype.setChecked=function(c){myjs_dom.get_obj(this).checked=c;return this;}
myjs_dom.prototype.getSelected=function(){return myjs_dom.get_obj(this).selected;}
myjs_dom.prototype.setSelected=function(s){myjs_dom.get_obj(this).selected=s;return this;}
myjs_dom.set_style=function(obj,style,value){if(typeof style=='string'){if(style=='opacity'){set_opacity(obj,parseFloat(value,10));}else{value=myjs_sandbox.safe_string(value);if(myjs_dom.css_regex.test(value)){obj.style[style]=value;}else{myjs_console.error(style+': '+value+' is not a valid CSS style');}}}else{for(var i in style){myjs_dom.set_style(obj,i,style[i]);}}}
myjs_dom.css_regex=/^(?:[\w\-#%+]+|rgb\(\d+ *, *\d+, *\d+\)|url\('?http[^ ]+?'?\)| +)*$/i
myjs_dom.prototype.setStyle=function(style,value){myjs_dom.set_style(myjs_dom.get_obj(this),style,value);return this;}
myjs_dom.prototype.getStyle=function(style_str){return myjs_dom.get_obj(this).style[idx(style_str)];}
myjs_dom.prototype.setHref=function(href){href=myjs_sandbox.safe_string(href);if(myjs_dom.href_regex.test(href)){myjs_dom.get_obj(this).href=href;return this;}else{myjs_console.error(href+' is not a valid hyperlink');}}
myjs_dom.href_regex=/^(?:https?|mailto|ftp|aim|irc|itms|gopher|\/|#)/;myjs_dom.prototype.getHref=function(){return myjs_dom.get_obj(this).href;}
myjs_dom.prototype.setAction=function(a){a=myjs_sandbox.safe_string(a);if(myjs_dom.href_regex.test(a)){myjs_dom.get_obj(this).action=a;return this;}else{myjs_console.error(a+' is not a valid hyperlink');}}
myjs_dom.prototype.getAction=function(){return myjs_dom.get_obj(this).action;}
myjs_dom.prototype.setMethod=function(m){m=myjs_sandbox.safe_string(m);myjs_dom.get_obj(this).method=m.toLowerCase()=='get'?'get':'post';return this;}
myjs_dom.prototype.getMethod=function(){return myjs_dom.get_obj(this).method;}
myjs_dom.prototype.setSrc=function(src){src=myjs_sandbox.safe_string(src);if(myjs_dom.href_regex.test(src)){myjs_dom.get_obj(this).src=src;return this;}else{myjs_console.error(src+' is not a valid hyperlink');}}
myjs_dom.prototype.getSrc=function(){return myjs_dom.get_obj(this).src;}
myjs_dom.prototype.setTarget=function(target){myjs_dom.get_obj(this).target=target;return this;}
myjs_dom.prototype.getTarget=function(){return myjs_dom.get_obj(this).target;}
myjs_dom.prototype.setClassName=function(classname){myjs_dom.get_obj(this).className=classname;return this;}
myjs_dom.prototype.getClassName=function(){return myjs_dom.get_obj(this).className;}
myjs_dom.prototype.hasClassName=function(classname){return has_css_class_name(myjs_dom.get_obj(this),classname);}
myjs_dom.prototype.addClassName=function(classname){add_css_class_name(myjs_dom.get_obj(this),classname);return this;}
myjs_dom.prototype.removeClassName=function(classname){remove_css_class_name(myjs_dom.get_obj(this),classname);return this;}
myjs_dom.prototype.toggleClassName=function(classname){this.hasClassName(classname)?this.removeClassName(classname):this.addClassName(classname);return this;}
myjs_dom.prototype.getTagName=function(){return myjs_dom.get_obj(this).tagName;}
myjs_dom.prototype.getNodeType=function(){return myjs_dom.get_obj(this).nodeType;}
myjs_dom.prototype.getId=function(){var id=myjs_dom.get_obj(this).id;if(id){return id.replace(/^app\d+_/,'');}else{return id;}}
myjs_dom.prototype.setId=function(id){var data=myjs_dom.get_data(this);data.obj.id=['app',data.appid,'_',id].join('');return this;}
myjs_dom.prototype.setDir=function(dir){myjs_dom.get_obj(this).dir=dir;return this;}
myjs_dom.prototype.getdir=function(dir){return myjs_dom.get_obj(this).dir;}
myjs_dom.prototype.getClientWidth=function(){return myjs_dom.get_obj(this).clientWidth;}
myjs_dom.prototype.getClientHeight=function(){return myjs_dom.get_obj(this).clientHeight;}
myjs_dom.prototype.getOffsetWidth=function(){return myjs_dom.get_obj(this).offsetWidth;}
myjs_dom.prototype.getOffsetHeight=function(){return myjs_dom.get_obj(this).offsetHeight;}
myjs_dom.prototype.getAbsoluteLeft=function(){return elementX(myjs_dom.get_obj(this));}
myjs_dom.prototype.getAbsoluteTop=function(){return elementY(myjs_dom.get_obj(this));}
myjs_dom.prototype.getScrollHeight=function(){return myjs_dom.get_obj(this).scrollHeight;}
myjs_dom.prototype.getScrollWidth=function(val){return myjs_dom.get_obj(this).scrollWidth;}
myjs_dom.prototype.getScrollTop=function(){return myjs_dom.get_obj(this).scrollTop;}
myjs_dom.prototype.setScrollTop=function(val){myjs_dom.get_obj(this).scrollTop=val;return this;}
myjs_dom.prototype.getScrollLeft=function(){return myjs_dom.get_obj(this).scrollLeft;}
myjs_dom.prototype.setScrollLeft=function(val){myjs_dom.get_obj(this).scrollLeft=val;return this;}
myjs_dom.prototype.getTabIndex=function(){return myjs_dom.get_obj(this).tabIndex;}
myjs_dom.prototype.setTabIndex=function(tabindex){myjs_dom.get_obj(this).tabIndex=tabindex;return this;}
myjs_dom.prototype.getTitle=function(){return myjs_dom.get_obj(this).title;}
myjs_dom.prototype.setTitle=function(title){myjs_dom.get_obj(this).title=title;return this;}
myjs_dom.prototype.getRowSpan=function(){return myjs_dom.get_obj(this).rowSpan;}
myjs_dom.prototype.setRowSpan=function(rowSpan){myjs_dom.get_obj(this).rowSpan=rowSpan;return this;}
myjs_dom.prototype.getColSpan=function(){return myjs_dom.get_obj(this).colSpan;}
myjs_dom.prototype.setColSpan=function(colSpan){myjs_dom.get_obj(this).colSpan=colSpan;return this;}
myjs_dom.prototype.getName=function(){return myjs_dom.get_obj(this).name;}
myjs_dom.prototype.setName=function(name){myjs_dom.get_obj(this).name=name;return this;}
myjs_dom.prototype.getCols=function(){return myjs_dom.get_obj(this).cols;}
myjs_dom.prototype.setCols=function(cols){myjs_dom.get_obj(this).cols=cols;return this;}
myjs_dom.prototype.getRows=function(){return myjs_dom.get_obj(this).rows;}
myjs_dom.prototype.setRows=function(rows){myjs_dom.get_obj(this).rows=rows;return this;}
myjs_dom.prototype.getAccessKey=function(){return myjs_dom.get_obj(this).accessKey;}
myjs_dom.prototype.setAccessKey=function(accesskey){myjs_dom.get_obj(this).accessKey=accesskey;return this;}
myjs_dom.prototype.setDisabled=function(disabled){myjs_dom.get_obj(this).disabled=disabled;return this;}
myjs_dom.prototype.getDisabled=function(){return myjs_dom.get_obj(this).disabled;}
myjs_dom.prototype.setMaxLength=function(length){myjs_dom.get_obj(this).maxLength=length;return this;}
myjs_dom.prototype.getMaxLength=function(){return myjs_dom.get_obj(this).maxLength;}
myjs_dom.prototype.setReadOnly=function(readonly){myjs_dom.get_obj(this).readOnly=readonly;return this;}
myjs_dom.prototype.getReadOnly=function(){return myjs_dom.get_obj(this).readOnly;}
myjs_dom.prototype.setType=function(type){type=myjs_sandbox.safe_string(type);myjs_dom.get_obj(this).type=type;return this;}
myjs_dom.prototype.getType=function(){return myjs_dom.get_obj(this).type;}
myjs_dom.prototype.getSelection=function(){var obj=myjs_dom.get_obj(this);return get_caret_position(obj);}
myjs_dom.prototype.setSelection=function(start,end){var obj=myjs_dom.get_obj(this);set_caret_position(obj,start,end);return this;}
myjs_dom.prototype.submit=function(){myjs_dom.get_obj(this).submit();return this;}
myjs_dom.prototype.focus=function(){myjs_dom.get_obj(this).focus();return this;}
myjs_dom.prototype.select=function(){myjs_dom.get_obj(this).select();return this;}
myjs_dom.eventHandler=function(event){var e=(event instanceof myjs_event)?event:new myjs_event(event?event:window.event,this[2]);if(e.ignore){return;}
var r=this[1].call(this[0],e);if(r===false){e.preventDefault();}
return myjs_event.destroy(e);}
myjs_dom.prototype.addEventListener=function(type,func){type=myjs_sandbox.safe_string(type.toLowerCase());if(!myjs_main.allowed_events[type]){myjs_console.error(type+' is not an allowed event');return false;}
var data=myjs_dom.get_data(this);var obj=data.obj;if(!data.events[type]){data.events[type]=[];}
var handler=null;if(obj.addEventListener){obj.addEventListener(type,handler=myjs_dom.eventHandler.bind([this,func,data.appid]),false);}else if(obj.attachEvent){obj.attachEvent('on'+type,handler=myjs_dom.eventHandler.bind([this,func,data.appid]));}
data.events[type].push({func:func,handler:handler});return this;}
myjs_dom.prototype.removeEventListener=function(type,func){type=type.toLowerCase();var data=myjs_dom.get_data(this);var obj=data.obj;if(data.events[type]){for(var i=0,il=data.events[type].length;i<il;i++){if(data.events[type][i].func==func){if(obj.removeEventListener){obj.removeEventListener(type,data.events[type][i].handler,false);}else if(obj.detachEvent){obj.detachEvent('on'+type,data.events[type][i].handler);}
data.events[type].splice(i,1);}}}
if(obj['on'+type]==func){obj['on'+type]=null;}
return this;}
myjs_dom.prototype.listEventListeners=function(type){type=type.toLowerCase();var data=myjs_dom.get_data(this);var events=[];if(data.events[type]){for(var i=0,il=data.events[type].length;i<il;i++){events.push(data.events[type].func);}}
if(data.obj['on'+type]){events.push(data.obj['on'+type]);}
return events;}
myjs_dom.prototype.purgeEventListeners=function(type){type=type.toLowerCase();var data=myjs_dom.get_data(this);var obj=data.obj;if(data.events[type]){for(var i=0,il=data.events[type].length;i<il;i++){if(obj.removeEventListener){obj.removeEventListener(type,data.events[type][i].handler,false);}else if(obj.detachEvent){obj.detachEvent('on'+type,data.events[type][i].handler);}}}
if(obj['on'+type]){obj['on'+type]=null;}
return this;}
myjs_dom.prototype.callSWF=function(method){var obj=myjs_dom.get_data(this).obj;var args=new Array(arguments.length-1);for(var i=1;i<arguments.length;i++){args[i-1]=arguments[i];}
if(ua.ie()){var id=0;for(var i=0;i<obj.childNodes.length;i++){if(obj.childNodes[i].name=="myjs"){id=obj.childNodes[i].getAttribute("value");}}
var myjsBridge=window["so_swf_myjs"];}else{var id=obj.getAttribute("myjs");var myjsBridge=document["so_swf_myjs"];}
return myjsBridge.callFlash(id,method,args);}
function myjs_myml_dom(type,appid){var data=myjs_private.get(this);data.type=type;data.appid=appid;}
myjs_myml_dom.get_obj=function(instance){var data=myjs_private.get(instance);if(!data.obj){data.obj=document.createElement('div');data.obj.className='__myml_tag';}
return data.obj;}
myjs_myml_dom.render=function(instance){var data=myjs_private.get(instance);if(data.rendered){return;}
if(!data.id){data.id='swf'+parseInt(Math.random()*999999);}
switch(data.type){case'my:swf':var flash_obj=new SWFObject(data.swf_src,data.id,data.width,data.height,'5.0.0',data.bg_color?data.bg_color:'000000');var flash_params={loop:true,quality:true,scale:true,align:true,salign:true};for(i in flash_params){if(data[i]){flash_obj.addParam(i,data[i]);}}
flash_obj.addParam('wmode','transparent');flash_obj.addParam('allowScriptAccess','never');if(data.flash_vars){for(var i in data.flash_vars){flash_obj.addVariable(i,data.flash_vars[i]);}}
var sandbox=myjs_sandbox.instances['a'+data.appid];if(sandbox.validation_vars){for(var i in sandbox.validation_vars){flash_obj.addVariable(i,sandbox.validation_vars[i]);}}
if(ge('myjs_bridge_id')){var local_connection=$('myjs_bridge_id').value;flash_obj.addVariable('my_local_connection','_'+local_connection);var myjs_conn='_'+'swf'+parseInt(Math.random()*999999);flash_obj.addVariable('my_myjs_connection',myjs_conn);flash_obj.addParam('myjs',myjs_conn);}
if(data.wait_for_click){var img=document.createElement('img');img.src=data.img_src;if(data.width){img.width=data.width;}
if(data.height){img.height=data.height;}
if(data.img_style){myjs_dom.set_style(img,data.img_style);}
if(data.img_class){img.className=data.img_class;}
var anchor=document.createElement('a');anchor.href='#';anchor.onclick=function(){flash_obj.write(data.obj);return false;}
anchor.appendChild(img);data.obj.appendChild(anchor);}else{flash_obj.write(data.obj);}
break;}}
myjs_myml_dom.prototype.setId=function(id){var data=myjs_private.get(this);data.id=['app',data.appid,'_',id].join('');return this;}
myjs_myml_dom.prototype.setSWFSrc=function(swf){var data=myjs_private.get(this);swf=myjs_sandbox.safe_string(swf);if(myjs_dom.href_regex.test(swf)){data.swf_src=swf;}else{myjs_console.error(swf+' is not a valid swf');}}
myjs_myml_dom.prototype.setImgSrc=function(img){var data=myjs_private.get(this);img=myjs_sandbox.safe_string(img);if(myjs_dom.href_regex.test(img)){data.img_src=img;}else{myjs_console.error(img+' is not a valid src');}
return this;}
myjs_myml_dom.prototype.setWidth=function(width){var data=myjs_private.get(this);data.width=(/\d+%?/.exec(width)||[]).pop();return this;}
myjs_myml_dom.prototype.setHeight=function(height){var data=myjs_private.get(this);data.height=(/\d+%?/.exec(height)||[]).pop();return this;}
myjs_myml_dom.prototype.setImgStyle=function(style,value){var data=myjs_private.get(this);var style_obj=data.img_style?data.img_style:data.img_style={};if(typeof style=='string'){style_obj[style]=value;}else{for(var i in style){this.setImgStyle(i,style[i]);}}
return this;}
myjs_myml_dom.prototype.setImgClass=function(img_class){var data=myjs_private.get(this);data.img_class=img_class;return this;}
myjs_myml_dom.prototype.setFlashVar=function(key,val){var data=myjs_private.get(this);var flash_vars=data.flash_vars?data.flash_vars:data.flash_vars={};flash_vars[key]=val;return this;}
myjs_myml_dom.prototype.setSWMYGColor=function(bg){var data=myjs_private.get(this);if(myjs_dom.css_regex.text(bg)){data.bg_color=bg;}else{myjs_console.error(bg+' is not a valid background color.');}
return this;}
myjs_myml_dom.prototype.setWaitForClick=function(wait){var data=myjs_private.get(this);data.wait_for_click=wait;return this;}
myjs_myml_dom.prototype.setLoop=function(val){var data=myjs_private.get(this);data.loop=val;return this;}
myjs_myml_dom.prototype.setQuality=function(val){var data=myjs_private.get(this);data.quality=val;return this;}
myjs_myml_dom.prototype.setScale=function(val){var data=myjs_private.get(this);data.scale=val;return this;}
myjs_myml_dom.prototype.setAlign=function(val){var data=myjs_private.get(this);data.align=val;return this;}
myjs_myml_dom.prototype.setSAlign=function(val){var data=myjs_private.get(this);data.salign=val;return this;}
function myjs_event(event,appid){if(!myjs_event.hacks){myjs_event.hacks=true;myjs_event.should_check_double_arrows=ua.safari()&&(ua.safari()<500);myjs_event.arrow_toggle={};}
for(var i in myjs_event.allowed_properties){this[i]=event[i];}
var target=null;if(event.target){target=event.target;}else if(event.srcElement){target=event.srcElement;}
if(target&&target.nodeType==3){target=target.parentNode;}
this.target=myjs_dom.get_instance(target,appid);var posx=0;var posy=0;if(event.pageX||event.pageY){posx=event.pageX;posy=event.pageY;}else if(event.clientX||event.clientY){posx=event.clientX+document.body.scrollLeft+document.documentElement.scrollLeft;posy=event.clientY+document.body.scrollTop+document.documentElement.scrollTop;}
this.pageX=posx;this.pageY=posy;if(myjs_event.should_check_double_arrows&&this.keyCode>=37&&this.keyCode<=40){myjs_event.arrow_toggle[this.type]=!myjs_event.arrow_toggle[this.type];if(myjs_event.arrow_toggle[this.type]){this.ignore=true;}}
myjs_private.get(this).event=event;}
myjs_event.allowed_properties={type:true,ctrlKey:true,keyCode:true,metaKey:true,shiftKey:true}
myjs_event.prototype.preventDefault=function(){var data=myjs_private.get(this);if(!data.prevented&&data.event.preventDefault){data.event.preventDefault();data.prevented=true;}
data.return_value=false;}
myjs_event.prototype.stopPropagation=function(){var event=myjs_private.get(this).event;if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}}
myjs_event.destroy=function(obj){var return_value=myjs_private.get(obj).return_value;myjs_private.remove(obj);delete obj.target;return return_value==undefined?true:return_value;}
function myjs_math(){}
myjs_math.prototype.abs=Math.abs;myjs_math.prototype.acos=Math.acos;myjs_math.prototype.asin=Math.asin;myjs_math.prototype.atan=Math.atan;myjs_math.prototype.atan2=Math.atan2;myjs_math.prototype.ceil=Math.ceil;myjs_math.prototype.cos=Math.cos;myjs_math.prototype.exp=Math.exp;myjs_math.prototype.floor=Math.floor;myjs_math.prototype.log=Math.log;myjs_math.prototype.max=Math.max;myjs_math.prototype.min=Math.min;myjs_math.prototype.pow=Math.pow;myjs_math.prototype.random=Math.random;myjs_math.prototype.round=Math.round;myjs_math.prototype.sin=Math.sin;myjs_math.prototype.sqrt=Math.sqrt;myjs_math.prototype.tan=Math.tan;myjs_math.prototype.valueOf=Math.valueOf;myjs_math.prototype.E=Math.E;myjs_math.prototype.LN2=Math.LN2;myjs_math.prototype.LN10=Math.LN10;myjs_math.prototype.LOG2E=Math.LOG2E;myjs_math.prototype.PI=Math.PI;myjs_math.prototype.SQRT1_2=Math.SQRT1_2;myjs_math.prototype.SQRT2=Math.SQRT2;function myjs_string(){}
myjs_string.prototype.fromCharCode=String.fromCharCode;function myjs_date(){var date=function(){var ret=new Date();if(arguments.length){ret.setFullYear.apply(ret,arguments);}
return ret;}
date.parse=Date.parse;return date;}
function myjs_regexp(){var regexp=function(){var ret=arguments.length?new RegExp(arguments[0],arguments[1]):new RegExp();return ret;}
return regexp;}
function myjs_console(){}
myjs_console.error=function(text){if(typeof console!='undefined'&&console.error){console.error(text);}}
myjs_console.render=function(obj){if(obj&&typeof obj.__priv!='undefined'){var new_obj={};for(var i in obj){new_obj[i]=obj[i];}
delete new_obj.__priv;delete new_obj.__private;for(var i in new_obj){new_obj[i]=myjs_console.render(new_obj[i]);}
var priv=myjs_private.get(obj);for(var i in priv){new_obj['PRIV_'+i]=priv[i];}
if(obj.__private){var priv=myjs_private.get(obj.__private);for(var i in priv){new_obj['PRIV_'+i]=priv[i];}}
return new_obj;}else if(obj&&typeof obj.__instance!='undefined'&&obj.setInnerMYML){var new_obj={};for(var i in obj){new_obj[i]=obj[i];}
delete new_obj.__instance;new_obj.PRIV_obj=myjs_dom.get_obj(obj);return new_obj;}else if(obj&&typeof obj=='object'&&obj.ownerDocument!=document){var new_obj=obj instanceof Array?[]:{};var changed=false;for(var i in obj){obj instanceof Array?new_obj.push(myjs_console.render(obj[i])):new_obj[i]=myjs_console.render(obj[i]);if(new_obj[i]!=obj[i]){changed=true;}}
return changed?new_obj:obj;}else{return obj;}}
myjs_console.render_args=function(args){var new_args=[];for(var i=0;i<args.length;i++){new_args[i]=myjs_console.render(args[i]);}
return new_args;}
if(typeof console!='undefined'){for(var i in console){myjs_console.prototype[i]=console[i];}}
myjs_console.prototype.debug=function(){if(typeof console!='undefined'&&console.debug){console.debug.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.log=function(){if(typeof console!='undefined'&&console.log){console.log.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.warn=function(){if(typeof console!='undefined'&&console.warn){console.warn.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.error=function(){if(typeof console!='undefined'&&console.error){console.error.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.assert=function(){if(typeof console!='undefined'&&console.assert){console.assert.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.dir=function(){if(typeof console!='undefined'&&console.dir){console.dir.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.group=function(){if(typeof console!='undefined'&&console.group){console.group.apply(console,myjs_console.render_args(arguments));}}
myjs_console.prototype.dirxml=function(obj){if(typeof console!='undefined'&&console.dirxml){if(obj.get_obj){console.dirxml(obj.get_obj(obj));}else{console.dirxml(obj);}}}
function myjs_ajax(appid){var proto=function(){}
for(var i in myjs_ajax.prototype){proto.prototype[i]=myjs_ajax.prototype[i];}
var priv=myjs_private.get(proto.prototype.__private={});priv.appid=appid;priv.sandbox=myjs_sandbox.instances['a'+appid];proto.JSON=myjs_ajax.JSON;proto.MYML=myjs_ajax.MYML;proto.RAW=myjs_ajax.RAW;return proto;}
myjs_ajax.proxy_url='/ajax/proxy';myjs_ajax.RAW=0;myjs_ajax.JSON=1;myjs_ajax.MYML=2;myjs_ajax.STATUS_WAITING_FOR_USER=1;myjs_ajax.STATUS_WAITING_FOR_SERVER=2;myjs_ajax.STATUS_IDLE=0;myjs_ajax.prototype.responseType=0;myjs_ajax.prototype.useLocalProxy=false;myjs_ajax.prototype.requireLogin=false;myjs_ajax.prototype.status=myjs_ajax.STATUS_IDLE;myjs_ajax.tokencount=0;myjs_ajax.tokens=new Object();myjs_ajax.new_xml_http=function(){try{return new XMLHttpRequest();}catch(e){try{return new ActiveXObject('Msxml2.XMLHTTP');}catch(e){try{return new ActiveXObject('Microsoft.XMLHTTP');}catch(e){return null;}}}}
myjs_ajax.get_transport=function(instance,force_new){var data=myjs_private.get(instance);if(data.xml&&!force_new){return data.xml;}else{data.xml=myjs_ajax.new_xml_http();data.xml.onreadystatechange=myjs_ajax.onreadystatechange.bind([instance,data.xml]);return data.xml;}}
myjs_ajax.prototype.abort=function(){var xml=myjs_ajax.get_transport(this,true);if(xml.abort){xml.abort();}
myjs_private.get(this).inflight=false;};myjs_ajax.flash_success=function(res,t){myjs_ajax.tokens[t].success(res);};myjs_ajax.flash_fail=function(t){myjs_ajax.tokens[t].fail();};myjs_ajax.prototype.post=function(url,query){var priv=myjs_private.get(this.__private);var appid=priv.appid;var post_form_id=ge('post_form_id');var xml=myjs_ajax.get_transport(this,true);if(xml){this.status=myjs_ajax.STATUS_WAITING_FOR_SERVER;xml.open('POST',myjs_ajax.proxy_url,true);xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');xml.send(URI.implodeQuery({url:url,query:query,type:this.responseType,require_login:this.requireLogin,my_mockajax_context:myjs_sandbox.instances['a'+appid].contextd,my_mockajax_context_hash:myjs_sandbox.instances['a'+appid].context,appid:appid}));myjs_private.get(this).inflight=true;}else if(this.onerror){this.onerror();}else{myjs_console.error('There was an uncaught Ajax error. Please attach on onerror handler to properly handle failures.');}}
myjs_ajax.make_myjs_recursive=function(obj){for(var i in obj){if(i.substring(0,5)=='myml_'){obj[i]=new myjs_myml_string(obj[i]);}else if(typeof obj[i]=='object'){myjs_ajax.make_myjs_recursive(obj[i]);}}}
myjs_ajax.onreadystatechange=function(){var xml=this[1];try{if(xml.readyState==4){var text=xml.responseText;this[0].status=myjs_ajax.STATUS_READY;if(xml.status>=200&&xml.status<300&&text.length){var priv_data=myjs_private.get(this[0]);if(priv_data.inflight){priv_data.inflight=false;}else{return;}
try{eval('var response = '+(text.substring(0,8)=='for(;;);'?text.substring(8):text));}catch(e){Util.error('MYJS AJAX eval failed! Response: '+text);var response={error:true};}
if(response.error!==undefined){throw'foo';}else if(this[0].ondone){try{switch(response.type){case myjs_ajax.RAW:this[0].ondone(response.data);break;case myjs_ajax.JSON:myjs_ajax.make_myjs_recursive(response.data);this[0].ondone(response.data);break;case myjs_ajax.MYML:this[0].ondone(new myjs_myml_string(response.data));break;}}catch(ignored){}}}else{throw'foo';}}}catch(ignored){if(this[0].onerror){this[0].onerror();}else{myjs_console.error('There was an uncaught Ajax error. Please attach on onerror handler to properly handle failures.');}}}
function myjs_dialog(appid){var proto=function(type){var priv=myjs_private.get(this);switch(type){case myjs_dialog.DIALOG_CONTEXTUAL:priv.dialog=new contextual_dialog('app_content_'+appid);priv.dialog.is_stackable=true;break;case myjs_dialog.DIALOG_POP:default:priv.dialog=new pop_dialog('app_content_'+appid);priv.dialog.is_stackable=true;break;}
priv.type=type;priv.ready=false;}
for(var i in myjs_dialog.prototype){proto.prototype[i]=myjs_dialog.prototype[i];}
proto.DIALOG_POP=myjs_dialog.DIALOG_POP;proto.DIALOG_CONTEXTUAL=myjs_dialog.DIALOG_CONTEXTUAL;return proto;}
myjs_dialog.DIALOG_POP=1;myjs_dialog.DIALOG_CONTEXTUAL=2;myjs_dialog.onconfirm=function(){var hide=true;if(this.onconfirm){if(this.onconfirm()===false){hide=false;}}
if(hide){this.hide();}}
myjs_dialog.oncancel=function(){var hide=true;if(this.oncancel){if(this.oncancel()===false){hide=false;}}
if(hide){this.hide();}}
myjs_dialog.build_dialog=function(){var priv=myjs_private.get(this);if(!priv.ready){priv.dialog.build_dialog();priv.ready=true;}}
myjs_dialog.prototype.setStyle=function(style,value){var priv=myjs_private.get(this);myjs_dialog.build_dialog.call(this);var obj=null;if(style=='width'||style=='height'){obj=priv.type==myjs_dialog.DIALOG_CONTEXTUAL?priv.dialog.frame:priv.dialog.frame.parentNode;}else{obj=priv.dialog.content;}
myjs_dom.set_style(obj,style,value);return ref(this);}
myjs_dialog.prototype.showMessage=function(title,content,button1){this.showChoice(title,content,button1,false);return ref(this);}
myjs_dialog.prototype.showChoice=function(title,content,button1,button2){var dialog=myjs_private.get(this).dialog;myjs_dialog.build_dialog.call(this);dialog.show_choice(myjs_myml_string.get(title),myjs_myml_string.get(content),!button1?'Okay':myjs_myml_string.get(button1),bind(this,myjs_dialog.onconfirm),button2===undefined?'Cancel':(button2?myjs_myml_string.get(button2):false),bind(this,myjs_dialog.oncancel));dialog.content.id='app_content_'+gen_unique();return ref(this);}
myjs_dialog.prototype.setContext=function(node){var dialog=myjs_private.get(this).dialog;var obj=myjs_dom.get_obj(node);dialog.set_context(obj);return ref(this);}
myjs_dialog.prototype.hide=function(){var dialog=myjs_private.get(this).dialog;if(generic_dialog.dialog_stack&&generic_dialog.dialog_stack.length>1){dialog.hide();}else{dialog.fade_out(200);}
return ref(this);}
function myjs_animation(){var proto=function(obj){if(this==window){return new arguments.callee(myjs_dom.get_obj(obj));}else{myjs_private.get(this).animation=new animation(obj);}}
for(var i in myjs_animation.prototype){proto.prototype[i]=myjs_animation.prototype[i];}
proto.ease={begin:animation.ease.begin,end:animation.ease.end,both:animation.ease.both};return proto;}
myjs_animation.prototype.stop=function(){myjs_private.get(this).animation.stop();return this;}
myjs_animation.prototype.to=function(attr,val){myjs_private.get(this).animation.to(attr,val);return this;}
myjs_animation.prototype.by=function(attr,val){myjs_private.get(this).animation.by(attr,val);return this;}
myjs_animation.prototype.from=function(attr,val){myjs_private.get(this).animation.from(attr,val);return this;}
myjs_animation.prototype.duration=function(duration){myjs_private.get(this).animation.duration(duration);return this;}
myjs_animation.prototype.checkpoint=function(length,callback){myjs_private.get(this).animation.checkpoint(length,typeof callback=='function'?bind(this,callback):null);return this;}
myjs_animation.prototype.ondone=function(callback){if(typeof callback=='function'){myjs_private.get(this).animation.checkpoint(bind(this,callback));return this;}}
myjs_animation.prototype.blind=function(){myjs_private.get(this).animation.blind();return this;}
myjs_animation.prototype.show=function(){myjs_private.get(this).animation.show();return this;}
myjs_animation.prototype.hide=function(){myjs_private.get(this).animation.hide();return this;}
myjs_animation.prototype.ease=function(callback){myjs_private.get(this).animation.ease(callback);return this;}
myjs_animation.prototype.go=function(){myjs_private.get(this).animation.go();return this;}
function myjs_myml_string(html){myjs_private.get(this).htmlstring=html;}
myjs_myml_string.get=function(html){if(html instanceof myjs_myml_string){return myjs_private.get(html).htmlstring;}else{return htmlspecialchars(myjs_sandbox.safe_string(html));}}
myjs_private=new Object();myjs_private.len=0;myjs_private.get=function(instance){if(typeof instance!='object'){return null;}
if(instance.__priv==undefined){var priv={data:{},instance:instance};instance.__priv=myjs_private.len;myjs_private.len++;priv.instance=instance;myjs_private[instance.__priv]=priv;return priv.data;}else if(typeof instance.__priv=='number'){var priv=myjs_private[instance.__priv];if(priv.instance==instance){return priv.data;}else{throw('Invalid object supplied to myjs_private.get');}}else{throw('Invalid object supplied to myjs_private.get');}}
myjs_private.remove=function(instance){if(instance.__priv!=undefined){if(myjs_private[instance.__priv].instance==instance){delete myjs_private[instance.__priv];delete instance.__priv;}}}
function myjs_myml_sanitize(appid){this.appid=appid;this.main=eval('a'+appid+'_document');return this;}
myjs_myml_sanitize.prototype.parseMYML=function(text){if(window.ActiveXObject){var doc=new ActiveXObject("Microsoft.XMLDOM");doc.async="false";doc.loadXML(text);if(doc.parseError.reason){myjs_console.error(doc.parseError.reason);return null;}}
else{var parser=new DOMParser();var doc=parser.parseFromString(text,"text/xml");if(doc.documentElement.nodeName=='parsererror'){myjs_console.error(doc.documentElement.textContent);return null;}}
var x=doc.documentElement;return this.processElement(x);};myjs_myml_sanitize.prototype.processElement=function(node){if(node.nodeType==3){return new myjs_dom(document.createTextNode(node.nodeValue),this.appid);}else if(node.nodeType!=1){return null;}
var domElement=this.main.createElement(node.nodeName);if(!domElement)return null;for(var x=0;x<node.attributes.length;x++){var attr=node.attributes[x];var aname=attr.nodeName;if(aname=='style'){var elems=attr.nodeValue.split(";");for(var i=0;i<elems.length;i++){if(elems[i]!=''){var props=elems[i].split(":");domElement.setStyle(props[0],props[1].replace(/^\s+|\s+$/g,''));}}}else{setter=myjs_dom.attr_setters[aname];if(domElement[setter]){domElement[setter](attr.nodeValue);}}}
for(var x=0;x<node.childNodes.length;x++){var child=node.childNodes[x];var ch=this.processElement(child);if(ch){domElement.appendChild(ch);}}
return domElement;};if(window.Bootloader){Bootloader.done(2);}
if(typeof deconcept=="undefined")var deconcept={};if(typeof deconcept.util=="undefined")deconcept.util={};if(typeof deconcept.SWFObjectUtil=="undefined")deconcept.SWFObjectUtil={};deconcept.SWFObject=function(swf,id,w,h,ver,c,quality,xiRedirectUrl,redirectUrl,detectKey){if(!document.getElementById){return;}
this.DETECT_KEY=detectKey?detectKey:'detectflash';this.skipDetect=deconcept.util.getRequestParameter(this.DETECT_KEY);this.params={};this.variables={};this.attributes=[];this.fallback_html='';this.fallback_js_fcn=function(){};if(swf){this.setAttribute('swf',swf);}
if(id){this.setAttribute('id',id);}
if(w){this.setAttribute('width',w);}
if(h){this.setAttribute('height',h);}
if(ver){this.setAttribute('version',new deconcept.PlayerVersion(ver.toString().split(".")));}
this.installedVer=deconcept.SWFObjectUtil.getPlayerVersion();if(!window.opera&&document.all&&this.installedVer.major>7){if(!deconcept.unloadSet){deconcept.SWFObjectUtil.prepUnload=function(){__flash_unloadHandler=function(){};__flash_savedUnloadHandler=function(){};window.attachEvent("onunload",deconcept.SWFObjectUtil.cleanupSWFs);}
window.attachEvent("onbeforeunload",deconcept.SWFObjectUtil.prepUnload);deconcept.unloadSet=true;}}
if(c){this.addParam('bgcolor',c);}
var q=quality?quality:'high';this.addParam('quality',q);this.setAttribute('useExpressInstall',false);this.setAttribute('doExpressInstall',false);var xir=(xiRedirectUrl)?xiRedirectUrl:window.location;this.setAttribute('xiRedirectUrl',xir);this.setAttribute('redirectUrl','');if(redirectUrl){this.setAttribute('redirectUrl',redirectUrl);}}
deconcept.SWFObject.prototype={useExpressInstall:function(path){this.xiSWFPath=!path?"/swf/expressinstall.swf":path;this.setAttribute('useExpressInstall',true);},setAttribute:function(name,value){this.attributes[name]=value;},getAttribute:function(name){return this.attributes[name]||"";},addParam:function(name,value){this.params[name]=value;},getParams:function(){return this.params;},addVariable:function(name,value){this.variables[name]=value;},getVariable:function(name){return this.variables[name]||"";},getVariables:function(){return this.variables;},getVariablePairs:function(){var variablePairs=[];var key;var variables=this.getVariables();for(key in variables){variablePairs[variablePairs.length]=key+"="+variables[key];}
return variablePairs;},getSWFHTML:function(){var swfNode="";if(navigator.plugins&&navigator.mimeTypes&&navigator.mimeTypes.length){if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","PlugIn");this.setAttribute('swf',this.xiSWFPath);}
swfNode='<embed type="application/x-shockwave-flash" src="'+htmlspecialchars(this.getAttribute('swf'))+'" width="'+htmlspecialchars(this.getAttribute('width'))+'" height="'+htmlspecialchars(this.getAttribute('height'))+'" style="'+htmlspecialchars(this.getAttribute('style')||"")+'"';swfNode+=' id="'+htmlspecialchars(this.getAttribute('id'))+'" name="'+htmlspecialchars(this.getAttribute('id'))+'" ';var params=this.getParams();for(var key in params){swfNode+=htmlspecialchars(key)+'="'+htmlspecialchars(params[key])+'" ';}
var pairs=this.getVariablePairs().join("&");if(pairs.length>0){swfNode+='flashvars="'+pairs+'"';}
swfNode+='/>';}else{if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","ActiveX");this.setAttribute('swf',this.xiSWFPath);}
swfNode='<object id="'+this.getAttribute('id')+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'+this.getAttribute('width')+'" height="'+this.getAttribute('height')+'" style="'+(this.getAttribute('style')||"")+'">';swfNode+='<param name="movie" value="'+this.getAttribute('swf')+'" />';var params=this.getParams();for(var key in params){swfNode+='<param name="'+key+'" value="'+params[key]+'" />';}
var pairs=this.getVariablePairs().join("&");if(pairs.length>0){swfNode+='<param name="flashvars" value="'+pairs+'" />';}
swfNode+="</object>";}
return swfNode;},write:function(elementId){if(this.getAttribute('useExpressInstall')){var expressInstallReqVer=new deconcept.PlayerVersion([6,0,65]);if(this.installedVer.versionIsValid(expressInstallReqVer)&&!this.installedVer.versionIsValid(this.getAttribute('version'))){this.setAttribute('doExpressInstall',true);this.addVariable("MMredirectURL",escape(this.getAttribute('xiRedirectUrl')));document.title=document.title.slice(0,47)+" - Flash Player Installation";this.addVariable("MMdoctitle",document.title);}}
var n=(typeof elementId=='string')?document.getElementById(elementId):elementId;if(this.skipDetect||this.getAttribute('doExpressInstall')||this.installedVer.versionIsValid(this.getAttribute('version'))){n.innerHTML=this.getSWFHTML();return true;}else{if(this.getAttribute('redirectUrl')!=""){document.location.replace(this.getAttribute('redirectUrl'));}
need_version=this.getAttribute('version').major+'.'+this.getAttribute('version').minor+'.'+this.getAttribute('version').rev;have_version=this.installedVer.major+'.'+this.installedVer.minor+'.'+this.installedVer.rev;this.fallback_js_fcn(have_version,need_version);n.innerHTML=this.fallback_html;}
return false;}}
deconcept.SWFObjectUtil.getPlayerVersion=function(){var PlayerVersion=new deconcept.PlayerVersion([0,0,0]);if(navigator.plugins&&navigator.mimeTypes.length){for(k=0;k<navigator.plugins.length;k++){try{x=navigator.plugins[k];if(x.name=='Shockwave Flash'){PlayerVersion_tmp=new deconcept.PlayerVersion(x.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s+r|\s+b[0-9]+)/,".").split("."));if(typeof PlayerVersion=='undefined'||PlayerVersion_tmp.major>PlayerVersion.major||(PlayerVersion_tmp.major==PlayerVersion.major&&(PlayerVersion_tmp.minor>PlayerVersion.minor||(PlayerVersion_tmp.minor==PlayerVersion.minor&&PlayerVersion_tmp.rev>PlayerVersion.rev)))){PlayerVersion=PlayerVersion_tmp;}}}catch(honk){}}}else if(navigator.userAgent&&navigator.userAgent.indexOf("Windows CE")>=0){var axo=1;var counter=3;while(axo){try{counter++;axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+counter);PlayerVersion=new deconcept.PlayerVersion([counter,0,0]);}catch(e){axo=null;}}}else{try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");}catch(e){try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");PlayerVersion=new deconcept.PlayerVersion([6,0,21]);axo.AllowScriptAccess="always";}catch(e){if(PlayerVersion.major==6){return PlayerVersion;}}
try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");}catch(e){}}
if(axo!=null){PlayerVersion=new deconcept.PlayerVersion(axo.GetVariable("$version").split(" ")[1].split(","));}}
return PlayerVersion;}
deconcept.PlayerVersion=function(arrVersion){this.major=arrVersion[0]!=null?parseInt(arrVersion[0]):0;this.minor=arrVersion[1]!=null?parseInt(arrVersion[1]):0;this.rev=arrVersion[2]!=null?parseInt(arrVersion[2]):0;}
deconcept.PlayerVersion.prototype.versionIsValid=function(fv){if(this.major<fv.major)return false;if(this.major>fv.major)return true;if(this.minor<fv.minor)return false;if(this.minor>fv.minor)return true;if(this.rev<fv.rev)return false;return true;}
deconcept.util={getRequestParameter:function(param){var q=document.location.search||document.location.hash;if(param==null){return q;}
if(q){var pairs=q.substring(1).split("&");for(var i=0;i<pairs.length;i++){if(pairs[i].substring(0,pairs[i].indexOf("="))==param){return pairs[i].substring((pairs[i].indexOf("=")+1));}}}
return"";}}
deconcept.SWFObjectUtil.cleanupSWFs=function(){var objects=document.getElementsByTagName("OBJECT");for(var i=objects.length-1;i>=0;i--){objects[i].style.display='none';for(var x in objects[i]){if(typeof objects[i][x]=='function'){objects[i][x]=function(){};}}}}
if(!document.getElementById&&document.all){document.getElementById=function(id){return document.all[id];}}
var getQueryParamValue=deconcept.util.getRequestParameter;var FlashObject=deconcept.SWFObject;var SWFObject=deconcept.SWFObject;var flash_update_dialog_shown=false;function spawn_flash_update_dialog(have_version,need_version){if(flash_update_dialog_shown)return;flash_update_dialog_shown=true;dialog=new pop_dialog('errorDialog');new AsyncRequest().setURI('/ajax/flash_update_dialog.php').setData({have_version:have_version,need_version:need_version}).setHandler(function(response){message_data=response.getPayload();dialog.show_message(message_data.title,message_data.body,'Close');}).send();}
function setFlashFallback(id,required_version){var fallback=ge(id);var version=deconcept.SWFObjectUtil.getPlayerVersion();if(fallback&&version['major']>0){var current_version=version['major']+'.'+version['minor']+'.'+version['rev'];fallback.innerHTML=tx('flash:upgrade-explanation',{'required-version':required_version,'current-version':current_version});}}
function getFlashPlayer(){goURI('http://adobe.com/go/getflashplayer');return false;}
var smartIframes=[];function smartSizingFrameAdded(){window.onresize=_resizeSmartFrames;smartIframes=[];var allIframes=document.getElementsByTagName('iframe');for(var i=0;i<allIframes.length;i++){var frame=allIframes[i];if(frame.className=='smart_sizing_iframe'){smartIframes.push(frame);frame.style.width=frame.parentNode.scrollWidth-2+"px";}}
_resizeSmartFrames();}
if(window.innerHeight){var windowHeight=function(){return window.innerHeight;};}else if(document.documentElement&&document.documentElement.clientHeight){var windowHeight=function(){return document.documentElement.clientHeight;};}else{var windowHeight=function(){return document.body.clientHeight;};}
function _resizeSmartFrames(){var height=windowHeight();for(var i=0;i<smartIframes.length;i++){var frame=smartIframes[i];var spaceLeft=height-elementY(frame)-61;frame.style.height=spaceLeft/(smartIframes.length-i)+'px';}}
if(window.Bootloader){Bootloader.done(1);}
function multifriend_selector(friend_info,form_id,max_selections,num_rows,num_cols,selected_ids){this.num_rows=num_rows;this.friend_info=friend_info;this.form=ge(form_id);this.max=max_selections;this.paginate=ua.ie();this.page=0;this.total_items=0;this.num_per_page=this.num_rows*num_cols;this.cur_view='all';this.num_selected=0;this.selected_ids={};this.last_clicked=null;this.cur_network=0;this.cur_network_name='';this.cur_list=0;this.cur_list_name='';this.cur_list_members={};this.notice_id='my_multi_friend_selector_notice';this.set_view(this.cur_view);this.update_counters(0);if(selected_ids){for(var i=0;i<selected_ids.length;++i){this.select(selected_ids[i]);}}
this.force_reset();}
multifriend_selector.prototype.set_typeahead=function(fsth){this.fsth=fsth;}
multifriend_selector.prototype.force_reset=function(){this.dirty=true;setTimeout(this.reset.bind(this),0);}
multifriend_selector.prototype.force_reset_now=function(){this.dirty=true;this.reset();}
multifriend_selector.prototype.reset=function(){if(!this.dirty){return;}
this.filters=[];if(this.cur_view=='unselected'){this.filters.push(function(id,info){return!this.selected_ids[id];}.bind(this));}else if(this.cur_view=='selected'){this.filters.push(function(id,info){return this.selected_ids[id];}.bind(this));}
if(this.cur_network){this.filters.push(function(id,info){return info.networks[this.cur_network];}.bind(this));}
if(this.cur_list){this.filters.push(function(id,info){return this.cur_list_members[id];}.bind(this));}
if(this.search_filter){this.filters.push(this.search_filter);}
this.page=0;this.update_boxes();this.dirty=false;}
multifriend_selector.prototype.set_search_filter=function(filter){this.search_filter=filter;this.force_reset();}
multifriend_selector.prototype.get_matching_friends=function(){var friends=[];for(var id in this.friend_info){for(var i=0;i<this.filters.length;i++){if(!this.filters[i](id,this.friend_info[id])){break;}}
if(i==this.filters.length){friends.push(id);}}
this.total_items=friends.length;return friends;}

multifriend_selector.prototype.update_boxes=function(){
	var friends=this.get_matching_friends();
	var lis=[];
	for(var i=0;i<friends.length;i++){
		if(!this.paginate||(i>=this.num_per_page*this.page&&i<this.num_per_page*(this.page+1))){
			lis.push(this.render_friend_box(friends[i]));
		}
	}
	$('friends').innerHTML=lis.join('');
	if(this.paginate){
		$('pag_nav_links').innerHTML=this.render_paginator();
	}
	if(this.total_items==0&&this.cur_view!='all'){
		if(this.cur_view=='unselected'){
			//this.notice_show(ascii('您已经选择所有好友'),true);			
			this.notice_show(tx('mfs02'),true);
			
		} else if (this.cur_view == 'selected'){
			//this.notice_show(ascii('您还未选择好友'),true);
			this.notice_show(tx('mfs04'),true);
		}
	}
}

multifriend_selector.prototype.render_friend_box=function(id){var friend=this.friend_info[id];if(this.fsth&&this.fsth.cur_str){var name=typeahead_source.highlight_found(friend.sname,this.fsth.cur_str);}else{var name=friend.sname;}
var result=['<li userid="',id,(this.selected_ids[id]?'" class="selected':''),'">','<a href="#" onclick="fs.click(this.parentNode); return false;">','<span class="square" style="background-image: url(',friend.pic,');"><span></span></span>','<strong>',name,'</strong>'];if(name.split(' ').length<4){result.push('<span class="network">',friend.pr_net,'</span>');}
result.push('</a></li>');return result.join('');}
multifriend_selector.prototype.render_paginator=function(){var result=[];var num_pages=parseInt(this.total_items/this.num_per_page+.999);if(this.page>0){result.push('<li><a href="#" onclick="return fs.prev_page();">上一页</a></li>');}
for(var i=Math.max(0,this.page-2);i<=Math.min(num_pages-1,this.page+2);i++){result.push('<li',(i==this.page?' class="current"':''),'><a href="#" onclick="return fs.goto_page(',i,');">',i+1,'</a></li>');}
if(this.page<num_pages-1){result.push('<li><a href="#" onclick="return fs.next_page();">下一页</a></li>');}
return result.join('');}
multifriend_selector.prototype.goto_page=function(page){this.page=page;if(this.page<0){this.page=0;}else if(this.page*this.num_per_page>=this.total_items){this.page=parseInt(this.total_items/this.num_per_page+.999);}
this.update_boxes();return false;}
multifriend_selector.prototype.prev_page=function(){return this.goto_page(this.page-1);}
multifriend_selector.prototype.next_page=function(){return this.goto_page(this.page+1);}
multifriend_selector.prototype.set_view=function(v){this.network_reset();$('view_selected').className='';$('view_unselected').className='';$('view_all').className='';if(ge('view_'+v)){$('view_'+v).className='view_on';}
this.cur_view=v;if(this.fsth){this.fsth.reset_search(true);}
this.force_reset();}
multifriend_selector.prototype.click=function(li){var uid=li.getAttribute('userid');if(this.cur_view.indexOf('selected')>=0&&uid==this.last_clicked){CSS.setOpacity(li,1);window.clearTimeout(fx.timer_id);}
if(!this.selected_ids[uid]){if(this.max<0||this.num_selected<this.max){li.className='selected';this.select(uid);if(this.cur_view=='unselected'){fx.doFadeOut(li,true);}}else if(this.max>=0){if(this.max==1){this.notice_show(tx('mfs16',{'maximum':this.max}),true);}else{this.notice_show(tx('mfs03',{'maximum':this.max}),true);}}}else{li.className='';this.unselect(uid);if(this.cur_view=='selected'){fx.doFadeOut(li,true);}}
if(this.cur_view=='selected'&&this.num_selected<=0){this.notice_show(tx('mfs04'),false);}
this.display_limit();this.last_clicked=uid;}
multifriend_selector.prototype.select=function(id){var elem=document.createElement('input');elem.setAttribute('my_protected','true');elem.type='hidden';elem.name='ids[]';elem.value=id;this.form.appendChild(elem);this.selected_ids[id]=elem;this.update_counters(1);}
multifriend_selector.prototype.unselect=function(id){this.form.removeChild(this.selected_ids[id]);delete this.selected_ids[id];this.update_counters(-1);}
multifriend_selector.prototype.update_counters=function(n){this.num_selected+=n;this.num_unselected-=n;$('view_selected_count').innerHTML=this.num_selected;}
multifriend_selector.prototype.display_limit=function(){var remainder=this.max-this.num_selected;show('max_limit_notice');if(remainder>0&&remainder<=3){$('max_limit_notice').style.color='#f60';$('max_limit_notice').innerHTML=tx('mfs05',{'remaining-friends':remainder});}else if(this.max>=0&&remainder<=0){$('max_limit_notice').style.color='#C90000';$('max_limit_notice').innerHTML=tx('mfs06',{'limit':this.max});}else{$('max_limit_notice').innerHTML='';}}
multifriend_selector.prototype.view=function(type){this.set_view(type);this.notice_hide();if(this.cur_network>0){this.network_filter(this.cur_network,this.cur_network_name);return;}
this.force_reset();}
multifriend_selector.prototype.network_filter=function(nid,nname){this.set_view('all');this.network_reset();this.cur_network=nid;this.cur_network_name=nname;if(this.fsth){this.fsth.reset_search(true);}
this.force_reset_now();var filter_text=[];if(this.max<0||this.total_items+this.num_selected<=this.max){filter_text.push('<a href="#" onClick="fs.select_all();return false;" class="select">Select All</a>');}
filter_text.push('<a href="#" class="hide" onClick="fs.network_clear(); return false;"></a> ');if(this.total_items==1){filter_text.push(tx('mfs07',{'network':nname}));}else{filter_text.push(tx('mfs08',{'count':this.total_items,'network':nname}));}
this.display_filter(filter_text.join(''));}
multifriend_selector.prototype.display_filter=function(text){show('fs_current_filter');$('fs_current_filter').innerHTML=text;}
multifriend_selector.prototype.network_reset=function(){hide('fs_current_filter');$('fs_current_filter').innerHTML='';this.cur_network=0;this.cur_network_name='';this.cur_list=0;this.cur_list_name='';this.cur_list_members={};this.force_reset();}
multifriend_selector.prototype.network_clear=function(){this.network_reset();this.view('all');}
multifriend_selector.prototype.list_filter=function(flid,name,members){this.set_view('all');this.network_reset();this.cur_list=flid;this.cur_list_name=name;var len=members.length;for(var i=0;i<len;++i){this.cur_list_members[members[i]]=1;}
if(this.fsth){this.fsth.reset_search(true);}
this.force_reset_now();var filter_text=[];if(this.max<0||this.total_items+this.num_selected<=this.max){filter_text.push('<a href="#" onClick="fs.select_all();return false;" class="select">Select All</a>');}
filter_text.push('<a href="#" class="hide" onClick="fs.network_clear(); return false;"></a> ');if(this.total_items==1){filter_text.push(tx('mfs13',{'list':name}));}else{filter_text.push(tx('mfs14',{'count':this.total_items,'list':name}));}
this.display_filter(filter_text.join(''));}
multifriend_selector.prototype.select_all=function(){var friends=this.get_matching_friends();if(friends.length<=this.max){for(var i=0;i<friends.length;i++){var uid=friends[i];if(!this.selected_ids[uid]){this.select(uid);}}}
this.update_boxes();}
multifriend_selector.prototype.unselect_all=function(){var friends=this.get_matching_friends();if(friends.length<=this.max){for(var i=0;i<friends.length;i++){var uid=friends[i];if(this.selected_ids[uid]){this.unselect(uid);}}}
this.update_boxes();}
multifriend_selector.prototype.notice_show=function(text,fade){$(this.notice_id).innerHTML=text;show(this.notice_id);CSS.setOpacity(ge(this.notice_id),1);if(fade==true){var t=setTimeout('fx.doFadeOut(\'my_multi_friend_selector_notice\', false);',2500);}}
multifriend_selector.prototype.notice_hide=function(){hide(this.notice_id);}
multifriend_selector.prototype.skip=function(target_name){var target;if(target_name=='_parent'){target=window.parent;}else if(target_name=='_top'){target=window.top;}else{target=document;}
target.location=get_form_attr(this.form,'action');}
multifriend_selector.prototype.show_force_invite_dialog=function(app_id,uninstalled){this.dialog=new pop_dialog();this.dialog.is_stackable=true;this.dialog.show_dialog('<div class="dialog_loading">'+tx('sh:loading')+' </div>');var exit_text;if(uninstalled){exit_text=tx('mfs15');}else{exit_text=tx('mfs11');}
this.onResponse=function(asyncResponse){var payload=asyncResponse.getPayload();if(payload['status']){this.dialog.show_choice(payload['dialog_title'],payload['dialog_contents'],exit_text,function(){this.onResponsePost=function(asyncResponsePost){var payloadPost=asyncResponsePost.getPayload();generic_dialog.get_dialog(this).show_message(payloadPost['dialog_title'],payloadPost['dialog_contents']);if(payloadPost['status']){window.location.href='/home.php';}};new AsyncRequest().setURI('/myml/ajax/force_invite.php').setData({'app_id':app_id,'remove':1}).setHandler(bind(this,'onResponsePost')).setErrorHandler(function(response){}).send();},exit_text=tx('mfs12'),function(){new AsyncRequest().setURI('/myml/ajax/force_invite.php').setData({'app_id':app_id,'continue':1}).setHandler(function(response){}).setErrorHandler(function(response){}).send();generic_dialog.get_dialog(this).fade_out(100);});}else{this.dialog.show_message(payload['dialog_title'],payload['dialog_contents']);}};new AsyncRequest().setURI('/myml/ajax/force_invite.php').setData({'app_id':app_id}).setHandler(bind(this,'onResponse')).setErrorHandler(bind(this,'onError')).send();return false;}
multifriend_selector.prototype.filter_menu_open=function(){setTimeout(function(){$('friends').style.overflow='hidden';}.bind(this),1);}
multifriend_selector.prototype.filter_menu_close=function(){$('friends').style.overflow='auto';}
function multifriend_selector_typeahead(obj,items,fs){this.cur_str='';this.clear_div=null;this.focused=false;this.obj=obj;this.obj.typeahead=this;this.items=items;this.fs=fs;this.fs.set_typeahead(this);this.placeholder=this.obj.value;addEventBase(this.obj,'focus',this._onfocus.bind(this));addEventBase(this.obj,'blur',this._onblur.bind(this));addEventBase(this.obj,'keyup',function(event){var e=event?event:window.event;var keycode=e?e.keyCode:-1;setTimeout(function(){return this._onkeyup(keycode);}.bind(this),0);}.bind(this));this.capture_submit();this.first_letter_index={};for(var id in items){var name=typeahead_source.tokenize(items[id].name);for(var token=0;token<name.length;token++){if(!this.first_letter_index[name[token][0]]){this.first_letter_index[name[token][0]]={};}
this.first_letter_index[name[token][0]][id]=true;}}}
multifriend_selector_typeahead.prototype={_onfocus:function(e)
{this.obj.value='';this.focused=true;this.capture_submit();if(this.fs&&this.fs.cur_view!='all'){this.fs.view('all');}},_onblur:function(e)
{this.focused=false;if(this.cur_str==''){this.hide_clear();this.obj.value=this.placeholder;}},_onkeyup:function(keycode)
{switch(keycode){case 27:return false;break;case undefined:case 37:case 38:case 39:case 40:return false;break;case 13:this.select();break;case 8:case 0:default:if(this.search()){this.reset_search(false,false);}else if(this.obj.value&&this.fs){this.fs.network_reset();}
break;}},capture_submit:function()
{if((!this.captured_form||this.captured_substitute!=this.captured_form.onsubmit)&&this.obj.form){this.captured_form=this.obj.form;this.captured_event=this.obj.form.onsubmit;this.captured_substitute=this.obj.form.onsubmit=function(){return false;}.bind(this.obj.form);}},reset_search:function(clear,pause)
{if(!this.obj){return false;}
var textInputController=this.obj.getControl();var value=textInputController.getValue();if(!value||clear){this.cur_str='';if(value){textInputController.clear();this._onblur();textInputController.setFocused(false);}}
if(pause==true){var delay=fx.timer_delay*10;window.setTimeout("fsth.show_all()",delay);}else{this.show_all();}},show_all:function(){this.fs.set_search_filter(null);},search:function()
{var str=typeahead_source.flatten_string(this.obj.value);if(str==this.cur_str){return false;}
this.cur_str=str;var tokenized_str=typeahead_source.tokenize(str).sort(typeahead_source._sort);if(!tokenized_str[0]){return true;}
var quick_index=this.first_letter_index[tokenized_str[0][0]];this.show_clear();this.fs.set_search_filter(function(id,info){if(quick_index!=null){return quick_index[id]&&typeahead_source.check_match(tokenized_str,info.name);}else{return null;}});return false;},show_clear:function()
{if(this.clear_div==null){this.clear_div=document.createElement('div');this.clear_div.setAttribute('id','clear_finder');this.clear_div.innerHTML='<a href="#" onClick="fsth.reset_search(true);return false;" class="hide"></a>';$('finder').appendChild(this.clear_div);}},hide_clear:function()
{if(ge('clear_finder')){this.clear_div=null;$('finder').removeChild(ge('clear_finder'));}},select:function()
{if(this.obj.value!=''&&this.obj.value!=this.placeholder&&this.fs.total_items==1){this.fs.click($('friends').firstChild);this.obj.value='';this.reset_search(true,this.fs.cur_view!='all');}}};function condensed_multifriend_selector(friend_info,form_id,max_selections,unselected_rows,selected_rows){this.parent.construct(this,friend_info,form_id,max_selections,0,[]);this.paginate=false;this.unselected_rows=unselected_rows;this.selected_rows=selected_rows;}
condensed_multifriend_selector.extend(multifriend_selector);condensed_multifriend_selector.prototype.set_typeahead=function(typeahead){this.parent.set_typeahead(typeahead);this.unselected_list=typeahead.obj.parentNode.nextSibling;if(this.selected_rows==0){this.onebox=true;}else{this.selected_list=this.unselected_list.nextSibling;this.onebox=false;}
this.total_items=0;for(var i=0;i<this.unselected_list.childNodes.length;i++){var friendNode=this.unselected_list.childNodes[i];friendNode.cb=friendNode.firstChild;friendNode.cb.checked=false;friendNode.name_span=friendNode.lastChild;friendNode.onclick=function(){this.parentNode.parentNode.cmfs.toggle(this.cb.value);};this.friend_info[friendNode.cb.value].unselected=friendNode;this.total_items++;}
if(!this.onebox){for(var i=0;i<this.selected_list.childNodes.length;i++){var friendNode=this.selected_list.childNodes[i];friendNode.cb=friendNode.firstChild;friendNode.cb.checked=false;friendNode.name_span=friendNode.lastChild;friendNode.onclick=function(){this.parentNode.parentNode.cmfs.toggle(this.cb.value);};this.friend_info[friendNode.cb.value].selected=friendNode;this.total_items++;}
this.nobody=document.createElement('div');this.nobody.className='nobody_selected';this.nobody.innerHTML=tx('mfs09');this.selected_list.appendChild(this.nobody);}
this.container=typeahead.obj.parentNode.parentNode;this.container.cmfs=this;this.toomany=document.createElement('div');this.toomany.className='toomany_selected';if(this.max==1){this.toomany.innerHTML=tx('mfs17',{'maximum':this.max});}else{this.toomany.innerHTML=tx('mfs10',{'maximum':this.max});}
this.container.appendChild(this.toomany);hide(this.toomany);this.check_sizes();window.setInterval(this.check_sizes.bind(this),100);this.container.style.visibility='visible';this.force_reset();}
condensed_multifriend_selector.prototype.check_sizes=function(){if(this.container.offsetWidth==this.container_width){return;}
this.container_width=this.container.offsetWidth;var cb_elem=this.unselected_list.firstChild;var cb_height=cb_elem&&cb_elem.offsetHeight?cb_elem.offsetHeight:19;this.unselected_list.style.height=cb_height*this.unselected_rows+'px';if(!this.onebox){var x_height=15;this.selected_list.style.height=x_height*this.selected_rows+'px';}
if(ua.safari()<500){var input_padding=0;}else{var input_padding=6;}
this.fsth.obj.style.width=Math.max((this.container.offsetWidth-input_padding-2),0)+'px';show(this.toomany);this.toomany.style.top=parseInt(this.unselected_list.offsetTop+
(this.unselected_list.offsetHeight-this.toomany.offsetHeight)/2)+'px';hide(this.toomany);}
condensed_multifriend_selector.prototype.check_match=function(id,friend){for(var i=0;i<this.filters.length;i++){if(!this.filters[i](id,friend)){return false;}}
return true;}
condensed_multifriend_selector.prototype.update_match=function(friend){this.total_items++;if(this.fsth&&this.fsth.cur_str){var name=typeahead_source.highlight_found(friend.name,this.fsth.cur_str);}else{var name=friend.name;}
friend.unselected.name_span.innerHTML=name;this.show(friend.unselected);}
condensed_multifriend_selector.prototype.update_boxes=function(){if(typeof this.onebox=='undefined'){return;}
this.total_items=0;this.last_showing=null;for(var id in this.friend_info){var friend=this.friend_info[id];if(friend.checked&&!this.onebox){continue;}
if(this.check_match(id,friend)){this.update_match(friend);}else{this.hide(friend.unselected);}}}
condensed_multifriend_selector.prototype.show=function(elem){show(elem);this.last_showing=elem;}
condensed_multifriend_selector.prototype.hide=hide;condensed_multifriend_selector.prototype.toggle=function(id){var friend=this.friend_info[id];if(this.onebox){if(!friend.checked&&!friend.unselected.cb.checked||friend.checked&&friend.unselected.cb.checked){return;}}else{if(!friend.checked&&!friend.unselected.cb.checked){return;}
if(ua.firefox()&&friend.checked&&friend.selected.cb.checked){return;}}
friend.checked=!friend.checked;if(friend.checked){if(this.num_selected==this.max){show(this.toomany);CSS.setOpacity(this.toomany,1);setTimeout(function(){fx.doFadeOut(this.toomany,false);}.bind(this),2500);friend.checked=false;friend.unselected.cb.checked=false;return false;}
this.num_selected++;}else{this.num_selected--;}
if(this.onebox){CSS.toggleClass(friend.unselected,'selected');}else if(friend.checked){this.total_items--;hide(this.nobody);hide(friend.unselected);friend.unselected.cb.checked=false;friend.selected.cb.checked=true;show(friend.selected);}else{if(!this.num_selected){show(this.nobody);}
this.hide(friend.selected);if(!ua.opera()&&!(ua.safari()>=500)){friend.selected.cb.checked=false;}
if(this.check_match(id,friend)){this.update_match(friend);}}}
condensed_multifriend_selector.prototype.network_reset=function(){}
condensed_multifriend_selector.prototype.set_view=function(){}
condensed_multifriend_selector.prototype.update_counters=function(){}
function condensed_mfs_typeahead(obj,items,fs){this.parent.construct(this,obj,items,fs);this.clear_div=document.createElement('div');this.clear_div.className='hide';this.clear_div.onclick=function(){this.reset_search(true,false);return false;}.bind(this);hide(this.clear_div);this.obj.parentNode.insertBefore(this.clear_div,this.obj);}
condensed_mfs_typeahead.extend(multifriend_selector_typeahead);condensed_mfs_typeahead.prototype.show_clear=function(){show(this.clear_div);}
condensed_mfs_typeahead.prototype.hide_clear=function(){hide(this.clear_div);}
condensed_mfs_typeahead.prototype.select=function(){if(this.fs.total_items==1){this.fs.last_showing.cb.click();this.obj.value='';this.reset_search(true,false);}}
var fx={timer_id:'',timer_delay:25,timer_clearout:false,delta:0.10,doFadeIn:function(id)
{if(ua.ie()==true){this.timer_delay=0;this.delta=0.50;}
if(this.timer_clearout&&this.timer_id){window.clearTimeout(this.timer_id);}
CSS.setOpacity(ge(id),0);$(id).style.visibility="visible";this.fadeIn(id,0);},fadeIn:function(id,opacity)
{obj=ge(id);if(opacity<=1){CSS.setOpacity(obj,opacity);opacity+=this.delta;this.timer_id=setTimeout(function(){fx.fadeIn(id,opacity)},this.timer_delay);}},doFadeOut:function(id,remove_elem)
{if(ua.ie()==true){this.timer_delay=0;this.delta=0.50;}
if(this.timer_clearout&&this.timer_id){window.clearTimeout(this.timer_id);}
CSS.setOpacity(ge(id),1);$(id).style.visibility="visible";this.fadeOut(id,1,remove_elem);},fadeOut:function(id,opacity,remove_elem)
{obj=ge(id);if(opacity>=0){CSS.setOpacity(obj,opacity);opacity-=this.delta;this.timer_id=setTimeout(function(){fx.fadeOut(id,opacity,remove_elem)},this.timer_delay);}else{if(window.fs&&fs.paginate&&id!=fs.notice_id){fs.update_boxes();}else if(remove_elem){obj.parentNode.removeChild(obj);}else{obj.style.display='none';}}}};if(window.Bootloader){Bootloader.done(1);}

MyXD=function(){}
var _myxd_ua=navigator.userAgent.toLowerCase();var _myxd_client_loaded=false;var _myxd_conn_type;MyXD.Constants={B_VER:(_myxd_ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[])[1],B_SAFARI:/webkit/.test(_myxd_ua),B_OPERA:/opera/.test(_myxd_ua),B_MSIE:/msie/.test(_myxd_ua)&&!/opera/.test(_myxd_ua),B_MOZILLA:/mozilla/.test(_myxd_ua)&&!/(compatible|webkit)/.test(_myxd_ua),B_FIREFOX2:/firefox\/2/.test(_myxd_ua),B_MAXTHON2:/maxthon\s2/.test(_myxd_ua),B_TT:/tencenttraveler/.test(_myxd_ua),CONNECT_URLHASH:"myxd_connect_urlhash",CONNECT_COOKIE:"myxd_connect_cookie",CONNECT_NAVIGATOR:"myxd_connect_navigator",IFRAME_HEIGHT:"ifmHeight",CALL_NAME:"__mymc__",CALL_VER:"__mymcv__",CALL_CALLBACK:"__mymcb__",CALL_PARAM_SIGN:"__myps__",CB_NAME:"__mycbn__",CB_RETN:"__mycbr__",CB_VER:"__mycbv__",CB_SUCC:"success",CB_ERROR:"error",CB_STATE_SIGN:"__myss__",CK_CLIENT_URL:"myXDClientPageURL_",HASH_SIGN:"$$",FOO_STR:"foo",WARN_INVALID_CB_STATE:"invalid callback state!",WARN_INVALID_CALL:"invalid method call",WARN_FAIL_CALL:"method call fail!",TIMER_INTERGER:50,PAGE_SERVER:"server",PAGE_CLIENT:"client",PAGE_CHANNEL:"channel"};_myxd_conn_type=MyXD.Constants.B_MSIE?MyXD.Constants.CONNECT_NAVIGATOR:MyXD.Constants.CONNECT_URLHASH;MyXD.Util=function MyXD$Util(){}
MyXD.Util.onDOMLoaded=function MyXD$Util$onDOMLoaded(handler){var u=navigator.userAgent.toLowerCase();var ie=MyXD.Constants.B_MSIE;if(/webkit/.test(u)){timeout=setTimeout(function(){if(document.readyState=="loaded"||document.readyState=="complete"){handler();}else{setTimeout(arguments.callee,10);}},10);}else if((/mozilla/.test(u)&&!/(compatible)/.test(u))||(/opera/.test(u))){document.addEventListener("DOMContentLoaded",handler,false);}else if(ie){(function(){var tempNode=document.createElement('document:ready');try{tempNode.doScroll('left');handler();tempNode=null;}catch(e){setTimeout(arguments.callee,0);}})();}else{window.onload=handler;}}
MyXD.Util.onDOMLoaded(function(){_myxd_client_loaded=true;});MyXD.Util.getElementHeight=function MyXD$Util$getElementHeight(elementID){var ie=MyXD.Constants.B_MSIE;var root=document.getElementById(elementID);var pObjArr=[];var objs=MyXD.Util.getElementsByTagNames('div,table',root);for(var i=0;i<objs.length;i++){var o=objs[i];var a=(/absolute|relative/.test(ie?o.currentStyle['position']:window.getComputedStyle(o,null).position));var d=ie?MyXD.Util.isElementVisible(o):o.scrollHeight;if(a&&d){var t=(ie?o.currentStyle['top']:window.getComputedStyle(o,null).top).replace('px','');if(MyXD.Constants.B_SAFARI){t=t=="auto"?0:t;}
var h=(ie?o.clientHeight*1:o.scrollHeight*1)+t*1;pObjArr.push(h);}}
var maxh=0;if(!ie){pObjArr=pObjArr.sort(function(a,b){return a-b});maxh=pObjArr[pObjArr.length-1];}else{for(var pp=0;pp<pObjArr.length;pp++){if(pObjArr[pp]>maxh){maxh=pObjArr[pp];}}}
var result=0;if(pObjArr.length>0){result=Math.max(maxh,root.scrollHeight);}else{result=root.scrollHeight;}
return result;}
MyXD.Util.isElementVisible=function MyXD$Util$isElementVisible(obj){while(obj.parentNode.tagName&&(obj.parentNode.tagName.toUpperCase()!='BODY')){if(MyXD.Constants.B_MSIE?(obj.currentStyle['display']=='none'):(window.getComputedStyle(obj,null).display=='none')){return false;}
obj=obj.parentNode;}
return true;}
MyXD.Util.getElementsByTagNames=function MyXD$Util$getElementsByTagNames(list,obj){if(!obj)var obj=document;var tagNames=list.split(',');var resultArray=new Array();for(var i=0;i<tagNames.length;i++){var tags=obj.getElementsByTagName(tagNames[i]);for(var j=0;j<tags.length;j++){resultArray.push(tags[j]);}}
var testNode=resultArray[0];if(!testNode)return[];if(testNode.sourceIndex){resultArray.sort(function(a,b){return a.sourceIndex-b.sourceIndex;});}
else if(testNode.compareDocumentPosition){resultArray.sort(function(a,b){return 3-(a.compareDocumentPosition(b)&6);});}
return resultArray;}
MyXD.Util.hideIframe=function MyXD$Util$hideIframe(iframeID){document.getElementById(iframeID).style.position="absolute";document.getElementById(iframeID).style.left="-5000px";document.getElementById(iframeID).style.right="-5000px";}
MyXD.Util.showIframe=function MyXD$Util$showIframe(iframeID){document.getElementById(iframeID).style.position="static";document.getElementById(iframeID).style.left="0px";document.getElementById(iframeID).style.right="0px";document.getElementById(iframeID).removeAttribute("style");}
MyXD.Util.HashURL=function MyXD$Util$HashURL(href,separator){var h=href||window.location.href;var s=separator||MyXD.Constants.HASH_SIGN;var uArr=MyXD.Util.split2(h,'#');var href_part=uArr[0];var hash_part=uArr[1];this.map={};if(hash_part){var arr=hash_part.split(s);for(var i=0;i<arr.length;i++){var s2=arr[i];var o=MyXD.Util.split2(s2,'=');this.map[o[0]]=o[1];}}
this.size=function(){var l=0;for(var j in this.map){l++;}
return l;}
this.keys=function(){var k=[];for(var m in this.map){k.push(m);}
return k;}
this.values=function(){var v=[];for(var m in this.map){v.push(this.map[m]);}
return v;}}
MyXD.Util.HashURL.prototype.get=function(key){return this.map[key]||null;}
MyXD.Util.HashURL.prototype.put=function(key,value){this.map[key]=value;}
MyXD.Util.HashURL.prototype.putAll=function(m){if(typeof(m)=='object'){for(var item in m){this.map[item]=m[item];}}}
MyXD.Util.HashURL.prototype.remove=function(key){if(this.map[key]){var newMap={};for(var item in this.map){if(item!=key){newMap[item]=this.map[item];}}
this.map=newMap;}}
MyXD.Util.HashURL.prototype.toString=function(){return MyXD.Util.map2query(this.map,MyXD.Constants.HASH_SIGN);}
MyXD.Util.split2=function(s,separator){var i=s.indexOf(separator);return i==-1?[s,'']:[s.substring(0,i),s.substring(i+1)];}
MyXD.Util.query2map=function(q){if(!q)
return{};var i,t,r={},d=decodeURIComponent;q=q.split('&');for(i=0,l=q.length;i<l;i++){t=MyXD.Util.split2(q[i],'=');r[d(t[0])]=typeof(t[1])=='undefined'?'':d(t[1]);}
return r;}
MyXD.Util.map2query=function(q,separator){var u=encodeURIComponent,k,r=[];var d=separator?separator:'&';for(k in q){r.push(u(k)+'='+u(q[k]));}
return r.join(d);}
MyXD.Util.query2Hash=function(q){var hash=new MyXD.Util.HashURL(MyXD.Constants.FOO_STR);if(!q)return hash;var arr=q.split(MyXD.Constants.HASH_SIGN);for(var i=0;i<arr.length;i++){var pair=arr[i];var kv=MyXD.Util.split2(pair,"=");hash.put(kv[0],kv[1]);}
return hash;}
MyXD.Util.decodeURL=function(str){var a1=MyXD.Util.split2(str.replace(/\%253F/,"?"),"?");var base=unescape(a1[0]).replace(/%3A/,":");var param=(a1.length>1)?a1[1]:"";if(""!=param)param=param.replace(/\%253D/g,"=").replace(/\%2526/g,"&").replace(/\%2525/g,"%");return base+"?"+param;}
MyXD.Util.Cookie=function(){this.cookie=document.cookie;};MyXD.Util.Cookie.prototype={get:function(propertyName){var length=this.cookie.length;var cookieArray=this.cookie.split(";");for(var i=0;i<length;i++){try{var property=MyXD.Util.split2(cookieArray[i],"=");if(escape(propertyName)==property[0].replace(/[(^\s)|(\s&)]/,"")){return unescape(property[1]);}}catch(ex){}}
return null;},set:function(propertyName,value,domain,path,expireDate,secure){path=path||"/";value=escape(value);propertyName=escape(propertyName);var cString=propertyName+"="+value;if(domain){cString+=";domain="+domain;}
if(path){cString+=";path="+path;}
if(expireDate){var expire_date=new Date();var ms_from_now=expireDate*24*60*60*1000;expire_date.setTime(expire_date.getTime()+ms_from_now);var expire_string=expire_date.toGMTString();cString+=";expires="+expire_string;}
if(secure!=undefined){cString+=";"+secure;}
document.cookie=cString;}};MyXD.Client=function MyXD$Client(serverURL,channelPage,iframeID){this._parentUrl=serverURL;this._iframeID=iframeID;this._rootID=null;this._transfer=null;this._channelSrc=channelPage;this._channelDom=null;this._hash=new MyXD.Util.HashURL('');this._oldHeight=null;this._callQueue=[];this._callLock=false;this._currCall=new MyXD.Client.CallObject(null,null,null,null,-1);this._flushParent=function(){if(_myxd_conn_type==MyXD.Constants.CONNECT_URLHASH){try{window.parent.location.replace(this._parentUrl+"#"+this._hash);}catch(ex){try{window.parent.location.replace(unescape(this._parentUrl+"#"+escape(this._hash)));}catch(ex2){}}}else if(_myxd_conn_type==MyXD.Constants.CONNECT_COOKIE){var tmpsid="myxdClientTransferScript";var tmpbdy=document.getElementsByTagName('head')[0];if(document.getElementById(tmpsid)){tmpbdy.removeChild(document.getElementById(tmpsid));}
var s=document.createElement('SCRIPT');s.type="text/javascript";s.id=tmpsid;s.src=this._transfer+escape(this._hash);tmpbdy.appendChild(s);}else if(_myxd_conn_type==MyXD.Constants.CONNECT_NAVIGATOR){window.navigator.xdparam=escape(this._hash);}}
this._sendCall=function(call){var tmpHeight=this._hash.get(MyXD.Constants.IFRAME_HEIGHT);this._hash=new MyXD.Util.HashURL(MyXD.Constants.FOO_STR);this._hash.put(MyXD.Constants.IFRAME_HEIGHT,tmpHeight);this._hash.put(MyXD.Constants.CALL_NAME+escape(call.name),decodeURIComponent((call.args).join(MyXD.Constants.CALL_PARAM_SIGN)));with(this._currCall){name=call.name;args=call.args;callback=call.callback;onError=call.onError;ver=Math.ceil(Math.random()*99999);};this._hash.put(MyXD.Constants.CALL_VER,this._currCall.ver);this._flushParent();}
this._shiftCall=function(){if(this._callQueue.length){this._callLock=false;var scall=this._callQueue.shift();this._sendCall(scall);this._callLock=true;}}
this._createChannel=function(){MyXD.Util.onDOMLoaded(function(){var cid="myxdClientChannelContainer";var fid="myxdClientChannelIframe";var client=MyXD.Client._client;var ctnr;if(document.getElementById(cid)){ctnr=document.getElementById(cid);}else{ctnr=document.createElement("DIV");ctnr.id=cid;ctnr.style.display="none";while (document.getElementsByTagName('body')[0]) {document.getElementsByTagName('body')[0].appendChild(ctnr);break;}}
if(document.getElementById(fid)){client._channelDom=document.getElementById(fid);}else{var h=new MyXD.Util.HashURL(MyXD.Constants.FOO_STR);h.put(MyXD.Constants.CK_CLIENT_URL+client._iframeID,escape(location.href));var cifm=document.createElement("IFRAME");cifm.id=fid;cifm.src=channelPage+"#"+h.toString();ctnr.appendChild(cifm);client._channelDom=cifm;}});}
this._sendToChannel=function(hash){try{this._channelDom.src=this._channelSrc+"#"+hash;}catch(ex){}}
MyXD.Client._client=this;MyXD.Client._callTimer=window.setInterval("MyXD.Client.processCall()",MyXD.Constants.TIMER_INTERGER);this._createChannel();window.myXDPageType=MyXD.Constants.PAGE_CLIENT;}
MyXD.Client._sizeTimer=null;MyXD.Client.CallObject=function(name,args,callback,onError,ver){this.name=name;this.args=args;this.callback=callback;this.onError=onError;this.ver=ver;}
MyXD.Client.updateHeight=function MyXD$Client$updateHeight(){var client=MyXD.Client._client;var newHeight;try{newHeight=MyXD.Util.getElementHeight(client._rootID);}catch(ex){}
if(newHeight&&newHeight!=client._oldHeight){client._hash.put(MyXD.Constants.IFRAME_HEIGHT,newHeight);client._flushParent();client._oldHeight=newHeight;}}
MyXD.Client.processCall=function MyXD$Client$processCall(){var client=MyXD.Client._client;if(client._currCall.ver==-1){client._shiftCall();}else{var selfH=new MyXD.Util.HashURL(location.href);var callVer=selfH.get(MyXD.Constants.CB_VER);if(callVer==client._currCall.ver){var cbkFunc=client._currCall.callback;var errFunc=client._currCall.onError;var cbkRetn;var keys=selfH.keys();var vlus=selfH.values();for(var kk=0;kk<keys.length;kk++){if(keys[kk].indexOf(MyXD.Constants.CB_NAME)>-1){cbkRetn=decodeURIComponent(vlus[kk]).replace(MyXD.Constants.CB_RETN,"");break;}}
var cbkState=cbkRetn.match(/^[a-z]*/)[0];var cbkParam=cbkRetn.replace(cbkState+MyXD.Constants.CB_STATE_SIGN,"");if(cbkState==MyXD.Constants.CB_SUCC){if(cbkFunc)
cbkFunc(cbkParam);}else if(cbkState==MyXD.Constants.CB_ERROR){if(errFunc)
errFunc(cbkParam);}else{if(errFunc)
alert(MyXD.Constants.WARN_INVALID_CB_STATE);}
client._currCall.ver=-1;client._callLock=false;}}}
MyXD.Client.prototype.setTransfer=function MyXD$Client$setTransfer(path){this._transfer=path;}
MyXD.Client.prototype.doCall=function MyXD$Client$doCall(methodName,args,callback,onError){this._callQueue.push(new MyXD.Client.CallObject(methodName,args,callback,onError,-2));}
MyXD.Client.prototype.setRoot=function MyXD$Client$setRoot(rootElementID){this._rootID=rootElementID;var ss='body{margin:0px;padding:0px;} #'+this._rootID+'{clear:both;overflow:hidden;padding:0px;margin:0px;border:none;}';var st=document.createElement('style');st.type="text/css";document.getElementsByTagName('head')[0].appendChild(st);if(st.styleSheet){st.styleSheet.cssText=ss;}else{st.appendChild(document.createTextNode(ss));}}
MyXD.Client.prototype.startSizeTimer=function MyXD$Client$startSizeTimer(rootElementID,delay){delay=delay||MyXD.Constants.TIMER_INTERGER;if(_myxd_client_loaded){this.setRoot(rootElementID);if(MyXD.Client._sizeTimer===null){MyXD.Client._sizeTimer=window.setInterval("MyXD.Client.updateHeight()",delay);}}else{MyXD.Util.onDOMLoaded(function(){MyXD.Client._client.startSizeTimer(rootElementID,delay);});}}
MyXD.Client.prototype.stopSizeTimer=function MyXD$Client$stopSizeTimer(){window.clearInterval(MyXD.Client._sizeTimer);MyXD.Client._sizeTimer=null;}
MyXD.Server=function MyXD$Server(clientIframeID){this._iframeID=clientIframeID;this._map=[];this._childURL=null;this._cookie=null;this._hash=null;this._oldHash=null;this._oldCall=null;this._childHash=null;this._flushChildUrl=function(hash){var ifm=document.getElementById(this._iframeID);try{this._childURL=MyXD.Util.split2(ifm.src,"#")[0];var oHash=(this._childHash=new MyXD.Util.HashURL(this._childURL,MyXD.Constants.HASH_SIGN)).toString();var cHash=oHash+(oHash==""?"":MyXD.Constants.HASH_SIGN)+hash.toString();var ck=new MyXD.Util.Cookie();var newChildUrl=ck.get(MyXD.Constants.CK_CLIENT_URL+this._iframeID);if(newChildUrl==null){var iii=0;while(iii<3&&newChildUrl==null){ck=new MyXD.Util.Cookie();newChildUrl=ck.get(MyXD.Constants.CK_CLIENT_URL+this._iframeID);iii++;}}
var compare=this._childURL;if(newChildUrl==compare){ifm.setAttribute("src",this._childURL+"#"+cHash);}else{this._childURL=newChildUrl;}}catch(ex){}}
MyXD.Server._server=this;window.myXDPageType=MyXD.Constants.PAGE_SERVER;}
MyXD.Server.prototype.registHandler=function MyXD$Server$registHandler(methodName){this._map.push(methodName);}
MyXD.Server.prototype.start=function MyXD$Server$start(){MyXD.Server._timer=window.setInterval("MyXD.Server.onTimer()",MyXD.Constants.TIMER_INTERGER);}
MyXD.Server.prototype._isMethodValid=function(methodName){for(var i=0;i<this._map.length;i++){if(methodName==this._map[i]){return true;}}
return false;}
MyXD.Server.prototype._onMethodCall=function(){var keys=this._hash.keys();var d=decodeURIComponent;var h=new MyXD.Util.HashURL(MyXD.Constants.FOO_STR,MyXD.Constants.HASH_SIGN);var mVer=this._hash.get(MyXD.Constants.CALL_VER);for(var ii=0;ii<keys.length;ii++){if(keys[ii].indexOf(MyXD.Constants.CALL_NAME)>-1){var mName=unescape(keys[ii].replace(MyXD.Constants.CALL_NAME,''));if(this._isMethodValid(mName)){var mParams=d(this._hash.get(keys[ii]));mParams="'"+mParams.replace(MyXD.Constants.CALL_PARAM_SIGN,'\',\'')+"'";try{h.put(MyXD.Constants.CB_NAME+mName,d(MyXD.Constants.CB_RETN+MyXD.Constants.CB_SUCC+MyXD.Constants.CB_STATE_SIGN+eval(mName+'('+mParams+')')));}catch(e){h.put(MyXD.Constants.CB_NAME+mName,d(MyXD.Constants.CB_RETN+MyXD.Constants.CB_ERROR+MyXD.Constants.CB_STATE_SIGN+MyXD.Constants.WARN_FAIL_CALL));}
break;}else{h.put(MyXD.Constants.CB_NAME+mName,d(MyXD.Constants.CB_RETN+MyXD.Constants.CB_ERROR+MyXD.Constants.CB_STATE_SIGN+MyXD.Constants.WARN_INVALID_CALL));}}}
h.put(MyXD.Constants.CB_VER,mVer);this._flushChildUrl(h.toString());}
MyXD.Server.onTimer=function MyXD$Server$onTimer(){var server=MyXD.Server._server;if(_myxd_conn_type==MyXD.Constants.CONNECT_URLHASH){server._hash=new MyXD.Util.HashURL();}else if(_myxd_conn_type==MyXD.Constants.CONNECT_COOKIE){server._hash=MyXD.Util.query2Hash((server._cookie=new MyXD.Util.Cookie()).get('xdparam'));}else if(_myxd_conn_type==MyXD.Constants.CONNECT_NAVIGATOR){server._hash=MyXD.Util.query2Hash(unescape(window.navigator.xdparam));}
if(server._hash!=server._oldHash){var ht=server._hash.get(MyXD.Constants.IFRAME_HEIGHT);try{document.getElementById(server._iframeID).setAttribute('height',ht+"px");}catch(e){}
var newCall=server._hash.get(MyXD.Constants.CALL_VER);if(newCall!=server._oldCall){server._onMethodCall();server._oldCall=newCall;}
server._oldHash=server._hash;}}
MyXD.Channel=function MyXD$Channel(){this._oldClientURL=null;this._oldCBParam=null;this._cookie=null;MyXD.Channel._channel=this;this._flushClient=function(hash){var u=MyXD.Util.split2(MyXD.Util.decodeURL(this._oldClientURL),"#")[0];if(_myxd_conn_type==MyXD.Constants.CONNECT_URLHASH||_myxd_conn_type==MyXD.Constants.CONNECT_COOKIE){if(u){try{window.parent.location.replace(u+"#"+hash);}catch(ex){try{window.parent.location.replace(unescape(u+"#"+escape(hash)));}catch(ex2){}}}}else if(_myxd_conn_type==MyXD.Constants.CONNECT_NAVIGATOR){window.navigator.callbackParam=hash;}}
this._reloadCookie=function(){this._cookie=new MyXD.Util.Cookie();}
window.onload=function(){MyXD.Channel.updateCKClientURL();}
window.myXDPageType=MyXD.Constants.PAGE_CHANNEL;}
MyXD.Channel.updateCKClientURL=function(){var cha=MyXD.Channel._channel;var hash=new MyXD.Util.HashURL(location.href);var ccu=MyXD.Constants.CK_CLIENT_URL;var ifmID=hash.toString().match(ccu+"[^=]+")[0].replace(ccu,"");var uName=ccu+ifmID;var clientURL=MyXD.Util.decodeURL(hash.get(uName));cha.set(uName,clientURL);cha._oldClientURL=clientURL;}
MyXD.Channel.prototype.set=function MyXD$Channel$set(key,value){this._reloadCookie();this._cookie.set(key,value);}
MyXD.Channel.prototype.get=function MyXD$Channel$get(key){this._reloadCookie();return this._cookie.get(key);}
