<?php
class Group_Schedule extends DataMapper {
    
    public $table = 'group_schedule';
    public $primary_key = 'id';
    public $default_order_by = array('id'=>'asc', 'day'=>'asc', 'route'=>'asc');
}
?>