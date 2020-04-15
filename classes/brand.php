<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_brand($brandName) {
			$brandName = $this->fm->validation($brandName);
			
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			

			if(empty($brandName)) {
				$alert = "<span class='error'>brand must be not empty!</span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
				$result = $this->db->insert($query);
				if($result == true) {
					$alert = "<span class='success'>Insert brand successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert brand NOT successfully</span>";
					return $alert;
				}
			}

		}

		public function show_brand() {
			$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandById($id) {
			$query = "SELECT * FROM tbl_brand WHERE brandId = $id";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_brand($brandId, $brandName) {

			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandId = mysqli_real_escape_string($this->db->link, $brandId);

			if(empty($brandName)) {
				$alert = "<span class='error'>brand must be not empty!</span>";
			} else {
				$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = $brandId";
				$result = $this->db->update($query);
				if($result == true) {
					$alert = "<span class='success'>Update brand successfully</span>";
				} else {
					$alert = "<span class='error'>Update brand NOT successfully</span>";
				}
			}
			return $alert;
		}

		public function delete_brand($brandId) {
			$query = "DELETE FROM tbl_brand WHERE brandId = $brandId";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete brand successfully</span>";
			} else {
				$alert = "<span class='error'>Delete brand NOT successfully</span>";
			}
			return $alert;
		}
	}
?>