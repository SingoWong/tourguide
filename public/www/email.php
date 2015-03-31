<?php

require dirname ( __FILE__ ) . '/aws/aws-autoloader.php';
		
$config = array(
			'key'    => 'AKIAI4ZGEP27U6LPPCRA',
			'secret' => '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',
			'region' => 'ap-southeast-1');
			
$aws = Aws\Common\Aws::factory($config);
$sns = $aws->get("Sns");

//$re = $sns->createTopic(array('Name'=>'test_topic'));
//var_dump($re);

//arn:aws:sns:ap-southeast-1:695614020375:Change_Bulletin
//arn:aws:sns:ap-southeast-1:695614020375:Change_Bulletin:6e7e1438-b8d1-4324-a77a-1bd6b8169bf0 => heisapp201501@gmail.com
$rowset = array(
	'TopicArn'=>'arn:aws:sns:ap-southeast-1:695614020375:Change_Bulletin',
	'Subject'=>'message title from sdk',
	'Message'=>'message from sdk'
);

$sns->publish($rowset);
?>