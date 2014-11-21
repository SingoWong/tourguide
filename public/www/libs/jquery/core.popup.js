/**
  * 弹出框函数：弹出一个窗口，浮动在页面上方
	
  *	参数说明：
  *	url(string):弹出框所包含的网页的url
  *	width(string):弹出框的宽度，接受两种类型的参数：auto（默认宽度为920px居中），pixel（具体的宽度值，不含'px'字符）
  *	height(string):弹出框的高度，接受两种类型的参数：auto（高度自适应，与浏览器窗口上下沿分别相隔20px），pixel（具体的高度值，不含'px'字符）
  * outsideClose(boolean):点击弹出框以外的区域，是否把弹出框关闭，默认false
  * opacity(number):遮蔽层的透明度，0为全透明，1为不透明，默认为0.8
*/
function openWindow(url,width,height,outsideClose,opacity){
	
	//判断窗口高度是否超过屏幕高度
	if ($(window).height() < height) {
		height = $(window).height() - 20;
	}
	
	//定义遮蔽层默认透明度
	opacity=opacity==undefined?0.8:opacity;
	
	//增加遮蔽层（需要用到样式#cover）
	$('body').append($("<div id='cover'></div>"));
	//设置遮蔽层高度（内容区域的高度，而不是可视区域的高度）
	$('#cover').height($(document).height() + 800);
	//添加遮蔽层点击事件
	if(outsideClose) $('#cover').click(function(){closeWindow()});
	
	//添加弹出框
	$("body").append($("<div id='examWindow'></div>"));
	
	//设置弹出框样式
	if(width=='' || width=='auto') width='920';                             //定义默认宽度
	if(height=='' || height=='auto') height=$(window).height()-40;          //定义默认高度
	//设置宽高度
	$('#examWindow').css('width',width);   
	$('#examWindow').css('height',height);   
	//左右居中弹出框
	$('#examWindow').css('margin-left','-'+width/2+'px');
	//$('#examWindow').css('margin-top','-'+height/2+'px');
	
	//定位弹出框
	var window_top=$(document).scrollTop() + ($(window).height() - height) / 2;
	$('#examWindow').css('top',window_top+'px');
	
	//添加关闭按钮
	$('#examWindow').append($("<a id='closeButton'>关闭</a>"));
	//添加关闭事件
	$('#closeButton').click(function(){closeWindow()});
	//检测浏览器版本
	var version;                  
	var ua = navigator.userAgent; //获取用户端信息
	var b = ua.indexOf("MSIE "); //检测特殊字符串"MSIE "的位置
	if (b < 0) version=0;
	else  version=parseFloat(ua.substring(b + 5, ua.indexOf(";", b))); //截取版本号字符串，并转换为数值
	//实现关闭按钮在ie6下png透明
	if(version==6){
		DD_belatedPNG.fix('a#closeButton');
	}
		
	//内嵌网页
	$('#examWindow').append($("<iframe src='"+url+"' frameborder='0' width='100%' height='100%'></iframe>"));
	//添加阴影层
	$("body").append($("<div class='shadow'></div>"));
	//设置阴影层样式
	var shadowWidth=$('#examWindow').width()+2;
	var shadowHeight=$('#examWindow').height()+2;
	$('.shadow').css({'width':shadowWidth+'px','height':shadowHeight+'px','margin-left':'-'+shadowWidth/2+'px'});
	//定位阴影层
	var shadow_top=window_top-1;
	$('.shadow').css('top',shadow_top+'px');

	//显示遮蔽层
	$('#cover').css('opacity',opacity).fadeIn('normal');
	//显示阴影层
	$('.shadow').fadeIn('normal');
	//显示弹出框
	$('#examWindow').fadeIn('normal');
	
	//若没有指定高度，则浏览器窗口大小变化时，自动调整弹出框和阴影层的高度
	if(height=='' || height=='auto'){
		$(window).resize(function(){
			$('#examWindow').css('height',$(window).height()-40+'px');
			$('.shadow').css('height',$('#examWindow').height()+2+'px');
		});
	}
	
	//限制屏幕滚动
	if ($.browser.msie) {
		document.documentElement.style.overflow = "hidden";
	} else {
		document.body.style.overflow="hidden";
	}
	
	return false;
}

