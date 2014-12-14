<?php /* Smarty version Smarty-3.1.16, created on 2014-12-11 17:40:03
         compiled from "../../app/www/views/guide/restaurant_result.html" */ ?>
<?php /*%%SmartyHeaderCode:1289193038547de99e6424e1-11397093%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25c8afa6b0968500ba8a87cb598388022c247ca4' => 
    array (
      0 => '../../app/www/views/guide/restaurant_result.html',
      1 => 1418319598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1289193038547de99e6424e1-11397093',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547de99e6b1645_55865549',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'rowset' => 0,
    'url_restaurant_detail' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547de99e6b1645_55865549')) {function content_547de99e6b1645_55865549($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>餐廳搜尋結果</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<style type="text/css">
			.quick-nav {
				padding: 0 50px;
			}
			.info-result {
				padding: 10px;
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
			<div class="info-result">
				<ul class="mui-table-view">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
					<li class="mui-table-view-cell mui-media">
						<a href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_detail']->value;?>
&rid=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
">
							<div class="mui-media-body">
								<div><b><?php echo $_smarty_tpl->tpl_vars['item']->value->users->name;?>
</b></div>
								<p class='mui-ellipsis'>電話：<?php echo $_smarty_tpl->tpl_vars['item']->value->contact_tel;?>
</p>
								<p class='mui-ellipsis'>地址：<?php echo $_smarty_tpl->tpl_vars['item']->value->address;?>
</p>
								<!--<p class='mui-ellipsis'>營業時間：</p>
								<p class='mui-ellipsis'>公休時間：</p>-->
							</div>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">
		    餐廳資訊
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
