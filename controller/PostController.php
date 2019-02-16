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
* @ post controller
*
*/
class PostController{
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

    public function userallPost(){
        $user_id = $this->fm->validation(Session::get('id'));
        $user_id = mysqli_real_escape_string($this->db->link, $user_id);
        
        $query = "SELECT p.id, p.title, p.body,p.updated_at, u.username, u.email, c.category_name FROM posts AS p INNER JOIN users AS u ON u.id = p.user_id INNER JOIN categories AS c ON c.id = p.cat_id WHERE p.user_id = '$user_id'";

        $result = $this->db->select($query);

        if(isset($result)) return $result;

        return "post not found";
    }

}
?>