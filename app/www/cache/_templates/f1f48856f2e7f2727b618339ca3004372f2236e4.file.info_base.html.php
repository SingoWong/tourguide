<?php /* Smarty version Smarty-3.1.16, created on 2014-12-13 13:56:18
         compiled from "../../app/www/views/guide/info_base.html" */ ?>
<?php /*%%SmartyHeaderCode:16024723154702cde8acc76-88205240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1f48856f2e7f2727b618339ca3004372f2236e4' => 
    array (
      0 => '../../app/www/views/guide/info_base.html',
      1 => 1418478976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16024723154702cde8acc76-88205240',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54702cde918189_77071163',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'info' => 0,
    'url_info_journey' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54702cde918189_77071163')) {function content_54702cde918189_77071163($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>團號資訊</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-content {
				padding: 10px;
			}
			.info-content-item {
				padding: 20px;
				background: #E2E2E3;
				margin-bottom: 5px;
				border-radius: 5px;
				text-align: center;
				font-size: 16px;
			}
			.info-content-tips {
				color: #666;
				text-align: center;
				padding: 5px;
			}
			.mui-table-view {
				background: none;
			}
			.mui-table-view-chevron .mui-table-view-cell {
				margin-bottom: 5px;
				background: #FFF;
				border-radius: 5px;
			}
			.mui-table-view-cell.mui-collapse .mui-table-view .mui-table-view-cell {
				border-top: 1px dotted #CCC;
				padding-left:15px;
			}
		</style>
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
			<div class="info-content">
				<div class="info-content-item"><?php echo $_smarty_tpl->tpl_vars['info']->value->code;?>
</div>
				<div class="info-content-item"><?php echo $_smarty_tpl->tpl_vars['info']->value->name;?>
</div>
				<div class="info-content-tips">系列團行：無</div>
				
				<ul class="mui-table-view mui-table-view-chevron">
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">旅行社資訊</a>
						<ul class="mui-table-view mui-table-view-chevron" id="pnl_info_base">
							<li class="mui-table-view-cell">
								<p>旅行社：<?php echo $_smarty_tpl->tpl_vars['info']->value->aid;?>
</p>
								<p>聯絡人：<?php echo $_smarty_tpl->tpl_vars['info']->value->contact_name;?>
</p>
								<p>聯絡資訊：<?php echo $_smarty_tpl->tpl_vars['info']->value->contact_tel;?>
</p>
							</li>
						</ul>
					</li>
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">相關聯絡人資訊</a>
						<ul class="mui-table-view mui-table-view-chevron" id="pnl_info_contact">
							<li class="mui-table-view-cell">
								<p>送機人員：</p>
								<p>手機：</p>
								<p>胸章：</p>
								<p>領隊：<?php echo $_smarty_tpl->tpl_vars['info']->value->info->leader;?>
</p>
								<p>手機：<?php echo $_smarty_tpl->tpl_vars['info']->value->info->leader_tel;?>
</p>
								<p>行李牌：</p>
								<p>注意事項：<?php echo $_smarty_tpl->tpl_vars['info']->value->info->attention;?>
</p>
								<p>緊急聯絡：</p>
							</li>
						</ul>
					</li>
					<li class="mui-table-view-cell mui-collapse"><a class="mui-navigate-right" href="#">航班資訊</a>
						<ul class="mui-table-view mui-table-view-chevron" id="pnl_info_flight">
							<li class="mui-table-view-cell">
								<p>出國日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value->start_date,"%Y-%m-%d");?>
</p>
								<p>班機代號：<?php echo $_smarty_tpl->tpl_vars['info']->value->start_flight_num;?>
</p>
								<p>班機行程：<?php echo $_smarty_tpl->tpl_vars['info']->value->start_flight_code;?>
</p>
								<p>起飛時間：<?php echo $_smarty_tpl->tpl_vars['info']->value->start_flight_departure_time;?>
</p>
								<p>抵達時間：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value->start_flight_arrive_time,"%H:%i");?>
</p>
								<br/>
								<p>回國日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value->end_date,"%Y-%m-%d");?>
</p>
								<p>班機代號：<?php echo $_smarty_tpl->tpl_vars['info']->value->end_flight_num;?>
</p>
								<p>班機行程：<?php echo $_smarty_tpl->tpl_vars['info']->value->end_flight_code;?>
</p>
								<p>起飛時間：<?php echo $_smarty_tpl->tpl_vars['info']->value->end_flight_departure_time;?>
</p>
								<p>抵達時間：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['info']->value->end_flight_arrive_time,"%H:%i");?>
</p>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
';">
		    團號資訊
		  </a>
		  <a class="mui-tab-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info_journey']->value;?>
';">
		    行程資訊
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
