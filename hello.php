
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
 
<!-- If IE use the latest rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Set the page to the width of the device and set the zoon level -->
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>PHP</title>
 
</head>

<body>
     <?php
 
          echo "Hello Web World from Language PHP.";
          $timezone = date_default_timezone_get();
          $date = date('m/d/Y h:i:s a', time());
echo "The current server timezone is: " . $date;


  print"<table border=0>";
    foreach ($_SERVER as $key=>$val )
       {
         echo "<tr><td>".$key."</td><td>" .$val."</tr>";
        }
    print"</table>";

       ?>
       
       
<form action="get.php" method="get">
First Name: <input type="text" name="name"><br>
Last Name: <input type="text" name="email"><br>
<input type="submit">
</form>
       
       
       <script type="text/javascript" src="/CSE135SUMMER/form_action.js"></script>
</body>
 


</html>
