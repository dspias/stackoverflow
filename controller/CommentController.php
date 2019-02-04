<?php
	
	$filepath = realpath(dirname(__FILE__));
	// include ($filepath.'/../config/Session.php');
	// Session::checkLogin();
	
	include_once ($filepath.'/../config/Database.php');
	include_once ($filepath.'/../config/Format.php');

?>

<?php
/*
*
* @ Comment controller
*
*/
class CommentController{
    private $db;
    private $fm;

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
    }
    
    public function getAllComment($id){
        $post_id = $this->fm->validation($id);
        $post_id = mysqli_real_escape_string($this->db->link, $post_id);

        $query = "SELECT c.id, u.username, u.email, c.comment FROM comments AS c INNER JOIN users AS u ON u.id = c.user_id WHERE c.post_id = '$post_id'";

        $result = $this->db->select($query);

        if(isset($result)) return $result;

        return "comment not found";
        
    }

}
?>