<?php /* Smarty version Smarty-3.1.16, created on 2014-12-19 23:07:27
         compiled from "../../app/www/views/sysmanager/group_manager.html" */ ?>
<?php /*%%SmartyHeaderCode:14466150675470a65747d4b5-77261803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd14eb6c1a73751e4f02b49d1fe0a5578b4346199' => 
    array (
      0 => '../../app/www/views/sysmanager/group_manager.html',
      1 => 1418918261,
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
function sh_sub_pnlc(id, day) {
	if ($("#pnlc_sub_"+id+"_"+day).css("display") == "none") {
		$("#pnlc_sub_"+id+"_"+day).show();
		$("#btnc_sub_"+id+"_"+day).htm("關閉");
	} else {
		$("#pnlc_sub_"+id+"_"+day).hide();
		$("#btnc_sub_"+id+"_"+day).htm("展開");
	}
	return false;
}
</script>

<div class="title_panel">
	旅行團查詢 - 進度
</div>

<input type="button" class="gm_t1_btn" value="旅遊團進度" onclick="self.location.href='index.php?ctr=sysgroup';">
<input type="button" class="gm_t1_btn_alt_disabled" value="歷史查詢" onclick="self.location.href='index.php?ctr=sysgroup&act=history';">

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
			團號：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
 &nbsp;&nbsp; 團名：<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
 &nbsp;&nbsp; 導遊：<?php echo $_smarty_tpl->tpl_vars['item']->value->guide->name;?>
 &nbsp;&nbsp; 進度：
		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			
			<!-- schedule -->
			
		</div>
		<script type="text/javascript">
		$.ajax({
			url: "index.php?ctr=sysgroup&act=schedule&gid=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
",
			success: function(json){
				var data = eval('('+json+')');
				$.each(data,function(day,schedule){
					var html_day = '<div class="sub_item_title">'+
								   '<a href="#" onclick="return sh_sub_pnlc(<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
, '+day+');" id="btnc_sub_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
_'+day+'">關閉</a>'+
								   'D'+day+' &nbsp;&nbsp; {日期} &nbsp;&nbsp;{状态}</div>'+
								   '<div class="sub_item_content" id="pnlc_sub_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
_'+day+'">'+
								   '<table border="0" width="100%" cellpadding="2" cellspacing="1">';
			 					 
					$.each(schedule,function(route,item){
						switch (item['type']) {
						case '0':
						case '1':
						case '2':
							html_day += '<tr><td colspan="5">'+item['time']+'&nbsp;&nbsp;'+item['location']+'&nbsp;&nbsp;{钩}</td></tr>';
							break;
						case '3':
						case '4':
							html_day += '<tr><td>'+item['time']+'&nbsp;&nbsp;'+item['location']+'</td><td class="s_status">已訂餐{钩}</td><td class="s_status">已訂餐未確認{钩}</td><td class="s_status">已訂餐已確認{钩}</td><td class="s_status">餐畢付款{钩}</td></tr>';
							break;
						case '5':
							html_day += '<tr><td>'+item['time']+'&nbsp;&nbsp;'+item['location']+'</td><td class="s_status">已訂房{钩}</td><td class="s_status">CHKIN{钩}</td><td class="s_status">未結帳{钩}</td><td class="s_status">CHKOUT{钩}</td></tr>';
							break;
						}
					});
						
					html_day += '</table></div>';
					
					$("#pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
").append(html_day);
				});
			}
		});
		</script>
	</div>
	<?php } ?>
	<!-- foreach -->
</div>
	
<?php echo $_smarty_tpl->getSubTemplate ("_common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
