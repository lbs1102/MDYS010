var time = 0;
var _CK_ = null;
var bOpen = 0;
var bObj = null;
var msgcache = {}
var player;
function BrowserType() {
	var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串 
	var isOpera = userAgent.indexOf("Opera") > -1; //判断是否Opera浏览器 
	// var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera; //判断是否IE浏览器 
	var isIE = window.ActiveXObject || "ActiveXObject" in window
	// var isEdge = userAgent.indexOf("Windows NT 6.1; Trident/7.0;") > -1 && !isIE; //判断是否IE的Edge浏览器 
	var isEdge = userAgent.indexOf("Edge") > -1; //判断是否IE的Edge浏览器
	var isFF = userAgent.indexOf("Firefox") > -1; //判断是否Firefox浏览器 
	var isSafari = userAgent.indexOf("Safari") > -1 && userAgent.indexOf("Chrome") == -1; //判断是否Safari浏览器 
	var isChrome = userAgent.indexOf("Chrome") > -1 && userAgent.indexOf("Safari") > -1 && !isEdge; //判断Chrome浏览器 

	if (isIE) {
		var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
		reIE.test(userAgent);
		var fIEVersion = parseFloat(RegExp["$1"]);
		if (userAgent.indexOf('MSIE 6.0') != -1) {
			return "IE6";
		} else if (fIEVersion == 7) { return "IE7"; }
		else if (fIEVersion == 8) { return "IE8"; }
		else if (fIEVersion == 9) { return "IE9"; }
		else if (fIEVersion == 10) { return "IE10"; }
		else if (userAgent.toLowerCase().match(/rv:([\d.]+)\) like gecko/)) {
			return "IE11";
		}
		else { return "0" }//IE版本过低
	}//isIE end 
	if (isFF) { return "FF"; }
	if (isOpera) { return "Opera"; }
	if (isSafari) { return "Safari"; }
	if (isChrome) { return "Chrome"; }
	if (isEdge) { return "Edge"; }
}//myBrowser() end 
function SetCookie(name, value) {
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
function getCookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (arr != null) return unescape(arr[2]); return null;
}
window.onerror = function () {
	return true;
}
function init() {
	var cookieTime = getCookie(videoid + "_time"); //调用已记录的time
	//alert("上次播放时间"+ cookieTime +"");
	if (!cookieTime || cookieTime == undefined) { //如果没有记录值，则设置时间0开始播放
		cookieTime = 0;
	}		
	
	if (playertype == 'ckplayer')
		ckplay(main, xml, videoid,pic, cookieTime);
	else
		dplay(main, videoid, cookieTime);
	
}
function timeHandler(t) {
	if (t > -1)
		SetCookie(videoid + "_time", t);
}
function loadHandler() {
	player.addListener('time', timeHandler); //监听播放时间
}

//ckplayer
function ckplay(main, xml, videoid, pic, starttime) {
	
	var hostname = window.location.hostname
	
	var port = window.location.port || '80';
	var picurl = window.location.protocol + "//" + window.location.host + pic;
	
	var url = main;	
	
	xml = window.location.protocol + "//" + window.location.host + xml
	var videoObject = null;
	var isiPad = navigator.userAgent.match(/iPhone|Linux|Android|iPad|iPod|ios|iOS|Windows Phone|Phone|WebOS/i) != null;
	
	if (isiPad) {
		document.getElementById('mvideo').innerHTML = '<video src="' + url + '" poster="' + picurl + '" controls="controls" webkit-playsinline="true" style="width: 100%; height: 100%; background-color: rgb(0, 0, 0);" width="100%" height="100%"></video>'
	}else
	{
		//ck参数
		var l = ''
		var r = ''
		var t = ''
		var d = ''
		var u = ''
		videoObject = {
			container: '.video',
			variable: 'player',
			loaded: 'loadHandler',
			autoplay: true,
			poster: picurl,
			adfront: l, //前置广告
			adfronttime: t,
			adfrontlink: r,
			adpause: d,//暂停广告
			adpausetime: t,
			adpauselink: u,
			video: url
		};
	}

	
	

	if (starttime > 0) {
		videoObject['seek'] = starttime;
	}
	
	player = new ckplayer(videoObject);


}

//获得多码率列表
function getPlayList(url, cb) {
	
	$.get(url, function (result) {
		cb(null, result);
	})
}

//dplayer
function dplay(main, videoid,  starttime) {
	
    var newurl = main + "?skipl=1";
	if(main.indexOf("?")>0)
		newurl = main + "&skipl=1"
	getPlayList(newurl, function (err, result) {		
		var url = main	
		var playcfg = {
			container: document.getElementById('mvideo'),
			screenshot: true,
			pic: pic,
			video: {
				url: url,
				type: "hls"
			}
		};
		
		
		//多码率
		if (result) {
			var labels = ["标清","高清","超清","蓝光"]
			var parser = new m3u8Parser.Parser();
			parser.push(result);
			parser.end();
			var qualitys = [];
			var playlist = parser.manifest.playlists;
			if (playlist && playlist.length > 1) {
				// console.log(playlist)
				for (var i = 0; i < playlist.length; i++) {
					qualitys.push({
						name: labels[i],
						url:  hosts+playlist[i].uri,
						type: 'hls'
					})
				}
				playcfg.video.quality = qualitys
				delete playcfg.video.url;
				playcfg.video.defaultQuality = 0;
				// console.log(playcfg)
			}
		}
		
		
		
		player = new DPlayer(playcfg);
		
		player.on('timeupdate', function () {

			var t = player.video.currentTime;
			if (t > 0)
				SetCookie(videoid + "_time", t);
		})
		
		if (starttime > 0)
			player.seek(starttime)
		
		
		player.play();
	})

}