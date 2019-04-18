<?php
define('CURL_ENABLED', true); 
function get_curl($url){
  $ch = curl_init();
  $timeout = 20;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
    }
	
function get_clipvn($id){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/ajax/login');
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => 'phim24online', 'password' => '123456', 'persistent' => 1));
curl_setopt($ch, CURLOPT_URL, 'http://clip.vn/movies/nfo/'.$id);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, array('onsite' => 'clip'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}


$link = isset($_GET['url']) ? $_GET['url'] : '';
error_reporting(E_ERROR | E_PARSE);
function clipvn_direct($link) {	
	$get = file_get_contents($_GET['url']);
	preg_match("/Clip.App.clipId = '(.*)';/U",$get,$id);
	preg_match_all("#<enclosure url='(.*?)' duration='([0-9]+)' id='(.*?)' type='(.*?)' quality='([0-9]+)' (.*?) />#is", get_clipvn($id[1]), $data);

	
if($data[1][1] != ''){
	$js .= '<source src="'.$data[1][1].'" type="video/mp4" data-res="720px"/>';
} elseif($data[1][0] != ''){
	$js .= '<source src="'.$data[1][0].'" type="video/mp4" data-res="720px"/>';
	$js .= '<source src="'.$data[1][0].'" type="video/mp4" data-res="360px"/>';
} else {
	$js .= '<source src="'.$data[1][0].'" type="video/mp4" data-res="360px"/>';
}
return $js;
}	
$cur_link = clipvn_direct($link);

echo "
<link href='/get/video-js47.css' rel='stylesheet'>
		<script src='/get/video.js'></script>
		<script src='/get/admin.js'></script>
		<script src='/get/video-quality-selector.js'></script>

	
	<video id='playerayer' class='video-js vjs-default-skin' controls autoplay width='100%' height='100%' poster=''title='Bạn đang xem video trên Phimhaynhat.org' data-setup='{}'>'.$cur_link.'
      <track src='/sub.srt' kind='captions' srclang='vi' label='Vietnamese' default>
        <p class='vjs-no-js'>To view this video please enable JavaScript, and consider upgrading to a web browser that <a href='http://videojs.com/html5-video-support/' target='_blank'>supports HTML5 video</a>
        </p>
    </video>
    <br>

    <script type='text/javascript'>
        videojs('#playerayer', {
            plugins: {
                resolutionSelector: {
                    default_res: '360px'
                }
            }
        }, function() {
            var player = this;
            player.on('changeRes', function() {
                console.log('Current Res is: ' + player.getCurrentRes());
            });
        });

        videojs('playerayer').watermark({
            file: 'xem-phim-hd-logo.png',
            opacity: 1
        });
		

    </script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66475503-1', 'auto');
  ga('send', 'pageview');

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

";
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