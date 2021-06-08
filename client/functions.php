<?php 
session_start();

/* connect to database */
$db = mysqli_connect('localhost', 'root', 'password', 'travel');

/* variable declaration */
$firstName = "";
$surname = "";
$phone = "";
$email    = "";
$errors   = array(); 


/* INSERTING DATA INTO DATABASE
-------------------------------------------------- */

/* call the register() function if register_btn is clicked */
if (isset($_POST['register_btn'])) {
	register();
}

/* REGISTER USER */
function register(){
	/* call these variables with the global keyword to make them available in function */
	global $db, $errors;

	/* receive all input values from the form. Call the e() function */
    /* defined below to escape form values */
	$firstName    =  e($_POST['firstName']);
    $surname    =  e($_POST['surname']);
    $phone    =  e($_POST['phone']);
	$email       =  e($_POST['email']);
	$password  =  e($_POST['password']);
	$confirmPassword  =  e($_POST['confirmPassword']);

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
                    VALUES('$firstName', '$surname', '$phone', '$email', '$password', 'client')";
        mysqli_query($db, $query);

        $_SESSION['success']  = "Registration was successful." . "<br>" . "Login to continue.";
        header('location: login.php');
	}
}


/* call the login() function if login_btn is clicked */
if (isset($_POST['login_btn'])) {
	login();
}

/* LOGIN USER */
function login(){
	global $db, $errors;

	/* grap form values */
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	/* make sure form is filled properly */
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	/* attempt login if no errors on form */
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { /* user found */
			/* check if user is admin/accountant or client */
			$user = mysqli_fetch_assoc($results);
			if($user['role'] == 'admin' || $user['role'] == 'accountant'){
				$_SESSION['user'] = $user;
				$_SESSION['success']  = "You are now logged in";

				header('location: ../admin/index.php');
			}else{
				$_SESSION['user'] = $user;

				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
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


/* log user out if logout button clicked */
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
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

/* fetching packages */
function packages(){
	global $db, $errors;


	if (isset($_GET['packageType'])) {
		$packageType = $_GET['packageType'];
		$query = "SELECT * FROM packages WHERE packageType=$packageType";

		$results = mysqli_query($db, $query);
	}

	return $results;
}


/*fetching package details */
function bookingDetails(){
	global $db, $errors;


	if (isset($_GET['packageId'])) {
		$packageId = $_GET['packageId'];
		$query = "SELECT * FROM packages WHERE packageId=$packageId LIMIT 1";

		$results = mysqli_query($db, $query);
	}

	return $results;

}


/*fetching payment status */
if (isset($_POST['checkoutRequestID'])) {
	$checkoutRequestID = $_POST['checkoutRequestID'];

	$result = mysqli_query($db, "SELECT paymentStatus FROM payments WHERE checkoutRequestID='$checkoutRequestID'");

	if ($result->num_rows > 0) {
		echo json_encode($result->fetch_assoc());
	} else {
		echo json_encode('0 results');
	}
}


/* MPESA payments
-------------------------------------------------- */

/* call the stkPush() function if complete button is clicked */
if (isset($_POST['stkPush'])) {
	stkPush();
}

function stkPush(){
	global $db, $errors;

	date_default_timezone_set('Africa/Nairobi');

	# access token
	$consumerKey = '3F30uGhK0V1gHsUsiPmgv4gG0sXdkvtJ'; //Fill with your app Consumer Key
	$consumerSecret = '6JUjqNwdFKNzLRyI'; // Fill with your app Secret
	
	# define the variales
	# provide the following details, this part is found on your test credentials on the developer account
	$BusinessShortCode = '174379';
	$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
	
	/*
		This are your info, for
		$PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
		$AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
		TransactionDesc can be anything, probably a better description of or the transaction
		$Amount this is the total invoiced amount, Any amount here will be 
		actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
		for developer/test accounts, this money will be reversed automatically by midnight.
	*/
	
	$PartyA = $_POST['phone']; // This is your phone number, 
	$AccountReference = 'Test';
	$TransactionDesc = 'Test';
	$Amount = $_POST['amount'];
	
	# Get the timestamp, format YYYYmmddhms -> 20181004151020
	$Timestamp = date('YmdHis');    
	
	# Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
	$Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
	
	# header for access token
	$headers = ['Content-Type:application/json; charset=utf8'];
	
		# M-PESA endpoint urls
	$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
	$initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
	
	# callback url
	$CallBackURL = '../supertravel/client/callback_url.php';  

	/* form validation: ensure that the form is correctly filled */
	if (empty($PartyA)) { 
		array_push($errors, "Please provide an MPESA registered number to complete checkout"); 
	}

	if (count($errors) == 0) {
			  
		$curl = curl_init($access_token_url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
		$result = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$result = json_decode($result);
		$access_token = $result->access_token;  
		curl_close($curl);
	  
		# header for stk push
		$stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
	  
		# initiating the transaction
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $initiate_url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
	  
		$curl_post_data = array(
		  //Fill in the request parameters with valid values
		  'BusinessShortCode' => $BusinessShortCode,
		  'Password' => $Password,
		  'Timestamp' => $Timestamp,
		  'TransactionType' => 'CustomerPayBillOnline',
		  'Amount' => 1,
		  'PartyA' => $PartyA,
		  'PartyB' => $BusinessShortCode,
		  'PhoneNumber' => $PartyA,
		  'CallBackURL' => $CallBackURL,
		  'AccountReference' => $AccountReference,
		  'TransactionDesc' => $TransactionDesc
		);
	  
		$data_string = json_encode($curl_post_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$curl_response = curl_exec($curl);

		$response = json_decode($curl_response, true);

		if($response['errorMessage'] == 'Bad Request - Invalid PhoneNumber'){

			array_push($errors, 'Please provide your phone number in the following format 254713710887');
		
		}else if($response['errorMessage'] == 'Unable to lock subscriber, a transaction is already in process for the current subscriber'){
			
			array_push($errors, 'A transaction is already in process for the current subscriber.');
		
		}else if($response['ResponseCode'] == '0'){
			
			$userId = $_SESSION['user']['userId'];
			$packageId = $_POST['packageId'];
			$checkoutRequestID = $response['CheckoutRequestID'];

			
			$query = "INSERT INTO bookings (userId, packageId, checkoutRequestID, status) 
			        VALUES('$userId', '$packageId', '$checkoutRequestID', 'pending')";
			mysqli_query($db, $query);

			header("location: checkout.php?checkoutRequestID=$checkoutRequestID");

		}else{
			
			array_push($errors, 'An error occurred, Please try again later');
		
		}
	  
	}

}



/* escape string */
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}