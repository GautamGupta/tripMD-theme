var	nav = document.querySelector('nav'),
    logo_img = document.querySelector('.logo.image');


jQuery(document).ready(function($) {
  jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
  $('#slider-with-blocks-1').royalSlider({
	arrowsNav: true,
	arrowsNavAutoHide: true,
	fadeinLoadedSlide: false,
	controlNavigationSpacing: 10,
	controlNavigation: 'bullets',
	imageScaleMode: 'fill',
	imageAlignCenter:false,
	blockLoop: true,
	loop: true,
	numImagesToPreload: 6,
	transitionType: 'fade',
	keyboardNavEnabled: true,
	block: {
		delay: 400
	},
	autoScaleSlider:false,
	autoHeight: false,   	
	autoPlay: {
    		// autoplay options go gere
    		enabled: true,
    		pauseOnHover: false,
    		delay: 7000
   }
  });
 
  $('#content-slider-1').royalSlider({
    autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
	transitionType: 'fade',
    controlNavigation: 'tabs',
    imageScaleMode: 'fill',
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: false
  });

  $('#content-slider-1').prepend($('#content-slider-1').find('.rsNav'));

});

window.onscroll = function() {

    if (nav.classList.contains('home') === true) {

        var scroll = window.pageYOffset;

        // Sticky Flag
        if (scroll >= (window.innerHeight/2)) {
            nav.classList.add('topo');
            nav.style.position = "fixed";
            logo_img.src = "http://tripmd.com/wp-content/themes/tripmd/img/logo-black.png";
        } else {
            nav.classList.remove('topo');
        }

        // To move it to -100px
        if (scroll >= (120)) {
            nav.classList.add('sticky');
            nav.style.top = "-80px";
        } else {
            logo_img.src = "http://tripmd.com/wp-content/themes/tripmd/img/logo-white.png";
            nav.style.position = "absolute";
            nav.classList.remove('sticky');
            nav.style.top = "0px";
        }

    }

}

// Smooth scrolling by some guy
Scroller={speed:10,gy:function(e){var t=e.offsetTop;if(e.offsetParent)while(e==e.offsetParent)t+=e.offsetTop;return t},scrollTop:function(){var e=document.body,t=document.documentElement;return e&&e.scrollTop?e.scrollTop:t&&t.scrollTop?t.scrollTop:window.pageYOffset?window.pageYOffset:0},add:function(e,t,n){if(e.addEventListener)return e.addEventListener(t,n,!1);if(e.attachEvent)return e.attachEvent("on"+t,n)},end:function(e){if(window.event){window.event.cancelBubble=!0,window.event.returnValue=!1;return}e.preventDefault&&e.stopPropagation&&(e.preventDefault(),e.stopPropagation())},scroll:function(e){var t=window.innerHeight||document.documentElement.clientHeight,n=document.body.scrollHeight,r=Scroller.scrollTop();n-e<t&&(e=n-t),e>r?r+=Math.ceil((e-r)/Scroller.speed):r+=(e-r)/Scroller.speed,window.scrollTo(0,r),(r==e||Scroller.previousPos==r)&&clearInterval(Scroller.interval),Scroller.previousPos=r},init:function(){Scroller.add(window,"load",Scroller.render)},render:function(){Scroller.end(this);var e=document.getElementsByTagName("a");for(var t=0;t<e.length;t++){var n=e[t];n.href&&n.href.indexOf("#")!=-1&&n.href.indexOf("#")!=n.href.length-1&&(n.pathname==location.pathname||"/"+n.pathname==location.pathname)&&Scroller.add(n,"click",function(){Scroller.end(this);var t=this.hash.substr(1),n=document.getElementById(t);if(!n)for(var r=0;r<e.length;r++)if(e[r].name==t){n=e[r];break}n&&(clearInterval(Scroller.interval),Scroller.interval=setInterval(function(){Scroller.scroll(Scroller.gy(n))},10))})}}},Scroller.init();