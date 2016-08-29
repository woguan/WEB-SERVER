<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Super Basic CRUD!</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>



<div class="container">
	
<h1>Super Basic CRUD!</h1>

<?php
    define('DB_USER','root');
    define('DB_PASSWORD','wong123');
    define('DB_HOST','127.0.0.1');
    define('DB_NAME','homework3');
    
	// CONNECT TO DB
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
    
      die("Connection failed: " . mysqli_connect_error());
      
    }
    
    print "show some data[2]: ";
     $sql2 = "SELECT count(movie_id) FROM movieInfo ";
         $retval3 = mysqli_query( $sql2, $conn );
         $row5 = mysqli_fetch_array($retval3, MYSQLI_NUM );
         $rec_count = $row5[0];
         print $rec_count;
         
         
         
    // FORM AND EXECUTE SOME QUERY
    //$sql = "SELECT user_id,login,first_name,last_name, password FROM users ORDER BY login";
    $sql = "SELECT * from movieInfo";
    $result = mysqli_query($conn, $sql);
    
    // USE THE QUERY RESULT
    print "<table class='table'>";
    print "<tr><th>Movie Title</th><th>Studio</th><th>Year</th><th>Box Office $</th><th>Picture</th></tr>";   
    
    if (mysqli_num_rows($result) > 0) {
    
    
      while($row = mysqli_fetch_assoc($result)) {
	    print "<tr>";
	    print "<td style=\"vertical-align:middle;\">". $row['movie_title'] . "</td>" ;
	    print "<td style=\"vertical-align:middle;\">". $row['studio'] . "</td>" ;
	    print "<td style=\"vertical-align:middle;\">". $row['year'] . "</td>" ;
	    print "<td style=\"vertical-align:middle;\">". $row['box_office'] . "</td>" ;
	    $imgName = $row['picture'];
	  //  print "<td><a href=\"../CRUD/images/$imgName\">LinkToImage</a> </td>";
	  if ($imgName !== ''){
	   print "<td> <img id=\"noimagefound\" src=\"../CRUD/images/$imgName\" height=\"150\" width=\"100\" alt=\"No Image\" onerror=\"showNoImage()\"> </td>";
	  }else{
	  print "<td> <img id=\"noimagefound\" src=\"../CRUD/images/noimage.png\" height=\"150\" width=\"100\" alt=\"No Image\" onerror=\"showNoImage()\"> </td>";	
	  }
	    print "<td><div class='row'>";
	    	    
	    print "<div class='col-sm-6'><form action='edit.php' method='POST' class='form-horizontal'><input type='hidden' name='movie_id' value='".$row['movie_id']."'>
	    <div class='form-group'><button type='submit' name='action' value='Update' class='btn btn-default'>
  <span class='glyphicon glyphicon-pencil'></span></button></div></form></div>";
	    
	    print "<div class='col-sm-6'><form action='delete.php' method='POST' class='form-horizontal'><input type='hidden' name='movie_id' value='".$row['movie_id']."'><div class='form-group'><button type='submit' class='btn btn-default' name='action' value=delete'>
  <span class='glyphicon glyphicon-trash'></span></button></div></form></div>";
  	    print "</div></td></tr>\n";
      }
    } else {
	    print "<tr><td colspan='4'>No Rows</td></tr>";
    }
    
   print "</table>"
?>

<form action="edit.php" method="POST">
	<input type="submit" name="action" value="Add" class="btn btn-lg btn-primary">
</form>	

<br><br>
<hr>
<br><br>

<div class="alert alert-danger" role="alert">
	<h2>Things Missing</h2>
	
	<ol>
		<li>Validation and more validation</li>
		<li>Paging</li>
		<li>Sorting</li>
		<li>JavaScript (Required or Optional?)</li>
		<li>As good as reasonable separation of code and template</li>
		<li>Little code improvements</li>
	</ol>
</div>

</div>

</body>
</html>
