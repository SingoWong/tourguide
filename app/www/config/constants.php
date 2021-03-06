<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('SKEY_RBAC_USER', 'rbac_user');
define('SKEY_RBAC_ROLE', 'rbac_role');

define('SECRET_KEY',"Nzg5ZjVmMjI0ZmI2MmE5YmY3ZGI2ODlmM2JiYjU4ZTk=");
define('ROLE_ID_ADMIN', '1');
define('ROLE_ID_GUIDE', '24');
define('ROLE_ID_RESTAURANT', '28');
define('ROLE_ID_HOTEL', '30');
define('ROLE_ID_AGENCY', '31');
define('ROLE_ID_LEADER', '32');
define('ROLE_ID_UNION', '33');
define('ROLE_ID_EMBRATUR', '34');
define('ROLE_ID_INSURANCE', '35');
define('ROLE_ID_REINSURANCE', '36');
define('ROLE_ID_ASSISTANCE', '37');
define('ROLE_ID_PASSENGER', '38');
define('ROLE_ID_FAMILY', '39');

define('UNION_USERNAME', 'union');
define('EMBRATUR_USERNAME', 'taiwan');

define('UPLOAD_PATH', 'uploads');
define('RES_SERVER', 'http://www.heiscloud.com');

//餐廳行程狀態
define('STATUS_R_PANDING', '0'); //未訂餐
define('STATUS_R_BOOKED', '1'); //已訂餐未確認
define('STATUS_R_CONFIRM', '2'); //已訂餐已確認
define('STATUS_R_PAYMENT', '3'); //已結帳
define('STATUS_R_CANCEL', '4'); //已取消

//飯店行程狀態
define('STATUS_H_PANDING', '0'); //未訂房
define('STATUS_H_BOOKED', '1'); //已訂房未確認
define('STATUS_H_CONFIRM', '2'); //已訂餐已確認
define('STATUS_H_PAYMENT', '3'); //已結帳
define('STATUS_H_CANCEL', '4'); //已取消

//餐廳訂單狀態
define('STATUS_RORDER_PANDING', '0'); //已下單未確認
define('STATUS_RORDER_CONFIRM', '1'); //已下單已確認
define('STATUS_RORDER_UNDERWAY', '2');//用餐中
define('STATUS_RORDER_PAYMENG', '3'); //已結帳
define('STATUS_RORDER_CANCEL', '4');  //已取消

//飯店訂單狀態
define('STATUS_HORDER_PANDING', '0'); //已下單未確認
define('STATUS_HORDER_CONFIRM', '1'); //已下單已確認
define('STATUS_HORDER_CHKIN', '2');   //到店CHKIN
define('STATUS_HORDER_CHKOUT', '3');  //CHKOUT結帳
define('STATUS_HORDER_CANCEL', '4');  //已取消

//AWS设置
define('AWS_KEY', 'AKIAI4ZGEP27U6LPPCRA');
define('AWS_SECRET', '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');
define('AWS_REGION', 'ap-southeast-1');
define('AWS_SNS_TOPIC_ARN_BULLETIN', 'arn:aws:sns:ap-southeast-1:695614020375:Change_Bulletin');
define('AWS_SNS_TOPIC_ARN_UNION', 'arn:aws:sns:ap-southeast-1:695614020375:Change_union');
define('AWS_SNS_TOPIC_ARN_DT', 'arn:aws:sns:ap-southeast-1:695614020375:Change_DT');

/* End of file constants.php */
/* Location: ./application/config/constants.php */