function number_format(e,t,o,n){e=(e+"").replace(/[^0-9+\-Ee.]/g,"");var i=isFinite(+e)?+e:0,a=isFinite(+t)?Math.abs(t):0,r="undefined"==typeof n?",":n,l="undefined"==typeof o?".":o,s="",c=function(e,t){var o=Math.pow(10,t);return""+(Math.round(e*o)/o).toFixed(t)};return s=(a?c(i,a):""+Math.round(i)).split("."),s[0].length>3&&(s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,r)),(s[1]||"").length<a&&(s[1]=s[1]||"",s[1]+=new Array(a-s[1].length+1).join("0")),s.join(l)}function array_values(e){var t=[],o="";if(e&&"object"==typeof e&&e.change_key_case)return e.values();for(o in e)t[t.length]=e[o];return t}function expandtext(e,t,o){for(t="undefined"!=typeof t?t:1,o="undefined"!=typeof o?o:10;e.rows>t&&e.scrollHeight<e.offsetHeight;)e.rows--;for(var n=0;e.rows<=o&&e.scrollHeight>e.offsetHeight&&n!==e.offsetHeight;)n=e.offsetHeight,e.rows++;e.rows<=o&&e.rows++}var nav=document.querySelector("nav"),logo_img=document.querySelector(".logo.image");window.onscroll=function(){if(nav.classList.contains("home")===!0){var e=window.pageYOffset;e>=window.innerHeight/2?(nav.classList.add("topo"),nav.style.position="fixed",logo_img.src="http://tripmd.com/wp-content/themes/tripmd/img/logo-black.png"):nav.classList.remove("topo"),e>=120?(nav.classList.add("sticky"),nav.style.top="-80px"):(logo_img.src="http://tripmd.com/wp-content/themes/tripmd/img/logo-white.png",nav.style.position="absolute",nav.classList.remove("sticky"),nav.style.top="0px")}},jQuery(document).ready(function($){if($("#aff").length>0||$(".costs-table").length>0){var e="/wp-admin/admin-ajax.php?action=tmd_api&method=procedures_costs&ver=0.1",t=0,o=[],n=[],i=[],a="";$.getJSON(e).done(function(e){a=e.current_country,e.countries.hasOwnProperty(a)&&"IN"!=a||(a="US"),$("#aff .country").text(e.countries[a]),$.each(e.specialities,function(e,a){t++,o.push(e),i.push(this.link),$("#aff .spec-select").append("<option value='"+e+"''>"+this.title+"</option>"),$.each(this.procedures,function(t,o){n[t]=o,$("select.sub#"+e).append("<option value='"+t+"''>"+this.title+"</option>")})}),$("#aff .spec-select").change(function(){$("#aff .sub + a").css({visibility:"hidden",opacity:"0.0",display:"none"}),$("#aff .sub#"+this.value+" + a").css({visibility:"visible",opacity:"1.0",display:"block"}),$("#aff .button#interested").attr("href",i[o.indexOf(this.value)])}),$("select.sub").change(function(){if($("#aff").length>0){$(".int").css({opacity:"1.0"}),$(".pred").css({opacity:"1.0"});var t=Math.min.apply(null,array_values(n[this.value].costs)),o=n[this.value].costs[a],i=Math.round((o-t)/o*100);1>i&&(i=0),$("#aff .actual").text(number_format(o)),$("#aff .perc-saved").text(i)}$(".costs-table").length>0&&($(".costs-table").css({webkitFilter:"blur(0)"}),this.value.indexOf("treatment")>-1&&$(".costs-table").css({webkitFilter:"blur(2px)"}),$(".costs-table tr.loc td").remove(),$(".costs-table tr.prices td").remove(),$.each(n[this.value].costs,function(t,o){$(".costs-table tr.loc").append("<td>"+e.countries[t]+"</td>"),$(".costs-table tr.prices").append("<td>"+number_format(o)+"</td>")}))})})}jQuery.rsCSS3Easing.easeOutBack="cubic-bezier(0.175, 0.885, 0.320, 1.275)",$("#slider-with-blocks-1").royalSlider({arrowsNav:!0,arrowsNavAutoHide:!0,fadeinLoadedSlide:!1,controlNavigationSpacing:10,controlNavigation:"bullets",imageScaleMode:"fill",imageAlignCenter:!1,blockLoop:!0,loop:!0,numImagesToPreload:6,transitionType:"fade",keyboardNavEnabled:!0,block:{delay:400},autoScaleSlider:!1,autoHeight:!1,autoPlay:{enabled:!0,pauseOnHover:!1,delay:7e3}}),$("#content-slider-1").royalSlider({autoHeight:!0,arrowsNav:!1,fadeinLoadedSlide:!1,controlNavigationSpacing:0,transitionType:"slide",controlNavigation:"tabs",imageScaleMode:"fill",imageAlignCenter:!1,loop:!0,loopRewind:!0,numImagesToPreload:6,keyboardNavEnabled:!1,usePreloader:!1}),$("#content-slider-1").prepend($("#content-slider-1").find(".rsNav")),$(".cd-timeline-block").each(function(){$(this).offset().top>$(window).scrollTop()+.75*$(window).height()&&$(this).find(".cd-timeline-img, .cd-timeline-content").addClass("is-hidden")}),$(window).on("scroll",function(){$(".cd-timeline-block").each(function(){$(this).offset().top<=$(window).scrollTop()+.75*$(window).height()&&$(this).find(".cd-timeline-img").hasClass("is-hidden")&&$(this).find(".cd-timeline-img, .cd-timeline-content").removeClass("is-hidden").addClass("bounce-in")})});var r=$(".contentSlider").data("royalSlider"),l=$(".arrow.left"),s=$(".arrow.right");$(l).click(function(){r.prev()}),$(s).click(function(){r.next()})});var logID="log",log=jQuery('<div id="'+logID+'"></div>');jQuery("body").append(log),jQuery('[type*="radio"]').change(function(){var e=jQuery(this);log.html(e.attr("value"))}),Scroller={speed:10,gy:function(e){var t=e.offsetTop;if(e.offsetParent)for(;e==e.offsetParent;)t+=e.offsetTop;return t},scrollTop:function(){var e=document.body,t=document.documentElement;return e&&e.scrollTop?e.scrollTop:t&&t.scrollTop?t.scrollTop:window.pageYOffset?window.pageYOffset:0},add:function(e,t,o){return e.addEventListener?e.addEventListener(t,o,!1):e.attachEvent?e.attachEvent("on"+t,o):void 0},end:function(e){return window.event?(window.event.cancelBubble=!0,void(window.event.returnValue=!1)):void(e.preventDefault&&e.stopPropagation&&(e.preventDefault(),e.stopPropagation()))},scroll:function(e){var t=window.innerHeight||document.documentElement.clientHeight,o=document.body.scrollHeight,n=Scroller.scrollTop();t>o-e&&(e=o-t),n+=e>n?Math.ceil((e-n)/Scroller.speed):(e-n)/Scroller.speed,window.scrollTo(0,n),(n==e||Scroller.previousPos==n)&&clearInterval(Scroller.interval),Scroller.previousPos=n},init:function(){Scroller.add(window,"load",Scroller.render)},render:function(){Scroller.end(this);for(var e=document.getElementsByTagName("a"),t=0;t<e.length;t++){var o=e[t];o.href&&-1!=o.href.indexOf("#")&&o.href.indexOf("#")!=o.href.length-1&&(o.pathname==location.pathname||"/"+o.pathname==location.pathname)&&Scroller.add(o,"click",function(){Scroller.end(this);var t=this.hash.substr(1),o=document.getElementById(t);if(!o)for(var n=0;n<e.length;n++)if(e[n].name==t){o=e[n];break}o&&(clearInterval(Scroller.interval),Scroller.interval=setInterval(function(){Scroller.scroll(Scroller.gy(o))},10))})}}},Scroller.init();