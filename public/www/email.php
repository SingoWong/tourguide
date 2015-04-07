<?php
require dirname ( __FILE__ ) . '/../../core/libraries/aws/aws-autoloader.php';
$config = array('key'=>'AKIAI4ZGEP27U6LPPCRA','secret'=>'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','region'=>'ap-southeast-1');
$aws = Aws\Common\Aws::factory($config);
$sns = $aws->get("Sns");

//$rowset = array(
//	'Endpoint'=>'singochina@gmail.com',
//	'Protocol'=>'email',
//	'TopicArn'=>'arn:aws:sns:ap-southeast-1:695614020375:Guide'
//);
//$re = $sns->subscribe($rowset);
//var_dump($re);

//$rowset = array(
//	'TargetArn'=>'arn:aws:sns:ap-southeast-1:695614020375:Guide:8ae2d501-24df-496d-9621-132cc87d2f2d',
//	'Subject'=>'test',
//	'Message'=>'message'
//);
//$sns->publish($rowset);

//$rowset = array(
//	'TopicArn'=>'arn:aws:sns:ap-southeast-1:695614020375:Guide'
//);
//$re = $sns->listSubscriptionsByTopic($rowset);
//var_dump($re['Subscriptions']);

$rowset = array(
	'Name'=>'Guide_E123454321'
);
$re = $sns->createTopic($rowset);
$topicarn = $re['TopicArn'];

$rowset = array(
	'Endpoint'=>'singochina@gmail.com',
	'Protocol'=>'email',
	'TopicArn'=>$topicarn
);
$re = $sns->subscribe($rowset);
var_dump($re);
?>