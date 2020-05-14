<?php
	// include_once '../lib/database.php';
	// include_once '../helpers/format.php';

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
	include_once ($filepath.'/../helpers/errorMessagePVS.php');
	include_once ($filepath.'/../helpers/utilsPVS.php');
?>

<?php
	/**
	 * 
	 */
	class customer
	{
		private $db;
		private $fm;
		private $ut;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
			$this->ut = new UtilsPVS();
		}

		public function insert_customer($data){
			$lastname = mysqli_real_escape_string($this->db->link, $data['lastname']);
			$firstname = mysqli_real_escape_string($this->db->link, $data['firstname']);
			$name = $lastname." ".$firstname ;
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			$confirm_password = mysqli_real_escape_string($this->db->link, md5($data['confirm_password']));
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$gender = mysqli_real_escape_string($this->db->link, $data['gender']);
			$birthday = mysqli_real_escape_string($this->db->link, $data['birthday']);
			// $country = mysqli_real_escape_string($this->db->link, $data['country']);
			// $city = mysqli_real_escape_string($this->db->link, $data['city']);
			// $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);

			if($lastname == "" || $firstname == "" || $email == "" || $address == ""  || $phone == "" || $password == "" || $gender == "" || $birthday == "") {
				$alert = "<span class='error'>".ErrorMessagePVS::CHECK_REQUIRED_FIELDS."</span>";
			} else {
				if ($password != $confirm_password) {
					$alert = "<span class='error'>".ErrorMessagePVS::PASSWORD_NOT_MATCHED."</span>";
				} else {
					$emailQuery = "SELECT * FROM tbl_customer WHERE email = '$email'";
					$emailQueryResult = $this->db->select($emailQuery);
					if($emailQueryResult) {
						$alert = "<span class='error'>This email already existed.</span>";
					} else {
						$query = "INSERT INTO tbl_customer(firstname, lastname, name, email, password, address, phone, gender, birthday) 
								VALUES('$firstname','$lastname','$name','$email','$password','$address','$phone','$gender','$birthday')";
						$result = $this->db->insert($query);
						if($result == true) {
							$alert = "<span class='success'>"._ACC_REGISTRATION_COMPLETED." <a href='login.php'>"._LOGIN."</a></span>";
							$lang = Session::get('lang');
							$this->ut->notifyUserRegistrationComplete($email, $data['password'], $name, $lang);
						} else {
							$alert = "<span class='error'>Account registration failed. </span>";
						}
					}
				}
			}
			return $alert;
		}

		public function update_customer($data){
			$id = Session::get('customer_id');
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$birthday = mysqli_real_escape_string($this->db->link, $data['birthday']);

			if($address == ""  || $phone == "" || $birthday == "") {
				$alert = "<span class='error'>Fields must be not empty.</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_customer
							SET address='$address', phone='$phone' , birthday='$birthday' 
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
					if($value['isChangedPassword'] == 0) { // never request change password before
						Session::set('customer_login',true);
						Session::set('customer_id', $value['id']);
						Session::set('customer_name', $value['name']);
						// header('Location: profile.php');
						echo "<script> location.replace('profile.php'); </script>";
					} else {//be sure user change generated password of system to their own password
						echo "<script> location.replace('updatepassword.php?id=".$value['id']."'); </script>";
					}
					
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

		public function check_customer_email($data){
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$userData = [];
			if($email == "") {
				return $userData;
			} else {
				$query = "SELECT * FROM tbl_customer WHERE email = '$email'";
				$result = $this->db->select($query);
				if($result) {
					$value = $result->fetch_assoc();
					$userData[0] = $value['name'];
					$userData[1] = $value['email'];
					$userData[2] = $value['id'];
					return $userData;
				} else {
					return $userData;
				}
			}
		}

		public function notifyResetPassword($to, $name, $id){
			$newPassword = $this->ut->randomPassword();
			$this->update_newPassword($to, md5($newPassword));
			$lang = Session::get('lang');
			$this->ut->notifyUserResetPassword($to, $name, $lang, $newPassword, $id);
		}


		public function update_newPassword($email, $password){
			$query = "UPDATE tbl_customer
							SET password='$password', isChangedPassword = 1 
							WHERE email = '$email'";
			$result = $this->db->update($query);
			if($result) {
				return true;
			} else {
				return false;
			}
		}

		public function update_newPasswordFromUser($customerId, $currentPassword, $newPassword){
			$decrypCurrentPass = md5($currentPassword);
			$decrypNewPass = md5($newPassword);
			$query = "UPDATE tbl_customer
					SET password='$decrypNewPass', isChangedPassword = 0 
					WHERE id = '$customerId' AND password = '$decrypCurrentPass'";
			$result = $this->db->update($query);
			if($result) {
				$finalQuery = "SELECT * FROM tbl_customer 
							WHERE id = '$customerId' AND password = '$decrypNewPass'";
				$finalResult = $this->db->select($finalQuery);
				if ($finalResult) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}


		//[START][2020/05/04] - Contact Us page---------------------
		public function get_all_contact_us_list() {
			$query = "SELECT * FROM tbl_contact";
			$result = $this->db->select($query);
			return $result;
		}

		public function get_all_contact_us_list_by_customer() {
			$id = Session::get('customer_id');
			if (empty($id)) {
				$id = -1;
			}
			$query = "SELECT * FROM tbl_contact WHERE customerId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function insert_contact_us_info($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$mobile = mysqli_real_escape_string($this->db->link, $data['mobile']);
			$subject = mysqli_real_escape_string($this->db->link, $data['subject']);
			$content = mysqli_real_escape_string($this->db->link, $data['content']);

			if($name == "" || $email == "" || $mobile == ""  || $subject == "" || $content == "") {
				$alert = "<span class='error'>Fields must be not empty.</span>";
				return $alert;
			} else {
				$id = Session::get('customer_id');
				$query = "";
				if (!empty($id)) {
					$query = "INSERT INTO tbl_contact(customerId, name, email, mobile, subject, content) 
							VALUES('$id','$name','$email','$mobile','$subject','$content')";
				} else {
					$query = "INSERT INTO tbl_contact(name, email, mobile, subject, content) 
							VALUES('$name','$email','$mobile','$subject','$content')";
				}
				
				$result = $this->db->insert($query);
				if($result == true) {
					$alert = "<span class='success'>Sent message successfully!</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Sending message failed!</span>";
					return $alert;
				}
			}
		}
		//[END] - Contact Us section---------------------
	}
?>