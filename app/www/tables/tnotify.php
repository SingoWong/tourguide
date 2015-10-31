<?php
class TNotify extends DataMapper {
    
    public $table = 'notify';
    public $primary_key = 'id';
    
	var $default_order_by = array('id' => 'desc');
	
}
?>