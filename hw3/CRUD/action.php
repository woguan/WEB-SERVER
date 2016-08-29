<?php
	
	define('DB_USER','root');
	define('DB_PASSWORD','wong123');
	define('DB_HOST','127.0.0.1');
	define('DB_NAME','homework3');

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
    }

	$action = $_REQUEST['action'];
	
	if ($action == 'Add') {

// my globals
	$msgerr = ''; //Error Reporting Variable
	$isActionExecuted = 0; // to check if some action were executed
	
// Request variables from the form
       $movie_title = $_REQUEST['movie_title'];
       $studio= $_REQUEST['studio'];
       $year = $_REQUEST['year'];
       $box_office = $_REQUEST['box_office'];

// Setting variables for uploading image 
       $target_dir = "../CRUD/images/";
       $target_file = $target_dir . basename($_FILES["file"]["name"]);
       $uploadOk = 1; // this is a boolean to tell if upload is valid
       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $picture = "picture_" . date('Y-m-d-H-i-s') . "_" . uniqid() . ".$imageFileType";
    
// SHOULD HAVE VALIDATION HERE!?   - check if data input is valid
$isActionExecuted = 1; // assuming its valid for now

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msgerr = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists - This is basically impossible to happen. But just in case it happens
if (file_exists($target_file)) {
    $msgerr = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    $msgerr = "Sorry, your file is over 5MB.";
    $uploadOk = 0;
}
// Only allow 3 extensions - jpg, png, jpeg
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $msgerr = "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
 //   $msgerr = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
;
} else {
	if ($isActionExecuted == 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "$target_dir$picture")) {
    	
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
    	$isActionExecuted = 0;
        $msgerr = "Sorry, there was an error uploading your file.";
    }
	}
}
	   
	   
	 
// we will add some validation here... like... if upload is success then call the two lines below	   
       if ($uploadOk == 1 && $isActionExecuted == 1){
       $sql = "INSERT INTO movieInfo (movie_title,studio,year,box_office,picture) VALUES ('$movie_title' , '$studio' , '$year', '$box_office','$picture')";
       $result = mysqli_query($conn, $sql);	
       }
		
	} else if ($action == "Update") {
		
	   $first_name = $_REQUEST['first_name'];
	   $last_name = $_REQUEST['last_name'];
	   $login = $_REQUEST['login'];
	   $password = $_REQUEST['password'];
	   $user_id = $_REQUEST['user_id'];
	
	   $sql = "UPDATE users SET first_name='" .$first_name."' ,last_name='".$last_name."' ,login='".$login."' ,password='".$password."' WHERE user_id='".$user_id."'";
       $result = mysqli_query($conn, $sql);
		
	}  else if ($action == "Delete") {
       $isActionExecuted = 1;
       $sql = "DELETE FROM movieInfo WHERE movie_id='".$_POST['movie_id']."'"; 
       $result = mysqli_query($conn, $sql);
	
	}
print "something..?";
// this is to redirect : WE WILL CREATE FUNCTION TO HANDLE THIS CASE.
//if ($isActionExecuted == 1){
//	header('Location: index.php');
//}
//else{
//	print "An error has occured. $msgerr";
//}
?>
