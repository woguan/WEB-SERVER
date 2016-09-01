<?php
	
	define('DB_USER','root');
	define('DB_PASSWORD','wong123');
	define('DB_HOST','127.0.0.1');
	define('DB_NAME','homework3');
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
    }
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
        mysqli_set_charset('gbk');
	$action = $_REQUEST['action'];
    
// my globals
	$msgerr = ''; //Error Reporting Variable
	$isActionExecuted = 0; // to check if action were executed
	
    // Helper Functions
    function uploadIMG(string $target_dir, string $Filename, string $imageFileType) {
          $uploadOk = 1; // this is a boolean to tell if upload is valid
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
	
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
    	
        print "File is not an image.<br>";
        $uploadOk = 0;
        return 0;
    }
//}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    print "Sorry, your file is over 5MB.<br>";
    $uploadOk = 0;
}
// Only allow 3 extensions - jpg, png, jpeg
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    print "Sorry, only JPG, JPEG, PNG files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	print "Image not uploaded<br>";
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
     
     // SHOULD HAVE VALIDATION HERE!?   - 1) check input 2) check picture

//$movie_title = mysqli_real_escape_string($conn, $movie_title);
$studio = mysqli_real_escape_string($conn, $studio);
$year = mysqli_real_escape_string($conn, $year);
$box_office = mysqli_real_escape_string($conn, $box_office);

       // Setting variables for uploading image 
       $target_directory = "../CRUD/images/";
       $target_full_filepath = $target_directory . basename( $_FILES["file"]["name"]);
       $image_FileType = pathinfo($target_full_filepath,PATHINFO_EXTENSION);
       $picture = "picture_" . date('Y-m-d-H-i-s') . "_" . uniqid() . ".$image_FileType"; // file name
       $uploaded_file_name = basename($_FILES["file"]["name"]);

$query = "INSERT INTO movieInfo (movie_title,studio,year,box_office,picture) VALUES (?,?,?,?,?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssids", $movie_title, $studio, $year, $box_office, $picture);

if ($stmt->execute()){
	$isActionExecuted = 1;
//print "the statement was executed;<br>";
}
else{
	$isActionExecuted = 0;
	print "One of the inputs has problem. Using mysqli_error report:<br>";
	print mysqli_error($mysqli);
	print "<br>";
}
$stmt->close();
       
     
     // validate if filename is empty
     if ($isActionExecuted == 1){
if ($uploaded_file_name == ''){
	$picture = "noimage.png";
}  else{
     $isActionExecuted = uploadIMG($target_directory, $picture,  $image_FileType);
}
}

// delete if action should not be performed
if ($isActionExecuted == 0){
print "image wont be uploaded due some error.<br>";
   if ($uploaded_file_name != ''){
      $sql = "DELETE FROM movieInfo WHERE picture='$picture'"; 
      $result = mysqli_query($conn, $sql);
	}

}


	} else if ($action == "Update") {
		
	   $movie_title = $_REQUEST['movie_title'];
	   $studio = $_REQUEST['studio'];
	   $year = $_REQUEST['year'];
	   $box_office = $_REQUEST['box_office'];
	   $movie_id = $_REQUEST['movie_id'];

//loading for new image	   
       $target_directory = "../CRUD/images/";
       $target_full_filepath = $target_directory . basename( $_FILES["file"]["name"]);
       $image_FileType = pathinfo($target_full_filepath,PATHINFO_EXTENSION);
       $newpicture = "picture_" . date('Y-m-d-H-i-s') . "_" . uniqid() . ".$image_FileType"; // file name  
       $picture = $_REQUEST['picture'];	  
        $uploaded_file_name = basename($_FILES["file"]["name"]);
        
//	$movie_title = mysqli_real_escape_string($conn, $movie_title);
	$studio = mysqli_real_escape_string($conn, $studio);
	$year = mysqli_real_escape_string($conn, $year);
	$box_office = mysqli_real_escape_string($conn, $box_office);
       
       $query = "UPDATE movieInfo SET movie_title = ? ,studio = ? ,year = ? ,box_office = ? WHERE movie_id = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("ssidi", $movie_title, $studio, $year, $box_office,$movie_id);
	if ($stmt->execute()){
		$isActionExecuted = 1;
//print "the statement was executed;<br>";
}
else{
	$isActionExecuted = 0;
	print "There is one error from inputs. Below is mysql_error report:<br>";
	print mysqli_error($mysqli);
	print "<br>";
}
	   
if ($isActionExecuted == 1){	  
	
	if ($uploaded_file_name == '' ){
	}
	else{
     $isActionExecuted = uploadIMG($target_directory, $newpicture,  $image_FileType);
     	if ($isActionExecuted == 1){
     			$stmt->close();
       $query = "UPDATE movieInfo SET picture = ? WHERE movie_id = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("si", $newpicture,$movie_id);
	$stmt->execute();
     		}
     		else{
     			print "Image was not uploaded, using default image.<br> All contents that has valid inputs were automatically updated.<br>";
     		}
	}
}

     //   $sql = "UPDATE movieInfo SET movie_title='" .$movie_title."' ,studio='".$studio."' ,year='".$year."' ,box_office='".$box_office."', picture='".$picture."' WHERE movie_id='".$movie_id."'";
     //  $result = mysqli_query($conn, $sql);
		
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

if ($_POST['action'] == "Cancel"){
	header('Location: index.php');
}

}

?>
