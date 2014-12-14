<?php /* Smarty version Smarty-3.1.16, created on 2014-12-10 16:50:55
         compiled from "../../app/www/views/guide/hotel_payment_checklist.html" */ ?>
<?php /*%%SmartyHeaderCode:1672316941547c12c558cc34-78643094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed5354a90d4df7f8e7543854efb14219bc3fcafb' => 
    array (
      0 => '../../app/www/views/guide/hotel_payment_checklist.html',
      1 => 1417616454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1672316941547c12c558cc34-78643094',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547c12c55fb2e3_76983157',
  'variables' => 
  array (
    'url_restaurant' => 0,
    'url_info' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_hotel_payment_submit' => 0,
    'gid' => 0,
    'day' => 0,
    'route' => 0,
    'mode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547c12c55fb2e3_76983157')) {function content_547c12c55fb2e3_76983157($_smarty_tpl) {?><!DOCTYPE html>
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
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_hotel_payment_submit']->value;?>
" method="post" id="form">
		
			<div class="checklist-form">
				<h3 class="checklist_title">訂房資訊</h3>
				<div class="checklist_content">
					<p>日期：</p>
					<p>飯店名：</p>
					<p>旅行社：</p>
					<p>團號：</p>
					<p>導遊：</p>
					<p>人數：</p>
					<p>金額：</p>
					<p>結帳方式：</p>
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
		  <a class="mui-tab-item mui-active" href="#">
		    訂房資訊
		  </a>
		  <a class="mui-tab-item" href="#">
		    &nbsp
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
