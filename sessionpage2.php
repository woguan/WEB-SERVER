
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
$fcookie = $_COOKIE['Cookie_First_Name'];
$lcookie = $_COOKIE['Cookie_Last_Name']; 

if ($first !== '' && $last !== ''){
 $fcookie = $first;
 $lcookie = $last;
}

if ( $fcookie == '' || $lcookie == ''){
echo "<h2>Howdy stranger...tell me your name on page1! </h2><br>";
}
else{
echo "<h2>Hi $fcookie $lcookie nice to meet you </h2><br>";
}//echo "<script>setBackGroundColor($color)</script>";
//echo "<script>document.body.style.backgroundColor=\"Blue\"</script>";




echo "<script>";
//echo "setBackGroundColor(\"blue\")";
echo "document.body.style.backgroundColor=\"$color\"";
echo "</script>";

?>

 <br>
 <button  onclick="delcookie()">Clear Cookie</button><br><script type="text/javascript" src="/CSE135SUMMER/cookie.js"></script>

      
       <script type="text/javascript" src="/CSE135SUMMER/cookie.js"></script>
 <!--     <script>document.body.style.backgroundColor="red"</script> -->

</body>
 


</html>
