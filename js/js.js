var	nav = document.querySelector('nav'),
    logo_img = document.querySelector('.logo.image');

// Navbar modifications on scrolling
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
};

jQuery(document).ready(function($) {

    var i = 0;
    // Speciality selection
    // http://tripmd.com/wp-admin/admin-ajax.php?action=tmd_api&method=procedures_costs&ver=0.1
    var specs = [];
    var procs = [];
    var incosts = [];
    var cacosts = [];
    var links = [];

    $.getJSON("/wp-admin/admin-ajax.php?action=tmd_api&method=procedures_costs&ver=0.1", function(json) {
        $.each(json.specialities, function(spec, val) {
            i++;
            specs.push(spec);
            links.push(this.link);
            $(".spec-select").append("<option value='" + spec + "''>" + this.title + "</option>");

            $.each(this.procedures, function(proc, val) {
                procs.push(proc);
                incosts.push(this.costs.IN);
                cacosts.push(this.costs.US);
                $("select.sub#" + spec).append("<option value='" + proc + "''>" + this.title + "</option>");
            });
        });
    });

    $(".spec-select").change(function(){
        $(".sub + a").css({"visibility":"hidden", "opacity":"0.0", "display": "none"});
        $(".sub#" + this.value + " + a").css({"visibility":"visible", "opacity":"1.0", "display": "block"});
        $("#aff .button#interested").attr("href", links[specs.indexOf(this.value)]);
    });

    $("select.sub").change(function(){
        $(".int").css({"opacity":"1.0"});
        $(".pred").css({"opacity":"1.0"});
        
        var pos = procs.indexOf(this.value);
        var inc = incosts[pos];
        var cac = cacosts[pos];
        var perc = Math.round(((cac - inc)/cac)*100);
        $(".actual").text(number_format(cac));
        $(".perc-saved").text(perc);
    });


  // Royal Slider
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
    loop: true,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: false
  });

  $('#content-slider-1').prepend($('#content-slider-1').find('.rsNav'));

    // Hide timeline blocks which are outside the viewport
    $('.cd-timeline-block').each(function(){
        if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
        }
    });

    // On scolling, show/animate timeline blocks when enter the viewport
    $(window).on('scroll', function(){

        $('.cd-timeline-block').each(function(){
            if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
                $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
            }
        });
    
    });

    var slider = $(".contentSlider").data('royalSlider'),
        leftAr = $(".arrow.left"),
        rightAr = $(".arrow.right");

        
    $(leftAr).click(function() {
        slider.prev();
    });

    $(rightAr).click(function() {
        slider.next();
    });

});

// number_format() (commas etc) for front-page procedure costs
// source http://phpjs.org/functions/number_format/
function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);


}

// Expandable textbox
function expandtext( textArea, min, max ) {
    min = typeof min !== 'undefined' ? min : 1;
    max = typeof max !== 'undefined' ? max : 10;
    while (
        textArea.rows > min &&
        textArea.scrollHeight < textArea.offsetHeight
    ){
        textArea.rows--;
    }
    var h=0;
    while (textArea.rows <= max && textArea.scrollHeight > textArea.offsetHeight && h!==textArea.offsetHeight)
    {
        h=textArea.offsetHeight;
        textArea.rows++;
    }
    if (textArea.rows <= max)
        textArea.rows++
}

var logID = 'log',
  log = $('<div id="'+logID+'"></div>');
$('body').append(log);
  $('[type*="radio"]').change(function () {
    var me = $(this);
    log.html(me.attr('value'));
  });

// Smooth scrolling by some guy
Scroller={speed:10,gy:function(e){var t=e.offsetTop;if(e.offsetParent)while(e==e.offsetParent)t+=e.offsetTop;return t},scrollTop:function(){var e=document.body,t=document.documentElement;return e&&e.scrollTop?e.scrollTop:t&&t.scrollTop?t.scrollTop:window.pageYOffset?window.pageYOffset:0},add:function(e,t,n){if(e.addEventListener)return e.addEventListener(t,n,!1);if(e.attachEvent)return e.attachEvent("on"+t,n)},end:function(e){if(window.event){window.event.cancelBubble=!0,window.event.returnValue=!1;return}e.preventDefault&&e.stopPropagation&&(e.preventDefault(),e.stopPropagation())},scroll:function(e){var t=window.innerHeight||document.documentElement.clientHeight,n=document.body.scrollHeight,r=Scroller.scrollTop();n-e<t&&(e=n-t),e>r?r+=Math.ceil((e-r)/Scroller.speed):r+=(e-r)/Scroller.speed,window.scrollTo(0,r),(r==e||Scroller.previousPos==r)&&clearInterval(Scroller.interval),Scroller.previousPos=r},init:function(){Scroller.add(window,"load",Scroller.render)},render:function(){Scroller.end(this);var e=document.getElementsByTagName("a");for(var t=0;t<e.length;t++){var n=e[t];n.href&&n.href.indexOf("#")!=-1&&n.href.indexOf("#")!=n.href.length-1&&(n.pathname==location.pathname||"/"+n.pathname==location.pathname)&&Scroller.add(n,"click",function(){Scroller.end(this);var t=this.hash.substr(1),n=document.getElementById(t);if(!n)for(var r=0;r<e.length;r++)if(e[r].name==t){n=e[r];break}n&&(clearInterval(Scroller.interval),Scroller.interval=setInterval(function(){Scroller.scroll(Scroller.gy(n))},10))})}}},Scroller.init();