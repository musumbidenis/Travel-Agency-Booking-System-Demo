<?php 
session_start();

/* connect to database */
$db = mysqli_connect('localhost', 'root', 'password', 'travel');

/* variable declaration */
$firstName = "";
$surname = "";
$phone = "";
$email    = "";
$role = "";
$errors   = array(); 


/* INSERTING DATA INTO DATABASE
-------------------------------------------------- */

/* call the createUser() function if create_user_btn is clicked */
if (isset($_POST['create_user_btn'])) {
	createUser();
}

/* CREATE USER */
function createUser(){
	global $db, $errors;
 
	/* receive all input values from the form. Call the e() function */
    /* defined below to escape form values */
	$firstName    =  e($_POST['firstName']);
    $surname    =  e($_POST['surname']);
    $phone    =  e($_POST['phone']);
	$email       =  e($_POST['email']);
	$password  =  e($_POST['password']);
	$confirmPassword  =  e($_POST['confirmPassword']);
	$role = e($_POST['role']);

	/* form validation: ensure that the form is correctly filled */
	if (empty($firstName)) { 
		array_push($errors, "First Name is required"); 
	}
    if (empty($surname)) { 
		array_push($errors, "Surname is required"); 
	}
    if (empty($phone)) { 
		array_push($errors, "Phone is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirmPassword) {
		array_push($errors, "The two passwords do not match");
	}

	/* register user if there are no errors in the form */
	if (count($errors) == 0) {
		$password = md5($password);/* encrypt the password before saving in the database */

        $query = "INSERT INTO users (firstName, surname, phone, email, password, role) 
                    VALUES('$firstName', '$surname', '$phone', '$email', '$password', '$role')";
        mysqli_query($db, $query);

        $_SESSION['success']  = "Registration was successfull.";
        header('location: users.php');
	}
}


/* checking if user is admin */
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

/* checking if user is accountant */
function isAccountant()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'accountant' ) {
		return true;
	}else{
		return false;
	}
}

/* checking if user is logged in */
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}



/* call the addPackage() function if add_package_btn is clicked */
if (isset($_POST['add_package_btn'])) {
	addPackage();
}


/* ADD PACKAGE */
function addPackage(){
	global $db, $errors;
 
	/* receive all input values from the form. Call the e() function */
    /* defined below to escape form values */
	$packageType    =  e($_POST['packageType']);
    $description    =  e($_POST['description']);
    $amount    =  e($_POST['amount']);

	/* Get image name */
	$image = $_FILES['image']['name'];
	/* image file directory */
	$target = "images/".basename($image);


	/* form validation: ensure that the form is correctly filled */
	if (empty($packageType)) { 
		array_push($errors, "Choose a package type"); 
	}
    if (empty($description)) { 
		array_push($errors, "Description is required"); 
	}
    if (empty($amount)) { 
		array_push($errors, "Amount is required"); 
	}
	if (empty($image)) { 
		array_push($errors, "Choose an image from files"); 
	}

	/* add package if there are no errors in the form */
	if (count($errors) == 0) {
        $query = "INSERT INTO packages (packageType, description, amount, imageUrl) 
                    VALUES('$packageType', '$description', '$amount', '$image')";
        mysqli_query($db, $query);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}

        $_SESSION['success']  = "Added successfully";
        header('location: packages.php');
	}
}


/* escape string */
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}


/* displaying errors */
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	


/* FETCHING DATA FROM DATABASE
-------------------------------------------------- */

/* fetching registered users */
function users(){
	global $db, $errors;

	$query = "SELECT * FROM users";
	$results = mysqli_query($db, $query);

	return $results;
}

/* fetching packages */
function packages(){
	global $db, $errors;

	$query = "SELECT * FROM packages";
	$results = mysqli_query($db, $query);

	return $results;
}

