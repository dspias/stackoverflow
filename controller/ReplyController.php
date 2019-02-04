<?php
/*
*
* @ Reply controller
*
*/
class ReplyController{
    private $db;
    private $fm;

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
    }
    
    public function getAllReply($id){
        
    }

}
?>