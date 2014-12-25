<?php /* Smarty version Smarty-3.1.16, created on 2014-12-19 23:10:22
         compiled from "../../app/www/views/sysmanager/group_history.html" */ ?>
<?php /*%%SmartyHeaderCode:2634010085470a658e071c7-82687027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '788e346b0ee6f48ad8b3a1a80ccf5da9ec1898a5' => 
    array (
      0 => '../../app/www/views/sysmanager/group_history.html',
      1 => 1419001819,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2634010085470a658e071c7-82687027',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5470a658e63bf9_99290366',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470a658e63bf9_99290366')) {function content_5470a658e63bf9_99290366($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

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
function getLocalTime(start_date, day) {
	var nS = parseInt(start_date) + ((parseInt(day) - 1) * 86400);
	var now = new Date(nS);
	var year=now.getFullYear();     
	var month=now.getMonth()+1;     
    var date=now.getDate();     
    return year+"-"+month+"-"+date;
}
</script>

<div class="title_panel">
	旅行團查詢 - 歷史查詢
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="旅行團進度" onclick="self.location.href='index.php?ctr=sysgroup';">
<input type="button" class="gm_t1_btn" value="歷史查詢" onclick="self.location.href='index.php?ctr=sysgroup&act=history';">

<div class="search-inner">
<form class="gm_t1_form" id="reg_form" action="" method="GET">
	<input type="hidden" name="ctr" value="sysgroup" />
	<input type="hidden" name="act" value="history" />
	<label class="v"><input id="start_date" type="text" name="start_date" value="" placeholder="日期開始" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></label>
	<label class="v"><input id="end_date" type="text" name="end_date" value="" placeholder="日期結束" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></label>
	<label class="v"><input id="contact_name" type="text" name="contact_name" value="" placeholder="導遊"></label>
	<label class="v"><input id="code" type="text" name="code" value="" placeholder="團號"></label>
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
			團號：<?php echo $_smarty_tpl->tpl_vars['item']->value->code;?>
 &nbsp;&nbsp; 團名：<?php echo $_smarty_tpl->tpl_vars['item']->value->name;?>
 &nbsp;&nbsp; 導遊：<?php echo $_smarty_tpl->tpl_vars['item']->value->guide->name;?>
 &nbsp;&nbsp; 進度：
		</div>
		<div class="item_content" id="pnlc_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">
			<input type="hidden" id="hdn_start_date_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value->start_date;?>
" />
			<!-- schedule -->
			
		</div>
		<script type="text/javascript">
		$.ajax({
			url: "index.php?ctr=sysgroup&act=schedule&gid=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
",
			success: function(json){
				var data = eval('('+json+')');
				$.each(data,function(day,schedule){
					var date = getLocalTime($("#hdn_start_date_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
").val(), day);
					var html_day = '<div class="sub_item_title">'+
								   '<a href="#" onclick="return sh_sub_pnlc(<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
, '+day+');" id="btnc_sub_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
_'+day+'">關閉</a>'+
								   'D'+day+' &nbsp;&nbsp; '+date+' &nbsp;&nbsp;{状态}</div>'+
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