/**
 * 弹出静态框
 * @param elem 框内的DOM所复制的容器内容
 * @param width 宽度
 * @param height 高度
 * @param outsideClose 点击弹出框以外的区域，是否把弹出框关闭，默认false
 * @param closeUI 是否有关闭按钮
 * @param opacity 遮蔽层的透明度，0为全透明，1为不透明，默认为0.8
 */
function openPanel(elem, width, height, outsideClose, closeUI, opacity) {
	var t = new Date();
	
	//判断窗口高度是否超过屏幕高度
	if ($(window).height() < height) {
		height = $(window).height() - 20;
	}
	
	//是否需要关闭按钮
	closeUI=closeUI==undefined?true:closeUI;
	
	//定义遮蔽层默认透明度
	opacity=opacity==undefined?0.8:opacity;
	
	//增加遮蔽层（需要用到样式#cover）
	$('body').append($("<div id='cover'></div>"));
	//设置遮蔽层高度（内容区域的高度，而不是可视区域的高度）
	$('#cover').height($(document).height() + 800);
	//添加遮蔽层点击事件
	if(outsideClose) $('#cover').click(function(){closeWindow()});
	
	//添加弹出框
	$("body").append($("<div id='examWindow'></div>"));
	
	//设置弹出框样式
	if(width=='' || width=='auto') width='920';                             //定义默认宽度
	if(height=='' || height=='auto') height=$(window).height()-40;          //定义默认高度
	//设置宽高度
	$('#examWindow').css('width',width);   
	$('#examWindow').css('height',height);   
	//左右居中弹出框
	$('#examWindow').css('margin-left','-'+width/2+'px');
	//$('#examWindow').css('margin-top','-'+height/2+'px');
	
	//定位弹出框
	var window_top=$(document).scrollTop() + ($(window).height() - height) / 2;
	$('#examWindow').css('top',window_top+'px');
	
	//添加关闭按钮
	if (closeUI) {
		$('#examWindow').append($("<a id='closeButton'>关闭</a>"));
	
		//添加关闭事件
		$('#closeButton').click(function(){closeWindow()});
	}
	//检测浏览器版本
	var version;                  
	var ua = navigator.userAgent; //获取用户端信息
	var b = ua.indexOf("MSIE "); //检测特殊字符串"MSIE "的位置
	if (b < 0) version=0;
	else  version=parseFloat(ua.substring(b + 5, ua.indexOf(";", b))); //截取版本号字符串，并转换为数值
	//实现关闭按钮在ie6下png透明
	if(version==6){
		DD_belatedPNG.fix('a#closeButton');
	}
		
	//内嵌网页
	//$('#examWindow').append($("<iframe src='"+url+"' frameborder='0' width='100%' height='100%'></iframe>"));
	var html = $("#"+elem).html();
	$('#examWindow').append(html);
	
	//添加阴影层
	$("body").append($("<div class='shadow'></div>"));
	//设置阴影层样式
	var shadowWidth=$('#examWindow').width()+2;
	var shadowHeight=$('#examWindow').height()+2;
	$('.shadow').css({'width':shadowWidth+'px','height':shadowHeight+'px','margin-left':'-'+shadowWidth/2+'px'});
	//定位阴影层
	var shadow_top=window_top-1;
	$('.shadow').css('top',shadow_top+'px');

	//显示遮蔽层
	$('#cover').css('opacity',opacity).fadeIn('normal');
	//显示阴影层
	$('.shadow').fadeIn('normal');
	//显示弹出框
	$('#examWindow').fadeIn('normal');
	
	//若没有指定高度，则浏览器窗口大小变化时，自动调整弹出框和阴影层的高度
	if(height=='' || height=='auto'){
		$(window).resize(function(){
			$('#examWindow').css('height',$(window).height()-40+'px');
			$('.shadow').css('height',$('#examWindow').height()+2+'px');
		});
	}
	
	//限制屏幕滚动
	if ($.browser.msie) {
		document.documentElement.style.overflow = "hidden";
	} else {
		document.body.style.overflow="hidden";
	}
	
	return false;
}

//关闭弹出框函数
function closeWindow() {
	//移除遮蔽层，阴影层和弹出框
	$('#examWindow').remove();
	$('.shadow').remove();
	$('#cover').remove();
	
	//恢复屏幕滚动
	if ($.browser.msie) {
		document.documentElement.style.overflow = "auto";
	} else {
		document.body.style.overflow="auto";
	}
	
	return false;
}