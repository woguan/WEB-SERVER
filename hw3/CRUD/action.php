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
       
       $picture = basename($_FILES["file"]["name"]); // this is used to pass to mysql - the file name	
       
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is over 5MB.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	   
	   
	   // SHOULD HAVE VALIDATION HERE!?
// we will add some validation here... like... if upload is success then call the two lines below	   
	   
       $sql = "INSERT INTO movieInfo (movie_title,studio,year,box_office,picture) VALUES ('$movie_title' , '$studio' , '$year', '$box_office','$picture')";
       $result = mysqli_query($conn, $sql);	
		
	} else if ($action == "Update") {
		
	   $first_name = $_REQUEST['first_name'];
	   $last_name = $_REQUEST['last_name'];
	   $login = $_REQUEST['login'];
	   $password = $_REQUEST['password'];
	   $user_id = $_REQUEST['user_id'];
	
	   $sql = "UPDATE users SET first_name='" .$first_name."' ,last_name='".$last_name."' ,login='".$login."' ,password='".$password."' WHERE user_id='".$user_id."'";
       $result = mysqli_query($conn, $sql);
		
	}  else if ($action == "Delete") {
		
  		
       $sql = "DELETE FROM users WHERE movie_id='".$_POST['movie_id']."'"; 
       $result = mysqli_query($conn, $sql);

print "This is the movie_id being removed: '".$REQUEST['movie_id']."'";

		
	}

// this is to redirect : WE WILL CREATE FUNCTION TO HANDLE THIS CASE.
//	header('Location: index.php');
	
?>
