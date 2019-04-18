<?php
function xvideos($curURL){
if ($curURL =="") { return "ERROR";}    
$curTemp= curls($curURL);
    $curTemp=cut_strs($curTemp,'mobileReplacePlayerDivTwoQual', '</script>');        
	if ($curTemp =="") { return "ERROR";}    
	$cur1080p='';    
	$cur720p='';    
	$cur480p='';    
	$cur360p='';
    $curList = explode(',',$curTemp);
        foreach ($curList as $curl) {            
		$curl = trim(cut_strs($curl,"'" , "'"));            
		$curl=urldecode($curl);             
		if ($curl <> "" ){                  
		if (strpos($curl,'mp4') !== false) {$cur720p=$curl;}  
        }        
	}        
		
		if ($cur720p <>"") 
	{          
$js .= '<source src="'.$cur720p.'" type="video/mp4" />';     
  } else{        
  return "ERROR";    
  }  
return $js;  
  }

function cut_strs($str, $left, $right)    
{        
$str = substr(stristr($str, $left) , strlen($left));        
$leftLen = strlen(stristr($str, $right));        
$leftLen = $leftLen ? -($leftLen) : strlen($str);        
$str = substr($str, 0, $leftLen);        
return $str;    
}
function curls($url)    
{    
$context = stream_context_create(array(  
'http'=>array(    
'method'=>"GET",                    
'header'=>"Accept: text/html,application/xhtml+xml,application/xml\r\n" .              
"Accept-Charset: ISO-8859-1,utf-8\r\n" .              
"Accept-Encoding: gzip,deflate,sdch\r\n" .              
"Accept-Language: en-US,en;q=0.8\r\n",    
'user_agent'=>"User-Agent: Mozilla/5.0 (Linux; U; Android 2.3; en-us; SAMSUNG-SGH-I717 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1\r\n"               
))); 
$html = file_get_contents($url, false, $context);return $html;    
}
$url = $_GET['url'];

$player = '<link href="/get/video-js47.css" rel="stylesheet">
		<script src="/get/video.js"></script>
		<script src="/get/admin.js"></script>
		<script src="/get/video-quality-selector.js"></script>
	
	<video id="playerayer" class="video-js vjs-default-skin" controls autoplay width="100%" height="100%" poster="" title="Bạn đang xem video trên Phimhaynhat.org" data-setup="{}">'.xvideos($url).'
      <track src="/sub.srt" kind="captions" srclang="vi" label="Vietnamese" default>
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>
    </video>
    <br>

    <script type="text/javascript">
        videojs("#playerayer", {
            plugins: {
                resolutionSelector: {
                    default_res: "360px"
                }
            }
        }, function() {
            var player = this;
            player.on("changeRes", function() {
                console.log("Current Res is: " + player.getCurrentRes());
            });
        });

        videojs("playerayer").watermark({
            file: "http://3.bp.blogspot.com/-hXlN9GCvbos/Vekv5Og_QnI/AAAAAAAACxs/Ul_sPtkLm-s/s1600/xem-phim-hd-logo.png",
            opacity: 1
        });
		

    </script>
	<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

  ga("create", "UA-66475503-1", "auto");
  ga("send", "pageview");

</script>
	<style>
    body{height:100%;margin:0;overflow:hidden;position:absolute;width:100%}
video,#playerayer{min-height:100%;min-width:100%;position:absolute}
.video-js .vjs-menu-button ul li.vjs-selected{background-color:#c93737;color:ffffff}
 .vjs-default-skin { color:#ffffff; }
  .vjs-default-skin .vjs-play-progress,
  .vjs-default-skin .vjs-volume-level { background-color: #46e1ff }
.vjs-default-skin .vjs-volume-level{position:absolute;top:0;left:0;height:.5em;width:100%;background:#c93737 url(/get/3-hieu-ung-text-bang-co1.jpg) -50% 0 repeat}.vjs-default-skin .vjs-play-progress{background:#c93737 url(/get/3-hieu-ung-text-bang-co1.jpg) -50% 0 repeat}

</style>
	';
	echo $player;
?>
	<link rel="stylesheet" href="/phim/src/videojs.logobrand.css">
	<script src="/phim/src/videojs.logobrand.js"></script>
		<script>
			// save a reference to the video element
			video = document.querySelector('video'),
			// save a reference to the video.js player for that element
			player = videojs(video);
			// initialize the plugin with some custom options:
			player.logobrand({
				//height: "32px",
				//width: "32px",
				image: "/get/logo01.png",
				destination: "http://www.phimhaynhat.org/"
			});
			//player.logobrand().loadImage("/mages/youtube.png");
			//player.logobrand().setDestination("/images/youtube.png");
			document.getElementById("example").onclick = function(){
				player.logobrand().loadImage("/get/3-hieu-ung-text-bang-co.jpg");
				player.logobrand().setDestination("http://www.phimhaynhat.org/");
				this.innerHTML = "Image+destination changed!";
			};
		</script>