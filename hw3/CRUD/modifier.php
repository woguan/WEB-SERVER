<?php
	
	define('DB_USER','root');
	define('DB_PASSWORD','wong123');
	define('DB_HOST','127.0.0.1');
	define('DB_NAME','homework3');
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
    }
    
    //   number int not null,
   // check(number >= 1234 and number <= 4523)
   
   
   
     $sql = "ALTER TABLE movieInfo MODIFY year INTEGER NOT NULL CHECK(year >= 1900 and year <= 9999)";
       $result = mysqli_query($conn, $sql);
       
       
    
    ?>
