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

    public function store($request) {

        $title = $this->fm->validation($request['title']);
        $user_id = $this->fm->validation(Session::get('id'));
        $cat_id = $this->fm->validation($request['cat_id']);
        $body = $this->fm->validation($request['body']);

		$title = mysqli_real_escape_string($this->db->link, $title);
		$user_id = mysqli_real_escape_string($this->db->link, $user_id);
		$cat_id = mysqli_real_escape_string($this->db->link, $cat_id);
        $body = mysqli_real_escape_string($this->db->link, $body);

        $query = "INSERT INTO posts (user_id, cat_id, title, body, created_at, updated_at)
        VALUES ('$user_id', '$cat_id', '$title', '$body', now(), now())";

        $result = $this->db->insert($query);

        if(isset($result)) header('location:profile.php');
		return "did not set data";
    }
    
    public function getAllComment($id){
        $post_id = $this->fm->validation($id);
        $post_id = mysqli_real_escape_string($this->db->link, $post_id);

        $query = "SELECT c.id, u.username, u.email, c.comment, c.updated_at FROM comments AS c INNER JOIN users AS u ON u.id = c.user_id WHERE c.post_id = '$post_id'";

        $result = $this->db->select($query);

        return $result;

        // return "comment not found";
        
    }

}

?>