<?php
/*
This php page/script deals with my signup form, it receives the user input details and 
sanitize it before sending it to my database. 







*/
// connect to my session //
session_start();



 // if the submit button is clicked //
if(isset($_POST['submit'])){
	
// include my db settings //
require "includes/testmysql.php";


// function to sanitize my data //
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
// assign variables to user input //
$err = 0;
$firstname = test_input($_POST ['firstname']); 
$middlename = test_input($_POST['middlename']);
$surname = test_input($_POST['surname']);

$email = test_input($_POST['email']);

// filter the email to check if its a valid mail //
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $err = 1;
	   $emailerr = "Invalid email format";
     }
	  
$username = test_input($_POST['username']);

// hash the password to be sent to the db //
$user_password = MD5($_POST['password']);

// assign the input password //
$user_password = test_input($user_password);


$_SESSION['success_signup'] = $_SESSION['fail_signup'] = "";





// check if the immage was successfully uploaded in preview.php //
if($_SESSION['uploadOk'] == 1 && $_SESSION['user_available'] == true) {
	
	//properties of the uploaded file

$target_dir = "upload_img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

	
  // if everything is ok, try to upload file  



if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				// prepare and bind //
				// this prepared statement will store the user values in my db //
		$db_statement = $db_con->prepare("INSERT INTO student_profile  (
		firstname,
		middlename,
		surname,
		email, 
		username,
		user_password, 
		photo_path
		
		) VALUES (:firstname, :middlename, :surname, :email, :userName, :userPassword, :photo )");

		$db_statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
		$db_statement->bindValue(':middlename',$middlename,PDO::PARAM_STR );
		$db_statement->bindValue(':surname', $surname, PDO::PARAM_STR);
		$db_statement->bindValue(':email', $email, PDO::PARAM_STR);
		$db_statement->bindValue(':userName', $username, PDO::PARAM_STR);
		$db_statement->bindValue(':userPassword', $user_password, PDO::PARAM_STR);
		$db_statement->bindValue(':photo', $target_file, PDO::PARAM_STR );
		
		// run the query i.e. prepared query //
		$db_query = $db_statement->execute();
			if($db_query){
			$_SESSION['success_signup'] = "User profile created successfully <br/> 
					The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					header('Location: signup_sucess.php', true, 303);
					exit;
				}
				//============================endif db_query =============================== //
				else{
			$_SESSION['fail_signup'] =  "There were errors uploading and creating the user";
			header('Location: signup_form.php', true, 303);
			exit;
			
				}
				//=========================================================== //
		
			
	} 
	//============= endif move_uploaded file =====================================//
	
	
	else {
        $_SESSION['fail_signup'] =  "Sorry, there was an error uploading your file. <br/> Please select another picture";
		header('Location: signup_form.php', true, 303);
		exit;
    }
	// ======================= else move_uploaded file ================== //


   }
   //==================endif $_SESSION['uploadOk'] ===========================//
   // if there were errors in uploading the file in preview.php or username is already taken //
   else{
   if($_SESSION['uploadOk'] == 1 && $_SESSION['user_available'] == false){
   $_SESSION['fail_signup'] = "Username is already taken please enter another username";
   header('Location: signup_form.php', true, 303);
   exit;
   }
   
   elseif($_SESSION['uploadOk'] == 0){
   $_SESSION['fail_signup'] = "There was errors uploading your profile picture, <br/> Please make sure you preview the selected picture   				    before submitting the form";
   header('Location: signup_form.php', true, 303);
   exit;
   
   }
   
   
   
   }
   // end of else //

	

// close connection to my db //
$db_con = null;

}

//=================== endif submit ======================= //


// if this page is accessed through history, bookmark or url without filling the form //
else {
		// redirect user to the signup_form //
	header ("Location:signup_form.php" );
	exit;
}
?>