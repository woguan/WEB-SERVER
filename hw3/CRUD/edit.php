<?php

 $action = $_POST['action'];

 
 $first_name = '';
 $last_name = '';
 $login = '';
 $password = '';
 
 
 if ($action == "Update") {
   
    $user_id = $_POST['user_id'];
     
    define('DB_USER','cse135demo');
    define('DB_PASSWORD','notsecret');
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','userDB');

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT login,first_name,last_name, password FROM users where user_id = ".$user_id;
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
    
	 $first_name = $row['first_name'];
	 $last_name = $row['last_name'];
	 $login = $row['login'];
	 $password = $row['password'];
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

<div class="container">
	
<h1><?= $action ?> Record</h1>

<form action="action.php" method="POST" class="form">
	<div class="form-group">
	 <label for="first_name">First Name</label>
	 <input type="text" name="first_name" value="<?= $first_name ?>"  class="form-control">
	</div>

	<div class="form-group">
	<label for="last_name">Last Name</label>
	<input type="text" name="last_name" value="<?= $last_name ?>"  class="form-control">
	</div>

	<div class="form-group">
	<label for="login">Login</label>
	<input type="text" name="login" value="<?= $login ?>"  class="form-control">
	</div>

	<div class="form-group">
	<label>Password</label>
	<input type="password" name="password" value="<?= $password ?>"  class="form-control">
	</div>

	<input type="hidden" name="user_id" value="<?= $user_id ?>">
	
	<div class="form-group">
	<input type="submit" value="<?= $action ?>" name="action" class="btn btn-primary">
	<input type="submit" value="Cancel" name="action"  class="btn btn-default">	
	</div>
	
</form>

</div>

</body>
</html>