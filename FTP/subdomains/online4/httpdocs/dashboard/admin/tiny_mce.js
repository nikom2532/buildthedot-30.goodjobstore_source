(function(e){var a=/^\s*|\s*$/g,b,d="B".replace(/A(.)|B/,"$1")==="$1";var c={majorVersion:"3",minorVersion:"5.4.1",releaseDate:"2012-06-24",_init:function(){var s=this,q=document,o=navigator,g=o.userAgent,m,f,l,k,j,r;s.isOpera=e.opera&&opera.buildNumber;s.isWebKit=/WebKit/.test(g);s.isIE=!s.isWebKit&&!s.isOpera&&(/MSIE/gi).test(g)&&(/Explorer/gi).test(o.appName);s.isIE6=s.isIE&&/MSIE [56]/.test(g);s.isIE7=s.isIE&&/MSIE [7]/.test(g);s.isIE8=s.isIE&&/MSIE [8]/.test(g);s.isIE9=s.isIE&&/MSIE [9]/.test(g);s.isGecko=!s.isWebKit&&/Gecko/.test(g);s.isMac=g.indexOf("Mac")!=-1;s.isAir=/adobeair/i.test(g);s.isIDevice=/(iPad|iPhone)/.test(g);s.isIOS5=s.isIDevice&&g.match(/AppleWebKit\/(\d*)/)[1]>=534;if(e.tinyMCEPreInit){s.suffix=tinyMCEPreInit.suffix;s.baseURL=tinyMCEPreInit.base;s.query=tinyMCEPreInit.query;return}s.suffix="";f=q.getElementsByTagName("base");for(m=0;m<f.length;m++){r=f[m].href;if(r){if(/^https?:\/\/[^\/]+$/.test(r)){r+="/"}k=r?r.match(/.*\//)[0]:""}}function h(i){if(i.src&&/tiny_mce(|_gzip|_jquery|_prototype|_full)(_dev|_src)?.js/.test(i.src)){if(/_(src|dev)\.js/g.test(i.src)){s.suffix="_src"}if((j=i.src.indexOf("?"))!=-1){s.query=i.src.substring(j+1)}s.baseURL=i.src.substring(0,i.src.lastIndexOf("/"));if(k&&s.baseURL.indexOf("://")==-1&&s.baseURL.indexOf("/")!==0){s.baseURL=k+s.baseURL}return s.baseURL}return null}f=q.getElementsByTagName("script");for(m=0;m<f.length;m++){if(h(f[m])){return}}l=q.getElementsByTagName("head")[0];if(l){f=l.getElementsByTagName("script");for(m=0;m<f.length;m++){if(h(f[m])){return}}}return},is:function(g,f){if(!f){return g!==b}if(f=="array"&&(g.hasOwnProperty&&g instanceof Array)){return true}return typeof(g)==f},makeMap:function(f,j,h){var g;f=f||[];j=j||",";if(typeof(f)=="string"){f=f.split(j)}h=h||{};g=f.length;while(g--){h[f[g]]={}}return h},each:function(i,f,h){var j,g;if(!i){return 0}h=h||i;if(i.length!==b){for(j=0,g=i.length;j<g;j++){if(f.call(h,i[j],j,i)===false){return 0}}}else{for(j in i){if(i.hasOwnProperty(j)){if(f.call(h,i[j],j,i)===false){return 0}}}}return 1},map:function(g,h){var i=[];c.each(g,function(f){i.push(h(f))});return i},grep:function(g,h){var i=[];c.each(g,function(f){if(!h||h(f)){i.push(f)}});return i},inArray:function(g,h){var j,f;if(g){for(j=0,f=g.length;j<f;j++){if(g[j]===h){return j}}}return -1},extend:function(n,k){var j,f,h,g=arguments,m;for(j=1,f=g.length;j<f;j++){k=g[j];for(h in k){if(k.hasOwnProperty(h)){m=k[h];if(m!==b){n[h]=m}}}}return n},trim:function(f){return(f?""+f:"").replace(a,"")},create:function(o,f,j){var n=this,g,i,k,l,h,m=0;o=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(o);k=o[3].match(/(^|\.)(\w+)$/i)[2];i=n.createNS(o[3].replace(/\.\w+$/,""),j);if(i[k]){return}if(o[2]=="static"){i[k]=f;if(this.onCreate){this.onCreate(o[2],o[3],i[k])}return}if(!f[k]){f[k]=function(){};m=1}i[k]=f[k];n.extend(i[k].prototype,f);if(o[5]){g=n.resolve(o[5]).prototype;l=o[5].match(/\.(\w+)$/i)[1];h=i[k];if(m){i[k]=function(){return g[l].apply(this,arguments)}}else{i[k]=function(){this.parent=g[l];return h.apply(this,arguments)}}i[k].prototype[k]=i[k];n.each(g,function(p,q){i[k].prototype[q]=g[q]});n.each(f,function(p,q){if(g[q]){i[k].prototype[q]=function(){this.parent=g[q];return p.apply(this,arguments)}}else{if(q!=k){i[k].prototype[q]=p}}})}n.each(f["static"],function(p,q){i[k][q]=p});if(this.onCreate){this.onCreate(o[2],o[3],i[k].prototype)}},walk:function(i,h,j,g){g=g||this;if(i){if(j){i=i[j]}c.each(i,function(k,f){if(h.call(g,k,f,j)===false){return false}c.walk(k,h,j,g)})}},createNS:function(j,h){var g,f;h=h||e;j=j.split(".");for(g=0;g<j.length;g++){f=j[g];if(!h[f]){h[f]={}}h=h[f]}return h},resolve:function(j,h){var g,f;h=h||e;j=j.split(".");for(g=0,f=j.length;g<f;g++){h=h[j[g]];if(!h){break}}return h},addUnload:function(j,i){var h=this,g;g=function(){var f=h.unloads,l,m;if(f){for(m in f){l=f[m];if(l&&l.func){l.func.call(l.scope,1)}}if(e.detachEvent){e.detachEvent("onbeforeunload",k);e.detachEvent("onunload",g)}else{if(e.removeEventListener){e.removeEventListener("unload",g,false)}}h.unloads=l=f=w=g=0;if(e.CollectGarbage){CollectGarbage()}}};function k(){var l=document;function f(){l.detachEvent("onstop",f);if(g){g()}l=0}if(l.readyState=="interactive"){if(l){l.attachEvent("onstop",f)}e.setTimeout(function(){if(l){l.detachEvent("onstop",f)}},0)}}j={func:j,scope:i||this};if(!h.unloads){if(e.attachEvent){e.attachEvent("onunload",g);e.attachEvent("onbeforeunload",k)}else{if(e.addEventListener){e.addEventListener("unload",g,false)}}h.unloads=[j]}else{h.unloads.push(j)}return j},removeUnload:function(i){var g=this.unloads,h=null;c.each(g,function(j,f){if(j&&j.func==i){g.splice(f,1);h=i;return false}});return h},explode:function(f,g){if(!f||c.is(f,"array")){return f}return c.map(f.split(g||","),c.trim)},_addVer:function(g){var f;if(!this.query){return g}f=(g.indexOf("?")==-1?"?":"&")+this.query;if(g.indexOf("#")==-1){return g+f}return g.replace("#",f+"#")},_replace:function(h,f,g){if(d){return g.replace(h,function(){var l=f,j=arguments,k;for(k=0;k<j.length-2;k++){if(j[k]===b){l=l.replace(new RegExp("\\$"+k,"g"),"")}else{l=l.replace(new RegExp("\\$"+k,"g"),j[k])}}return l})}return g.replace(h,f)}};c._init();e.tinymce=e.tinyMCE=c})(window);tinymce.create("tinymce.util.Dispatcher",{scope:null,listeners:null,inDispatch:false,Dispatcher:function(a){this.scope=a||this;this.listeners=[]},add:function(b,a){this.listeners.push({cb:b,scope:a||this.scope});return b},addToTop:function(d,b){var a=this,c={cb:d,scope:b||a.scope};if(a.inDispatch){a.listeners=[c].concat(a.listeners)}else{a.listeners.unshift(c)}return d},remove:function(c){var b=this.listeners,a=null;tinymce.each(b,function(e,d){if(c==e.cb){a=e;b.splice(d,1);return false}});return a},dispatch:function(){var a=this,e,b=arguments,c,d=a.listeners,f;a.inDispatch=true;for(c=0;c<d.length;c++){f=d[c];e=f.cb.apply(f.scope,b.length>0?b:[f.scope]);if(e===false){break}}a.inDispatch=false;return e}});(function(){var a=tinymce.each;tinymce.create("tinymce.util.URI",{URI:function(e,g){var f=this,i,d,c,h;e=tinymce.trim(e);g=f.settings=g||{};if(/^([\w\-]+):([^\/]{2})/i.test(e)||/^\s*#/.test(e)){f.source=e;return}if(e.indexOf("/")===0&&e.indexOf("//")!==0){e=(g.base_uri?g.base_uri.protocol||"http":"http")+"://mce_host"+e}if(!/^[\w\-]*:?\/\//.test(e)){h=g.base_uri?g.base_uri.path:new tinymce.util.URI(location.href).directory;e=((g.base_uri&&g.base_uri.protocol)||"http")+"://mce_host"+f.toAbsPath(h,e)}e=e.replace(/@@/g,"(mce_at)");e=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);a(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],function(b,j){var k=e[j];if(k){k=k.replace(/\(mce_at\)/g,"@@")}f[b]=k});c=g.base_uri;if(c){if(!f.protocol){f.protocol=c.protocol}if(!f.userInfo){f.userInfo=c.userInfo}if(!f.port&&f.host==="mce_host"){f.port=c.port}if(!f.host||f.host==="mce_host"){f.host=c.host}f.source=""}},setPath:function(c){var b=this;c=/^(.*?)\/?(\w+)?$/.exec(c);b.path=c[0];b.directory=c[1];b.file=c[2];b.source="";b.getURI()},toRelative:function(b){var d=this,f;if(b==="./"){return b}b=new tinymce.util.URI(b,{base_uri:d});if((b.host!="mce_host"&&d.host!=b.host&&b.host)||d.port!=b.port||d.protocol!=b.protocol){return b.getURI()}var c=d.getURI(),e=b.getURI();if(c==e||(c.charAt(c.length-1)=="/"&&c.substr(0,c.length-1)==e)){return c}f=d.toRelPath(d.path,b.path);if(b.query){f+="?"+b.query}if(b.anchor){f+="#"+b.anchor}return f},toAbsolute:function(b,c){b=new tinymce.util.URI(b,{base_uri:this});return b.getURI(this.host==b.host&&this.protocol==b.protocol?c:0)},toRelPath:function(g,h){var c,f=0,d="",e,b;g=g.substring(0,g.lastIndexOf("/"));g=g.split("/");c=h.split("/");if(g.length>=c.length){for(e=0,b=g.length;e<b;e++){if(e>=c.length||g[e]!=c[e]){f=e+1;break}}}if(g.length<c.length){for(e=0,b=c.length;e<b;e++){if(e>=g.length||g[e]!=c[e]){f=e+1;break}}}if(f===1){return h}for(e=0,b=g.length-(f-1);e<b;e++){d+="../"}for(e=f-1,b=c.length;e<b;e++){if(e!=f-1){d+="/"+c[e]}else{d+=c[e]}}return d},toAbsPath:function(e,f){var c,b=0,h=[],d,g;d=/\/$/.test(f)?"/":"";e=e.split("/");f=f.split("/");a(e,function(i){if(i){h.push(i)}});e=h;for(c=f.length-1,h=[];c>=0;c--){if(f[c].length===0||f[c]==="."){continue}if(f[c]===".."){b++;continue}if(b>0){b--;continue}h.push(f[c])}c=e.length-b;if(c<=0){g=h.reverse().join("/")}else{g=e.slice(0,c).join("/")+"/"+h.reverse().join("/")}if(g.indexOf("/")!==0){g="/"+g}if(d&&g.lastIndexOf("/")!==g.length-1){g+=d}return g},getURI:function(d){var c,b=this;if(!b.source||d){c="";if(!d){if(b.protocol){c+=b.protocol+"://"}if(b.userInfo){c+=b.userInfo+"@"}if(b.host){c+=b.host}if(b.port){c+=":"+b.port}}if(b.path){c+=b.path}if(b.query){c+="?"+b.query}if(b.anchor){c+="#"+b.anchor}b.source=c}return b.source}})})();(function(){var a=tinymce.each;tinymce.create("static tinymce.util.Cookie",{getHash:function(d){var b=this.get(d),c;if(b){a(b.split("&"),function(e){e=e.split("=");c=c||{};c[unescape(e[0])]=unescape(e[1])})}return c},setHash:function(j,b,g,f,i,c){var h="";a(b,function(e,d){h+=(!h?"":"&")+escape(d)+"="+escape(e)});this.set(j,h,g,f,i,c)},get:function(i){var h=document.cookie,g,f=i+"=",d;if(!h){return}d=h.indexOf("; "+f);if(d==-1){d=h.indexOf(f);if(d!==0){return null}}else{d+=2}g=h.indexOf(";",d);if(g==-1){g=h.length}return unescape(h.substring(d+f.length,g))},set:function(i,b,g,f,h,c){document.cookie=i+"="+escape(b)+((g)?"; expires="+g.toGMTString():"")+((f)?"; path="+escape(f):"")+((h)?"; domain="+h:"")+((c)?"; secure":"")},remove:function(c,e,d){var b=new Date();b.setTime(b.getTime()-1000);this.set(c,"",b,e,d)}})})();(function(){function serialize(o,quote){var i,v,t,name;quote=quote||'"';if(o==null){return"null"}t=typeof o;if(t=="string"){v="\bb\tt\nn\ff\rr\"\"''\\\\";return quote+o.replace(/([\u0080-\uFFFF\x00-\x1f\"\'\\])/g,function(a,b){if(quote==='"'&&a==="'"){return a}i=v.indexOf(b);if(i+1){return"\\"+v.charAt(i+1)}a=b.charCodeAt().toString(16);return"\\u"+"0000".substring(a.length)+a})+quote}if(t=="object"){if(o.hasOwnProperty&&o instanceof Array){for(i=0,v="[";i<o.length;i++){v+=(i>0?",":"")+serialize(o[i],quote)}return v+"]"}v="{";for(name in o){if(o.hasOwnProperty(name)){v+=typeof o[name]!="function"?(v.length>1?","+quote:quote)+name+quote+":"+serialize(o[name],quote):""}}return v+"}"}return""+o}tinymce.util.JSON={serialize:serialize,parse:function(s){try{return eval("("+s+")")}catch(ex){}}}})();tinymce.create("static tinymce.util.XHR",{send:function(g){var a,e,b=window,h=0;function f(){if(!g.async||a.readyState==4||h++>10000){if(g.success&&h<10000&&a.status==200){g.success.call(g.success_scope,""+a.responseText,a,g)}else{if(g.error){g.error.call(g.error_scope,h>10000?"TIMED_OUT":"GENERAL",a,g)}}a=null}else{b.setTimeout(f,10)}}g.scope=g.scope||this;g.success_scope=g.success_scope||g.scope;g.error_scope=g.error_scope||g.scope;g.async=g.async===false?false:true;g.data=g.data||"";function d(i){a=0;try{a=new ActiveXObject(i)}catch(c){}return a}a=b.XMLHttpRequest?new XMLHttpRequest():d("Microsoft.XMLHTTP")||d("Msxml2.XMLHTTP");if(a){if(a.overrideMimeType){a.overrideMimeType(g.content_type)}a.open(g.type||(g.data?"POST":"GET"),g.url,g.async);if(g.content_type){a.setRequestHeader("Content-Type",g.content_type)}a.setRequestHeader("X-Requested-With","XMLHttpRequest");a.send(g.data);if(!g.async){return f()}e=b.setTimeout(f,10)}}});(function(){var c=tinymce.extend,b=tinymce.util.JSON,a=tinymce.util.XHR;tinymce.create("tinymce.util.JSONRequest",{JSONRequest:function(d){this.settings=c({},d);this.count=0},send:function(f){var e=f.error,d=f.success;f=c(this.settings,f);f.success=function(h,g){h=b.parse(h);if(typeof(h)=="undefined"){h={error:"JSON Parse error."}}if(h.error){e.call(f.error_scope||f.scope,h.error,g)}else{d.call(f.success_scope||f.scope,h.result)}};f.error=function(h,g){if(e){e.call(f.error_scope||f.scope,h,g)}};f.data=b.serialize({id:f.id||"c"+(this.count++),method:f.method,params:f.params});f.content_type="application/json";a.send(f)},"static":{sendRPC:function(d){return new tinymce.util.JSONRequest().send(d)}}})}());(function(a){a.VK={BACKSPACE:8,DELETE:46,DOWN:40,ENTER:13,LEFT:37,RIGHT:39,SPACEBAR:32,TAB:9,UP:38,modifierPressed:function(b){return b.shiftKey||b.ctrlKey||b.altKey},metaKeyPressed:function(b){return a.isMac?b.metaKey:b.ctrlKey}}})(tinymce);tinymce.util.Quirks=function(d){var m=tinymce.VK,t=m.BACKSPACE,u=m.DELETE,p=d.dom,E=d.selection,s=d.settings;function c(I,H){try{d.getDoc().execCommand(I,false,H)}catch(G){}}function z(){var G=d.getDoc().documentMode;return G?G:6}function j(){function G(J){var H,L,I,K;H=E.getRng();L=p.getParent(H.startContainer,p.isBlock);if(J){L=p.getNext(L,p.isBlock)}if(L){I=L.firstChild;while(I&&I.nodeType==3&&I.nodeValue.length===0){I=I.nextSibling}if(I&&I.nodeName==="SPAN"){K=I.cloneNode(false)}}d.getDoc().execCommand(J?"ForwardDelete":"Delete",false,null);L=p.getParent(H.startContainer,p.isBlock);tinymce.each(p.select("span.Apple-style-span,font.Apple-style-span",L),function(M){var N=E.getBookmark();if(K){p.replace(K.cloneNode(false),M,true)}else{p.remove(M,true)}E.moveToBookmark(N)})}d.onKeyDown.add(function(H,J){var I;I=J.keyCode==u;if(!J.isDefaultPrevented()&&(I||J.keyCode==t)&&!m.modifierPressed(J)){J.preventDefault();G(I)}});d.addCommand("Delete",function(){G()})}function F(){function G(J){var I=p.create("body");var K=J.cloneContents();I.appendChild(K);return E.serializer.serialize(I,{format:"html"})}function H(I){var K=G(I);var L=p.createRng();L.selectNode(d.getBody());var J=G(L);return K===J}d.onKeyDown.add(function(J,L){var K=L.keyCode,I;if(!L.isDefaultPrevented()&&(K==u||K==t)){I=J.selection.isCollapsed();if(I&&!p.isEmpty(J.getBody())){return}if(tinymce.isIE&&!I){return}if(!I&&!H(J.selection.getRng())){return}J.setContent("");J.selection.setCursorLocation(J.getBody(),0);J.nodeChanged()}})}function x(){d.onKeyDown.add(function(G,H){if(H.keyCode==65&&m.metaKeyPressed(H)){H.preventDefault();G.execCommand("SelectAll")}})}function y(){if(!d.settings.content_editable){p.bind(d.getDoc(),"focusin",function(G){E.setRng(E.getRng())});p.bind(d.getDoc(),"mousedown",function(G){if(G.target==d.getDoc().documentElement){d.getWin().focus();E.setRng(E.getRng())}})}}function n(){d.onKeyDown.add(function(G,J){if(!J.isDefaultPrevented()&&J.keyCode===t){if(E.isCollapsed()&&E.getRng(true).startOffset===0){var I=E.getNode();var H=I.previousSibling;if(H&&H.nodeName&&H.nodeName.toLowerCase()==="hr"){p.remove(H);tinymce.dom.Event.cancel(J)}}}})}function b(){if(!Range.prototype.getClientRects){d.onMouseDown.add(function(H,I){if(I.target.nodeName==="HTML"){var G=H.getBody();G.blur();setTimeout(function(){G.focus()},0)}})}}function B(){d.onClick.add(function(G,H){H=H.target;if(/^(IMG|HR)$/.test(H.nodeName)){E.getSel().setBaseAndExtent(H,0,H,1)}if(H.nodeName=="A"&&p.hasClass(H,"mceItemAnchor")){E.select(H)}G.nodeChanged()})}function C(){function H(){var J=p.getAttribs(E.getStart().cloneNode(false));return function(){var K=E.getStart();if(K!==d.getBody()){p.setAttrib(K,"style",null);tinymce.each(J,function(L){K.setAttributeNode(L.cloneNode(true))})}}}function G(){return !E.isCollapsed()&&E.getStart()!=E.getEnd()}function I(J,K){K.preventDefault();return false}d.onKeyPress.add(function(J,L){var K;if((L.keyCode==8||L.keyCode==46)&&G()){K=H();J.getDoc().execCommand("delete",false,null);K();L.preventDefault();return false}});p.bind(d.getDoc(),"cut",function(K){var J;if(G()){J=H();d.onKeyUp.addToTop(I);setTimeout(function(){J();d.onKeyUp.remove(I)},0)}})}function k(){var H,G;p.bind(d.getDoc(),"selectionchange",function(){if(G){clearTimeout(G);G=0}G=window.setTimeout(function(){var I=E.getRng();if(!H||!tinymce.dom.RangeUtils.compareRanges(I,H)){d.nodeChanged();H=I}},50)})}function D(){document.body.setAttribute("role","application")}function A(){d.onKeyDown.add(function(G,I){if(!I.isDefaultPrevented()&&I.keyCode===t){if(E.isCollapsed()&&E.getRng(true).startOffset===0){var H=E.getNode().previousSibling;if(H&&H.nodeName&&H.nodeName.toLowerCase()==="table"){return tinymce.dom.Event.cancel(I)}}}})}function h(){if(z()>7){return}c("RespectVisibilityInDesign",true);d.contentStyles.push(".mceHideBrInPre pre br {display: none}");p.addClass(d.getBody(),"mceHideBrInPre");d.parser.addNodeFilter("pre",function(G,I){var J=G.length,L,H,M,K;while(J--){L=G[J].getAll("br");H=L.length;while(H--){M=L[H];K=M.prev;if(K&&K.type===3&&K.value.charAt(K.value-1)!="\n"){K.value+="\n"}else{M.parent.insert(new tinymce.html.Node("#text",3),M,true).value="\n"}}}});d.serializer.addNodeFilter("pre",function(G,I){var J=G.length,L,H,M,K;while(J--){L=G[J].getAll("br");H=L.length;while(H--){M=L[H];K=M.prev;if(K&&K.type==3){K.value=K.value.replace(/\r?\n$/,"")}}}})}function f(){p.bind(d.getBody(),"mouseup",function(I){var H,G=E.getNode();if(G.nodeName=="IMG"){if(H=p.getStyle(G,"width")){p.setAttrib(G,"width",H.replace(/[^0-9%]+/g,""));p.setStyle(G,"width","")}if(H=p.getStyle(G,"height")){p.setAttrib(G,"height",H.replace(/[^0-9%]+/g,""));p.setStyle(G,"height","")}}})}function r(){d.onKeyDown.add(function(M,N){var L,G,H,J,K,O,I;L=N.keyCode==u;if(!N.isDefaultPrevented()&&(L||N.keyCode==t)&&!m.modifierPressed(N)){G=E.getRng();H=G.startContainer;J=G.startOffset;I=G.collapsed;if(H.nodeType==3&&H.nodeValue.length>0&&((J===0&&!I)||(I&&J===(L?0:1)))){nonEmptyElements=M.schema.getNonEmptyElements();N.preventDefault();K=p.create("br",{id:"__tmp"});H.parentNode.insertBefore(K,H);M.getDoc().execCommand(L?"ForwardDelete":"Delete",false,null);H=E.getRng().startContainer;O=H.previousSibling;if(O&&O.nodeType==1&&!p.isBlock(O)&&p.isEmpty(O)&&!nonEmptyElements[O.nodeName.toLowerCase()]){p.remove(O)}p.remove("__tmp")}}})}function e(){d.onKeyDown.add(function(K,L){var I,H,M,G,J;if(L.isDefaultPrevented()||L.keyCode!=m.BACKSPACE){return}I=E.getRng();H=I.startContainer;M=I.startOffset;G=p.getRoot();J=H;if(!I.collapsed||M!==0){return}while(J&&J.parentNode&&J.parentNode.firstChild==J&&J.parentNode!=G){J=J.parentNode}if(J.tagName==="BLOCKQUOTE"){K.formatter.toggle("blockquote",null,J);I.setStart(H,0);I.setEnd(H,0);E.setRng(I);E.collapse(false)}})}function l(){function G(){d._refreshContentEditable();c("StyleWithCSS",false);c("enableInlineTableEditing",false);if(!s.object_resizing){c("enableObjectResizing",false)}}if(!s.readonly){d.onBeforeExecCommand.add(G);d.onMouseDown.add(G)}}function o(){function G(H,I){tinymce.each(p.select("a"),function(L){var J=L.parentNode,K=p.getRoot();if(J.lastChild===L){while(J&&!p.isBlock(J)){if(J.parentNode.lastChild!==J||J===K){return}J=J.parentNode}p.add(J,"br",{"data-mce-bogus":1})}})}d.onExecCommand.add(function(H,I){if(I==="CreateLink"){G(H)}});d.onSetContent.add(E.onSetContent.add(G))}function v(){if(s.forced_root_block){d.onInit.add(function(){c("DefaultParagraphSeparator",s.forced_root_block)})}}function a(){function G(I,H){if(!I||!H.initial){d.execCommand("mceRepaint")}}d.onUndo.add(G);d.onRedo.add(G);d.onSetContent.add(G)}function q(){d.onKeyDown.add(function(H,I){var G;if(!I.isDefaultPrevented()&&I.keyCode==t){G=H.getDoc().selection.createRange();if(G&&G.item){I.preventDefault();H.undoManager.beforeChange();p.remove(G.item(0));H.undoManager.add()}}})}function i(){var G;if(z()>=10){G="";tinymce.each("p div h1 h2 h3 h4 h5 h6".split(" "),function(H,I){G+=(I>0?",":"")+H+":empty"});d.contentStyles.push(G+"{padding-right: 1px !important}")}}function g(){var K,H,G,I,J;if(!s.object_resizing||s.webkit_fake_resize===false){return}d.contentStyles.push(".mceResizeImages img {cursor: se-resize !important}");function L(R){var O,N,Q,P,M;if(K){O=R.screenX-H;N=R.screenY-G;Q=Math.max((I+O)/I,(J+N)/J);if(Math.abs(O)>1||Math.abs(N)>1){P=Math.round(I*Q);M=Math.round(J*Q);if(K.style.width){p.setStyle(K,"width",P)}else{p.setAttrib(K,"width",P)}if(K.style.height){p.setStyle(K,"height",M)}else{p.setAttrib(K,"height",M)}if(!p.hasClass(d.getBody(),"mceResizeImages")){p.addClass(d.getBody(),"mceResizeImages")}}}}d.onMouseDown.add(function(M,O){var N=O.target;if(N.nodeName=="IMG"){K=N;H=O.screenX;G=O.screenY;I=K.clientWidth;J=K.clientHeight;p.bind(M.getDoc(),"mousemove",L);O.preventDefault()}});d.onNodeChange.add(function(){if(K){K=null;p.unbind(d.getDoc(),"mousemove",L)}if(E.getNode().nodeName=="IMG"){p.addClass(d.getBody(),"mceResizeImages")}else{p.removeClass(d.getBody(),"mceResizeImages")}})}A();e();F();if(tinymce.isWebKit){r();j();y();B();v();if(tinymce.isIDevice){k()}else{g();x()}}if(tinymce.isIE){n();D();h();f();q();i()}if(tinymce.isGecko){n();b();C();l();o();a()}};(function(j){var a,g,d,k=/[&<>\"\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,b=/[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,f=/[<>&\"\']/g,c=/&(#x|#)?([\w]+);/g,i={128:"\u20AC",130:"\u201A",131:"\u0192",132:"\u201E",133:"\u2026",134:"\u2020",135:"\u2021",136:"\u02C6",137:"\u2030",138:"\u0160",139:"\u2039",140:"\u0152",142:"\u017D",145:"\u2018",146:"\u2019",147:"\u201C",148:"\u201D",149:"\u2022",150:"\u2013",151:"\u2014",152:"\u02DC",153:"\u2122",154:"\u0161",155:"\u203A",156:"\u0153",158:"\u017E",159:"\u0178"};g={'"':"&quot;","'":"&#39;","<":"&lt;",">":"&gt;","&":"&amp;"};d={"&lt;":"<","&gt;":">","&amp;":"&","&quot;":'"',"&apos;":"'"};function h(l){var m;m=document.createElement("div");m.innerHTML=l;return m.textContent||m.innerText||l}function e(m,p){var n,o,l,q={};if(m){m=m.split(",");p=p||10;for(n=0;n<m.length;n+=2){o=String.fromCharCode(parseInt(m[n],p));if(!g[o]){l="&"+m[n+1]+";";q[o]=l;q[l]=o}}return q}}a=e("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro",32);j.html=j.html||{};j.html.Entities={encodeRaw:function(m,l){return m.replace(l?k:b,function(n){return g[n]||n})},encodeAllRaw:function(l){return(""+l).replace(f,function(m){return g[m]||m})},encodeNumeric:function(m,l){return m.replace(l?k:b,function(n){if(n.length>1){return"&#"+(((n.charCodeAt(0)-55296)*1024)+(n.charCodeAt(1)-56320)+65536)+";"}return g[n]||"&#"+n.charCodeAt(0)+";"})},encodeNamed:function(n,l,m){m=m||a;return n.replace(l?k:b,function(o){return g[o]||m[o]||o})},getEncodeFunc:function(l,o){var p=j.html.Entities;o=e(o)||a;function m(r,q){return r.replace(q?k:b,function(s){return g[s]||o[s]||"&#"+s.charCodeAt(0)+";"||s})}function n(r,q){return p.encodeNamed(r,q,o)}l=j.makeMap(l.replace(/\+/g,","));if(l.named&&l.numeric){return m}if(l.named){if(o){return n}return p.encodeNamed}if(l.numeric){return p.encodeNumeric}return p.encodeRaw},decode:function(l){return l.replace(c,function(n,m,o){if(m){o=parseInt(o,m.length===2?16:10);if(o>65535){o-=65536;return String.fromCharCode(55296+(o>>10),56320+(o&1023))}else{return i[o]||String.fromCharCode(o)}}return d[n]||a[n]||h(n)})}}})(tinymce);tinymce.html.Styles=function(d,f){var k=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,h=/(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,b=/\s*([^:]+):\s*([^;]+);?/g,l=/\s+$/,m=/rgb/,e,g,a={},j;d=d||{};j="\\\" \\' \\; \\: ; : \uFEFF".split(" ");for(g=0;g<j.length;g++){a[j[g]]="\uFEFF"+g;a["\uFEFF"+g]=j[g]}function c(n,q,p,i){function o(r){r=parseInt(r).toString(16);return r.length>1?r:"0"+r}return"#"+o(q)+o(p)+o(i)}return{toHex:function(i){return i.replace(k,c)},parse:function(s){var z={},q,n,x,r,v=d.url_converter,y=d.url_converter_scope||this;function p(D,G){var F,C,B,E;F=z[D+"-top"+G];if(!F){return}C=z[D+"-right"+G];if(F!=C){return}B=z[D+"-bottom"+G];if(C!=B){return}E=z[D+"-left"+G];if(B!=E){return}z[D+G]=E;delete z[D+"-top"+G];delete z[D+"-right"+G];delete z[D+"-bottom"+G];delete z[D+"-left"+G]}function u(C){var D=z[C],B;if(!D||D.indexOf(" ")<0){return}D=D.split(" ");B=D.length;while(B--){if(D[B]!==D[0]){return false}}z[C]=D[0];return true}function A(D,C,B,E){if(!u(C)){return}if(!u(B)){return}if(!u(E)){return}z[D]=z[C]+" "+z[B]+" "+z[E];delete z[C];delete z[B];delete z[E]}function t(B){r=true;return a[B]}function i(C,B){if(r){C=C.replace(/\uFEFF[0-9]/g,function(D){return a[D]})}if(!B){C=C.replace(/\\([\'\";:])/g,"$1")}return C}function o(C,B,F,E,G,D){G=G||D;if(G){G=i(G);return"'"+G.replace(/\'/g,"\\'")+"'"}B=i(B||F||E);if(v){B=v.call(y,B,"style")}return"url('"+B.replace(/\'/g,"\\'")+"')"}if(s){s=s.replace(/\\[\"\';:\uFEFF]/g,t).replace(/\"[^\"]+\"|\'[^\']+\'/g,function(B){return B.replace(/[;:]/g,t)});while(q=b.exec(s)){n=q[1].replace(l,"").toLowerCase();x=q[2].replace(l,"");if(n&&x.length>0){if(n==="font-weight"&&x==="700"){x="bold"}else{if(n==="color"||n==="background-color"){x=x.toLowerCase()}}x=x.replace(k,c);x=x.replace(h,o);z[n]=r?i(x,true):x}b.lastIndex=q.index+q[0].length}p("border","");p("border","-width");p("border","-color");p("border","-style");p("padding","");p("margin","");A("border","border-width","border-style","border-color");if(z.border==="medium none"){delete z.border}}return z},serialize:function(p,r){var o="",n,q;function i(t){var x,u,s,v;x=f.styles[t];if(x){for(u=0,s=x.length;u<s;u++){t=x[u];v=p[t];if(v!==e&&v.length>0){o+=(o.length>0?" ":"")+t+": "+v+";"}}}}if(r&&f&&f.styles){i("*");i(r)}else{for(n in p){q=p[n];if(q!==e&&q.length>0){o+=(o.length>0?" ":"")+n+": "+q+";"}}}return o}}};(function(f){var a={},e=f.makeMap,g=f.each;function d(j,i){return j.split(i||",")}function h(m,l){var j,k={};function i(n){return n.replace(/[A-Z]+/g,function(o){return i(m[o])})}for(j in m){if(m.hasOwnProperty(j)){m[j]=i(m[j])}}i(l).replace(/#/g,"#text").replace(/(\w+)\[([^\]]+)\]\[([^\]]*)\]/g,function(q,o,n,p){n=d(n,"|");k[o]={attributes:e(n),attributesOrder:n,children:e(p,"|",{"#comment":{}})}});return k}function b(){var i=a.html5;if(!i){i=a.html5=h({A:"id|accesskey|class|dir|draggable|item|hidden|itemprop|role|spellcheck|style|subject|title|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup",B:"#|a|abbr|area|audio|b|bdo|br|button|canvas|cite|code|command|datalist|del|dfn|em|embed|i|iframe|img|input|ins|kbd|keygen|label|link|map|mark|meta|meter|noscript|object|output|progress|q|ruby|samp|script|select|small|span|strong|sub|sup|svg|textarea|time|var|video|wbr",C:"#|a|abbr|area|address|article|aside|audio|b|bdo|blockquote|br|button|canvas|cite|code|command|datalist|del|details|dfn|dialog|div|dl|em|embed|fieldset|figure|footer|form|h1|h2|h3|h4|h5|h6|header|hgroup|hr|i|iframe|img|input|ins|kbd|keygen|label|link|map|mark|menu|meta|meter|nav|noscript|ol|object|output|p|pre|progress|q|ruby|samp|script|section|select|small|span|strong|style|sub|sup|svg|table|textarea|time|ul|var|video"},"html[A|manifest][body|head]head[A][base|command|link|meta|noscript|script|style|title]title[A][#]base[A|href|target][]link[A|href|rel|media|type|sizes][]meta[A|http-equiv|name|content|charset][]style[A|type|media|scoped][#]script[A|charset|type|src|defer|async][#]noscript[A][C]body[A][C]section[A][C]nav[A][C]article[A][C]aside[A][C]h1[A][B]h2[A][B]h3[A][B]h4[A][B]h5[