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

        $user_id = $this->fm->validation($request['user_id']);
        $post_id = $this->fm->validation($request['post_id']);
        $comment = $this->fm->validation($request['postComment']);

		$user_id = mysqli_real_escape_string($this->db->link, $user_id);
		$post_id = mysqli_real_escape_string($this->db->link, $post_id);
        $comment = mysqli_real_escape_string($this->db->link, $comment);

        $query = "INSERT INTO comments (user_id, post_id, comment, created_at, updated_at)
        VALUES ('$user_id', '$post_id', '$comment', now(), now())";

        $result = $this->db->insert($query);

        $query = "SELECT c.id, u.username, u.email, c.comment, c.post_id,c.user_id, c.updated_at FROM comments AS c INNER JOIN users AS u ON u.id = c.user_id WHERE c.post_id = '$post_id' ORDER BY c.id DESC LIMIT 1";

        $data = $this->db->select($query);

        // $data = array($data);

        if($data){
            $i=0;
            $array = [];
            while($dat = $data->fetch_assoc()){
                $array[$i] = $dat;
                $i++;
            }
        }

        return $array;
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