!function(t,e){"function"==typeof define&&define.amd?define(e):"object"==typeof exports?module.exports=e(require,exports,module):t.Tether=e()}(this,function(){return function(){var t,e,o,i,n,r,s,l,h,a,p,u,c,f,d,g,m,v={}.hasOwnProperty,b=[].indexOf||function(t){for(var e=0,o=this.length;o>e;e++)if(e in this&&this[e]===t)return e;return-1},y=[].slice;null==this.Tether&&(this.Tether={modules:[]}),p=function(t){var e,o,i,n,r;if(o=getComputedStyle(t).position,"fixed"===o)return t;for(i=void 0,e=t;e=e.parentNode;){try{n=getComputedStyle(e)}catch(s){}if(null==n)return e;if(/(auto|scroll)/.test(n.overflow+n["overflow-y"]+n["overflow-x"])&&("absolute"!==o||"relative"===(r=n.position)||"absolute"===r||"fixed"===r))return e}return document.body},d=function(){var t;return t=0,function(){return t++}}(),m={},h=function(t){var e,i,r,s,l;if(r=t._tetherZeroElement,null==r&&(r=t.createElement("div"),r.setAttribute("data-tether-id",d()),n(r.style,{top:0,left:0,position:"absolute"}),t.body.appendChild(r),t._tetherZeroElement=r),e=r.getAttribute("data-tether-id"),null==m[e]){m[e]={},l=r.getBoundingClientRect();for(i in l)s=l[i],m[e][i]=s;o(function(){return m[e]=void 0})}return m[e]},c=null,s=function(t){var e,o,i,n,r,s,l;t===document?(o=document,t=document.documentElement):o=t.ownerDocument,i=o.documentElement,e={},l=t.getBoundingClientRect();for(n in l)s=l[n],e[n]=s;return r=h(o),e.top-=r.top,e.left-=r.left,null==e.width&&(e.width=document.body.scrollWidth-e.left-e.right),null==e.height&&(e.height=document.body.scrollHeight-e.top-e.bottom),e.top=e.top-i.clientTop,e.left=e.left-i.clientLeft,e.right=o.body.clientWidth-e.width-e.left,e.bottom=o.body.clientHeight-e.height-e.top,e},l=function(t){return t.offsetParent||document.documentElement},a=function(){var t,e,o,i,r;return t=document.createElement("div"),t.style.width="100%",t.style.height="200px",e=document.createElement("div"),n(e.style,{position:"absolute",top:0,left:0,pointerEvents:"none",visibility:"hidden",width:"200px",height:"150px",overflow:"hidden"}),e.appendChild(t),document.body.appendChild(e),i=t.offsetWidth,e.style.overflow="scroll",r=t.offsetWidth,i===r&&(r=e.clientWidth),document.body.removeChild(e),o=i-r,{width:o,height:o}},n=function(t){var e,o,i,n,r,s,l;for(null==t&&(t={}),e=[],Array.prototype.push.apply(e,arguments),l=e.slice(1),r=0,s=l.length;s>r;r++)if(i=l[r])for(o in i)v.call(i,o)&&(n=i[o],t[o]=n);return t},f=function(t,e){var o,i,n,r,s;if(null!=t.classList){for(r=e.split(" "),s=[],i=0,n=r.length;n>i;i++)o=r[i],o.trim()&&s.push(t.classList.remove(o));return s}return t.className=t.className.replace(new RegExp("(^| )"+e.split(" ").join("|")+"( |$)","gi")," ")},e=function(t,e){var o,i,n,r,s;if(null!=t.classList){for(r=e.split(" "),s=[],i=0,n=r.length;n>i;i++)o=r[i],o.trim()&&s.push(t.classList.add(o));return s}return f(t,e),t.className+=" "+e},u=function(t,e){return null!=t.classList?t.classList.contains(e):new RegExp("(^| )"+e+"( |$)","gi").test(t.className)},g=function(t,o,i){var n,r,s,l,h,a;for(r=0,l=i.length;l>r;r++)n=i[r],b.call(o,n)<0&&u(t,n)&&f(t,n);for(a=[],s=0,h=o.length;h>s;s++)n=o[s],a.push(u(t,n)?void 0:e(t,n));return a},i=[],o=function(t){return i.push(t)},r=function(){var t,e;for(e=[];t=i.pop();)e.push(t());return e},t=function(){function t(){}return t.prototype.on=function(t,e,o,i){var n;return null==i&&(i=!1),null==this.bindings&&(this.bindings={}),null==(n=this.bindings)[t]&&(n[t]=[]),this.bindings[t].push({handler:e,ctx:o,once:i})},t.prototype.once=function(t,e,o){return this.on(t,e,o,!0)},t.prototype.off=function(t,e){var o,i,n;if(null!=(null!=(i=this.bindings)?i[t]:void 0)){if(null==e)return delete this.bindings[t];for(o=0,n=[];o<this.bindings[t].length;)n.push(this.bindings[t][o].handler===e?this.bindings[t].splice(o,1):o++);return n}},t.prototype.trigger=function(){var t,e,o,i,n,r,s,l,h;if(o=arguments[0],t=2<=arguments.length?y.call(arguments,1):[],null!=(s=this.bindings)?s[o]:void 0){for(n=0,h=[];n<this.bindings[o].length;)l=this.bindings[o][n],i=l.handler,e=l.ctx,r=l.once,i.apply(null!=e?e:this,t),h.push(r?this.bindings[o].splice(n,1):n++);return h}},t}(),this.Tether.Utils={getScrollParent:p,getBounds:s,getOffsetParent:l,extend:n,addClass:e,removeClass:f,hasClass:u,updateClasses:g,defer:o,flush:r,uniqueId:d,Evented:t,getScrollBarSize:a}}.call(this),function(){var t,e,o,i,n,r,s,l,h,a,p,u,c,f,d,g,m,v,b,y,C,w,O,T,E,S,x,A,L,M=[].slice,H=function(t,e){return function(){return t.apply(e,arguments)}};if(null==this.Tether)throw new Error("You must include the utils.js file before tether.js");i=this.Tether,L=i.Utils,g=L.getScrollParent,m=L.getSize,f=L.getOuterSize,u=L.getBounds,c=L.getOffsetParent,a=L.extend,n=L.addClass,O=L.removeClass,S=L.updateClasses,h=L.defer,p=L.flush,d=L.getScrollBarSize,x=function(t,e,o){return null==o&&(o=1),t+o>=e&&e>=t-o},E=function(){var t,e,o,i,n;for(t=document.createElement("div"),n=["transform","webkitTransform","OTransform","MozTransform","msTransform"],o=0,i=n.length;i>o;o++)if(e=n[o],void 0!==t.style[e])return e}(),T=[],w=function(){var t,e,o;for(e=0,o=T.length;o>e;e++)t=T[e],t.position(!1);return p()},v=function(){var t;return null!=(t="undefined"!=typeof performance&&null!==performance&&"function"==typeof performance.now?performance.now():void 0)?t:+new Date},function(){var t,e,o,i,n,r,s,l,h;for(e=null,o=null,i=null,n=function(){return null!=o&&o>16?(o=Math.min(o-16,250),void(i=setTimeout(n,250))):null!=e&&v()-e<10?void 0:(null!=i&&(clearTimeout(i),i=null),e=v(),w(),o=v()-e)},l=["resize","scroll","touchmove"],h=[],r=0,s=l.length;s>r;r++)t=l[r],h.push(window.addEventListener(t,n));return h}(),t={center:"center",left:"right",right:"left"},e={middle:"middle",top:"bottom",bottom:"top"},o={top:0,left:0,middle:"50%",center:"50%",bottom:"100%",right:"100%"},l=function(o,i){var n,r;return n=o.left,r=o.top,"auto"===n&&(n=t[i.left]),"auto"===r&&(r=e[i.top]),{left:n,top:r}},s=function(t){var e,i;return{left:null!=(e=o[t.left])?e:t.left,top:null!=(i=o[t.top])?i:t.top}},r=function(){var t,e,o,i,n,r,s;for(e=1<=arguments.length?M.call(arguments,0):[],o={top:0,left:0},n=0,r=e.length;r>n;n++)s=e[n],i=s.top,t=s.left,"string"==typeof i&&(i=parseFloat(i,10)),"string"==typeof t&&(t=parseFloat(t,10)),o.top+=i,o.left+=t;return o},b=function(t,e){return"string"==typeof t.left&&-1!==t.left.indexOf("%")&&(t.left=parseFloat(t.left,10)/100*e.width),"string"==typeof t.top&&-1!==t.top.indexOf("%")&&(t.top=parseFloat(t.top,10)/100*e.height),t},y=C=function(t){var e,o,i;return i=t.split(" "),o=i[0],e=i[1],{top:o,left:e}},A=function(){function t(t){this.position=H(this.position,this);var e,o,n,r,s;for(T.push(this),this.history=[],this.setOptions(t,!1),r=i.modules,o=0,n=r.length;n>o;o++)e=r[o],null!=(s=e.initialize)&&s.call(this);this.position()}return t.modules=[],t.prototype.getClass=function(t){var e,o;return(null!=(e=this.options.classes)?e[t]:void 0)?this.options.classes[t]:(null!=(o=this.options.classes)?o[t]:void 0)!==!1?this.options.classPrefix?""+this.options.classPrefix+"-"+t:t:""},t.prototype.setOptions=function(t,e){var o,i,r,s,l,h;for(this.options=t,null==e&&(e=!0),o={offset:"0 0",targetOffset:"0 0",targetAttachment:"auto auto",classPrefix:"tether"},this.options=a(o,this.options),l=this.options,this.element=l.element,this.target=l.target,this.targetModifier=l.targetModifier,"viewport"===this.target?(this.target=document.body,this.targetModifier="visible"):"scroll-handle"===this.target&&(this.target=document.body,this.targetModifier="scroll-handle"),h=["element","target"],r=0,s=h.length;s>r;r++){if(i=h[r],null==this[i])throw new Error("Tether Error: Both element and target must be defined");null!=this[i].jquery?this[i]=this[i][0]:"string"==typeof this[i]&&(this[i]=document.querySelector(this[i]))}if(n(this.element,this.getClass("element")),n(this.target,this.getClass("target")),!this.options.attachment)throw new Error("Tether Error: You must provide an attachment");return this.targetAttachment=y(this.options.targetAttachment),this.attachment=y(this.options.attachment),this.offset=C(this.options.offset),this.targetOffset=C(this.options.targetOffset),null!=this.scrollParent&&this.disable(),this.scrollParent="scroll-handle"===this.targetModifier?this.target:g(this.target),this.options.enabled!==!1?this.enable(e):void 0},t.prototype.getTargetBounds=function(){var t,e,o,i,n,r,s,l,h;if(null==this.targetModifier)return u(this.target);switch(this.targetModifier){case"visible":return this.target===document.body?{top:pageYOffset,left:pageXOffset,height:innerHeight,width:innerWidth}:(t=u(this.target),n={height:t.height,width:t.width,top:t.top,left:t.left},n.height=Math.min(n.height,t.height-(pageYOffset-t.top)),n.height=Math.min(n.height,t.height-(t.top+t.height-(pageYOffset+innerHeight))),n.height=Math.min(innerHeight,n.height),n.height-=2,n.width=Math.min(n.width,t.width-(pageXOffset-t.left)),n.width=Math.min(n.width,t.width-(t.left+t.width-(pageXOffset+innerWidth))),n.width=Math.min(innerWidth,n.width),n.width-=2,n.top<pageYOffset&&(n.top=pageYOffset),n.left<pageXOffset&&(n.left=pageXOffset),n);case"scroll-handle":return h=this.target,h===document.body?(h=document.documentElement,t={left:pageXOffset,top:pageYOffset,height:innerHeight,width:innerWidth}):t=u(h),l=getComputedStyle(h),o=h.scrollWidth>h.clientWidth||"scroll"===[l.overflow,l.overflowX]||this.target!==document.body,r=0,o&&(r=15),i=t.height-parseFloat(l.borderTopWidth)-parseFloat(l.borderBottomWidth)-r,n={width:15,height:.975*i*(i/h.scrollHeight),left:t.left+t.width-parseFloat(l.borderLeftWidth)-15},e=0,408>i&&this.target===document.body&&(e=-11e-5*Math.pow(i,2)-.00727*i+22.58),this.target!==document.body&&(n.height=Math.max(n.height,24)),s=this.target.scrollTop/(h.scrollHeight-i),n.top=s*(i-n.height-e)+t.top+parseFloat(l.borderTopWidth),this.target===document.body&&(n.height=Math.max(n.height,24)),n}},t.prototype.clearCache=function(){return this._cache={}},t.prototype.cache=function(t,e){return null==this._cache&&(this._cache={}),null==this._cache[t]&&(this._cache[t]=e.call(this)),this._cache[t]},t.prototype.enable=function(t){return null==t&&(t=!0),n(this.target,this.getClass("enabled")),n(this.element,this.getClass("enabled")),this.enabled=!0,this.scrollParent!==document&&this.scrollParent.addEventListener("scroll",this.position),t?this.position():void 0},t.prototype.disable=function(){return O(this.target,this.getClass("enabled")),O(this.element,this.getClass("enabled")),this.enabled=!1,null!=this.scrollParent?this.scrollParent.removeEventListener("scroll",this.position):void 0},t.prototype.destroy=function(){var t,e,o,i,n;for(this.disable(),n=[],t=o=0,i=T.length;i>o;t=++o){if(e=T[t],e===this){T.splice(t,1);break}n.push(void 0)}return n},t.prototype.updateAttachClasses=function(t,e){var o,i,n,r,s,l,a,p,u,c=this;for(null==t&&(t=this.attachment),null==e&&(e=this.targetAttachment),r=["left","top","bottom","right","middle","center"],(null!=(u=this._addAttachClasses)?u.length:void 0)&&this._addAttachClasses.splice(0,this._addAttachClasses.length),o=null!=this._addAttachClasses?this._addAttachClasses:this._addAttachClasses=[],t.top&&o.push(""+this.getClass("element-attached")+"-"+t.top),t.left&&o.push(""+this.getClass("element-attached")+"-"+t.left),e.top&&o.push(""+this.getClass("target-attached")+"-"+e.top),e.left&&o.push(""+this.getClass("target-attached")+"-"+e.left),i=[],s=0,a=r.length;a>s;s++)n=r[s],i.push(""+this.getClass("element-attached")+"-"+n);for(l=0,p=r.length;p>l;l++)n=r[l],i.push(""+this.getClass("target-attached")+"-"+n);return h(function(){return null!=c._addAttachClasses?(S(c.element,c._addAttachClasses,i),S(c.target,c._addAttachClasses,i),c._addAttachClasses=void 0):void 0})},t.prototype.position=function(t){var e,o,n,h,a,f,g,m,v,y,C,w,O,T,E,S,x,A,L,M,H,B,P,W,k,_,N,z,q,D,F,Y,X,j,I,U=this;if(null==t&&(t=!0),this.enabled){for(this.clearCache(),M=l(this.targetAttachment,this.attachment),this.updateAttachClasses(this.attachment,M),e=this.cache("element-bounds",function(){return u(U.element)}),k=e.width,n=e.height,0===k&&0===n&&null!=this.lastSize?(D=this.lastSize,k=D.width,n=D.height):this.lastSize={width:k,height:n},P=B=this.cache("target-bounds",function(){return U.getTargetBounds()}),v=b(s(this.attachment),{width:k,height:n}),H=b(s(M),P),a=b(this.offset,{width:k,height:n}),f=b(this.targetOffset,P),v=r(v,a),H=r(H,f),h=B.left+H.left-v.left,W=B.top+H.top-v.top,F=i.modules,_=0,z=F.length;z>_;_++)if(g=F[_],E=g.position.call(this,{left:h,top:W,targetAttachment:M,targetPos:B,attachment:this.attachment,elementPos:e,offset:v,targetOffset:H,manualOffset:a,manualTargetOffset:f,scrollbarSize:A}),null!=E&&"object"==typeof E){if(E===!1)return!1;W=E.top,h=E.left}if(m={page:{top:W,left:h},viewport:{top:W-pageYOffset,bottom:pageYOffset-W-n+innerHeight,left:h-pageXOffset,right:pageXOffset-h-k+innerWidth}},document.body.scrollWidth>window.innerWidth&&(A=this.cache("scrollbar-size",d),m.viewport.bottom-=A.height),document.body.scrollHeight>window.innerHeight&&(A=this.cache("scrollbar-size",d),m.viewport.right-=A.width),(""!==(Y=document.body.style.position)&&"static"!==Y||""!==(X=document.body.parentElement.style.position)&&"static"!==X)&&(m.page.bottom=document.body.scrollHeight-W-n,m.page.right=document.body.scrollWidth-h-k),(null!=(j=this.options.optimizations)?j.moveElement:void 0)!==!1&&null==this.targetModifier){for(C=this.cache("target-offsetparent",function(){return c(U.target)}),T=this.cache("target-offsetparent-bounds",function(){return u(C)}),O=getComputedStyle(C),o=getComputedStyle(this.element),w=T,y={},I=["Top","Left","Bottom","Right"],N=0,q=I.length;q>N;N++)L=I[N],y[L.toLowerCase()]=parseFloat(O["border"+L+"Width"]);T.right=document.body.scrollWidth-T.left-w.width+y.right,T.bottom=document.body.scrollHeight-T.top-w.height+y.bottom,m.page.top>=T.top+y.top&&m.page.bottom>=T.bottom&&m.page.left>=T.left+y.left&&m.page.right>=T.right&&(x=C.scrollTop,S=C.scrollLeft,m.offset={top:m.page.top-T.top+x-y.top,left:m.page.left-T.left+S-y.left})}return this.move(m),this.history.unshift(m),this.history.length>3&&this.history.pop(),t&&p(),!0}},t.prototype.move=function(t){var e,o,i,n,r,s,l,p,u,f,d,g,m,v,b,y,C,w=this;if(null!=this.element.parentNode){p={};for(f in t){p[f]={};for(n in t[f]){for(i=!1,y=this.history,v=0,b=y.length;b>v;v++)if(l=y[v],!x(null!=(C=l[f])?C[n]:void 0,t[f][n])){i=!0;break}i||(p[f][n]=!0)}}e={top:"",left:"",right:"",bottom:""},u=function(t,o){var i,n,r;return(null!=(r=w.options.optimizations)?r.gpu:void 0)===!1?(t.top?e.top=""+o.top+"px":e.bottom=""+o.bottom+"px",t.left?e.left=""+o.left+"px":e.right=""+o.right+"px"):(t.top?(e.top=0,n=o.top):(e.bottom=0,n=-o.bottom),t.left?(e.left=0,i=o.left):(e.right=0,i=-o.right),e[E]="translateX("+Math.round(i)+"px) translateY("+Math.round(n)+"px)","msTransform"!==E?e[E]+=" translateZ(0)":void 0)},r=!1,(p.page.top||p.page.bottom)&&(p.page.left||p.page.right)?(e.position="absolute",u(p.page,t.page)):(p.viewport.top||p.viewport.bottom)&&(p.viewport.left||p.viewport.right)?(e.position="fixed",u(p.viewport,t.viewport)):null!=p.offset&&p.offset.top&&p.offset.left?(e.position="absolute",s=this.cache("target-offsetparent",function(){return c(w.target)}),c(this.element)!==s&&h(function(){return w.element.parentNode.removeChild(w.element),s.appendChild(w.element)}),u(p.offset,t.offset),r=!0):(e.position="absolute",u({top:!0,left:!0},t.page)),r||"BODY"===this.element.parentNode.tagName||(this.element.parentNode.removeChild(this.element),document.body.appendChild(this.element)),m={},g=!1;for(n in e)d=e[n],o=this.element.style[n],""===o||""===d||"top"!==n&&"left"!==n&&"bottom"!==n&&"right"!==n||(o=parseFloat(o),d=parseFloat(d)),o!==d&&(g=!0,m[n]=e[n]);return g?h(function(){return a(w.element.style,m)}):void 0}},t}(),i.position=w,this.Tether=a(A,i)}.call(this),function(){var t,e,o,i,n,r,s,l,h,a,p=[].indexOf||function(t){for(var e=0,o=this.length;o>e;e++)if(e in this&&this[e]===t)return e;return-1};a=this.Tether.Utils,s=a.getOuterSize,r=a.getBounds,l=a.getSize,i=a.extend,h=a.updateClasses,o=a.defer,e={left:"right",right:"left",top:"bottom",bottom:"top",middle:"middle"},t=["left","top","right","bottom"],n=function(e,o){var i,n,s,l,h,a,p;if("scrollParent"===o?o=e.scrollParent:"window"===o&&(o=[pageXOffset,pageYOffset,innerWidth+pageXOffset,innerHeight+pageYOffset]),o===document&&(o=o.documentElement),null!=o.nodeType)for(n=l=r(o),h=getComputedStyle(o),o=[n.left,n.top,l.width+n.left,l.height+n.top],i=a=0,p=t.length;p>a;i=++a)s=t[i],s=s[0].toUpperCase()+s.substr(1),"Top"===s||"Left"===s?o[i]+=parseFloat(h["border"+s+"Width"]):o[i]-=parseFloat(h["border"+s+"Width"]);return o},this.Tether.modules.push({position:function(e){var s,l,a,u,c,f,d,g,m,v,b,y,C,w,O,T,E,S,x,A,L,M,H,B,P,W,k,_,N,z,q,D,F,Y,X,j,I,U,R,Z,V,$,G,J,K,Q,te,ee=this;if(W=e.top,b=e.left,L=e.targetAttachment,!this.options.constraints)return!0;for(S=function(e){var o,i,n,r;for(ee.removeClass(e),r=[],i=0,n=t.length;n>i;i++)o=t[i],r.push(ee.removeClass(""+e+"-"+o));return r},Z=this.cache("element-bounds",function(){return r(ee.element)}),v=Z.height,k=Z.width,0===k&&0===v&&null!=this.lastSize&&(V=this.lastSize,k=V.width,v=V.height),H=this.cache("target-bounds",function(){return ee.getTargetBounds()}),M=H.height,B=H.width,A={},m={},l=[this.getClass("pinned"),this.getClass("out-of-bounds")],$=this.options.constraints,_=0,D=$.length;D>_;_++)g=$[_],g.outOfBoundsClass&&l.push(g.outOfBoundsClass),g.pinnedClass&&l.push(g.pinnedClass);for(N=0,F=l.length;F>N;N++)for(d=l[N],G=["left","top","right","bottom"],z=0,Y=G.length;Y>z;z++)x=G[z],l.push(""+d+"-"+x);for(s=[],A=i({},L),m=i({},this.attachment),J=this.options.constraints,q=0,X=J.length;X>q;q++){if(g=J[q],P=g.to,a=g.attachment,O=g.pin,null==a&&(a=""),p.call(a," ")>=0?(K=a.split(" "),f=K[0],c=K[1]):c=f=a,u=n(this,P),("target"===f||"both"===f)&&(W<u[1]&&"top"===A.top&&(W+=M,A.top="bottom"),W+v>u[3]&&"bottom"===A.top&&(W-=M,A.top="top")),"together"===f&&(W<u[1]&&"top"===A.top&&("bottom"===m.top?(W+=M,A.top="bottom",W+=v,m.top="top"):"top"===m.top&&(W+=M,A.top="bottom",W-=v,m.top="bottom")),W+v>u[3]&&"bottom"===A.top&&("top"===m.top?(W-=M,A.top="top",W-=v,m.top="bottom"):"bottom"===m.top&&(W-=M,A.top="top",W+=v,m.top="top")),"middle"===A.top&&(W+v>u[3]&&"top"===m.top?(W-=v,m.top="bottom"):W<u[1]&&"bottom"===m.top&&(W+=v,m.top="top"))),("target"===c||"both"===c)&&(b<u[0]&&"left"===A.left&&(b+=B,A.left="right"),b+k>u[2]&&"right"===A.left&&(b-=B,A.left="left")),"together"===c&&(b<u[0]&&"left"===A.left?"right"===m.left?(b+=B,A.left="right",b+=k,m.left="left"):"left"===m.left&&(b+=B,A.left="right",b-=k,m.left="right"):b+k>u[2]&&"right"===A.left?"left"===m.left?(b-=B,A.left="left",b-=k,m.left="right"):"right"===m.left&&(b-=B,A.left="left",b+=k,m.left="left"):"center"===A.left&&(b+k>u[2]&&"left"===m.left?(b-=k,m.left="right"):b<u[0]&&"right"===m.left&&(b+=k,m.left="left"))),("element"===f||"both"===f)&&(W<u[1]&&"bottom"===m.top&&(W+=v,m.top="top"),W+v>u[3]&&"top"===m.top&&(W-=v,m.top="bottom")),("element"===c||"both"===c)&&(b<u[0]&&"right"===m.left&&(b+=k,m.left="left"),b+k>u[2]&&"left"===m.left&&(b-=k,m.left="right")),"string"==typeof O?O=function(){var t,e,o,i;for(o=O.split(","),i=[],e=0,t=o.length;t>e;e++)w=o[e],i.push(w.trim());return i}():O===!0&&(O=["top","left","right","bottom"]),O||(O=[]),T=[],y=[],W<u[1]&&(p.call(O,"top")>=0?(W=u[1],T.push("top")):y.push("top")),W+v>u[3]&&(p.call(O,"bottom")>=0?(W=u[3]-v,T.push("bottom")):y.push("bottom")),b<u[0]&&(p.call(O,"left")>=0?(b=u[0],T.push("left")):y.push("left")),b+k>u[2]&&(p.call(O,"right")>=0?(b=u[2]-k,T.push("right")):y.push("right")),T.length)for(E=null!=(Q=this.options.pinnedClass)?Q:this.getClass("pinned"),s.push(E),U=0,j=T.length;j>U;U++)x=T[U],s.push(""+E+"-"+x);if(y.length)for(C=null!=(te=this.options.outOfBoundsClass)?te:this.getClass("out-of-bounds"),s.push(C),R=0,I=y.length;I>R;R++)x=y[R],s.push(""+C+"-"+x);(p.call(T,"left")>=0||p.call(T,"right")>=0)&&(m.left=A.left=!1),(p.call(T,"top")>=0||p.call(T,"bottom")>=0)&&(m.top=A.top=!1),(A.top!==L.top||A.left!==L.left||m.top!==this.attachment.top||m.left!==this.attachment.left)&&this.updateAttachClasses(m,A)}return o(function(){return h(ee.target,s,l),h(ee.element,s,l)}),{top:W,left:b}}})}.call(this),function(){var t,e,o,i;i=this.Tether.Utils,e=i.getBounds,o=i.updateClasses,t=i.defer,this.Tether.modules.push({position:function(i){var n,r,s,l,h,a,p,u,c,f,d,g,m,v,b,y,C,w,O,T,E,S,x,A,L,M=this;if(d=i.top,a=i.left,E=this.cache("element-bounds",function(){return e(M.element)}),h=E.height,g=E.width,f=this.getTargetBounds(),l=d+h,p=a+g,n=[],d<=f.bottom&&l>=f.top)for(S=["left","right"],m=0,C=S.length;C>m;m++)u=S[m],((x=f[u])===a||x===p)&&n.push(u);if(a<=f.right&&p>=f.left)for(A=["top","bottom"],v=0,w=A.length;w>v;v++)u=A[v],((L=f[u])===d||L===l)&&n.push(u);for(s=[],r=[],c=["left","top","right","bottom"],s.push(this.getClass("abutted")),b=0,O=c.length;O>b;b++)u=c[b],s.push(""+this.getClass("abutted")+"-"+u);for(n.length&&r.push(this.getClass("abutted")),y=0,T=n.length;T>y;y++)u=n[y],r.push(""+this.getClass("abutted")+"-"+u);return t(function(){return o(M.target,r,s),o(M.element,r,s)}),!0}})}.call(this),function(){this.Tether.modules.push({position:function(t){var e,o,i,n,r,s,l;return s=t.top,e=t.left,this.options.shift?(o=function(t){return"function"==typeof t?t.call(this,{top:s,left:e}):t},i=o(this.options.shift),"string"==typeof i?(i=i.split(" "),i[1]||(i[1]=i[0]),r=i[0],n=i[1],r=parseFloat(r,10),n=parseFloat(n,10)):(l=[i.top,i.left],r=l[0],n=l[1]),s+=r,e+=n,{top:s,left:e}):void 0}})}.call(this),this.Tether}),function(){var t,e,o,i,n,r,s,l,h,a,p,u,c,f,d,g,m,v,b,y,C,w=function(t,e){return function(){return t.apply(e,arguments)}},O={}.hasOwnProperty,T=function(t,e){function o(){this.constructor=t}for(var i in e)O.call(e,i)&&(t[i]=e[i]);return o.prototype=e.prototype,t.prototype=new o,t.__super__=e.prototype,t};C=Tether.Utils,a=C.extend,l=C.addClass,g=C.removeClass,c=C.hasClass,p=C.getBounds,i=C.Evented,e=13,o=27,n=32,s=38,t=40,b="ontouchstart"in document.documentElement,h=b?"touchstart":"click",y=function(){return b&&(640>=innerWidth||640>=innerHeight)},f=function(t){return Array.prototype.reduce.call(t,function(t,e){return t===e?e:!1})},u=function(){var t;return null!=(t=document.querySelector(".select-target-focused"))?t.selectInstance:void 0},m="",v=void 0,d=void 0,document.addEventListener("keypress",function(t){var e,o,i,r;return(i=u())&&0!==t.charCode?(t.keyCode===n&&t.preventDefault(),clearTimeout(v),v=setTimeout(function(){return m=""},500),m+=String.fromCharCode(t.charCode),e=i.findOptionsByPrefix(m),1===e.length?void i.selectOption(e[0]):m.length>1&&f(m)&&(o=i.findOptionsByPrefix(m[0]),o.length)?(r=o.indexOf(i.getChosen()),r+=1,r%=o.length,void i.selectOption(o[r])):void(e.length&&i.selectOption(e[0]))):void 0}),document.addEventListener("keydown",function(i){var r,l,h;if(r=u())if(((l=i.keyCode)===s||l===t||l===o)&&i.preventDefault(),r.isOpen())switch(i.keyCode){case s:case t:return r.moveHighlight(i.keyCode);case e:return r.selectHighlightedOption();case o:return r.close(),r.target.focus()}else if((h=i.keyCode)===s||h===t||h===n)return r.open()}),r=function(t){function e(t){if(this.options=t,this.update=w(this.update,this),this.options=a({},e.defaults,this.options),this.select=this.options.el,null!=this.select.selectInstance)throw new Error("This element has already been turned into a Select");this.setupTarget(),this.renderTarget(),this.setupDrop(),this.renderDrop(),this.setupSelect(),this.setupTether(),this.bindClick(),this.bindMutationEvents(),this.value=this.select.value}return T(e,t),e.defaults={alignToHighlighed:"auto",className:"select-theme-default"},e.prototype.useNative=function(){return this.options.useNative===!0||y()&&this.options.useNative!==!1},e.prototype.setupTarget=function(){var t,e=this;return this.target=document.createElement("a"),this.target.href="javascript:;",l(this.target,"select-target"),t=this.select.getAttribute("tabindex")||0,this.target.setAttribute("tabindex",t),this.options.className&&l(this.target,this.options.className),this.target.selectInstance=this,this.target.addEventListener("click",function(){return e.isOpen()?e.target.blur():e.target.focus()}),this.target.addEventListener("focus",function(){return l(e.target,"select-target-focused")}),this.target.addEventListener("blur",function(t){return e.isOpen()&&t.relatedTarget&&!e.drop.contains(t.relatedTarget)&&e.close(),g(e.target,"select-target-focused")}),this.select.parentNode.insertBefore(this.target,this.select.nextSibling)},e.prototype.setupDrop=function(){var t=this;return this.drop=document.createElement("div"),l(this.drop,"select"),this.options.className&&l(this.drop,this.options.className),document.body.appendChild(this.drop),this.drop.addEventListener("click",function(e){return c(e.target,"select-option")&&t.pickOption(e.target),e.stopPropagation()}),this.drop.addEventListener("mousemove",function(e){return c(e.target,"select-option")?t.highlightOption(e.target):void 0}),this.content=document.createElement("div"),l(this.content,"select-content"),this.drop.appendChild(this.content)},e.prototype.open=function(){var t,e,o=this;return l(this.target,"select-open"),this.useNative()?(this.select.style.display="block",void setTimeout(function(){var t;return t=document.createEvent("MouseEvents"),t.initEvent("mousedown",!0,!0),o.select.dispatchEvent(t)})):(l(this.drop,"select-open"),setTimeout(function(){return o.tether.enable()}),(e=this.drop.querySelector(".select-option-selected"))?(this.highlightOption(e),this.scrollDropContentToOption(e),t=function(){var t,i,n;return c(o.drop,"tether-abutted-left")||c(o.drop,"tether-abutted-bottom")?(t=p(o.drop),n=p(e),i=t.top-(n.top+n.height),o.drop.style.top=(parseFloat(o.drop.style.top)||0)+i+"px"):void 0},("always"===this.options.alignToHighlighted||"auto"===this.options.alignToHighlighted&&this.content.scrollHeight<=this.content.clientHeight)&&setTimeout(t),this.trigger("open")):void 0)},e.prototype.close=function(){return g(this.target,"select-open"),this.useNative()?void(this.select.style.display="none"):(this.tether.disable(),g(this.drop,"select-open"),this.trigger("close"))},e.prototype.toggle=function(){return this.isOpen()?this.close():this.open()},e.prototype.isOpen=function(){return c(this.drop,"select-open")},e.prototype.bindClick=function(){var t=this;return this.target.addEventListener(h,function(e){return e.preventDefault(),t.toggle()}),document.addEventListener(h,function(e){return!t.isOpen()||e.target===t.drop||t.drop.contains(e.target)||e.target===t.target||t.target.contains(e.target)?void 0:t.close()})},e.prototype.setupTether=function(){return this.tether=new Tether(a({element:this.drop,target:this.target,attachment:"top left",targetAttachment:"bottom left",classPrefix:"select",constraints:[{to:"window",attachment:"together"}]},this.options.tetherOptions))},e.prototype.renderTarget=function(){var t,e,o,i;for(this.target.innerHTML="",i=this.select.querySelectorAll("option"),e=0,o=i.length;o>e;e++)if(t=i[e],t.selected){this.target.innerHTML=t.innerHTML;break}return this.target.appendChild(document.createElement("b"))},e.prototype.renderDrop=function(){var t,e,o,i,n,r;for(o=document.createElement("ul"),l(o,"select-options"),r=this.select.querySelectorAll("option"),i=0,n=r.length;n>i;i++)t=r[i],e=document.createElement("li"),l(e,"select-option"),e.setAttribute("data-value",t.value),e.innerHTML=t.innerHTML,t.selected&&l(e,"select-option-selected"),o.appendChild(e);return this.content.innerHTML="",this.content.appendChild(o)},e.prototype.update=function(){return this.renderDrop(),this.renderTarget()},e.prototype.setupSelect=function(){return this.select.selectInstance=this,l(this.select,"select-select"),this.select.addEventListener("change",this.update)},e.prototype.bindMutationEvents=function(){return null!=window.MutationObserver?(this.observer=new MutationObserver(this.update),this.observer.observe(this.select,{childList:!0,attributes:!0,characterData:!0,subtree:!0})):this.select.addEventListener("DOMSubtreeModified",this.update)},e.prototype.findOptionsByPrefix=function(t){var e;return e=this.drop.querySelectorAll(".select-option"),t=t.toLowerCase(),Array.prototype.filter.call(e,function(e){return e.innerHTML.toLowerCase().substr(0,t.length)===t})},e.prototype.findOptionsByValue=function(t){var e;return e=this.drop.querySelectorAll(".select-option"),Array.prototype.filter.call(e,function(e){return e.getAttribute("data-value")===t})},e.prototype.getChosen=function(){return this.drop.querySelector(this.isOpen()?".select-option-highlight":".select-option-selected")},e.prototype.selectOption=function(t){return this.isOpen()?(this.highlightOption(t),this.scrollDropContentToOption(t)):this.pickOption(t,!1)},e.prototype.resetSelection=function(){return this.selectOption(this.drop.querySelector(".select-option"))},e.prototype.highlightOption=function(t){var e;return e=this.drop.querySelector(".select-option-highlight"),null!=e&&g(e,"select-option-highlight"),l(t,"select-option-highlight"),this.trigger("highlight",{option:t})},e.prototype.moveHighlight=function(t){var e,o,i,n;return(e=this.drop.querySelector(".select-option-highlight"))?(n=this.drop.querySelectorAll(".select-option"),o=Array.prototype.indexOf.call(n,e),o>=0&&(t===s?o-=1:o+=1,!(0>o||o>=n.length))?(i=n[o],this.highlightOption(i),this.scrollDropContentToOption(i)):void 0):void this.highlightOption(this.drop.querySelector(".select-option"))},e.prototype.scrollDropContentToOption=function(t){var e,o;return this.content.scrollHeight>this.content.clientHeight?(e=p(this.content),o=p(t),this.content.scrollTop=o.top-(e.top-this.content.scrollTop)):void 0},e.prototype.selectHighlightedOption=function(){return this.pickOption(this.drop.querySelector(".select-option-highlight"))},e.prototype.pickOption=function(t,e){var o=this;return null==e&&(e=!0),this.value=this.select.value=t.getAttribute("data-value"),this.triggerChange(),e?setTimeout(function(){return o.close(),o.target.focus()}):void 0},e.prototype.triggerChange=function(){var t;return t=document.createEvent("HTMLEvents"),t.initEvent("change",!0,!1),this.select.dispatchEvent(t),this.trigger("change",{value:this.select.value})},e.prototype.change=function(t){var e;if(e=this.findOptionsByValue(t),!e.length)throw new Error('Select Error: An option with the value "'+t+"\" doesn't exist");return this.pickOption(e[0],!1)},e}(i),r.init=function(t){var e,o,i,n,s;if(null==t&&(t={}),"loading"===document.readyState)return void document.addEventListener("DOMContentLoaded",function(){return r.init(t)});for(null==t.selector&&(t.selector="select"),n=document.querySelectorAll(t.selector),s=[],o=0,i=n.length;i>o;o++)e=n[o],s.push(e.selectInstance?void 0:new r(a({el:e},t)));return s},window.Select=r}.call(this),Select.init({selector:".my-select"});