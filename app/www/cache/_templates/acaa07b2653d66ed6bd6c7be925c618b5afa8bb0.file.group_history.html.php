<?php /* Smarty version Smarty-3.1.16, created on 2014-12-21 14:18:04
         compiled from "../../app/www/views/agency/group_history.html" */ ?>
<?php /*%%SmartyHeaderCode:18585209585478c3e6f09956-52902455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acaa07b2653d66ed6bd6c7be925c618b5afa8bb0' => 
    array (
      0 => '../../app/www/views/agency/group_history.html',
      1 => 1419142679,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18585209585478c3e6f09956-52902455',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5478c3e70a5263_80231514',
  'variables' => 
  array (
    'rowset' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5478c3e70a5263_80231514')) {function content_5478c3e70a5263_80231514($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("_common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="./libs/jquery/core.date.js"></script>

<script type="text/javascript">
function sh_pnlc(id) {
	if ($("#pnlc_"+id).css("display") == "none") {
		$("#pnlc_"+id).show();
		$("#btnc_"+id).html("關閉");
	} else {
		$("#pnlc_"+id).hide();
		$("#btnc_"+id).html("展开");
	}
	return false;
}
function sh_sub_pnlc(id, day) {
	if ($("#pnlc_sub_"+id+"_"+day).css("display") == "none") {
		$("#pnlc_sub_"+id+"_"+day).show();
		$("#btnc_sub_"+id+"_"+day).html("關閉");
	} else {
		$("#pnlc_sub_"+id+"_"+day).hide();
		$("#btnc_sub_"+id+"_"+day).html("展开");
	}
	return false;
}
function getLocalTime(start_date, day) {
	var nS = parseInt(start_date) + ((parseInt(day) - 1) * 86400);
	var now = new Date(nS*1000);
	var year=now.getFullYear();     
	var month=now.getMonth()+1;     
    var date=now.getDate();
    
    return year+"-"+month+"-"+date;
}
</script>
<style type="text/css">
.sub_item_title {
	background: #66CCCC url(/theme/images/sbg_line.png) 11px top repeat-y!important;
	background-size: 12px!important;
	padding-left: 2px!important;
}
.sub_item_title em {
	display: block;
	width: 30px;
	height: 30px;
	border-radius: 30px;
	background: #E8AF28;
	float: left;
	margin-right: 6px;
	text-align: center;
	color: #FFF;
	font-size: 12px;
}
.schedule_table tr td.l {
	background: #FFF url(/theme/images/sbg_line.png) 10px top repeat-y!important;
	background-size: 12px!important;
}
.schedule_table tr td.l .t {
	display: block;
	width: 25px;
	height: 25px;
	border-radius: 25px;
	background: #028FD7;
	float: left;
	margin-right: 10px;
	text-align: center;
	color: #FFF;
	font-size: 12px;
}
.schedule_table tr td.l .t_0:before {
	content: "機";
}
.schedule_table tr td.l .t_1:before {
	content: "景";
}
.schedule_table tr td.l .t_2:before {
	content: "中";
}
.schedule_table tr td.l .t_3:before {
	content: "晚";
}
.schedule_table tr td.l .t_4:before {
	content: "住";
}
</style>

<div class="title_panel">
	旅行團進度 - 歷史查詢
</div>

<input type="button" class="gm_t1_btn_alt_disabled" value="旅行团进度" onclick="self.location.href='index.php?ctr=sysagency&act=groupprogress';">
<input type="button" class="gm_t1_btn" value="历史查询" onclick="self.location.href='index.php?ctr=sysagency&act=grouphistory';">

<div class="search-inner">
<form class="gm_t1_form" id="reg_form" action="" method="GET">
	<input type="hidden" name="ctr" value="sysagency" />
	<input type="hidden" name="act" value="grouphistory" />
	<label class="v"><input id="start_date" type="text" name="start_date" value="" placeholder="日期開始" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></label>
	<label class="v"><input id="end_date" type="text" name="end_date" value="" placeholder="日期結束" onclick="JTC.setday(this,this,'yyyy-MM-dd',0,1)"></label>
	<label class="v"><input id="guide" type="text" name="guide" value="" placeholder="導遊"></label>
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
			url: "index.php?ctr=sysagency&act=schedule&gid=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
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
								   '<em>D'+day+'</em> '+date+' &nbsp;&nbsp;{狀態}</div>'+
								   '<div class="sub_item_content" id="pnlc_sub_<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
_'+day+'">'+
								   '<table border="0" width="100%" cellpadding="2" cellspacing="1" class="schedule_table">';
			 					 
					$.each(schedule,function(route,item){
						switch (item['type']) {
						case '0':
						case '1':
							html_day += '<tr><td colspan="5" class="l"><em class="t t_'+item['type']+'"></em>'+item['time']+'&nbsp;&nbsp;'+item['location']+'&nbsp;&nbsp;{鉤}</td></tr>';
							break;
						case '2':
						case '3':
							html_day += '<tr><td class="l"><em class="t t_'+item['type']+'"></em>'+item['time']+'&nbsp;&nbsp;'+item['location']+'</td><td class="s_status">已訂餐{鉤}</td><td class="s_status">已訂餐未確認{鉤}</td><td class="s_status">已訂餐已確認{鉤}</td><td class="s_status">餐畢付款{鉤}</td></tr>';
							break;
						case '4':
							html_day += '<tr><td class="l"><em class="t t_'+item['type']+'"></em>'+item['time']+'&nbsp;&nbsp;'+item['location']+'</td><td class="s_status">已訂房{鉤}</td><td class="s_status">CHKIN{鉤}</td><td class="s_status">未結帳{鉤}</td><td class="s_status">CHKOUT{鉤}</td></tr>';
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
