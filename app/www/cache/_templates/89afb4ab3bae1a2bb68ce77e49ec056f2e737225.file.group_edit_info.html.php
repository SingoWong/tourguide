<?php /* Smarty version Smarty-3.1.16, created on 2014-12-06 07:10:52
         compiled from "../../app/www/views/agency/group_edit_info.html" */ ?>
<?php /*%%SmartyHeaderCode:6228895365474bb19ddae35-59790614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89afb4ab3bae1a2bb68ce77e49ec056f2e737225' => 
    array (
      0 => '../../app/www/views/agency/group_edit_info.html',
      1 => 1417531748,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6228895365474bb19ddae35-59790614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5474bb19e53a49_47085446',
  'variables' => 
  array (
    'id' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5474bb19e53a49_47085446')) {function content_5474bb19e53a49_47085446($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="flowset">
	<a href="index.php?ctr=sysagency&act=groupedit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">旅行社的基本資料</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=grouproom&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">分房資訊</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupschedule&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">行程安排</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupinfo&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="curr">開團說明會資料</a>
</div>

<form method="post" action="index.php?ctr=sysagency&act=groupinfosave">
<div class="title_panel">
	開團說明會資料
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">出團名稱</td>
			<td><span class="v"><input type="text" id="" name="" value=""></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">領隊</td>
			<td><span class="v"><input type="text" id="leader" name="leader" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->leader;?>
"></span></td>
			<td class="tf_key">手機</td>
			<td><span class="v"><input type="text" id="leader_tel" name="leader_tel" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->leader_tel;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">注意事項</td>
			<td></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="4"><textarea style="width:745px;height:80px;"><?php echo $_smarty_tpl->tpl_vars['row']->value->attention;?>
</textarea></td>
		</tr>
	</table>
</div>

<div class="title_panel">
	导游资料
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">導遊帳號</td>
			<td><span class="v"><input type="text" id="guide_id" name="guide_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->guide_id;?>
"></span></td>
			<td class="tf_key"></td>
			<td></td>
		</tr>
		<tr>
			<td class="tf_key">導遊</td>
			<td><span class="v"><input type="text" id="guide_name" name="guide_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->guide_name;?>
"></span></td>
			<td class="tf_key">手機</td>
			<td><span class="v"><input type="text" id="guide_tel" name="guide_tel" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->guide_tel;?>
"></span></td>
		</tr>
		<tr>
			<td class="tf_key">團控</td>
			<td><span class="v"><input type="text" id="regulator" name="regulator" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->regulator;?>
"></span></td>
			<td class="tf_key">手機</td>
			<td><span class="v"><input type="text" id="regulator_tel" name="regulator_tel" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->regulator_tel;?>
"></span></td>
		</tr>
	</table>
</div>

<div class="title_panel">
	團員姓名
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td>
				<textarea style="width:745px;height:80px;"><?php echo $_smarty_tpl->tpl_vars['row']->value->member_names;?>
</textarea>
			</td>
		</tr>
	</table>
</div>

<hr size="1" />
<div>
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
	<input type="submit" class="gm_t1_btn" value="提交訊息">
</div>
</form>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
