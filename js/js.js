// JS

var mockup = document.querySelectorAll('.mockup')[0],
	quote = document.querySelectorAll('.quote')[0];

window.onscroll = function() {

	if(window.innerHeight <= 960 && window.innerHeight >= 600) {
	
		mockup.style.marginTop = -window.pageYOffset / 3 + "px";
	
	}

	//quote.style.backgroundPosition = "0 " + 350 + window.pageYOffset / 12 + "px";

}

// Smooth scrolling by some guy
Scroller={speed:10,gy:function(e){var t=e.offsetTop;if(e.offsetParent)while(e==e.offsetParent)t+=e.offsetTop;return t},scrollTop:function(){var e=document.body,t=document.documentElement;return e&&e.scrollTop?e.scrollTop:t&&t.scrollTop?t.scrollTop:window.pageYOffset?window.pageYOffset:0},add:function(e,t,n){if(e.addEventListener)return e.addEventListener(t,n,!1);if(e.attachEvent)return e.attachEvent("on"+t,n)},end:function(e){if(window.event){window.event.cancelBubble=!0,window.event.returnValue=!1;return}e.preventDefault&&e.stopPropagation&&(e.preventDefault(),e.stopPropagation())},scroll:function(e){var t=window.innerHeight||document.documentElement.clientHeight,n=document.body.scrollHeight,r=Scroller.scrollTop();n-e<t&&(e=n-t),e>r?r+=Math.ceil((e-r)/Scroller.speed):r+=(e-r)/Scroller.speed,window.scrollTo(0,r),(r==e||Scroller.previousPos==r)&&clearInterval(Scroller.interval),Scroller.previousPos=r},init:function(){Scroller.add(window,"load",Scroller.render)},render:function(){Scroller.end(this);var e=document.getElementsByTagName("a");for(var t=0;t<e.length;t++){var n=e[t];n.href&&n.href.indexOf("#")!=-1&&n.href.indexOf("#")!=n.href.length-1&&(n.pathname==location.pathname||"/"+n.pathname==location.pathname)&&Scroller.add(n,"click",function(){Scroller.end(this);var t=this.hash.substr(1),n=document.getElementById(t);if(!n)for(var r=0;r<e.length;r++)if(e[r].name==t){n=e[r];break}n&&(clearInterval(Scroller.interval),Scroller.interval=setInterval(function(){Scroller.scroll(Scroller.gy(n))},10))})}}},Scroller.init();