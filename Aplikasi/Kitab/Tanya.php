<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Tanya 
{

	function __construct() 
	{
		//$this->db = new DB_Pdo(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$this->db = new DB_Mysqli(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		//$this->crud = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	}

}
