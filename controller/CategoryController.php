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
* @ Category controller
*
*/
class CategoryController{
    private $db;
    private $fm;

	public function __construct() {
		$this->db = new Database();
        $this->fm = new Format();
	}
	
	public function setCategory($request){
		$category = $this->fm->validation($request['category']);

		$category = mysqli_real_escape_string($this->db->link, $category);

		$query = "INSERT INTO categories (category_name) VALUES('$category')";

		$result = $this->db->insert($query);

		if(isset($result)) header('location: category.php');
		return "did not set data";
		

	}

	public function getAllCategory(){
		$query = "SELECT * FROM categories";

		$result = $this->db->select($query);

		if(isset($result)) return $result;
		return "did not get data";	

	}

	public function updateCategory($request, $id){
		$category = $this->fm->validation($request['category']);
		$id = $this->fm->validation($id);

		$category = mysqli_real_escape_string($this->db->link, $category);
		$id = mysqli_real_escape_string($this->db->link, $id);

		// $query = asfd;

	}

	public function deleteCategory($id) {
		$id = $this->fm->validation($id);
		$id = mysqli_real_escape_string($this->db->link, $id);

		$query = "DELETE FROM categories WHERE id= '$id'";

		$result = $this->db->delete($query);

		if(isset($result)) return $result;

		return "category not deleted";
	}

    
}

?>