
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
 
<!-- If IE use the latest rendering engine -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Set the page to the width of the device and set the zoon level -->
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>PHP</title>
 
 <style>
table, th, td {
    border: 1px solid black;
}
</style>


</head>

<body>

    <?php
// define variables and set to empty values
$last = $first = $$method = $color = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $last = test_input($_POST["last_name"]);
  $first = test_input($_POST["first_name"]);
  $method = test_input($_POST["method"]);
  $color = test_input($_POST["colordropdown"]);
  
}
/*else{
   $last = test_input($_GET["last_name"]);
  $first = test_input($_GET["first_name"]);
  $method = test_input($_GET["method"]);
  $color = test_input($_GET["colordropdown"]);
}*/

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "Hello $last $first. Nice to meet you. Your Favorite color is: $color";

?>

       
       <script type="text/javascript" src="/CSE135SUMMER/cookie.js"></script>
</body>
 


</html>
