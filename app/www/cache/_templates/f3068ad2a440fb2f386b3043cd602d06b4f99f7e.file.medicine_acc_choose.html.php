<?php /* Smarty version Smarty-3.1.16, created on 2014-12-03 17:51:56
         compiled from "../../app/www/views/accident/medicine_acc_choose.html" */ ?>
<?php /*%%SmartyHeaderCode:120587716547f4dbcd3bfd2-92586855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3068ad2a440fb2f386b3043cd602d06b4f99f7e' => 
    array (
      0 => '../../app/www/views/accident/medicine_acc_choose.html',
      1 => 1417629100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120587716547f4dbcd3bfd2-92586855',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'url_medicine_photo_submit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547f4dbcdb38d0_52075548',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547f4dbcdb38d0_52075548')) {function content_547f4dbcdb38d0_52075548($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<script type="text/javascript" src="/libs/jquery/core.imagevisible.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$.imageFileVisible({display: "#image-wrap", file: "#photo", width: 300, height: 300});
		});
		function upload() {
			$("#photo").click();
		}
		function preview(sender) {
			$(".confirm-form").show();
			$(".photo-form").hide();
		}
		function retake() {
			$(".confirm-form").hide();
			$(".photo-form").show();
			$("#image-wrap").html("");
		}
		function submit() {
			$("#form").submit();
		}
		</script>
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
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_medicine_photo_submit']->value;?>
" method="post" id="form">
		
			<div class="photo-form">
				<div class="upload_photo">
					<button class="mui-btn mui-btn-primary mui-btn-block" onclick="upload();return false;">請拍下事故照片</button>
					<input type="file" id="photo" name="photo" class="mui-btn mui-btn-primary mui-btn-block" onchange="preview(this);" />
				</div>
				<br/>
			</div>
			
			<div class="confirm-form">
				<div class="confirm_content">
					<div id="image-wrap"></div>
				</div>
				<div style="text-align: center;">
					<button class="mui-btn mui-btn-primary" onclick="retake();return false;">重拍</button>
					<button class="mui-btn mui-btn-primary" onclick="submit();return false;">上傳雲端</button>
				</div>
				<br/><br/>
			</div>
			
			</form>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item mui-active" href="tel://119">
		    救护车119
		  </a>
		  <a class="mui-tab-item mui-active" href="tel://110">
		    报警110
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    联系旅行社
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
