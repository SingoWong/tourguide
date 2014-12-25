<?php /* Smarty version Smarty-3.1.16, created on 2014-12-17 22:39:25
         compiled from "../../app/www/views/guide/info_journey.html" */ ?>
<?php /*%%SmartyHeaderCode:3460976615470312a6341e8-30470229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9028acb1357f11da1ac12053e134c7df5e86bdf' => 
    array (
      0 => '../../app/www/views/guide/info_journey.html',
      1 => 1418826070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3460976615470312a6341e8-30470229',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470312a69b780_53047358',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'map' => 0,
    'schedule' => 0,
    'url_info_journey' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470312a69b780_53047358')) {function content_5470312a69b780_53047358($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>行程資訊</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-icon mui-icon-bars mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
'">團號</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
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
				<div class="info-map"><img src="<?php echo $_smarty_tpl->tpl_vars['map']->value;?>
" width="100%" onerror="this.src='/theme/images/error.jpg';this.height='200'" /></div>
				<div class="info-flow"></div>
			</div>
		</div>
		<script type="text/javascript">
		var data = eval('(<?php echo $_smarty_tpl->tpl_vars['schedule']->value;?>
)');
		$.each(data,function(day,schedule){
			var html_day = '<a class="flow-item-title" href="#" onclick="return sh_day('+day+');"><em>D'+day+'</em>'+schedule[0]['tab']+'&nbsp;</a><div class="flow-item-list" id="pnl_day_'+day+'">';

			$.each(schedule,function(route,item){
				html_day += '<a class="flow-item-stitle" href="#" onclick="return sh_schedule('+day+','+route+');"><span>'+item['time']+'</span><em>'+item['type_label']+'</em>';
				html_day += item['location']+'</a><div class="flow-item-sdetail" id="pnl_schedule_'+day+'_'+route+'">';
				html_day += item['detail']+'</div>';
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
		</script>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
';">
		    團號資訊
		  </a>
		  <a class="mui-tab-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info_journey']->value;?>
';">
		    行程資訊
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
