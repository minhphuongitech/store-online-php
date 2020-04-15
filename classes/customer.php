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
	class customer
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_customer($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($name == "" || $city == ""  || $zipcode == ""  
				|| $email == "" || $address == ""  || $country == "" || $phone == "" || $password == "") {
				$alert = "<span class='error'>Fields must be not empty.</span>";
				return $alert;
			} else {
				$emailQuery = "SELECT * FROM tbl_customer WHERE email = '$email'";
				$emailQueryResult = $this->db->select($emailQuery);
				if($emailQueryResult) {
					$alert = "<span class='error'>This email already existed.</span>";
					return $alert;
				} else {
					$query = "INSERT INTO tbl_customer(name, city, zipcode, email, address, country, phone, password) 
							VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
					$result = $this->db->insert($query);
					if($result == true) {
						$alert = "<span class='success'>Account registration completed.</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Account registration failed. </span>";
						return $alert;
					}
				}
			}
		}

		public function update_customer($data){
			$id = Session::get('customer_id');
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			// $country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);

			if($name == "" || $city == ""  || $zipcode == "" || $address == ""  || $phone == "") {
				$alert = "<span class='error'>Fields must be not empty.</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_customer
							SET name='$name', city='$city', zipcode='$zipcode', address='$address', phone='$phone' 
							WHERE id = '$id'";
				$result = $this->db->update($query);
				if($result) {
					$alert = "<span class='success'>Profile updated successfully.</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Profile update failed. </span>";
					return $alert;
				}
			}
		}

		public function check_customer($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($email == "" || $password == "") {
				$alert = "<span class='error'>Email and Password are required.</span>";
				return $alert;
			} else {
				$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
				$result = $this->db->select($query);
				if($result) {
					$value = $result->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id', $value['id']);
					Session::set('customer_name', $value['name']);
					header('Location: profile.php');
				} else {
					$alert = "<span class='error'>Email and Password are not matched.</span>";
					return $alert;
				}
			}
		}

		public function get_customer_info() {
			$id = Session::get('customer_id');
			$query = "SELECT * FROM tbl_customer WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCustomerById($customerId) {
			$id = Session::get('customer_id');
			$query = "SELECT * FROM tbl_customer WHERE id = '$customerId'";
			$result = $this->db->select($query);
			return $result;
		}


	}
?>