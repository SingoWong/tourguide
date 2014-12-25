<?php /* Smarty version Smarty-3.1.16, created on 2014-12-19 23:03:18
         compiled from "../../app/www/views/sysmanager/hotel_expired.html" */ ?>
<?php /*%%SmartyHeaderCode:21381566885470a3eed47af4-12768658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e54fcfd5ceb46c94d3a584e27428d8dae3fae398' => 
    array (
      0 => '../../app/www/views/sysmanager/hotel_expired.html',
      1 => 1418924576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21381566885470a3eed47af4-12768658',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a3eedacc52_34548232',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a3eedacc52_34548232')) {function content_5470a3eedacc52_34548232($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Users/singowong/Project/default/tourguide/core/libraries/Smarty/libs/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript">
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
	飯店管理 - 過期飯店
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="續約飯店" onclick="self.location.href='index.php?ctr=syshotel';">
<input type="button" class="gm_t1_btn" value="過期飯店" onclick="self.location.href='index.php?ctr=syshotel&act=expired';">
<input type="button" class="gm_t1_btn_alt_disabled" value="新增飯店" onclick="self.location.href='index.php?ctr=syshotel&act=edit';">

<div class="search-inner">
<form class="gm_t1_form" id="reg_form" action="" method="GET">
	<input type="hidden" name="ctr" value="syshotel" />
	<input type="hidden" name="act" value="expired" />
	<label class="v"><input id="name" type="text" name="name" value="" placeholder="飯店"></label>
	<label class="v"><input id="username" type="text" name="username" value="" placeholder="帳號"></label>
	<label class="s"><input type="submit" class="gm_t1_btn" value="查詢" /></label>	
</form>
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
			<?php echo $_smarty_tpl->tpl_vars['item']->value->users->name;?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
&nbsp;&nbsp;簽約日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_start,'%Y-%m-%d');?>
 至 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_end,'%Y-%m-%d');?>

		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			<table border="0" width="100%" cellpadding="2" cellspacing="1">
				<tr>
					<td colspan="2">帳號：<?php echo $_smarty_tpl->tpl_vars['item']->value->users->username;?>
</td>
					<td>密碼：******</td>
					<td width="10%"><a href="index.php?ctr=syshotel&act=resetpassword&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" onclick="if(!confirm('確定要重置這個帳號嗎？')){return false;}">重置密碼</a></td>
				</tr>
				<tr>
					<td colspan="2">飯店名稱：<?php echo $_smarty_tpl->tpl_vars['item']->value->users->name;?>
</td>
					<td>地址：<?php echo $_smarty_tpl->tpl_vars['item']->value->address;?>
</td>
					<td><a href="index.php?ctr=syshotel&act=updateprofile&type=address&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
" onclick="return window.openWindow(this.href,'600','150',false,0.3)">修改</a></td>
				</tr>
				<tr>
					<td colspan="2" width="50%">流水號：<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
</td>
					<td colspan="2" width="50%">統一編碼：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
</td>
				</tr>
				<tr>
					<td>聯絡人：<?php echo $_smarty_tpl->tpl_vars['item']->value->contact;?>
</td>
					<td width="10%"><a href="index.php?ctr=syshotel&act=updateprofile&type=contact&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
" onclick="return window.openWindow(this.href,'600','150',false,0.3)">修改</a></td>
					<td>電話：<?php echo $_smarty_tpl->tpl_vars['item']->value->contact_tel;?>
</td>
					<td><a href="index.php?ctr=syshotel&act=updateprofile&type=contact_tel&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
" onclick="return window.openWindow(this.href,'600','150',false,0.3)">修改</a></td>
				</tr>
				<tr>
					<td colspan="2">上月訂房總數：</td>
					<td colspan="2">本月訂房總數：</td>
				</tr>
			</table>
			<div class="item_footer">
				<a href="index.php?ctr=syshotel&act=renewal&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
" onclick="return window.openWindow(this.href,'600','400',false,0.3)">續約</a>
				<a href="index.php?ctr=syshotel&act=suspended&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->uid;?>
" onclick="if(!confirm('確定要停權這個帳號嗎？')){return false;}">停權</a>
				簽約日期：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_start,'%Y-%m-%d');?>
 至 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->sign_date_end,'%Y-%m-%d');?>

			</div>
		</div>
	</div>
	<?php } ?>
	<!-- foreach -->
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
