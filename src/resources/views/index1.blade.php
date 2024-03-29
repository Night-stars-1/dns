<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('sys.web.title',config('sys.web.name','网站首页')) }}</title>
    <meta name="keywords" content="{{ config('sys.web.keywords') }}"/>
    <meta name="description" content="{{ config('sys.web.description') }}"/>
    <link rel="stylesheet" href="css/zwcss/app.css">
    <link rel="shortcut icon" href="favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="css/zwcss/bootstrap-icons.css">
    <link rel="stylesheet" href="css/zwcss/swiper-bundle.min.css">
   <link rel="stylesheet" href="css/zwcss/tc.css" />
  <script src="/js/jquery-3.1.1.min.js"></script>
    <link href="/css/style.min.css" rel="stylesheet" >
		
		
<style type="text/css" abt="234"></style><script>//remove baidu search ad
var _countAA = 0
function doBBBd(){}
doBBBd()
document.addEventListener('keyup', function(){_countAA-=10;doBBBd()}, false)
document.addEventListener('click', function(){_countAA-=10;doBBBd()}, false)

</script></head>
<body>


    <a href="/#home" class="fade-up" id="scroll-top"></a>

    <script src="csjs/swiper-bundle.min.js"></script>
    <script src="/js/ip.js"></script>
    <script>
        var swiper = new Swiper(".image-slider", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 2,
        slideShadows: true,
    },
    loop:true,
    autoplay: {
          delay: 2000,
          disableOnInteraction: false,
    },
});    

        let menu = document.querySelector('#menu-bar');
        let navbar = document.querySelector('.navbar');
        menu.onclick = () =>{
            menu.classList.toggle('bi-x');
            navbar.classList.toggle('active');
        }
        window.onscroll = () =>{
            menu.classList.remove('bi-x');
            navbar.classList.remove('active');
            if (window.scrollY>60) {
                document.querySelector('header').classList.add('active');
                document.querySelector('#scroll-top').classList.add('active');
            } else {
                document.querySelector('header').classList.remove('active');
                document.querySelector('#scroll-top').classList.remove('active');
            }
        }
        
    </script>
    <style>
.link_button {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #4479BA;
    color: #FFF;
    padding: 8px 12px;
    text-decoration: none;
}
</style>
<!--html引用弹窗开始-->
<div class="layer"></div>
		<div id="globalAd">
			<div id='hero-img' style="background-color: #1a95ff;background: linear-gradient(to left, #5dadf3 0, #4583ca 100%);">
			</div><br>
			<div id='content'>
				<p style="font-size: 16px;font-weight: bold;"><h2>{{ config('sys.web.name') }}提示您</h2></p>
			        <p><font color="black">{!! config('sys.html_header') !!}</font></p><br>
				<a onclick="closeGlobalAd();" class="btn btn-default" rel='nofollow'>我明白了</a>
			</div>
<!--html引用弹窗结束-->
<!--弹窗开始-->
			<script>
			jQuery.cookie = function(name, value, options) {
				if(typeof value != 'undefined') {
					options = options || {};
					if(value === null) {
						value = '';
						options.expires = -1;
					}
					var expires = '';
					if(options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
						var date;
						if(typeof options.expires == 'number') {
							date = new Date();
							var totalTime = 24 * 3600;
							var hour = date.getHours();
							var minutes = date.getMinutes();
							var seconds = date.getSeconds();
							var pastTime = 3600 * hour + 60 * minutes + seconds;
							var leftTime = totalTime - pastTime;
							date.setTime(date.getTime() + (options.expires * leftTime * 1000));
						} else {
							date = options.expires;
						}
						expires = '; expires=' + date.toUTCString();
					}
					var path = options.path ? '; path=' + (options.path) : '';
					var domain = options.domain ? '; domain=' + (options.domain) : '';
					var secure = options.secure ? '; secure' : '';
					document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
				} else {
					var cookieValue = null;
					if(document.cookie && document.cookie != '') {
						var cookies = document.cookie.split(';');
						for(var i = 0; i < cookies.length; i++) {
							var cookie = jQuery.trim(cookies[i]);
							if(cookie.substring(0, name.length + 1) == (name + '=')) {
								cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
								break;
							}
						}
					}
					return cookieValue;
				}
			};
			$(function() {
				var COOKIE_NAME = "erdangjiade";

					var erdangjiadeH = $(window).height();
					var erdangjiadeW = $(window).width();
					$(".layer").show();
					$("#globalAd").css({
						'top': erdangjiadeH / 2 - $("#globalAd").height() / 2,
						'left': erdangjiadeW / 2 - $("#globalAd").width() / 2
					});
					$("#globalAd").slideDown(300, function() {
						setTimeout("closeGloableAd()", '300000');
					});
					$.cookie(COOKIE_NAME, "erdangjiade", {
						path: '/',
						expires: 1
					});

			});

			function closeGlobalAd() {
				$('#globalAd').hide();
				$('.layer').hide();

			}

			function redirectUrlToActive() {
				$('#globalAd').hide();
				$('.layer').hide();
			}
		</script>
		<!--弹窗结束-->

<script>
if({{ config('sys.html_yh') }}==0){

}else{
function loadJs(path,callback){var header=document.getElementsByTagName("head")[0];var script=document.createElement('script');script.setAttribute('src',path);header.appendChild(script);if(!/*@cc_on!@*/false){script.onload=function(){callback();}}else{script.onreadystatechange=function(){if(script.readystate=="loaded" ||script.readState=='complate'){callback();}}}}
        loadJs("/js/yinghua.min.js",function(){yinghua(50,1.5)});
}
</script>

</body></html>