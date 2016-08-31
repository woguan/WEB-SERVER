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

    // Testing getting number of records
        mysqli_select_db('homework3');
        $sql = "SELECT * FROM movieInfo";
        $retval = mysqli_query($conn, $sql);
        $rec_count = mysqli_num_rows($retval);
        print "There are  $rec_count rows<br>";

	// Code to set rec_limit
	if( isset($_GET['rec_limit'])){
	$rec_limit = $_GET['rec_limit'];}
	else{
        $rec_limit =5;}

        // Page number
        if( isset($_GET['page'] ) ) {
            $page = $_GET['page'] + 1 ;
            $offset = $rec_limit * $page ;

        // Hard coded. Find more efficient way of doing this
       /* if($page == 1){$rec_limit = 5;}
        elseif($page == 2){$rec_limit = $rec_limit * 2;}
        elseif($page == 3){$rec_limit = $rec_limit * 4;}
        else{ $rec_limit = $rec_count;}
        $offset = 0;*/
         }
	else {
        $page = 0;
        //$page = 1;
        $offset = 0;
        //$rec_limit = 5;
         }
        print "rec_limit currently is $rec_limit<br>";
        print "Page $page<br>";

        // Checks for sort
        if( isset($_GET['sort'])){
        $sort = $_GET['sort'];}
        else{$sort = 0;}

        // Cases which sort the data
        if($sort == 0){$sql = "SELECT * FROM movieInfo ORDER BY movie_title ASC LIMIT $offset, $rec_limit";}

        elseif($sort == 1){
                $sql = "SELECT * FROM movieInfo ORDER BY studio ASC LIMIT  $offset, $rec_limit";}


        elseif($sort == 2){
                $sql = "SELECT * FROM movieInfo ORDER BY year ASC LIMIT  $offset, $rec_limit";}

        elseif($sort == 3){
                $sql = "SELECT * FROM movieInfo ORDER BY box_office DESC LIMIT  $offset, $rec_limit";}

        else{
                $sql = "SELECT * FROM movieInfo ORDER BY picture ASC LIMIT  $offset, $rec_limit";}

        // Get results from query
        $result = mysqli_query($conn, $sql);

        //  Checks if data was received
        if(! $result ) {
            die('Could not get data: ' . mysqli_error());
         }

	// Code for drop down menu
	print "Show ";
	print "<select id=\"dropdown\" onchange=\"reload()\"><option value=\"\"></option><option value=\"5\">5</option><option value=\"10\">10</option><option value=\"20\">20</option><option value=\"all\">All</option></select>";
	print " entries";

	// JS code which reads what is currently being selected from drop down menu
/*	print "<script type=\"text/javascript\">
		function reload(){
		var tmp = document.getElementById(\"dropdown\").value;
		window.location.href=\"$_PHP_SELF?page=2\";}
		</script>";*/

    // USE THE QUERY RESULT
    print "<table class='table'>";
    print "<tr><th><a href=\"$_PHP_SELF?page=$page&sort=0\">Movie Title</a></th><th><a href=\"$_PHP_SELF?page=$page&sort=1\">Studio</a></th><th><a href=\"$_PHP_SELF?page=$page&sort=2\">Year</a></th>";
    print "<th><a href=\"$_PHP_SELF?page=$page&sort=3\">Box Office $</a></th><th><a href=\"$_PHP_SELF?page=$page&sort=4\">Picture</a></th></tr>";

   // if (mysqli_num_rows($result) > 0) {
if($rec_count > 0){


      while($row = mysqli_fetch_assoc($result)) {
//      while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            print "<tr>";
            print "<td style=\"vertical-align:middle;\">". $row['movie_title'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['studio'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['year'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['box_office'] . "</td>" ;
            $imgName = $row['picture'];
            //print "<td><a href=\"../CRUD/images/$imgName\">LinkToImage</a> </td>";
            
             if ($imgName !== ''){
	   print "<td> <img id=\"noimagefound\" src=\"../CRUD/images/$imgName\" height=\"150\" width=\"100\" alt=\"No Image\" onerror=\"showNoImage()\"> </td>";
	  }else{
	  print "<td> <img id=\"noimagefound\" src=\"../CRUD/images/noimage.png\" height=\"150\" width=\"100\" alt=\"No Image\" onerror=\"showNoImage()\"> </td>";	
	  }
            
            
            print "<td style=\"vertical-align:middle;\"><div class='row'>";

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

	print "</table>";
	$start_Val = $offset + 1;
	$end_val = $rec_limit * ($page + 1);
	$prev_page = $page - 2;
	$last_page = ceil($rec_count/$rec_limit) - 2;
	print "Showing $start_Val to $end_val of $rec_count entries"; // Fix rec_limit = 999 bug
	print "<a href=\"$_PHP_SELF?rec_limit=$rec_limit\">First Page</a>";
	print "<a href=\"$_PHP_SELF?page=$prev_page&rec_limit=$rec_limit\">Previous Page</a>"; // Fix bug where u can hit privious and not get data. Add if statement
	print "<a href=\"$_PHP_SELF?page=$page&rec_limit=$rec_limit\">Next Page</a>";
	print "<a href=\"$_PHP_SELF?page=$last_page&rec_limit=$rec_limit\">Last Page</a>";

	// Still need to account for edge cases especially for the "All" selected option
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
<script type="text/javascript">
                function reload(){
                var tmp = document.getElementById("dropdown").value;

		if(tmp == 10){window.location.href="index2.php?rec_limit=10";}
		else if(tmp == 20){window.location.href="index2.php?rec_limit=20";}
		else if(tmp == "all"){window.location.href="index2.php?rec_limit=9999";}
		else if(tmp == 5){window.location.href="index2.php?rec_limit=5";}
		}
</script>

</html>
