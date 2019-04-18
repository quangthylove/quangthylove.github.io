<?php
$url = isset($_GET['url']) ? $_GET['url'] : '';
function getYouTube($url)
{    
$geturl = NULL;    
$c = curl_init();    
curl_setopt($c, CURLOPT_URL,$url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_FAILONERROR, 1); 
$err = curl_error($c);
$r = curl_exec($c);
curl_close($c);
if(isset($err))
{
$geturl = "Link Warn Video Not Found";    
}else{   
 preg_match_all('#url_encoded_fmt_stream_map=([^&]+)#', $r, $fvars);    
$fvars = explode('&', urldecode($fvars[1][0]));        
$results = array();    
$resultIndex = -1;   
foreach($fvars as $item)    
{       
 if(strpos($item, 'url=') !== false)$resultIndex++;               
 if(!isset($results[$resultIndex]))$results[$resultIndex] = array();       
 if(strpos($item, 'url=') === false)        
{            
$parse = explode('=', $item);            
$results[$resultIndex][$parse[0]] = urldecode($parse[1]);            
continue;        
}                
$parse = preg_match('#url=(.+)$#', $item, $url);        
$results[$resultIndex]['url'] = urldecode($url[1]);    
}
//video/mp4; codecs="avc1.42001E, mp4a.40.2"    
$searchType = "/mp4/i";    
foreach($results as $test)    
{        
if(preg_match($searchType,$test["type"]))        
{            
$geturl = $test["url"];            
echo "Type {$test["type"]} and link file {$test["url"]}";            
break;        
}    
}    
if(empty($geturl))    
{        
$geturl = $results[0]["url"];    
}    
}    
return $geturl;
}
//echo $url;
$player = '<link href="/get/video-js47.css" rel="stylesheet">
		<script src="/get/video.js"></script>
		<script src="/get/dailymotion.js"></script>
		<script src="/get/video-quality-selector.js"></script>
	
	<video  id="playerayer"  class="video-js vjs-default-skin" controls preload="autoplay" width="auto" height="auto" poster="" title="Bạn đang xem video trên Phimhaynhat.org" data-setup="{ 
                                &quot;techOrder&quot;: [&quot;dailymotion&quot;],
                                &quot;src&quot;: &quot;'.$url.'&quot; 
                            }"><track src="/sub.srt" kind="captions" srclang="vi" label="Vietnamese" default>
        </video>
    <br>
	

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