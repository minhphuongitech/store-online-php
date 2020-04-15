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
	class cart
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function add_cart($prodId, $quantity) {
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$prodId = mysqli_real_escape_string($this->db->link, $prodId);
			$sId = session_id();

			$query = "SELECT * FROM tbl_product WHERE productId = $prodId";
			$result = $this->db->select($query)->fetch_assoc();
			// echo "<pre>";
			// print_r($result);
			// echo "</pre>";

			$addCartQuery = "SELECT * FROM tbl_cart WHERE productId = $prodId AND sId = '$sId'";
			$checkCartResult = $this->db->select($addCartQuery);
			if($checkCartResult) {
				$msg = "Product already added.";
				return $msg;
			} else {
				$insertQuery = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image) 
							VALUES('{$result['productId']}','$sId','{$result['productName']}','{$result['price']}','$quantity','{$result['image']}')";
				$insertResult = $this->db->insert($insertQuery);
				if($insertResult) {
					header('Location:cart.php');
				} else {
					header('Location:404.php');
				}	
			}
		}

		public function update_cart($cartId, $quantity) {
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);

			$query = "UPDATE tbl_cart 
						SET quantity = '$quantity'
						WHERE cartId = '$cartId'";
			$result = $this->db->update($query);
			if($result) {
				$alert = "<span class='success'>Updated quantity successfully.</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Cannot update quantity.</span>";
				return $alert;	
			}
		}

		public function get_product_cart() {
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function delete_cart($cartId) {
			$query = "DELETE FROM tbl_cart WHERE cartId = $cartId";
			$result = $this->db->delete($query);
			if($result == true) {
				header('Location: cart.php');
			} else {
				$alert = "<span class='error'>Delete product cart NOT successfully.</span>";
			}
			return $alert;
		}

		public function check_cart() {
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function check_ordered() {
			$customerId = Session::get('customer_id');
			$query = "SELECT * FROM tbl_order WHERE customerId = '$customerId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteAllCartBySessionId() {
			$sId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertOrder() {
			$productCart = $this->get_product_cart();
			if($productCart) {
				$i = 0;
				$customerId = Session::get('customer_id');
				while ($result = $productCart->fetch_assoc()) {
					$totalPrice = $result['price'] * $result['quantity'];
					$insertQuery = "INSERT INTO tbl_order(productId, productName, totalPrice, customerId, quantity, image) 
							VALUES('{$result['productId']}','{$result['productName']}','$totalPrice','$customerId','{$result['quantity']}','{$result['image']}')";
					$insertResult = $this->db->insert($insertQuery);
					$i++;
				}
				if($i > 0) {
					$this->deleteAllCartBySessionId();
					header('Location: ordersuccess.php');
				} else {
					header('Location: orderfail.php');
				}	
			} else {
				header('Location: orderfail.php');
			}
		}

		public function getOrder() {
			$customerId = Session::get('customer_id');
			$query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY orderDate DESC";	
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllOrder() {
			$customerId = Session::get('customer_id');
			$query = "SELECT * FROM tbl_order ORDER BY orderDate DESC";	
			$result = $this->db->select($query);
			return $result;
		}

		public function update_order($data) {
			$status = $data['status'];
			$orderId = $data['orderid'];
			$query = "UPDATE tbl_order 
						SET status = '$status'
						WHERE id = '$orderId'";
			$result = $this->db->update($query);
			if($result) {
				$alert = "<span class='success'>Updated status successfully.</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Cannot update status.</span>";
				return $alert;	
			}
		}
	}
?>