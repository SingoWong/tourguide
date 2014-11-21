

var validation_ajax_count	= 0;
jQuery.fn.validation	= function (options , error , description) {
	
	var rules	= {
		required	: /^.+$/i,
		password	: /^.+$/i,
		loginname	: /^[a-z][a-z0-9-_.]+$/i,
		email		: /^([a-zA-Z0-9\._-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/i,
		nickname    : /^[a-zA-Z0-9\u4e00-\u9fa5_-]{1,30}$/i,
		phone		: /^([+][0-9]{1,2}\-)?([0-9]{0}|[0-9]{3,4})[-]{0,1}[0-9]{7,8}(\-[0-9]{1,})?$/i,
		cellphone	: /^1[0-9][0-9][0-9]{8}$/i,
		zip			: /^[0-9]{6}$/i,
		numeric		: /^[0-9]+$/i,
		idcard		: /^[1-9]([0-9]{14}|[0-9]{16}(?:[0-9]|x|X))$/i,
		domain		: /^(http:\/\/)?([a-zA-Z0-9\-]{1,}\.)+[a-zA-Z0-9]{2,4}$/i,
		float		: /^\d{1,}(\.\d{1,2})?$/i
	};
	
	var el	= $(this);
	var el_tips = el.parent('.v').next('.descrip').text();//原始的说明文字
	// 获得焦点时
	$(this).focus(function() {
		// 清除错误提示
		el.removeClass('validationError');
		el.closest('li').removeClass('gm_t1_form_error').find('.descrip').html(el_tips);
	});
	
	$(this).blur(function() {				// 失去焦点时
		return validation_check(el , rules , options , error);
	}).parents("form").submit(function() {	// 表单提交时		
		return validation_check(el , rules , options , error);
	})
	
	return $(this);
	
}

function validation_check(el , rules , options , error) {
	// 如果当前表单项已有错误消息，则不再检查
	if (el.attr('class') == 'validationError') {
		return false;
	}
	
	var result	= null;
	var validation_value	= $.trim(el.val());
	el.val(validation_value);
	
	// 检查是否有自定函数
	eval('function_exist = typeof validation_rule_' + options.rule);
	
	// 有自定义函数则通过自定义函数匹配
	if (function_exist == 'function') {
		result	= validation_check_rule(el , options , error);
		if (typeof result != 'boolean') {
			return false;
		}
	} else if (!validation_value && options.rule != 'required' && options.required != true) {
		return true;
	} else if (typeof options.check != 'undefined') {
		// 若定义了检查指定对象
		result	= $.trim($(options.check).val())?true:false;
	} else {
		eval('validation_patrn = rules.' + options.rule  + ';');
		//var reg	= new RegExp(validation_patrn , "i");
		//result	= reg.test(validation_value)?true:false;
		result = validation_patrn.test(validation_value)?true:false;
	}
	
	return validation_after_check(el, result , error);
	
}

function validation_after_check(el , result , error) {
	
	if (!result) {
		el.addClass('validationError').parent('.v').next('.descrip').text(error);
		el.closest('li').removeClass('gm_t1_form_correct').addClass('gm_t1_form_error');
	} else {
		el.removeClass('validationError').parent('.v').next('.descrip').text("");
		el.closest('li').removeClass('gm_t1_form_error').addClass('gm_t1_form_correct');
		return true;
	}
	
	return false;
}

function validation_check_rule(el , options , error) {
	eval('validation_patrn = validation_rule_' + options.rule  + '(el , options , error);');
	return validation_patrn;
}

/**
 * 验证两次输入是否一致
 * @param {Object} el
 * @param {Object} options
 */
function validation_rule_match(el , options) {
	return (el.val() == $(options.el).val())?true:false;
}

/**
 * 验证两次输入是否不一致
 * @param {Object} el
 * @param {Object} options
 */
function validation_rule_unmatch(el , options) {
	return (el.val() == $(options.el).val())?false:true;
}

function validation_rule_exist(el , options , error) {
	validation_ajax_count++;
	validation_after_check(el , false , '请稍候……');
	
	$.getJSON(options.url , {data:el.val()} , function(json) {
		validation_ajax_count--;
		if (json) {
			var result	= (json.result == 1)?false:true;
			validation_after_check(el , result , error);
		}
		
	})
	
	return true;
	//return true;
}