<?php
	
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../config/Session.php');
	Session::checkLogin();
	
	include_once ($filepath.'/../config/Database.php');
	include_once ($filepath.'/../config/Format.php');

?>

<?php
/*
*
* @ Category controller
*
*/
class Category{
    private $db;
    private $fm;

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
    }

    
}

?>