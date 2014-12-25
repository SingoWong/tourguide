<?php /* Smarty version Smarty-3.1.16, created on 2014-12-21 05:05:34
         compiled from "../../app/www/views/agency/group_edit_room.html" */ ?>
<?php /*%%SmartyHeaderCode:257460465474b1c055d245-38588446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a88d5fbc35fd8e6942606a38a4410edff8c16f88' => 
    array (
      0 => '../../app/www/views/agency/group_edit_room.html',
      1 => 1419107683,
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
    'html_rooms_single' => 0,
    'html_rooms_double' => 0,
    'html_rooms_full' => 0,
    'html_rooms_plus' => 0,
    'html_rooms_kid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5474b1c05a73b8_25678757')) {function content_5474b1c05a73b8_25678757($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript">
$(document).ready(function(){
	calc();
});
function calc() {
	var single_room = parseInt($("#single_room").val());
	var double_room = parseInt($("#double_room").val())*2;
	var full_room = parseInt($("#full_room").val())*3;
	var plus_room = parseInt($("#plus_room").val());
	var kid_room = parseInt($("#kid_room").val());
	
	var total = single_room + double_room + full_room + plus_room + kid_room;
	$("#lbl_amount").html(total);
}
</script>

<div class="flowset">
	<a href="index.php?ctr=sysagency&act=groupedit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">旅行社的基本資料</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=grouproom&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="curr">分房資訊</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupschedule&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">行程安排</a>
	<em>&gt;</em>
	<a href="index.php?ctr=sysagency&act=groupinfo&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">開團說明會資料</a>
</div>

<form method="post" action="index.php?ctr=sysagency&act=grouproomsave">
<div class="title_panel">
	房型類型
</div>
<div class="form_inner">
	<table class="table_form">
		<tr>
			<td class="tf_key">單人房</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['html_rooms_single']->value;?>
</span></td>
		</tr>
		<tr>
			<td class="tf_key">雙人房</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['html_rooms_double']->value;?>
</span></td>
		</tr>
		<tr>
			<td class="tf_key">三人房</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['html_rooms_full']->value;?>
</span></td>
		</tr>
		<tr>
			<td class="tf_key">加床</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['html_rooms_plus']->value;?>
</span></td>
		</tr>
		<tr>
			<td class="tf_key">兒童床</td>
			<td><span class="v"><?php echo $_smarty_tpl->tpl_vars['html_rooms_kid']->value;?>
</span></td>
		</tr>
		<tr>
			<td class="tf_key">總計</td>
			<td><label id="lbl_amount">0</label>人</td>
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
