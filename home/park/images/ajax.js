function AsyncRequest(){
	var dispatchResponse=bind(this,function(asyncResponse){
		try{
			this.clearStatusIndicator();
			if(this.initialHandler(asyncResponse)!==false){
				try{
					this.handler(asyncResponse);
					} catch(exception){
					this.finallyHandler(asyncResponse);
					throw exception;
				}
				this.finallyHandler(asyncResponse);
				if(asyncResponse.instrument){
					Env.t_domcontent=(new Date()).getTime();
					Env.t_layout=Env.t_domcontent;
					var force_layout=document&&document.body&&document.body.offsetWidth;
					Env.t_onload=(new Date()).getTime();
					Env.t_willonloadhooks=Env.t_onload;
				}
				var onload=asyncResponse.onload;
				if(onload){
					for(var ii=0;ii<onload.length;ii++){
						try{
							eval('(function() {'+onload[ii]+'})();');
							} catch(exception){
							Util.error('An onload hook in response to a request to to URI %q threw an '+'exception: %x. (This is not a problem with AsyncRequest, it is '+'a problem with the registered hook.)',this.uri,exception);
						}
					}
				}
				if(asyncResponse.instrument){
					Env.t_doneonloadhooks=(new Date()).getTime();
				}
				var onafterload=asyncResponse.onafterload;
				if(onafterload){
					for(var ii=0;ii<onafterload.length;ii++){
						try{
							eval('(function() {'+onafterload[ii]+'})();');
							} catch(exception){
							Util.error('An onafterload hook in response to a request to to URI %q threw an '+'exception: %x. (This is not a problem with AsyncRequest, it is '+'a problem with the registered hook.)',this.uri,exception);
						}
					}
				}
				if(asyncResponse.instrument&&asyncResponse.server_stats&&(typeof(haste_stats)=="function")){
					haste_stats(asyncResponse.server_stats);
				}
			}
			if(asyncResponse.cacheObservation&&typeof(TabConsoleCacheobserver)!='undefined'&&TabConsoleCacheobserver.instance){
				TabConsoleCacheobserver.getInstance().addAsyncObservation(asyncResponse.cacheObservation);
			}
			} catch(exception){
			Util.error('The user supplied handler function for an AsyncRequest to URI %q '+'threw an exception: %x. (This is not a problem with AsyncRequest, it '+'is a problem with the callback, which failed to catch the exception.)',this.uri,exception);
		}
		} );
	var dispatchErrorResponse=bind(this,function(asyncResponse,isTransport){
		try{
			this.clearStatusIndicator();
			if(this.initialHandler(asyncResponse)!==false){
				try{
					if(isTransport){
						this.transportErrorHandler(asyncResponse);
						} else{
						this.errorHandler(asyncResponse);
					}
					} catch(exception){
					this.finallyHandler(asyncResponse);
					throw exception;
				}
				this.finallyHandler(asyncResponse);
			}
			} catch(exception){
			Util.error('Async error handler threw an exception for URI %q, when processing a '+'%d error: %x.',this.uri,asyncResponse.getError(),exception);
		}
		} );
	var _interpretTransportResponse=bind(this,function(){
		if(this.getOption('suppressEvaluation')){
			var r=new AsyncResponse();
			r.payload=this.transport;
			return{
				asyncResponse:r
				} ;
		}
		var shield="for(;;);";
		var shieldlen=shield.length;
		
		if(this.transport.responseText.length<=shieldlen){
			var kind=this.transport.responseText.length?('a '+this.transport.responseText.length+' byte'):'an empty';
			return{
				transportError:sprintf('An error occurred when making an AsyncRequest to %q. '+'The server returned '+kind+' response.',this.uri)
				} ;
		}
		var text=this.transport.responseText;
		//alert(text);
		
		// 判断响应前面有没有空白或者换行
		var offset=0;
		while(text.charAt(offset)==" "||text.charAt(offset)=="\n"){
			offset++;
		}

		//有空格或者换行，接着以for(;;);开头，即响应有效，但前面有空格
		if(offset&&text.substring(offset,offset+shieldlen)==shield){
			Util.error('Response for request to endpoint %q seems to be valid, but was '+'preceeded by whitespace. (This probably means that someone '+'committed whitespace in a header file.)',this.uri);
		}

		// 除去前面的空格或换
		var safeResponse=text.substring(offset+shieldlen);		
		var response;

		try{		
			//alert(safeResponse);
			eval('response = ('+safeResponse+')');
			
			//alert(response.payload.body);	

			} catch(exception){
			return{
				transportError:sprintf('Evaluation failed for <a href="javascript:aiert(%e);">'+'response from %q</a>: %x.',this.transport.responseText,this.uri,exception)
				} ;
		}		
		return interpretResponse(response);
		} );
	var interpretResponse=bind(this,function(response){
		if(response.redirect){
			return{
				redirect:response.redirect
				} ;
		}
		var r=new AsyncResponse();
		if(typeof(response.payload)=='undefined'||typeof(response.error)=='undefined'||typeof(response.errorDescription)=='undefined'||typeof(response.errorSummary)=='undefined'){
			Util.warn('AsyncRequest to endpoint %q returned a JSON response, but it '+'is not properly formatted. The endpoint needs to provide a '+'response including both error and payload information; use '+'the AsyncResponse PHP class to do this easily.',this.uri);
			r.payload=response;
			} else{
			copy_properties(r,response);
		}
		return{
			asyncResponse:r
			} ;
		} );
	var invokeResponseHandler=bind(this,function(interp){
		if(typeof(interp.redirect)!='undefined'){
			(function(){
				this.setURI(interp.redirect).send();
				} ).bind(this).defer();
			return;
		}
		if(this.handler){
			if(typeof(interp.transportError)!='undefined'){
				var r=new AsyncResponse();				
				//var errorDescription=Util.isDevelopmentEnvironment()?interp.transportError:tx('async:error');
				var errorDescription=true?interp.transportError:tx('async:error');
				copy_properties(r,{
					error:1000,errorSummary:tx('async:oops'),errorDescription:errorDescription
					} );
				if(this.transportErrorHandler){
					dispatchErrorResponse(r,true);
					} else{
					Util.error('Something bad happened; provide a transport error handler for '+'complete details.');
				}
				return;
			}
			var r=interp.asyncResponse;
			if(r.instrument){
				if(window.___t_measuring){
					r.instrument=false;
					} else{
					window.___t_measuring=true;
					window.Env=window.Env||{ } ;
					Env.start=(new Date()).getTime();
					cavalry_measure=[];
				}
			}
			if(r.bootload){
				var boot=r.bootload;
				for(var ii=0;ii<boot.length;ii++){
					Bootloader.loadResource(boot[ii]);
				}
			}
			if(r.instrument){
				___tcss=0;
				___thtml=0;
				___tjs=(new Date()).getTime()-Env.start;
			}
			if(r.getError()){
				Bootloader.wait(dispatchErrorResponse.bind(null,r));
				} else{
				Bootloader.wait.bind(null,(dispatchResponse.bind(null,r))).defer();
			}
		}
		} );
	var invokeErrorHandler=bind(this,function(explicitError){
		try{
			if(!window.loaded){
				return;
			}
			} catch(ex){
			return;
		}
		var r=new AsyncResponse();
		var err;
		try{
			err=explicitError||this.transport.status||1001;
			} catch(ex){
			err=1001;
		}
		try{
			if(this.responseText==''){
				err=1002;
			}
			} catch(ignore){ } 
		if(this.transportErrorHandler){
			var desc=sprintf('Transport error (#%d) while retrieving data from endpoint %q: %s',err,this.uri,AsyncRequest.getHTTPErrorDescription(err));
			if(!this.getOption('suppressErrorAlerts')){
				Util.error(desc);
			}
			copy_properties(r,{
				error:err,errorSummary:AsyncRequest.getHTTPErrorSummary(err),errorDescription:desc
				} );
			dispatchErrorResponse(r,true);
			} else{
			Util.error('Async request to %q failed with a %d error, but there was no error '+'handler available to deal with it.',this.uri,err);
		}
		} );
	var onStateChange=function(){
		try{
			if(this.transport.readyState==4){
				if(this.transport.status>=200&&this.transport.status<300){
					invokeResponseHandler(_interpretTransportResponse());
					} else{
					if(ua.safari()&&(typeof(this.transport.status)=='undefined')){
						invokeErrorHandler(1002);
						} else{
						invokeErrorHandler();
					}
				}
				delete this.transport;
			}
			} catch(exception){
			try{
				if(!window.loaded){
					return;
				}
				} catch(ex){
				return;
			}
			delete this.transport;
			if(this.remainingRetries){
				--this.remainingRetries;
				this.send(true);
				} else{
				if(!this.getOption('suppressErrorAlerts')){
					Util.error('AsyncRequest exception when attempting to handle a state change: %x.',exception);
				}
				invokeErrorHandler(1001);
			}
		}
		} ;
	//ajax瀵硅薄灞炴€у垵濮嬪寲
	copy_properties(this,{
		onstatechange:onStateChange,
		invokeResponseHandler:invokeResponseHandler,
		interpretResponse:interpretResponse,
		transport:null,
		method:'POST',
		uri:'',
		initialHandler:bagofholding,
		handler:null,
		errorHandler:null,
		transportErrorHandler:null,
		finallyHandler:bagofholding,
		statusElement:null,data:{ } ,
		context:{ } ,
		readOnly:false,
		writeRequiredParams:['post_form_id'], //蹇呴』鎻愪氦鐨勫弬鏁?
		remainingRetries:0,
		
		//鍙傛暟
		option:{
			asynchronous:true,
			suppressErrorHandlerWarning:false,
			suppressEvaluation:false,
			suppressErrorAlerts:false,
			retries:1,jsonp:false,
			useIframeTransport:false 
		}
	} );

	if(typeof ErrorDialog!="undefined"){
		this.errorHandler=ErrorDialog.showAsyncError;
		this.transportErrorHandler=ErrorDialog.showAsyncError;
	}
	return this;
}
copy_properties(AsyncRequest,{
	getHTTPErrorSummary:function(errCode){
		return AsyncRequest._getHTTPError(errCode).summary;
		} ,getHTTPErrorDescription:function(errCode){
		return AsyncRequest._getHTTPError(errCode).description;
		} ,pingURI:function(uri,data,synchronous){
		data=data||{ } ;
		return new AsyncRequest().setURI(uri).setData(data).setOption('asynchronous',!synchronous).setOption('suppressErrorHandlerWarning',true).send();
		} ,receiveJSONPResponse:function(path,data){
		if(this._JSONPReceivers[path]){
			for(var ii=0;ii<this._JSONPReceivers[path].length;ii++){
				var request=this._JSONPReceivers[path][ii];
				if(request.transportIframe){
					document.body.removeChild(request.transportIframe);
				}
				request.invokeResponseHandler(request.interpretResponse(data));
			}
			delete this._JSONPReceivers[path];
		}
		} ,_getHTTPError:function(errCode){
		var e=AsyncRequest._HTTPErrors[errCode]||AsyncRequest._HTTPErrors[errCode-(errCode%100)]||{
			summary:'HTTP Error',description:'Unknown HTTP error #'+errCode
			} ;
		return e;
		} ,_HTTPErrors:{
		400:{
			summary:'Bad Request',description:'Bad HTTP request.'
			} ,401:{
			summary:'Unauthorized',description:'Not authorized.'
			} ,403:{
			summary:'Forbidden',description:'Access forbidden.'
			} ,404:{
			summary:'Not Found',description:'Web address does not exist.'
			} ,1000:{
			summary:'Bad Response',description:'Invalid response.'
			} ,1001:{
			summary:'No Network',description:'A network error occurred. Check that you are connected to the '+'internet.'
			} ,1002:{
			summary:'No Data',description:'The server did not return a response.'
			} ,1003:{
			summary:'Eval Error',description:'Exception thrown during JSON evaluation.'
		}
		} ,_JSONPReceivers:[]
	} );


