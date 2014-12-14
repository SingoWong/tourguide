<?php /* Smarty version Smarty-3.1.16, created on 2014-12-06 19:23:53
         compiled from "../../app/www/views/sysmanager/accidents.html" */ ?>
<?php /*%%SmartyHeaderCode:3288861995470a6a666ddc0-50823481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4836cb99b3fceba9db6100d6550bb383023a908' => 
    array (
      0 => '../../app/www/views/sysmanager/accidents.html',
      1 => 1417811277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3288861995470a6a666ddc0-50823481',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a6a66b57d8_23449233',
  'variables' => 
  array (
    'res' => 0,
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a6a66b57d8_23449233')) {function content_5470a6a66b57d8_23449233($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<script type="text/javascript">
$(document).ready(function() {
	var res = eval('{'+'<?php echo $_smarty_tpl->tpl_vars['res']->value;?>
'+'}');
	console.log(res[1]);
	for (var i=0; i<res.length; i++) {
		$("#res_"+res[i]['aid']).append('<a href="'+res[i]['pic_url']+'" target="_blank" class="res_item"><img src="'+res[i]['pic_url']+'" /></a>');
	}
});

function sh_pnlc(id) {
	if ($("#pnlc_"+id).css("display") == "none") {
		$("#pnlc_"+id).show();
		$("#btnc_"+id).html("關閉");
	} else {
		$("#pnlc_"+id).hide();
		$("#btnc_"+id).html("展開");
	}
	return false;
}
</script>

<div class="title_panel">
	意外通報
</div>

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
">關閉</a>
			<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->time,'%Y-%m-%d %H:%i');?>
&nbsp;&nbsp;
			<?php echo $_smarty_tpl->tpl_vars['item']->value->type;?>
&nbsp;&nbsp;
			團號：<?php echo $_smarty_tpl->tpl_vars['item']->value->gid;?>
&nbsp;&nbsp;
			導遊：<?php echo $_smarty_tpl->tpl_vars['item']->value->gid;?>
&nbsp;&nbsp;
			緊急事故
		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			<table border="0" width="100%" cellpadding="2" cellspacing="1">
				<tr>
					<td width="10%">流水號</td>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
</td>
				</tr>
				<tr>
					<td width="10%">發生時間</td>
					<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->time,'%Y-%m-%d %H:%i');?>
</td>
				</tr>
				<tr>
					<td width="10%">發生地點</td>
					<td><?php echo $_smarty_tpl->tpl_vars['item']->value->location;?>
</td>
				</tr>
				<tr>
					<td width="10%">事故情況</td>
					<td></td>
				</tr>
				<tr>
					<td width="10%">遊覽車</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['item']->value->bus->bus_status=='0') {?>
						可行進
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->bus_status=='1') {?>
						無法行進
						<?php }?>
					</td>
				</tr>
				<tr>
					<td width="10%">司機狀況</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['item']->value->bus->driver_status=='0') {?>
						死亡
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->driver_status=='1') {?>
						重傷
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->driver_status=='2') {?>
						輕傷
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->driver_status=='3') {?>
						平安
						<?php }?>
					</td>
				</tr>
				<tr>
					<td width="10%">遊客情況</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['item']->value->bus->member_status=='0') {?>
						死亡
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->member_status=='1') {?>
						重傷
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->member_status=='2') {?>
						輕傷
						<?php } elseif ($_smarty_tpl->tpl_vars['item']->value->bus->member_status=='3') {?>
						平安
						<?php }?>
					</td>
				</tr>
				<tr>
					<td width="10%">事故圖片</td>
					<td id="res_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" class="res_list"></td>
				</tr>
			</table>
		</div>
	</div>
	<?php } ?>
	<!-- foreach -->
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
