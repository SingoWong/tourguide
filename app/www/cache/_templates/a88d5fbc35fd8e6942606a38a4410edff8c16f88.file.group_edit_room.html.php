<?php /* Smarty version Smarty-3.1.16, created on 2014-11-25 17:25:14
         compiled from "../../app/www/views/agency/group_edit_room.html" */ ?>
<?php /*%%SmartyHeaderCode:257460465474b1c055d245-38588446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a88d5fbc35fd8e6942606a38a4410edff8c16f88' => 
    array (
      0 => '../../app/www/views/agency/group_edit_room.html',
      1 => 1416936308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '257460465474b1c055d245-38588446',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5474b1c05a73b8_25678757',
  'variables' => 
  array (
    'id' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5474b1c05a73b8_25678757')) {function content_5474b1c05a73b8_25678757($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="flowset">
	<a href="index.php?ctr=sysagency&act=groupedit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">基本资料</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=grouproom&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="curr">分房资讯</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupschedule&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">行程安排</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupinfo&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">开团说明会资料</a>
</div>

<form method="post" action="index.php?ctr=sysagency&act=grouproomsave">
<div class="title_panel">
	房型类型
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">单人房</td>
			<td><span class="v"><input type="text" id="single_room" name="single_room" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->single_room;?>
"></span></td>
			<td class="tf_key">双人房</td>
			<td><span class="v"><input type="text" id="double_room" name="double_room" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->double_room;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">加床</td>
			<td><span class="v"><input type="text" id="plus_room" name="plus_room" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->plus_room;?>
"></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">总计</td>
			<td><label id="lbl_amount">0</label>人</td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
	</table>
</div>

<hr size="1" />
<div>
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
	<input type="submit" class="gm_t1_btn" value="提交信息">
</div>
</form>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
