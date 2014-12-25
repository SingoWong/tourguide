<?php /* Smarty version Smarty-3.1.16, created on 2014-12-16 04:05:35
         compiled from "../../app/www/views/guide/restaurant_detail.html" */ ?>
<?php /*%%SmartyHeaderCode:216729511547ded392d2ed7-81322712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f923e4faa7486aec2bdab43ec16a0bb52d4b45e' => 
    array (
      0 => '../../app/www/views/guide/restaurant_detail.html',
      1 => 1418673299,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216729511547ded392d2ed7-81322712',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_547ded39359001_17577930',
  'variables' => 
  array (
    'url_menu' => 0,
    'url_info' => 0,
    'url_restaurant' => 0,
    'url_hotel' => 0,
    'url_accident' => 0,
    'date' => 0,
    'type' => 0,
    'rname' => 0,
    'aname' => 0,
    'code' => 0,
    'gname' => 0,
    'amount' => 0,
    'url_restaurant_submit' => 0,
    'gid' => 0,
    'day' => 0,
    'route' => 0,
    'rid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547ded39359001_17577930')) {function content_547ded39359001_17577930($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>訂餐明細</title>
		
		<?php echo $_smarty_tpl->getSubTemplate ("_common/minclude.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		
		<script type="text/javascript">
		$(document).ready(function(){
			calc_total();
		});
		function onset_amount(i) {
			var amount = parseInt($("#lbl_amount").html());
			amount += i;
			$("#lbl_amount").html(amount);
			$("#amount").val(amount);
			
			calc_total();
		}
		
		function onset_unit(i) {
			var amount = parseInt($("#lbl_unit").html());
			amount += i;
			$("#lbl_unit").html(amount);
			$("#unit").val(amount);
			
			calc_total();
		}
		
		function calc_total() {
			var total = parseInt($("#lbl_amount").html()) * parseInt($("#lbl_unit").html());
			$("#lbl_total").html(total);
		}
		</script>
		<style type="text/css">
			.restaurant-detail {
				border-bottom: 1px dotted #CCC;
			}
			.restaurant-detail p a {
				display: inline-block;
				height: 40px;
				line-height: 40px;
				width: 40px;
				text-align: center;
				border: 1px solid #CCC;
			}
			.restaurant-detail p em {
				display: inline-block;
				height: 40px;
				line-height: 40px;
				width: 60px;
				text-align: center;
			}
			.info-detail h3 {
				background: #CCC!important;
				padding: 10px!important;
				border-radius: 5px!important;
				text-align: center;
				font-size: 16px;
			}
			.attention {
				padding: 5px;
			}
			.attention textarea {
				border: 1px solid #CCC;
				border-radius: 5px;
			}
			h5.mui-content-padded {
				padding: 10px!important;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
"></a>
			<a class="mui-icon mui-icon-gear mui-pull-right"></a>
			<div class="quick-nav">
				<div id="sc-nav" class="mui-segmented-control">
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_info']->value;?>
'">團號</a>
					<a class="mui-control-item mui-active" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
'">訂餐</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_hotel']->value;?>
'">訂房</a>
					<a class="mui-control-item" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['url_accident']->value;?>
'">意外</a>
				</div>
			</div>
		</header>
		<div class="mui-content">
			<div class="info-detail">
				<h3>訂餐資訊</h3>
				<div class="restaurant-detail">
					<p>日期：<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</p>
					<p>餐別：<?php if ($_smarty_tpl->tpl_vars['type']->value=='2') {?>中餐<?php } elseif ($_smarty_tpl->tpl_vars['type']->value=='3') {?>晚餐<?php }?></p>
					<p>餐廳名稱：<?php echo $_smarty_tpl->tpl_vars['rname']->value;?>
</p>
					<p>旅行社：<?php echo $_smarty_tpl->tpl_vars['aname']->value;?>
</p>
					<p>團號：<?php echo $_smarty_tpl->tpl_vars['code']->value;?>
</p>
					<p>導遊：<?php echo $_smarty_tpl->tpl_vars['gname']->value;?>
</p>
					<p>人數：<a href="#" onclick="onset_amount(-1);return false;">－</a><em id="lbl_amount"><?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
</em><a href="#" onclick="onset_amount(1);return false;">＋</a> 人</p>
					<p>餐標：<a href="#" onclick="onset_unit(-50);return false;">－</a><em id="lbl_unit">150</em><a href="#" onclick="onset_unit(50);return false;">＋</a> 元</p>
					<p>金額：<em id="lbl_total">0</em></p>
					<br/>
				</div>
				
				
				<form class="mui-input-group" action="<?php echo $_smarty_tpl->tpl_vars['url_restaurant_submit']->value;?>
" method="post">
					<input type="hidden" name="amount" id="amount" value="<?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
" />
					<input type="hidden" name="unit" id="unit" value="500" />
					<h5 class="mui-content-padded">用餐時間</h5>
					<div class="restaurant-eattime">
						<div class="mui-card">
							<?php if ($_smarty_tpl->tpl_vars['type']->value=='2') {?>
							<div class="mui-input-row mui-radio mui-left">
								<label>[11:00]</label>
								<input name="eattime" type="radio" value="11:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[11:30]</label>
								<input name="eattime" type="radio" value="11:30">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[12:00]</label>
								<input name="eattime" type="radio" value="12:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[12:30]</label>
								<input name="eattime" type="radio" value="12:30">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[13:00]</label>
								<input name="eattime" type="radio" value="13:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[13:30]</label>
								<input name="eattime" type="radio" value="13:30">
							</div>
							<?php } elseif ($_smarty_tpl->tpl_vars['type']->value=='3') {?>
							<div class="mui-input-row mui-radio mui-left">
								<label>[17:00]</label>
								<input name="eattime" type="radio" value="17:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[17:30]</label>
								<input name="eattime" type="radio" value="17:30">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[18:00]</label>
								<input name="eattime" type="radio" value="18:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[18:30]</label>
								<input name="eattime" type="radio" value="18:30">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[19:00]</label>
								<input name="eattime" type="radio" value="19:00">
							</div>
							<div class="mui-input-row mui-radio mui-left">
								<label>[19:30]</label>
								<input name="eattime" type="radio" value="19:30">
							</div>
							<?php }?>
						</div>
					</div>
					<h5 class="mui-content-padded">注意事項</h5>
					<div class="restaurant-option">
						<div class="attention"><textarea name="attention" placeholder="這裏填寫注意事項"></textarea></div>
						<div class="mui-card">
							<div class="mui-input-row mui-checkbox mui-left">
								<label>重鹹</label>
								<input name="note[]" type="checkbox" value="重鹹">
							</div>
							<div class="mui-input-row mui-checkbox mui-left">
								<label>重油</label>
								<input name="note[]" type="checkbox" value="重油">
							</div>
							<div class="mui-input-row mui-checkbox mui-left">
								<label>重辣</label>
								<input name="note[]" type="checkbox" value="重辣">
							</div>
							<div class="mui-input-row mui-checkbox mui-left">
								<label>勿糖</label>
								<input name="note[]" type="checkbox" value="勿糖">
							</div>
							<div class="mui-input-row mui-checkbox mui-left">
								<label>勿辣</label>
								<input name="note[]" type="checkbox" value="勿辣">
							</div> 
							<div class="mui-input-row mui-checkbox mui-left">
								<label>備公筷洗碗水</label>
								<input name="note[]" type="checkbox" value="備公筷洗碗水">
							</div>
							<div class="mui-input-row mui-checkbox mui-left">
								<label>麵食</label>
								<input name="note[]" type="checkbox" value="麵食">
							</div>
						</div>
					</div>
					<input type="hidden" name="gid" value="<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
" />
					<input type="hidden" name="day" value="<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
" />
					<input type="hidden" name="route" value="<?php echo $_smarty_tpl->tpl_vars['route']->value;?>
" />
					<input type="hidden" name="rid" value="<?php echo $_smarty_tpl->tpl_vars['rid']->value;?>
" />
					<button class="mui-btn mui-btn-primary mui-btn-block btn-signin">確認訂餐</button>
				</form>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab">
		  <a class="mui-tab-item" href="<?php echo $_smarty_tpl->tpl_vars['url_restaurant']->value;?>
">
		    訂餐資訊
		  </a>
		  <a class="mui-tab-item mui-active" href="#">
		    餐廳搜尋
		  </a>
		</nav>
	</body>
</html>
<?php }} ?>
