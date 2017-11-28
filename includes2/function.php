<?php
	function uploadFile($files, $name, $loc){ // passing parameters into uploadFile function
		$result = []; // initializing $result array

		$rnd = rand(0000000000, 9999999999); // to initialize a random number
		$strip_name = str_replace(' ', '_', $files[$name]['name']); // replace white spaces with "underscore _"

		$fileName = $rnd.$strip_name; // concatinate random number and new name
		$destination = $loc.$fileName; // concatinate location and filename to set destination

		if(move_uploaded_file($files[$name]['tmp_name'], $destination)){ // to check if file has been moved
			$result[] = true;
			$result[] = $destination;

		} else{
			$result[] = false;
		}


		return $result;

	}

	function customerRegister($dbconn, $input){
		$hash = password_hash($input['password'], PASSWORD_BCRYPT); // this line is to encrypt the password
		$stmt = $dbconn->prepare("INSERT INTO customers(firstName, lastName, email, username, hash)
			VALUES(:f, :l, :e, :u, :h)");
		$data = [
			":f" => $input['fname'],
			":l" => $input['lname'],
			":e" => $input['email'],
			":u" => $input['uname'],
			":h" => $hash
		];
		$stmt->execute($data);
	}

	function doesEmailExist($dbconn, $email){
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE :e=email");

		$stmt->bindParam(":e", $email);

		$stmt->execute();
		$count = $stmt->rowCount();

		if($count > 0){
			$result = true;
		}

		return $result;
	}

	// validation for input errors
	function displayErrors($err, $name){
		$result = "";

		if(isset($err[$name])){
			$result = '<p class="err">'.$err[$name].'</p>';
		}

		return $result;
	}



	function custLogin($dbconn, $input){

		$result = [];

		$stmt = $dbconn->prepare("SELECT * FROM customers WHERE email=:e");

		$stmt->bindParam(":e", $input['email']);

		$stmt->execute();

		$count = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_BOTH); // Could also use FETCH_BOTH which fetches both the key and value pair

		/*print_r($count); exit();*/ // To check what values or errors you have exit() is to stop the printing

		if($count != 1 || !password_verify($input['password'], $row['hash'])){ //if it's not equal to 1, it means it did not fetch the email from the database {email does not exist}

		$result[] = false;

		} else{
			$result[] = true;
			$result[] = $row;
		}

		return $result;

	}


	function addCategory($dbconn, $input){
		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:catName)");

		$stmt->bindParam(':catName', $input['cat_name']);

		$stmt->execute();
	}

	function checkLogin(){
		if(!isset($_SESSION['customer_id'])){
			redirect("login.php");
		}
	}

	function redirect($location, $msg){

		header("Location: ".$location.$msg);
	}




	function viewCategory($dbconn){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM category");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$result .= '<tr><td>'.$row[0].'<td>';
			$result .= '<td>'.$row[1].'<td>';
			$result .= '<td><a href="edit_category.php?cat_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="delete_category.php?cat_id='.$row[0].'">delete</a></td></tr>';
		}

		return $result;
	}


	function getCategoryById($dbconn, $id){


		$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id =:catId");

		$stmt->bindParam('catId', $id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;
	}





	function updateCategory($dbconn, $input){

		$stmt = $dbconn->prepare("UPDATE category SET category_name =:catName WHERE category_id =:catID");

		$data = [
			":catName" => $input['cat_name'],
			":catID" => $input['id']
		];

		$stmt->execute($data);
	}



	function curNave($page){

		$curPage = basename($_SERVER['SCRIPT_FILENAME']);

		if($curPage == $page){
			echo 'class="selected"';
		}
	}

	function deleteCategory($dbconn, $input){
		$stmt = $dbconn->prepare("DELETE FROM category WHERE category_name =:catName AND category_id =:catID");

		$data = [
			":catID" => $input['id'],
			":catName" => $input['cat_name']
		];

		$stmt->execute($data);
	}


	function numeric($input){
		$result = false;

		if(!is_numeric($input)){
			$result = true;
		}
		return $result;
	}

	function addProduct($dbconn, $input){
		$stmt  = $dbconn->prepare("INSERT INTO books(title, author, price, publication_date, category_id, flag, img_path) 
			VALUES(:t,:a,:p,:pub,:cat,:fl,:img)");

		$data = [
			":t" => $input['title'],
			":a" => $input['author'],
			":p" => $input['price'],
			":pub" => $input['pub_date'],
			":cat" => $input['cat'],
			":fl" => $input['flag'],
			":img" => $input['dest']

		];

		$stmt ->execute($data);

	}



	function fetchCategory($dbconn, $val=null){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM category");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){

			if($val == $row[1]){
				continue;
			}

			$result .= '<option value="'.$row[0].'">'.$row[1].'</option>';

		}

		return $result;
	}



	function viewProducts($dbconn){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM books");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$result .= '<tr><td>'.$row[1].'</td>';
			$result .= '<td>'.$row[2].'</td>';
			$result .= '<td>'.$row[3].'</td>';
			$result .= '<td>'.$row[5].'</td>';
			$result .= '<td><img src="'.$row[7].'" height="50" width="50"></td>';
			$result .= '<td><a href="edit_products.php?book_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="delete_products.php?book_id='.$row[0].'">delete</a></td></tr>';
		}

		return $result;

	}

	function getProductById($dbconn, $id){
		/*$result = "";*/	

		$stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id =:bookId");

		$stmt->bindParam('bookId', $id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);
	/*	$result = $stmt->fetch(PDO::FETCH_BOTH);*/
		/*return $result;*/
		return $row;
	}


	function updateProduct($dbconn, $input){

		$stmt = $dbconn->prepare("UPDATE books SET title =:t, author=:a, price=:p, publication_date=:pd, category_id=:cat WHERE book_id =:bID");

		$data = [
			":t" => $input['title'],
			":bID" => $input['id'],
			":a" => $input['author'],
			":p" => $input['price'],
			":pd" => $input['pub_date'],
			":cat" => $input['cat'],
			":bID" => $input['id']
		];

		$stmt->execute($data);
	}


	function deleteProduct($dbconn, $input) {

		$stmt = $dbconn->prepare("DELETE FROM books WHERE book_id=:bookId ");

		$data = [
			":bookId" => $input
		];

		$stmt->execute($data);
	}


	function updateImage($dbconn, $id, $location){
		$stmt = $dbconn->prepare("UPDATE books SET img_path = :img WHERE book_id = :bID");

		$data = [
			":img" => $location,
			":bID" => $id
		];

		$stmt-> execute($data);

	}







?>


