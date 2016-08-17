
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

$timezone = date_default_timezone_get();
$date = date('m/d/Y h:i:s a', time());
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $last = test_input($_POST["last_name"]);
  $first = test_input($_POST["first_name"]);
  $method = test_input($_POST["method"]);
  $color = test_input($_POST["colordropdown"]);
  
}
else{
   $last = test_input($_GET["last_name"]);
  $first = test_input($_GET["first_name"]);
  $method = test_input($_GET["method"]);
  $color = test_input($_GET["colordropdown"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ( $first == '' || $last == ''){
echo "<h2>Howdy stranger...tell me your name on page1! </h2><br>";
}
else{
echo "<h2>Hello $last $first from a Web app written in PHP on $date </h2><br>";
}//echo "<script>setBackGroundColor($color)</script>";




echo "<script>";
echo "document.body.style.backgroundColor=\"$color\"";
echo "</script>";

?>

 <br>

      
</body>
 


</html>
