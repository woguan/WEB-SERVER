<?php

 $action = $_POST['action'];

 $movie_id = '';	
 $movie_title = '';
 $studio= '';
 $year = '';
 $box_office = '';
 $picture = '';
 
 
 if ($action == "Update") {
	
    $movie_id = $_POST['movie_id'];
     
    define('DB_USER','root');
    define('DB_PASSWORD','wong123');
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','homework3');

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
       
    $sql = "SELECT movie_title, studio, year, box_office, picture FROM movieInfo where movie_id = ".$movie_id;
    $result = mysqli_query($conn, $sql);
  

    while($row = mysqli_fetch_assoc($result)) {
    print $row['movie_title'];
//	 $movie_title = $row['movie_title'];
//	 $studio = $row['studio'];
//	 $year = $row['year'];
//	 $box_office = $row['box_office']
//	 $picture = $row['picture']; // need to modify this?
	}
 }
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?= $action ?> Record</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
Checking IF updated [0]
<div class="container">
	
<h1><?= $action ?> Record</h1>

<form action="action.php" method="POST" enctype="multipart/form-data" class="form">
	<div class="form-group">
	 <label for="movie_title">Movie Title</label>
	 <input type="text" name="movie_title" value="<?= $movie_title ?>"  class="form-control">
	</div> 

	<div class="form-group">
	<label for="studio">Studio</label>
	<input type="text" name="studio" value="<?= $studio ?>"  class="form-control">
	</div>

	<div class="form-group">
	<label for="year">Year</label>
	<input type="text" name="year" value="<?= $year ?>"  class="form-control">
	</div>

	<div class="form-group">
	<label for="box_office">Box Office</label>
	<input type="text" name="box_office" value="<?= $box_office ?>"  class="form-control">
	</div>
	
	<div class="form-group">
	<label for="Select picture to upload">Picture</label>
	<input type="file" name="file" id="file">
	</div>

	<!-- <input type="hidden" name="user_id" value="< ?= $user_id ?>">  move '?' to left-->
	
	<div class="form-group">
	<input type="submit" value="<?= $action ?>" name="action" class="btn btn-primary">
	<input type="submit" value="Cancel" name="action"  class="btn btn-default">	
	</div>
	
</form>

</div>

</body>
</html>
