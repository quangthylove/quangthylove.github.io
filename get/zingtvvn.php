<?php

$url = isset($_GET['url']) ? $_GET['url'] : '';
error_reporting(E_ERROR | E_PARSE);
function del($url){
	$data = explode("?format", $url);
	return $data[0];
}


function zingtv($url) {	
	preg_match('/http:\/\/tv.zing.vn\/video\/(.*)\/(.*).html/U', $url, $id);
	$data = 'http://api.tv.zing.vn/2.0/media/info?api_key=d04210a70026ad9323076716781c223f&media_id='.$id[2];
	$dataapi = file_get_contents('compress.zlib://'.$data);
	preg_match('/"file_url": "(.*)",/U', $dataapi, $v360);
	preg_match('/"Video480": "(.*)"/U', $dataapi, $v480);
	preg_match('/"Video720": "(.*)"/U', $dataapi, $v720);
	if($v720[1]){
		$link .= '<source src="http://'.del($v360[1]).'" type="video/mp4" data-res="360p"/>';
		$link .= '<source src="http://'.del($v480[1]).'" type="video/mp4" data-res="480p"/>';
		$link .= '<source src="http://'.del($v720[1]).'" type="video/mp4" data-res="720p"/>';
	}elseif($v480[1]){
		$link .= '<source src="http://'.del($v360[1]).'" type="video/mp4" data-res="360p"/>';
		$link .= '<source src="http://'.del($v480[1]).'" type="video/mp4" data-res="480p"/>';
		$link .= '<source src="http://'.del($v720[1]).'" type="video/mp4" data-res="720p"/>';
	}else{
		$link .= '<source src="http://'.del($v360[1]).'" type="video/mp4" data-res="360p"/>';
	}return $link;
}

$cur_link =  zingtv($url);

$player = '<link href="/get/video-js47.css" rel="stylesheet">
		<script src="/get/video.js"></script>
		<script src="/get/video-quality-selector.js"></script>
	
	<video id="playerayer" class="video-js vjs-default-skin" controls autoplay width="100%" height="100%" poster="" title="Bạn đang xem video trên Phimhaynhat.org" data-setup="{}">'.$cur_link.'
      <track src="/sub.srt" kind="captions" srclang="vi" label="Vietnamese" default>
        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>
    </video>
    <br>

    <script type="text/javascript">
        videojs("#playerayer", {
            plugins: {
                resolutionSelector: {
                    default_res: "480p"
                }
            }
        }, function() {
            var player = this;
            player.on("changeRes", function() {
                console.log("Current Res is: " + player.getCurrentRes());
            });
        });

        videojs("playerayer").watermark({
            file: "xem-phim-hd-logo.png",
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