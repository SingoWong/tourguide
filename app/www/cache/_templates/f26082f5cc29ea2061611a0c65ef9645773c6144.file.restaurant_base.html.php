<?php /* Smarty version Smarty-3.1.16, created on 2014-12-13 16:52:58
         compiled from "../../app/www/views/guide/restaurant_base.html" */ ?>
<?php /*%%SmartyHeaderCode:104942899354702d47168a23-76198650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f26082f5cc29ea2061611a0c65ef9645773c6144' => 
    array (
      0 => '../../app/www/views/guide/restaurant_base.html',
      1 => 1418489574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104942899354702d47168a23-76198650',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702d471b0f98_95589839',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'schedule' => 0,
    'url_restaurant_search' => 0,
    'url_restaurant_payment' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54702d471b0f98_95589839')) {function content_54702d471b0f98_95589839($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>訂餐資訊</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
'">團號</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
'">訂餐</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-journey">
				<div class="info-flow"></div>
			</div>
		</div>
		<script type="text/javascript">
		var data = eval('(<?php echo $_smarty_tpl->tpl_vars['schedule']->value;?>
)');
		$.each(data,function(day,schedule){
			var html_day = '<a class="flow-item-title" href="#" onclick="return sh_day('+day+');"><em>D'+day+'</em>'+schedule[0]['tab']+'</a><div class="flow-item-list" id="pnl_day_'+day+'">';
			
			$.each(schedule,function(i,item){
				var route = item['route'];
				if (item['type']=='2' || item['type']=='3') {
					html_day += '<a class="flow-item-stitle" href="#" onclick="return sh_schedule('+day+','+route+');"><span>'+item['time']+'</span><em class="stitle-status-'+item['rstatus']+'">'+item['type_label']+'</em>';
					html_day += item['rstatus_label']+'</a><div class="flow-item-sdetail" id="pnl_schedule_'+day+'_'+route+'">';
					html_day += show_ctrl(day,route,item)+'</div>';
				}
			});
				
			html_day += '</div>';
			
			$(".info-flow").append(html_day);
		});
		$(".info-flow").append("<br/><br/><br/>");
		function sh_day(day) {
			if ($("#pnl_day_"+day).css("display") == "none") {
				$("#pnl_day_"+day).show();
				//TODO -
			} else {
				$("#pnl_day_"+day).hide();
				//TODO +
			}
			return false;
		}
		function sh_schedule(day,route) {
			if ($("#pnl_schedule_"+day+"_"+route).css("display") == "none") {
				$("#pnl_schedule_"+day+"_"+route).show();
				//TODO -
			} else {
				$("#pnl_schedule_"+day+"_"+route).hide();
				//TODO +
			}
			return false;
		}
		function show_ctrl(day,route,item) {
			var html = '';
			if (item['rstatus'] == '0') {
				html += '<a href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_search']->value;?>
&day='+day+'&route='+route+'&type='+item['type']+'" class="restaurant-order">請訂餐</a>';
			} else if (item['rstatus'] == '1') {
				html += '<a href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_search']->value;?>
&day='+day+'&route='+route+'&type='+item['type']+'">重新<br/>訂餐</a><a href="tel://'+item['rcontact']+'">電話<br/>確認</a>餐廳名稱：'+item['rname']+'<br/>收據上傳：'+item['receive_status'];
			} else if (item['rstatus'] == '2') {
				html += '<a href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_payment']->value;?>
&day='+day+'&route='+route+'">選擇<br/>付款</a><a href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_search']->value;?>
&day='+day+'&route='+route+'">重新<br/>訂餐</a>餐廳名稱：'+item['rname']+'<br/>收據上傳：'+item['receive_status'];
			} else if (item['rstatus'] == '3') {
				html += '</a>餐廳名稱：'+item['rname']+'<br/>收據上傳：'+item['receive_status'];
			}
			
			return html;
		}
		</script>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="#">
		    訂餐資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
