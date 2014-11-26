<?php /* Smarty version Smarty-3.1.16, created on 2014-11-25 13:48:45
         compiled from "../../app/www/views/sysmanager/group_manager.html" */ ?>
<?php /*%%SmartyHeaderCode:14466150675470a65747d4b5-77261803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd14eb6c1a73751e4f02b49d1fe0a5578b4346199' => 
    array (
      0 => '../../app/www/views/sysmanager/group_manager.html',
      1 => 1416923324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14466150675470a65747d4b5-77261803',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a6574c98a7_48337325',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a6574c98a7_48337325')) {function content_5470a6574c98a7_48337325($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="title_panel">
	旅游团查询 - 进度
</div>

<input type="button" class="gm_t1_btn" value="旅行团进度" onclick="self.location.href='index.php?ctr=sysgroup';">
<input type="button" class="gm_t1_btn_alt_disabled" value="历史查询" onclick="self.location.href='index.php?ctr=sysgroup&act=history';">

<div class="list_inner">
	<!-- foreach -->
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rowset']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<div class="item">
		<div class="item_title">
			<a href="#" onclick="return sh_pnlc(<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
);" id="btnc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">关闭</a>
			团号：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
 &nbsp;&nbsp; 团名：<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
 &nbsp;&nbsp; 导游：<?php echo $_smarty_tpl->tpl_vars['item']->value->contact_name;?>
 &nbsp;&nbsp; 进度：
		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			
		</div>
	</div>
	<?php } ?>
	<!-- foreach -->
</div>
	
<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
