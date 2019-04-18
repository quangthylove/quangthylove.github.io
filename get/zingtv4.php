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
		$link .= 'sources: [{file:"http://'.del($v360[1]).'","label":360,"type":"mp4"},';
		$link .= '{file:"http://'.del($v480[1]).'","label":480,"type":"mp4"},';
		$link .= '{file:"http://'.del($v720[1]).'","label":720,"type":"mp4"}],';
	}elseif($v480[1]){
		$link .= 'sources: [{file:"http://'.del($v360[1]).'","label":360,"type":"mp4"},';
		$link .= '{file:"http://'.del($v480[1]).'","label":480,"type":"mp4"},';
		$link .= '{file:"http://'.del($v720[1]).'","label":720,"type":"mp4"}],';
	}else{
		$link .= 'sources: [{file:"http://'.del($v360[1]).'","label":360,"type":"mp4"}],';
	}return $link;
}

$cur_link =  zingtv($url);

$player = '<script type="application/javascript" src="http://content.jwplatform.com/libraries/yDhu382z.js"></script>


    <style>
	    
	    html,body { height:100%; width:100%; padding:0; margin:0; }
	    #mediaplayer{background-image: url("");height:100%;width:100%; padding:0; margin:0;}
	    #mediaplayer_logo{display: none;}
    </style>
<div id="mediaplayer"></div>
	
	
	
	<script>
	    jwplayer("mediaplayer").setup({
		  width: "100%",
		  height: "100%",
		  primary: "HTML5",
		  autostart: true,
		  image: "http://i.imgur.com/1adX1Yl.png",
		  '.$cur_link.'
		  tracks: [{ file: "vuvanhoan.srt", label: "VietNam", kind: "subtitles", "default": true}],
		  skin: {
    name: "vapor",
    active: "#E16933",
    inactive: "#ffffff",
    background: "#333333"
    }
		});
	</script>

	';
	echo $player;
?>