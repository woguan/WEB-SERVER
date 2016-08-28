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
		
		echo '<script type="text/javascript">alert("It workk [1110].");</script>';
       $movie_title = $_REQUEST['movie_title'];
	   $studio= $_REQUEST['studio'];
	   $year = $_REQUEST['year'];
	   $box_office = $_REQUEST['box_office'];
	   
	 // START 
	  error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
	         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            echo '<script type="text/javascript">alert("It workk [0].");</script>';
             switch ($error) {
                case UPLOAD_ERR_OK:
                	echo '<script type="text/javascript">alert("It workk [1].");</script>';
                    $valid = true;
                    //validate file extensions
                    if ( !in_array($ext, array('jpg','jpeg','png')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 2 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
                    	 
                        $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'images' . DIRECTORY_SEPARATOR. $name;
                        move_uploaded_file($tmpName,$targetPath);
                        header( 'Location: index.php' ) ;
                        exit;
                    }
                    break;
                case UPLOAD_ERR_INI_SIZE:
                	echo '<script type="text/javascript">alert("It workk [2].");</script>';
                    $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                	echo '<script type="text/javascript">alert("It workk [3].");</script>';
                    $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                	echo '<script type="text/javascript">alert("It workk [4].");</script>';
                    $response = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                	echo '<script type="text/javascript">alert("It workk [5].");</script>';
                    $response = 'No file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                	echo '<script type="text/javascript">alert("It workk [6].");</script>';
                    $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                	echo '<script type="text/javascript">alert("It workk [7].");</script>';
                    $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                	echo '<script type="text/javascript">alert("It workk [8].");</script>';
                    $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                    break;
                default:
                	echo '<script type="text/javascript">alert("It workk [9].");</script>';
                    $response = 'Unknown error';
                break;
            }
	         }

	   
	   // END 
	  // $picture = $_REQUEST['picture'];
	   
	   // SHOULD HAVE VALIDATION HERE!?
		
	
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
		
  		
       $sql = "DELETE FROM users WHERE user_id='".$_POST['user_id']."'"; 
       $result = mysqli_query($conn, $sql);

		
	}

	header('Location: index.php');
	
?>