//AJAX瀵硅薄鏂规硶
copy_properties(AsyncRequest.prototype,{
	setMethod:function(m){
		this.method=m.toString().toUpperCase();
		return this;
		} ,getMethod:function(){
		return this.method;
		} ,setData:function(obj){
		this.data=obj;
		return this;
		} ,getData:function(){
		return this.data;
		} ,setContextData:function(key,value){
		this.context['_log_'+key]=value;
		return this;
		} ,setURI:function(uri){
		var uri_s=uri.toString();
		uri=URI(uri);
		if(this.getOption('useIframeTransport')&&!uri.isFacebookURI()){			
			Util.error('IframeTransport requests should only be used when going between '+'different Facebook subdomains. This probably won\'t do what you want '+'if you\'re going to a non-Facebook URI. Check out JSONP for that, '+'but that\'s also a bad idea to use.');
			return this;
		}
		if(!this.getOption('jsonp')&&!this.getOption('useIframeTransport')&&!uri.isSameOrigin()){
			Util.error('Asynchronous requests must specify relative URIs (like %q); this '+'ensures they conform to the Same Origin Policy (see %q). The '+'provided absolute URI (%q) is invalid, use a relative URI instead. '+'If you need to dispatch cross-domain requests, you can use JSONP, '+'but consider this decision carefully because there are tradeoffs and '+'JSONP is completely insecure.','/path/to/endpoint.php','http://www.mozilla.org/projects/security/components/same-origin.html',uri);
			return this;
		}
		this.uri=uri.toString();
		return this;
		} ,getURI:function(){
		return this.uri;
		} ,setInitialHandler:function(fn){
		this.initialHandler=fn;
		return this;
		} ,setHandler:function(fn){
		if(typeof(fn)!='function'){
			Util.error('AsyncRequest response handlers must be functions. Pass a function, '+'or use bind() to build one.');
			} else{
			this.handler=fn;
		}
		return this;
		} ,getHandler:function(){
		return this.handler;
		} ,setErrorHandler:function(fn){
		if(typeof(fn)!='function'){
			Util.error('AsyncRequest error handlers must be functions. Pass a function, or '+'use bind() to build one.');
			} else{
			this.errorHandler=fn;
		}
		return this;
		} ,setTransportErrorHandler:function(fn){
		this.transportErrorHandler=fn;
		return this;
		} ,getErrorHandler:function(){
		return this.errorHandler;
		} ,getTransportErrorHandler:function(){
		return this.transportErrorHandler;
		} ,setFinallyHandler:function(fn){
		this.finallyHandler=fn;
		return this;
		} ,setReadOnly:function(readOnly){
		if(typeof(readOnly)!='boolean'){
			Util.error('AsyncRequest readOnly value must be a boolean.');
			} else{
			this.readOnly=readOnly;
		}
		return this;
		} ,setMYMLForm:function(){
		this.writeRequiredParams=["my_sig"];
		return this;
		} ,getReadOnly:function(){
		return this.readOnly;
		} ,setStatusElement:function(element){
		this.statusElement=element;
		return this;
		} ,getStatusElement:function(){
		return this.statusElement;
		} ,clearStatusIndicator:function(){
		if(this.getStatusElement()){
			CSS.removeClass($(this.getStatusElement()),'async_saving');
		}
		} ,addStatusIndicator:function(){
		if(this.getStatusElement()){
			CSS.addClass($(this.getStatusElement()),'async_saving');
		}
		} ,specifiesWriteRequiredParams:function(){
		var specifiesWriteRequiredParams=true;
		//alert('鍙傛暟锛?' + this.writeRequiredParams);
		//alert('鍙傛暟闀垮害锛?' + this.writeRequiredParams.length);

		for(var i=0;i<this.writeRequiredParams.length;i++){
			var param=this.writeRequiredParams[i];
			if(typeof(this.data[param])=='undefined'){
				var e=ge(param);
				if(e&&typeof(e.value)!='undefined'){
					this.data[param]=e.value;
					} else{
					specifiesWriteRequiredParams=false;
					break;
				}
			}
		}
		return specifiesWriteRequiredParams;
		} ,setOption:function(opt,v){
		if(typeof(this.option[opt])!='undefined'){
			this.option[opt]=v;
			} else{
			Util.warn('AsyncRequest option %q does not exist; request to set it was ignored.',opt);
		}
		return this;
		} ,getOption:function(opt){
		if(typeof(this.option[opt])=='undefined'){
			Util.warn('AsyncRequest option %q does not exist, get request failed.',opt);
		}
		return this.option[opt];
		} ,send:function(isRetry){ //鍙戦€佽姹?
		
		isRetry=isRetry||false;		


		if(!this.uri){
			Util.error('Attempt to dispatch an AsyncRequest without an endpoint URI! This is '+'all sorts of silly and impossible, so the request failed.');
			return false;
		}
		
		/** 杈撳嚭data瀵硅薄鍐呭 **/
		var p,s = [];
		for(p in this.data){
			s.push(p+":"+this.data[p])
		}
		

		if(!this.errorHandler&&!this.getOption('suppressErrorHandlerWarning')){
			Util.warn('Dispatching an AsyncRequest that does not have an error handler. '+'You SHOULD supply one, or use AsyncRequest.pingURI(). If this '+'omission is intentional and well-considered, set the %q option to '+'suppress this warning.','suppressErrorHandlerWarning');
		}		

		if(this.getOption('jsonp')&&this.method!='GET'){
			this.setMethod('GET');
		}
		if(this.getOption('useIframeTransport')&&this.method!='GET'){
			Util.warn('Iframe transport currently works only with GET.');
			this.setMethod('GET');
		}
		//alert(s.join("\n"));

		//alert(this.writeRequiredParams.toString());

		if(!this.getReadOnly()){
			if(!this.specifiesWriteRequiredParams()){
				//鏈変簺鍙傛暟鏄繀闇€鐨勶紝鎴栧垯灏嗗湪姝ゅ嚭閿?
				//alert("Wrong");
				Util.error('You are making a POST request without one or more of the required '+'parameters: %s. Requests which modify data and do not verify the '+'request origin through parameter validation are vulnerable to CSRF '+'attacks. You should either specify values for these parameters '+'explicitly by using setData(), put them in the page as inputs, or '+'mark this request as safe and idempotent by using setReadOnly(). '+'Consult the setReadOnly() documentation for more information.',this.writeRequiredParams.join(','));
				
				//return false; 鏆傛椂閫氳繃
			}
			if(this.method!='POST'){
				Util.error('You are making a GET request which modifies data; this violates '+'the HTTP spec and is generally a bad idea. Either change this '+'request to use POST or use setReadOnly() to mark the request as '+'idempotent and appropriate for HTTP GET. Consult the setReadOnly() '+'documentation for more information.');return false;
			}
		}		

		if(!is_empty(this.context)){
			copy_properties(this.data,this.context);
			this.data['ajax_log']=1;
		}

		var uri;
		this.data['appid'] = appid;
		this.data['my_mockajax_context'] = myjs_sandbox.instances['a'+appid].contextd;
		this.data['my_mockajax_context_hash'] = myjs_sandbox.instances['a'+appid].context;
		
		var query=URI.implodeQuery(this.data);
			
		if(this.method=='GET'){
			uri=this.uri+(query?'?'+query:'');
			query='';
			} else{
			uri=this.uri;
		}
		if(this.getOption('jsonp')||this.getOption('useIframeTransport')){
			var path=URI(this.uri).getPath();
			if(!AsyncRequest._JSONPReceivers[path]){
				AsyncRequest._JSONPReceivers[path]=[];
			}
			AsyncRequest._JSONPReceivers[path].push(this);
			if(this.getOption('jsonp')){
				(function(){
					document.body.appendChild($N('script',{
						src:uri,type:"text/javascript"
						} ))
					} ).bind(this).defer();
				} else{
				var style={
					position:'absolute',top:'-1000px',left:'-1000px',width:'80px',height:'80px'
					} ;
				this.transportIframe=$N('iframe',{
					src:uri,style:style
					} );
				document.body.appendChild(this.transportIframe);
			}
			return true;
		}
		if(this.transport){
			Util.error('You must wait for an AsyncRequest to complete before sending another '+'request with the same object. To send two simultaneous requests, '+'create a second AsyncRequest object.');
			return false;
		}		

		var transport=null;
		try{
			transport=new XMLHttpRequest();
			} catch(ignored){ } ;
		if(!transport){
			try{
				transport=new ActiveXObject("Msxml2.XMLHTTP");
				} catch(ignored){ } ;
		}
		if(!transport){
			try{
				transport=new ActiveXObject("Microsoft.XMLHTTP");
				} catch(ignored){ } ;
		}
		if(!transport){
			Util.error('Unable to build XMLHTTPRequest transport.');
			return false;
		}
		transport.onreadystatechange=bind(this,'onstatechange');
		if(!isRetry){
			this.remainingRetries=0;
			if(this.getReadOnly()){
				this.remainingRetries=this.getOption('retries');
			}
		}
		this.transport=transport;
		try{
			this.transport.open(this.method,uri,this.getOption('asynchronous'));
			} catch(ex){
			Util.error(sprintf('Exception when opening Async transport to %q: %x',uri,ex));
			return false;
		}
		var svn_rev=env_get('svn_rev');
		if(svn_rev){
			this.transport.setRequestHeader('X-SVN-Rev',String(svn_rev));
		}
		if(this.method=='POST'){
			this.transport.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		}
		this.addStatusIndicator();		
		
		this.transport.send(query); //鍙戦€?query涓洪檮鍔犵殑鍙傛暟/鏁版嵁
		return true;
	}
	} );

