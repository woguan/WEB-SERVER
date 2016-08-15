
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

$last = $first = $$method = $color = "";
    <?php
 // define variables and set to empty values


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

// cookie place
if ($first !== '' && $last !== ''){
setcookie('Cookie_First_Name',$first,time() + (86400 * 7));
setcookie('Cookie_Last_Name',$last,time() + (86400 * 7));
setcookie('Cookie_Favorite_Color',$color,time() + (86400 * 7));
}

else if ($first == '' || $last == ''){
 $first = $_COOKIE['Cookie_First_Name'];
 $last = $_COOKIE['Cookie_Last_Name'];
 $color = $_COOKIE['Cookie_Favorite_Color'];
}

echo "Hello $last $first. Nice to meet you. Your Favorite color is: $color";

?>

 <br>
 <button  onclick="delcookie()">Clear Cookie</button><br><script type="text/javascript" src="/CSE135SUMMER/cookie.js"></script>

      
       <script type="text/javascript" src="/CSE135SUMMER/cookie.js"></script>
        <script> setBackGroundColor('$color')</script>
</body>
 


</html>
