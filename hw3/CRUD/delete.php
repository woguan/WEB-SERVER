<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Confirm Delete</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
<div class="container">
	
 <br><br>
 
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Confirm Delete?</h3>
  </div>
  <div class="panel-body">
	  
    <form action="action.php" method="POST">

	<input type="hidden" name="user_id" value="<?= $_POST['user_id'] ?>">

	<input type="submit" name="action" value="Delete" class="btn btn-primary">
	
	<input type="submit" name="action" value="Cancel" class="btn btn-default">

    </form>

  </div>
</div>
	


</div>

</body>
</html>