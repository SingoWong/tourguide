<?php
class Users extends DataMapper {
	
	public $table = 'users';
	public $primary_key = 'id';
	
	public $has_one = array('users_agency','users_hotel','users_restaurant','users_guide');
	
}
?>