<?php /* Smarty version Smarty-3.1.16, created on 2014-12-09 14:27:44
         compiled from "../../app/www/views/hotel/new_order.html" */ ?>
<?php /*%%SmartyHeaderCode:393554506548704d6bb37e2-23424417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfde9b26055509d707d01cd1ebeb9982b0b39fbd' => 
    array (
      0 => '../../app/www/views/hotel/new_order.html',
      1 => 1418135172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '393554506548704d6bb37e2-23424417',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_548704d6c935a2_89323640',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_today' => 0,
    'url_new_order' => 0,
    'url_report' => 0,
    'rowset' => 0,
    'item' => 0,
    'url_approve' => 0,
    'url_reject' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548704d6c935a2_89323640')) {function content_548704d6c935a2_89323640($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<script type="text/javascript">
			function sh_detail(sender) {
				var id = $(sender).attr("idx");
				if ($("#pnl_detail_"+id).css("display") == 'none') {
					$("#pnl_detail_"+id).show();
				} else {
					$("#pnl_detail_"+id).hide();
				}
			}
		</script>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a href="#" class="mui-icon mui-icon-bars mui-pull-left" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
';"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_today']->value;?>
';">今日</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_new_order']->value;?>
';">新进</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_report']->value;?>
';">报表</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="order-result">
				<ul class="mui-table-view">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
					<li class="mui-table-view-cell mui-media">
						<a href="#" idx="<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" onclick="sh_detail(this);return false;">
							<div class="mui-media-body">
								<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->created,"%Y-%m-%d");?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value->aid;?>

								<p class='mui-ellipsis'>導遊:<?php echo $_smarty_tpl->tpl_vars['item']->value->gid;?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value->amount;?>
人</p>
							</div>
						</a>
						<div class="detail_item" id="pnl_detail_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
							<p>日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->created,"%Y-%m-%d");?>
</p>
							<p>飯店名稱：<?php echo $_smarty_tpl->tpl_vars['item']->value->rname;?>
</p>
							<p>旅行社：<?php echo $_smarty_tpl->tpl_vars['item']->value->aname;?>
</p>
							<p>團號：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
</p>
							<p>導遊：<?php echo $_smarty_tpl->tpl_vars['item']->value->gname;?>
</p>
							<p>房客數：-</p>
							<p>房價：-</p>
							<p>金額：-</p>
							<button class="mui-btn mui-btn-primary" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_approve']->value;?>
&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
';">接受</button>
							<button class="mui-btn mui-btn-primary" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_reject']->value;?>
&oid=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
';">拒絕</button>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</body>
</html>
<?php }} ?>
