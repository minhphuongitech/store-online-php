<?php
	// include_once '../lib/database.php';
	// include_once '../helpers/format.php';

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_category($catName) {
			$catName = $this->fm->validation($catName);
			
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			

			if(empty($catName)) {
				$alert = "<span class='error'>Category must be not empty!</span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				$result = $this->db->insert($query);
				if($result == true) {
					$alert = "<span class='success'>Insert category successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert category NOT successfully</span>";
					return $alert;
				}
			}

		}

		public function show_category() {
			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id) {
			$query = "SELECT * FROM tbl_category WHERE catId = $id";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_category($catId, $catName) {

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$catId = mysqli_real_escape_string($this->db->link, $catId);

			if(empty($catName)) {
				$alert = "<span class='error'>Category must be not empty!</span>";
			} else {
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = $catId";
				$result = $this->db->update($query);
				if($result == true) {
					$alert = "<span class='success'>Update category successfully</span>";
				} else {
					$alert = "<span class='error'>Update category NOT successfully</span>";
				}
			}
			return $alert;
		}

		public function delete_category($catId) {
			$query = "DELETE FROM tbl_category WHERE catId = $catId";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete category successfully</span>";
			} else {
				$alert = "<span class='error'>Delete category NOT successfully</span>";
			}
			return $alert;
		}

		public function show_category_site() {
			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>