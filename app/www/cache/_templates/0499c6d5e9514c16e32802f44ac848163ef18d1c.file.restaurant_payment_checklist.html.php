<?php /* Smarty version Smarty-3.1.16, created on 2014-12-13 17:17:56
         compiled from "../../app/www/views/guide/restaurant_payment_checklist.html" */ ?>
<?php /*%%SmartyHeaderCode:1247331208547bc6264402f4-02095985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0499c6d5e9514c16e32802f44ac848163ef18d1c' => 
    array (
      0 => '../../app/www/views/guide/restaurant_payment_checklist.html',
      1 => 1418491072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1247331208547bc6264402f4-02095985',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547bc626441026_64037241',
  'variables' => 
  array (
    'url_restaurant' => 0,
    'url_info' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_restaurant_payment_submit' => 0,
    'date' => 0,
    'schedule' => 0,
    'restaurant' => 0,
    'group' => 0,
    'mode' => 0,
    'gid' => 0,
    'day' => 0,
    'route' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547bc626441026_64037241')) {function content_547bc626441026_64037241($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<script type="text/javascript" src="/libs/jquery/core.imagevisible.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$.imageFileVisible({display: "#image-wrap", file: "#receive", width: 300, height: 300});
		});
		function upload() {
			$("#receive").click();
		}
		function preview(sender) {
			$(".confirm-form").show();
			$(".checklist-form").hide();
		}
		function retake() {
			$(".confirm-form").hide();
			$(".checklist-form").show();
			$("#image-wrap").html("");
		}
		function submit() {
			$("#form").submit();
		}
		</script>
		<style type="text/css">
			.checklist_title {
				background: #CCC;
				font-size: 16px;
				padding: 10px;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
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
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_payment_submit']->value;?>
" method="post" id="form">
		
			<div class="checklist-form">
				<h3 class="checklist_title">用餐資訊</h3>
				<div class="checklist_content">
					<p>日期：<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</p>
					<p>餐別：<?php if ($_smarty_tpl->tpl_vars['schedule']->value->type=='2') {?>中餐<?php } elseif ($_smarty_tpl->tpl_vars['schedule']->value->type=='3') {?>晚餐<?php }?></p>
					<p>餐廳名：<?php echo $_smarty_tpl->tpl_vars['restaurant']->value->users->name;?>
</p>
					<p>旅行社：</p>
					<p>團號：<?php echo $_smarty_tpl->tpl_vars['group']->value->code;?>
</p>
					<p>導遊：<?php echo $_smarty_tpl->tpl_vars['group']->value->contact_name;?>
</p>
					<p>人數：<?php echo $_smarty_tpl->tpl_vars['group']->value->amount;?>
</p>
					<p>餐標：</p>
					<p>金額：</p>
					<p>結帳方式：<?php if ($_smarty_tpl->tpl_vars['mode']->value=='0') {?>現金<?php } elseif ($_smarty_tpl->tpl_vars['mode']->value=='1') {?>刷卡<?php } elseif ($_smarty_tpl->tpl_vars['mode']->value=='2') {?>簽單<?php }?></p>
				</div>
				<div class="upload_receive">
					<button class="mui-btn mui-btn-primary mui-btn-block" onclick="upload();return false;">請拍下收據</button>
					<input type="file" id="receive" name="receive" class="mui-btn mui-btn-primary mui-btn-block" onchange="preview(this);" />
				</div>
				<br/>
			</div>
			
			<div class="confirm-form">
				<div class="confirm_content">
					<div id="image-wrap"></div>
				</div>
				<div style="text-align: center;">
					<input type="hidden" name="gid" value="<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
" />
					<input type="hidden" name="day" value="<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
" />
					<input type="hidden" name="route" value="<?php echo $_smarty_tpl->tpl_vars['route']->value;?>
" />
					<input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" />
					<button class="mui-btn mui-btn-primary" onclick="retake();return false;">重拍</button>
					<button class="mui-btn mui-btn-primary" onclick="submit();return false;">上傳雲端</button>
				</div>
				<br/><br/>
			</div>
			
			</form>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="#">
		    訂餐資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
