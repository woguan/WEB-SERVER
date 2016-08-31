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
    
// my globals
	$msgerr = ''; //Error Reporting Variable
	$isActionExecuted = 0; // to check if action were executed
	
    // Helper Functions
    function uploadIMG(string $target_dir, string $Filename, string $imageFileType) {
  
          $uploadOk = 1; // this is a boolean to tell if upload is valid
// Check if image file is a actual image or fake image
if(isset($_POST["Submit"])) {
	
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
    	
        print "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    print "Sorry, your file is over 5MB.";
    $uploadOk = 0;
}
// Only allow 3 extensions - jpg, png, jpeg
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    print "Sorry, only JPG, JPEG, PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	print "Image not uploaded";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "$target_dir$Filename")) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        return 1;
    } else {
    	print "(E)<br>";
       print "Sorry, there was an error uploading your file.";
    }
	
}
 return 0;
}

	if ($action == 'Add') {
	
// Request variables from the form
       $movie_title = $_REQUEST['movie_title'];
       $studio= $_REQUEST['studio'];
       $year = $_REQUEST['year'];
       $box_office = $_REQUEST['box_office'];
     
     // SHOULD HAVE VALIDATION HERE!?   - check if data input is valid
$isActionExecuted = 1; // assuming its valid for now
    
// start
       // Setting variables for uploading image 
       $target_directory = "../CRUD/images/";
       $target_full_filepath = $target_directory . basename( $_FILES["file"]["name"]);
       $image_FileType = pathinfo($target_full_filepath,PATHINFO_EXTENSION);
       $picture = "picture_" . date('Y-m-d-H-i-s') . "_" . uniqid() . ".$image_FileType"; // file name
       
     $isActionExecuted = uploadIMG($target_directory, $picture,  $image_FileType);
     
     if(isset($_POST["submit"])) {
     print "isset suppose to appear....<br>";	
     }
     
// end
	   
	 
// we will add some validation here... like... if upload is success then call the two lines below	   
       if ($isActionExecuted == 1){
       	
     /* 	$stmt = $conn->prepare("INSERT INTO movieInfo (movie_title,studio,year,box_office,picture) VALUES (:movie_title , :studio , :year, :box_office,:picture)");
	$stmt->bindParam(':movie_title', $movie_title);
	$stmt->bindParam(':studio', $studio);
	$stmt->bindParam(':year', $year);
	$stmt->bindParam(':box_office', $box_office);
	$stmt->bindParam(':picture', $picture);
	$stmt->execute();*/
	
$movie_title = mysqli_real_escape_string($conn, $movie_title);
$studio = mysqli_real_escape_string($conn, $studio);
$year = mysqli_real_escape_string($conn, $year);
$box_office = mysqli_real_escape_string($conn, $box_office);

       $sql = "INSERT INTO movieInfo (movie_title,studio,year,box_office,picture) VALUES ('$movie_title' , '$studio' , '$year', '$box_office','$picture')";
       $result = mysqli_query($conn, $sql);	
       }
	} else if ($action == "Update") {
		
	   $movie_title = $_REQUEST['movie_title'];
	   $studio = $_REQUEST['studio'];
	   $year = $_REQUEST['year'];
	   $box_office = $_REQUEST['box_office'];
	  
	   $movie_id = $_REQUEST['movie_id'];
	   
	   $uploaded_file_name = basename($_FILES["file"]["name"]);
	
	if ($uploaded_file_name == '' ){
		 $picture = $_REQUEST['picture'];
	}
	else{
       $target_directory = "../CRUD/images/";
       $target_full_filepath = $target_directory . basename( $_FILES["file"]["name"]);
       $image_FileType = pathinfo($target_full_filepath,PATHINFO_EXTENSION);
       $picture = "picture_" . date('Y-m-d-H-i-s') . "_" . uniqid() . ".$image_FileType"; // file name
       
     $isActionExecuted = uploadIMG($target_directory, $picture,  $image_FileType);
	
	}
	
	//$isActionExecuted = 1;
      /* print "Title: $movie_title<br>";
       print "Picture: $picture<br>";
       print "File: ".$uploaded_file_name."<br>";
       print "ID: $movie_id<br>";*/
       
       
       
        $sql = "UPDATE movieInfo SET movie_title='" .$movie_title."' ,studio='".$studio."' ,year='".$year."' ,box_office='".$box_office."', picture='".$picture."' WHERE movie_id='".$movie_id."'";
       $result = mysqli_query($conn, $sql);
		
	}  else if ($action == "Delete") {
       $isActionExecuted = 1;
       $sql = "DELETE FROM movieInfo WHERE movie_id='".$_POST['movie_id']."'"; 
       $result = mysqli_query($conn, $sql);
	
	}
// this is to redirect : WE WILL CREATE FUNCTION TO HANDLE THIS CASE.
if ($isActionExecuted == 1){
	header('Location: index.php');
}
else{
	print "An error has occured. $msgerr";
}

?>
