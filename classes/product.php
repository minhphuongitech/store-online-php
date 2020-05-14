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
	//define("MAX_IMG_SIZE", 2097152);
	//const MAX_IMG_SIZE = 2097152; 
	class product
	{
		private $db;
		private $fm;
		const MAX_IMG_SIZE = 2097152; 

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_product($data, $files) {
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName == "" || $category == ""  || $brand == ""  
				|| $product_desc == "" || $price == ""  || $type == "" || $file_name == "") {
				$alert = "<span class='error'>Fields must be not empty!</span>";
				return $alert;
			} else {
				if($file_size > 2097152) {// file size > 2MB
					$alert = "<span class='error'>Image size must be less than 2Mb!</span>";
					return $alert;
				} elseif(in_array($file_ext, $permited) === false) {// === so sanh kieu, ham in_array cung tra ra false
					$alert = "<span class='error'>You can only upload:".implode(', ', $permited)."!</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, price, type, image) 
							VALUES('$productName','$category','$brand','$product_desc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result == true) {
					$alert = "<span class='success'>Insert product successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert product NOT successfully</span>";
					return $alert;
				}
			}

		}

		public function insert_slider($data, $files) {
			
			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$status = mysqli_real_escape_string($this->db->link, $data['status']);

			//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($title == "" || $status == "") {
				$alert = "<span class='error'>Fields must be not empty!</span>";
				return $alert;
			} else {
				if($file_size > 2097152) {// file size > 2MB
					$alert = "<span class='error'>Image size must be less than 2Mb!</span>";
					return $alert;
				} elseif(in_array($file_ext, $permited) === false) {// === so sanh kieu, ham in_array cung tra ra false
					$alert = "<span class='error'>You can only upload:".implode(', ', $permited)."!</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_slider(sliderName, sliderImage, status) 
							VALUES('$title','$unique_image','$status')";
				$result = $this->db->insert($query);
				if($result == true) {
					$alert = "<span class='success'>Insert slider successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Insert slider NOT successfully</span>";
					return $alert;
				}
			}

		}

		public function update_product($data, $files, $productId) {
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName == "" || $category == ""  || $brand == ""  
				|| $product_desc == "" || $price == ""  || $type == "") {
				$alert = "<span class='error'>Fields must be not empty!</span>";
				return $alert;
			} else {
				if(!empty($file_name)) {// upload new image
					if($file_size > 2097152) {// file size > 2MB
						$alert = "<span class='error'>Image size must be less than 2Mb!</span>";
						return $alert;
					} elseif(in_array($file_ext, $permited) === false) {//so sanh kieu, ham in_array cung tra ra false
						$alert = "<span class='error'>You can only upload:".implode(', ', $permited)."!</span>";
						return $alert;
					}
					$query = "UPDATE tbl_product 
								SET productName = '$productName', 
									catId = $category, 
									brandId = $brand, 
									product_desc = '$product_desc', 
									price = $price, 
									type = $type, 
									image = '$unique_image'
								WHERE productId = $productId";
				} else {
					$query = "UPDATE tbl_product 
							SET productName = '$productName', 
								catId = $category, 
								brandId = $brand, 
								product_desc = '$product_desc', 
								price = $price, 
								type = $type 
							WHERE productId = $productId";
				}
				move_uploaded_file($file_temp, $uploaded_image);
				$result = $this->db->update($query);
				if($result == true) {
					$alert = "<span class='success'>Update product successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Update product NOT successfully</span>";
					return $alert;
				}
			}

		}

		public function update_slider($data, $files, $sliderId) {
			
			$title = mysqli_real_escape_string($this->db->link, $data['title']);
			$status = mysqli_real_escape_string($this->db->link, $data['status']);

			//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($title == "" || $status == "") {
				$alert = "<span class='error'>Fields must be not empty!</span>";
				return $alert;
			} else {
				if(!empty($file_name)) {// upload new image
						if($file_size > 2097152) {// file size > 2MB
							$alert = "<span class='error'>Image size must be less than 2Mb!</span>";
							return $alert;
						} elseif(in_array($file_ext, $permited) === false) {//so sanh kieu, ham in_array cung tra ra false
							$alert = "<span class='error'>You can only upload:".implode(', ', $permited)."!</span>";
							return $alert;
						}
						$query = "UPDATE tbl_slider 
									SET sliderName = '$title', 
										sliderImage = '$unique_image', 
										status = $status
									WHERE sliderId = $sliderId";
					} else {
						$query = "UPDATE tbl_slider 
									SET sliderName = '$title',
										status = $status
									WHERE sliderId = $sliderId";
					}
					move_uploaded_file($file_temp, $uploaded_image);
					$result = $this->db->update($query);
					if($result == true) {
						$alert = "<span class='success'>Update slider successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Update slider NOT successfully</span>";
						return $alert;
					}
			}

		}

		public function update_slider_status($sliderId, $status) {
			
			$query = "UPDATE tbl_slider 
								SET status = '$status'
								WHERE sliderId = '$sliderId'";
			$result = $this->db->update($query);
			if($result == true) {
				$alert = "<span class='success'>Update status successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Update status NOT successfully</span>";
				return $alert;
			}
		}

		public function show_product() {
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_product_by_keyword($keyword) {
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 WHERE tbl_product.productName like '%$keyword%' OR 
					 		tbl_product.product_desc like '%$keyword%' OR 
					 		tbl_brand.brandName like '%$keyword%' OR 
					 		tbl_category.catName like '%$keyword%'
					 ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_slider() {
			$query = "SELECT *
					 FROM tbl_slider
					 ORDER BY sliderId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_featured_product() {
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 WHERE type = 1
					 ORDER BY tbl_product.productId DESC
					 LIMIT 5";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_new_product() {
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 ORDER BY tbl_product.productId DESC
					 LIMIT 5";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_all_product() {
			$query = "SELECT * FROM tbl_product";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_product_paging($pageOrder) {
			$itemsPerPage = ConstantPVS::ITEMS_PER_PAGE;
			$pageOrder -= 1;
			$nextRecord = $pageOrder * $itemsPerPage;
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 ORDER BY tbl_product.productId DESC
					 LIMIT $nextRecord,$itemsPerPage";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($productId) {
			$query = "SELECT tbl_product.*, tbl_category.*, tbl_brand.*
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 WHERE productId = $productId
					 ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_slider_by_id($sliderId) {
			$query = "SELECT *
					 FROM tbl_slider
					 WHERE sliderId = '$sliderId'
					 ORDER BY sliderId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_actived_slider() {
			$query = "SELECT *
					 FROM tbl_slider
					 WHERE status = '1'
					 ORDER BY sliderId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delete_product($productId) {
			$query = "DELETE FROM tbl_product WHERE productId = $productId";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete product successfully</span>";
			} else {
				$alert = "<span class='error'>Delete product NOT successfully</span>";
			}
			return $alert;
		}

		public function delete_slider($sliderId) {
			$query = "DELETE FROM tbl_slider WHERE sliderId = $sliderId";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete slider successfully</span>";
			} else {
				$alert = "<span class='error'>Delete slider NOT successfully</span>";
			}
			return $alert;
		}

		public function getLastest($brandId) {
			$query = "SELECT tbl_product.*, tbl_category.*, tbl_brand.*
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 WHERE tbl_brand.brandId = '$brandId'
					 ORDER BY tbl_product.productId DESC
					 LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductsByCategory($catId) {
			$query = "SELECT tbl_product.*, tbl_category.*, tbl_brand.*
					 FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					 INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					 WHERE tbl_category.catId = '$catId'
					 ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function addProductCompare($prodId) {
			$prodId = mysqli_real_escape_string($this->db->link, $prodId);
			$customerId = Session::get('customer_id');

			$compareQuery = "SELECT * FROM tbl_compare WHERE productId = $prodId";
			$compareResult = $this->db->select($compareQuery);

			if($compareResult) {
				$msg = "<span class='error'>Product already added to compare list.</span>";
				return $msg;
			} else {
				$productQuery = "SELECT * FROM tbl_product WHERE productId = $prodId";
				$productResult = $this->db->select($productQuery);
				if($productResult) {
					$result = $productResult->fetch_assoc();
					$insertQuery = "INSERT INTO tbl_compare(customerId, productId, productName, price, image) 
							VALUES('$customerId','{$result['productId']}','{$result['productName']}','{$result['price']}','{$result['image']}')";
					$insertResult = $this->db->insert($insertQuery);
					if($insertResult) {
						$msg = "<span class='success'>Product added to compare list.</span>";
						return $msg;
					} else {
						// header('Location:404.php');
						echo "<script> location.replace('404.php'); </script>";
					}	
				} else {
					// header('Location:404.php');
					echo "<script> location.replace('404.php'); </script>";
				}
				
			}
		}

		public function getProductCompareByCustomer($customerId) {
			$compareQuery = "SELECT * FROM tbl_compare WHERE customerId = '$customerId'";
			$compareResult = $this->db->select($compareQuery);
			return $compareResult;
		}

		public function deleteProductCompare($productId, $customerId) {
			$query = "DELETE FROM tbl_compare WHERE productId = '$productId' AND customerId = '$customerId'";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete product successfully</span>";
			} else {
				$alert = "<span class='error'>Delete product NOT successfully</span>";
			}
			return $alert;
		}


		public function addWishlist($prodId) {
			$prodId = mysqli_real_escape_string($this->db->link, $prodId);
			$customerId = Session::get('customer_id');

			$wishlistQuery = "SELECT * FROM tbl_wishlist WHERE productId = $prodId";
			$wishlistResult = $this->db->select($wishlistQuery);

			if($wishlistResult) {
				$msg = "<span class='error'>Product already added to wishlist.</span>";
				return $msg;
			} else {
				$productQuery = "SELECT * FROM tbl_product WHERE productId = $prodId";
				$productResult = $this->db->select($productQuery);
				if($productResult) {
					$result = $productResult->fetch_assoc();
					$insertQuery = "INSERT INTO tbl_wishlist(customerId, productId, productName, price, image) 
							VALUES('$customerId','{$result['productId']}','{$result['productName']}','{$result['price']}','{$result['image']}')";
					$insertResult = $this->db->insert($insertQuery);
					if($insertResult) {
						$msg = "<span class='success'>Product added to wishlist.</span>";
						return $msg;
					} else {
						header('Location:404.php');
					}	
				} else {
					header('Location:404.php');
				}
				
			}
		}

		public function getWishlistByCustomer($customerId) {
			$wishlistQuery = "SELECT * FROM tbl_wishlist WHERE customerId = '$customerId'";
			$result = $this->db->select($wishlistQuery);
			return $result;
		}

		public function deleteWishlist($productId, $customerId) {
			$query = "DELETE FROM tbl_wishlist WHERE productId = '$productId' AND customerId = '$customerId'";
			$result = $this->db->delete($query);
			if($result == true) {
				$alert = "<span class='success'>Delete product successfully.</span>";
			} else {
				$alert = "<span class='error'>Delete product NOT successfully.</span>";
			}
			return $alert;
		}
	}
?>