/** Response **/
function AsyncResponse(payload){
	copy_properties(this,{
		error:0,errorSummary:null,errorDescription:null,onload:null,payload:payload||null
		} );
	return this;
}
copy_properties(AsyncResponse.prototype,{
	getPayload:function(){
		return this.payload;
		} ,getError:function(){
		return this.error;
		} ,getErrorSummary:function(){
		return this.errorSummary;
		} ,getErrorDescription:function(){
		return this.errorDescription;
	}
	} );


/** URI **/
function URI(uri){
	if(uri===window){
		Util.error('what the hell are you doing');
		return;
	}
	if(this===window){
		return new URI(uri||window.location.href);
	}
	this.parse(uri||'');
}
copy_properties(URI,{
	getRequestURI:function(respect_page_transitions){
		respect_page_transitions=respect_page_transitions===undefined||respect_page_transitions;
		if(respect_page_transitions&&window.PageTransitions){
			return PageTransitions.getCurrentURI().getQualifiedURI();
			} else{
			return new URI(window.location.href);
		}
		} ,expression:/(((\w+):\/\/)([^\/:]*)(:(\d+))?)?([^#?]*)(\?([^#]*))?(#(.*))?/,arrayQueryExpression:/^(\w+)((?:\[\w*\])+)=?(.*)/,explodeQuery:function(q){
		if(!q){
			return{ } ;
		}
		var ii,result={ } ;
		q=q.split('&');
		for(ii=0,l=q.length;ii<l;ii++){
			var match=q[ii].match(URI.arrayQueryExpression);
			if(!match){
				var term=q[ii].split('=');
				result[URI.decodeComponent(term[0])]=URI.decodeComponent(term[1]||'');
				} else{
				var indices=match[2].split(/\]\[|\[|\]/).slice(0,-1);
				var name=match[1];
				var value=URI.decodeComponent(match[3]||'');
				indices[0]=name;
				var resultNode=result;
				for(var i=0;i<indices.length-1;i++){
					if(indices[i]){
						if(resultNode[indices[i]]===undefined){
							if(indices[i+1]&&!indices[i+1].match(/\d+$/)){
								resultNode[indices[i]]={ } ;
								} else{
								resultNode[indices[i]]=[];
							}
						}
						resultNode=resultNode[indices[i]];
						} else{
						if(indices[i+1]&&!indices[i+1].match(/\d+$/)){
							resultNode.push({ } );
							} else{
							resultNode.push([]);
						}
						resultNode=resultNode[resultNode.length-1];
					}
				}
				if(resultNode instanceof Array&&indices[indices.length-1]==''){
					resultNode.push(value);
					} else{
					resultNode[indices[indices.length-1]]=value;
				}
			}
		}
		return result;
		} ,implodeQuery:function(obj,name){
		name=name||'';
		var r=[];
		if(obj instanceof Array){
			for(var ii=0;ii<obj.length;++ii){
				try{
					if(obj[ii]!==undefined){
						r.push(URI.implodeQuery(obj[ii],name?(name+'['+ii+']'):ii));
					}
					} catch(ignored){ } 
			}
			} else if(typeof(obj)=='object'){
			if(is_node(obj)){
				r.push('{node}');
				} else{
				for(var k in obj){
					try{
						r.push(URI.implodeQuery(obj[k],name?(name+'['+k+']'):k));
						} catch(ignored){ } 
				}
			}
			} else if(name&&name.length){
			r.push(URI.encodeComponent(name)+'='+URI.encodeComponent(obj));
			} else{
			r.push(URI.encodeComponent(obj));
		}
		return r.join('&');
		} ,encodeComponent:function(raw){
		var parts=String(raw).split(/([\[\]])/);
		for(var i=0,l=parts.length;i<l;i+=2){
			parts[i]=window.encodeURIComponent(parts[i]);
		}
		return parts.join('');
		} ,decodeComponent:function(encoded_s){
		return window.decodeURIComponent(encoded_s.replace(/\+/g,' '));
	}
	} );
copy_properties(URI.prototype,{
	parse:function(uri){
		var m=uri.toString().match(URI.expression);
		copy_properties(this,{
			protocol:m[3]||'',domain:m[4]||'',port:m[6]||'',path:m[7]||'',query_s:m[9]||'',fragment:m[11]||''
			} );
		return this;
		} ,setProtocol:function(p){
		this.protocol=p;
		return this;
		} ,getProtocol:function(){
		return this.protocol;
		} ,setQueryData:function(o){
		this.query_s=URI.implodeQuery(o);
		return this;
		} ,addQueryData:function(o){
		return this.setQueryData(copy_properties(this.getQueryData(),o));
		} ,removeQueryData:function(keys){
		if(!(keys instanceof Array)){
			keys=[keys];
		}
		var query=this.getQueryData();
		for(var i=0,l=keys.length;i<l;++i){
			delete query[keys[i]];
		}
		return this.setQueryData(query);
		} ,getQueryData:function(){
		return URI.explodeQuery(this.query_s);
		} ,setFragment:function(f){
		this.fragment=f;
		return this;
		} ,getFragment:function(){
		return this.fragment;
		} ,setDomain:function(d){
		this.domain=d;
		return this;
		} ,getDomain:function(){
		return this.domain;
		} ,setPort:function(p){
		this.port=p;
		return this;
		} ,getPort:function(){
		return this.port;
		} ,setPath:function(p){
		this.path=p;
		return this;
		} ,getPath:function(){
		return this.path.replace(/^\/+/,'/');
		} ,toString:function(){
		var r='';
		this.protocol&&(r+=this.protocol+'://');
		this.domain&&(r+=this.domain);
		this.port&&(r+=':'+this.port);
		if(this.domain&&!this.path){
			r+='/';
		}
		this.path&&(r+=this.path);
		this.query_s&&(r+='?'+this.query_s);
		this.fragment&&(r+='#'+this.fragment);
		return r;
		} ,isFacebookURI:function(){
		return!this.domain||!!this.domain.match(/(^|\.)facebook\.com$/i);
		} ,getUnqualifiedURI:function(){
		return new URI(this).setProtocol(null).setDomain(null).setPort(null);
		} ,getQualifiedURI:function(){
		var uri=new URI(this);
		if(!uri.getDomain()){
			var current=URI();
			uri.setProtocol(current.getProtocol()).setDomain(current.getDomain()).setPort(current.getPort());
		}
		return uri;
		} ,isSameOrigin:function(asThisURI){
		var uri=asThisURI||window.location.href;
		if(!(uri instanceof URI)){
			uri=new URI(uri.toString());
		}
		if(this.getProtocol()&&this.getProtocol()!=uri.getProtocol()){
			return false;
		}
		if(this.getDomain()&&this.getDomain()!=uri.getDomain()){
			return false;
		}
		return true;
		} ,coerceToSameOrigin:function(targetURI){
		var uri=targetURI||window.location.href;
		if(!(uri instanceof URI)){
			uri=new URI(uri.toString());
		}
		if(this.isSameOrigin(uri)){
			return true;
		}
		if(this.getProtocol()!=uri.getProtocol()){
			return false;
		}
		var dst=uri.getDomain().split('.');
		var src=this.getDomain().split('.');
		if(dst.pop()=='com'&&src.pop()=='com'){
			if(dst.pop()=='facebook'&&src.pop()=='facebook'){
				this.setDomain(uri.getDomain());
				return true;
			}
		}
		return false;
		} ,go:function(){
		window.location.href=this;
		} ,setSubdomain:function(subdomain){
		var uri=new URI(this).getQualifiedURI();
		var domains=uri.getDomain().split('.');
		if(domains.length<=2){
			domains.unshift(subdomain);
			} else{
			domains[0]=subdomain;
		}
		return uri.setDomain(domains.join('.'));
		} ,getSubdomain:function(){
		if(!this.getDomain()){
			return'';
		}
		if(!this.isFacebookURI()){
			return null;
		}
		var domains=this.getDomain().split('.');
		if(domains.length<=2){
			return'';
			} else{
			return domains[0];
		}
	}
	} );
