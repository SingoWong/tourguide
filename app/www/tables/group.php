<?php
class Group extends DataMapper {
    
    public $table = 'group';
    public $primary_key = 'id';
    
    public $has_one = array('group_room','group_info');
    public $has_many = array('group_schedule');
    
}
?>