/* fetching bookings */
function bookings(){
	global $db;

	if (isset($_POST['show_bookings'])) {
		
		$packageType    =  $_POST['packageType'];
		$status    =  $_POST['status'];
	
		if ($packageType == 'any' && $status != 'any' ) {
			$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			    JOIN bookings ON bookings.userId = users.userId
				JOIN packages ON packages.packageId = bookings.packageId
				WHERE bookings.status='$status'");

            $results = mysqli_query($db, $query);
			
		} else if($packageType != 'any' && $status == 'any') {
			$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
				JOIN bookings ON bookings.userId = users.userId
				JOIN packages ON packages.packageId = bookings.packageId
				WHERE packages.packageType='$packageType'");

            $results = mysqli_query($db, $query); 

		} else if($packageType != 'any' && $status != 'any') {
			$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
				JOIN bookings ON bookings.userId = users.userId
				JOIN packages ON packages.packageId = bookings.packageId
				WHERE packages.packageType='$packageType'
				AND bookings.status='$status'");

            $results = mysqli_query($db, $query); 
		}else{
			$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
				JOIN bookings ON bookings.userId = users.userId
				JOIN packages ON packages.packageId = bookings.packageId");

			$results = mysqli_query($db, $query);
		}
	
	}else{

		$packageType = 'any';
	    $status = 'any';

		$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			JOIN bookings ON bookings.userId = users.userId
			JOIN packages ON packages.packageId = bookings.packageId");
		
		// $query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status, payments.amount as amountPaid FROM payments
		// 			JOIN bookings ON bookings.checkoutRequestID = payments.checkoutRequestID
		// 			JOIN packages ON packages.packageId = bookings.packageId
		// 			JOIN users ON users.userId = bookings.userId"
		// 		);

	    $results = mysqli_query($db, $query);
	}

	session_start();
	unset($_SESSION['bookings_packageType']);
	unset($_SESSION['bookings_status']);
	session_regenerate_id();
	$_SESSION['bookings_packageType']  = $packageType;
	$_SESSION['bookings_status']  = $status;

	return $results;

	
}

/* fetching payments */
function payments(){
	global $db, $errors;

	$query = ("SELECT users.email, payments.transactionDate, payments.checkoutRequestID, payments.amount, payments.mpesaReceiptNumber, payments.phone FROM payments 
				JOIN bookings ON bookings.checkoutRequestID = payments.checkoutRequestID
				JOIN users ON bookings.userId = users.userId"
			);

	$results = mysqli_query($db, $query);

	return $results;
}





/* UPDATING DATA IN DATABASE
-------------------------------------------------- */

/* booking update*/
if (isset($_GET['update-booking'])) {
	global $db, $errors;

	$id = $_GET['update-booking'];
	mysqli_query($db, "UPDATE bookings SET status='cancelled' WHERE bookingId=$id");

	$_SESSION['success'] = "Booking updated"; 
	header('location: bookings.php');
}





/* DELETING DATA FROM DATABASE
-------------------------------------------------- */

/* package delete */
if (isset($_GET['del-package'])) {
	global $db, $errors;

	$id = $_GET['del-package'];
	mysqli_query($db, "DELETE FROM packages WHERE packageId=$id");

	$_SESSION['success'] = "Package deleted"; 
	header('location: packages.php');
}




/* GENERATING REPORTS
-------------------------------------------------- */

/** Booking Reports */
if (isset($_POST['bookings_report'])) {
	global $db;

	$packageType    =  $_SESSION['bookings_packageType'];
	$status    =  $_SESSION['bookings_status'];

	if ($packageType == 'any' && $status != 'any' ) {
		$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			JOIN bookings ON bookings.userId = users.userId
			JOIN packages ON packages.packageId = bookings.packageId
			WHERE bookings.status='$status'");

		$results = mysqli_query($db, $query);
		
	} else if($packageType != 'any' && $status == 'any') {
		$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			JOIN bookings ON bookings.userId = users.userId
			JOIN packages ON packages.packageId = bookings.packageId
			WHERE packages.packageType='$packageType'");

		$results = mysqli_query($db, $query); 

	} else if($packageType != 'any' && $status != 'any') {
		$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			JOIN bookings ON bookings.userId = users.userId
			JOIN packages ON packages.packageId = bookings.packageId
			WHERE packages.packageType='$packageType'
			AND bookings.status='$status'");

		$results = mysqli_query($db, $query); 
	}else{
		$query = ("SELECT users.email, users.phone, packages.packageType, packages.amount, bookings.bookingId, bookings.status FROM users
			JOIN bookings ON bookings.userId = users.userId
			JOIN packages ON packages.packageId = bookings.packageId");

		$results = mysqli_query($db, $query);
	}

	$output = '';

	while($row = mysqli_fetch_array($results)){       
		$output .= '<tr>  
						<td>' .$row["email"].'</td>  
						<td>'.$row["phone"].'</td>  
						<td>'.$row["packageType"].'</td>  
						<td>'.$row["status"].'</td> 
					</tr>';  
	}


	require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Bookings Data for Super Travel Agency");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Bookings Data for Super Travel Agency</h3><br /><br />  
      <table cellspacing="0" cellpadding="3" border="1" style="border-color:gray;"> 
           <tr style="background-color:green;color:white;">  
                <th>Email</th>  
                <th>Phone</th>  
                <th>Package Type</th>  
                <th>Status</th>
           </tr>  
      ';  
      $content .= $output;  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('bookings.pdf', 'I');
}