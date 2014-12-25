<?php /* Smarty version Smarty-3.1.16, created on 2014-12-22 02:09:13
         compiled from "../../app/www/views/guide/hotel_base.html" */ ?>
<?php /*%%SmartyHeaderCode:32300137654703124e03bf8-17046285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd09ba001d66035938324770aa6ff027db8d569e0' => 
    array (
      0 => '../../app/www/views/guide/hotel_base.html',
      1 => 1419182053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32300137654703124e03bf8-17046285',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54703124e6ea81_67038324',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'schedule' => 0,
    'url_hotel_payment' => 0,
    'url_hotel_info' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54703124e6ea81_67038324')) {function content_54703124e6ea81_67038324($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>訂房資訊</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
		</style>
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
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
'">訂餐</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-hotel">
				<div class="info-flow"></div>
			</div>
		</div>
		<script type="text/javascript">
		var data = eval('(<?php echo $_smarty_tpl->tpl_vars['schedule']->value;?>
)');
		$.each(data,function(day,schedule){
			var html_day = '<a class="flow-item-title" href="#" onclick="return sh_day('+day+');"><em>D'+day+'</em>'+schedule[0]['tab']+'</a><div class="flow-item-list" id="pnl_day_'+day+'">';
	 					 
			$.each(schedule,function(route,item){
				if (item['type']=='4') {
					html_day += '<a class="flow-item-stitle" href="#" onclick="return sh_schedule('+day+','+route+');"><span>'+item['time']+'</span><em class="stitle-status-'+item['rstatus']+'">'+item['type_label']+'</em>';
					html_day += item['location']+'</a><div class="flow-item-sdetail hotel-ctrls" id="pnl_schedule_'+day+'_'+route+'">';
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
				html += '未訂房';
			} else if (item['rstatus'] == '1') {
				html += '<a href="<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment']->value;?>
&day='+day+'&route='+route+'">退房<br/>付款</a><a href="<?php echo $_smarty_tpl->tpl_vars['url_hotel_info']->value;?>
&sid='+item['id']+'">分房<br/>資訊</a>';
			} else if (item['rstatus'] == '2') {
				html += '<a href="<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment']->value;?>
&day='+day+'&route='+route+'">退房<br/>付款</a><a href="<?php echo $_smarty_tpl->tpl_vars['url_hotel_info']->value;?>
&sid='+item['id']+'">分房<br/>資訊</a>';
			} else if (item['rstatus'] == '3') {
				html += '已結帳';
			} else {
				html += '';
			}
			
			html += '<br/><br/>';
			
			return html;
		}
		</script>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="#">
		    訂房資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    &nbsp;
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
