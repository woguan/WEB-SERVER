<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Box Office Tracker</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
<h1 style="color:red; border:solid 2px blue; font-style:italic; text-align:center">Box Office Tracker</h1>
	

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
        //print "There are  $rec_count rows<br>";

	// Code to set rec_limit
	if( isset($_GET['rec_limit'])){
	$rec_limit = $_GET['rec_limit'];
		if($rec_limit == 'All'){
		$rec_limit = $rec_count;
		}
	}
	else{
        $rec_limit =5;
	}

        // Page number
        if( isset($_GET['page'] ) ) {
            $page = $_GET['page'] + 1 ;
            $offset = $rec_limit * $page ;
         }
	else {
        $page = 0;
        $offset = 0;
        }

       // print "rec_limit currently is $rec_limit<br>";
       // print "Page $page<br>";
	

        // Checks for sort
        if( isset($_GET['sort'])){
        $sort = $_GET['sort'];}
        else{$sort = 0;}

	$page2 = $page - 1;
	print "Sort is $sort<br>";
	print "Page is $page<br>";
	print "Page2 is $page2<br>";
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
	?>
	
	<select id="dropdown" onchange="reload()">
	<option value="5" <?PHP if ($rec_limit==5) echo ' selected="selected"';?>>5</option>
	<option value="10" <?PHP if ($rec_limit==10) echo ' selected="selected"';?>>10</option>
	<option value="20" <?PHP if ($rec_limit==20) echo ' selected="selected"';?>>20</option>
	<option value="All" <?PHP if ($rec_limit==$rec_count) echo ' selected="selected"';?>>All</option>
	</select>

<?PHP
	print " entries";

    // USE THE QUERY RESULT
    print "<table class='table'>";
    print "<tr><th><a href=\"$_PHP_SELF?sort=0&rec_limit=$rec_limit\">Movie Title</a></th><th><a href=\"$_PHP_SELF?sort=1&rec_limit=$rec_limit&page=$page2\">Studio</a></th><th><a href=\"$_PHP_SELF?sort=2&rec_limit=$rec_limit\">Year</a></th>";
    print "<th><a href=\"$_PHP_SELF?sort=3&rec_limit=$rec_limit\">Box Office $</a></th><th><a href=\"$_PHP_SELF?sort=4&rec_limit=$rec_limit\">Picture</a></th></tr>";

    if($rec_count > 0){
      while($row = mysqli_fetch_assoc($result)) {
            print "<tr>";
            print "<td style=\"vertical-align:middle;\">". $row['movie_title'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['studio'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['year'] . "</td>" ;
            print "<td style=\"vertical-align:middle;\">". $row['box_office'] . "</td>" ;
            $imgName = $row['picture'];
            
            if ($imgName !== ''){
	    print "<td> <img id=\"noimagefound\" src=\"../CRUD/images/$imgName\" height=\"150\" width=\"100\" alt=\"No Image\" onerror=\"showNoImage()\"> </td>";
	  }
	    else{
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

	// Prints next page
	if($end_val > $rec_count){
	print "<b>Showing $start_Val to $rec_count of $rec_count entries</b>";
	}

	else{
	print "<b>Showing $start_Val to $end_val of $rec_count entries</b>";
	}
?>

<div style="border:dashed 2px black; font-size:1.5em; text-align:center">

<?PHP
	// Prints first page
	if($page == 0){
	print "<a href=\"$_PHP_SELF?rec_limit=$rec_limit\" onclick=\"return false\">First Page</a>";
	}

	else{
	print "<a href=\"$_PHP_SELF?rec_limit=$rec_limit&sort=$sort\">First Page</a>";
	}

	// Prints previous page
	if($page < 1){
	print "<a href=\"$_PHP_SELF?page=$prev_page&rec_limit=$rec_limit\" onclick=\"return false\">Previous Page</a>";
	}

	else{
	print "<a href=\"$_PHP_SELF?page=$prev_page&rec_limit=$rec_limit&sort=$sort\">Previous Page</a>";
	}

	// Prints next page
	if($page > $last_page){
	print "<a href=\"$_PHP_SELF?page=$page&rec_limit=$rec_limit\" onclick=\"return false\">Next Page</a>";
	}

	else{
	print "<a href=\"$_PHP_SELF?page=$page&rec_limit=$rec_limit&sort=$sort\">Next Page</a>";
	}

	// Prints last page
	if($page > $last_page){
//	print "<a href=\"$_PHP_SELF?page=$last_page&rec_limit=$rec_limit\" onclick=\"return false\" style=\"cursor:not-allowed\">Last Page</a>";
	print "Last Page";
	}

	else{
	print "<a href=\"$_PHP_SELF?page=$last_page&rec_limit=$rec_limit&sort=$sort\">Last Page</a>";
	}

?>
</div>
<br><br>
<form action="edit.php" method="POST">
	<input type="submit" name="action" value="Add" class="btn btn-lg btn-primary">
</form>	

<br><br>
<hr>
<br><br>

</body>
<script type="text/javascript">
                function reload(){
                var tmp = document.getElementById("dropdown").value;

		if(tmp == 5){window.location.href="index2.php?rec_limit=5";}
		else if(tmp == 10){window.location.href="index2.php?rec_limit=10";}
		else if(tmp == 20){window.location.href="index2.php?rec_limit=20";}
		else if(tmp == 'All'){window.location.href="index2.php?rec_limit=All";}
		}
</script>

</html>
