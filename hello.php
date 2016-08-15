
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
 
 $first = $_COOKIE['Cookie_First_Name'];
 $last = $_COOKIE['Cookie_Last_Name'];

          echo "<h1>Hello Web World from Language PHP. ";
          $timezone = date_default_timezone_get();
          $date = date('m/d/Y h:i:s a', time());
echo "The current server timezone is: " . $date;
 echo "</h1><br />\n";
 
 if ( $first !== "" && $last !== ""){
  echo "<h2>Hello friend, you're $last $first.</h2>";
 }
 else{
  echo "<h2>Hello Anonymous.</h2>";
 }
echo "<br />\n";
    
  
echo  "<table> <tr>  <th>Firstname</th>   <th>Lastname</th>  </tr>";
 foreach ($_SERVER as $key=>$val ){
             echo "<tr><td>".$key."</td><td>" .$val."</tr>";
         }
echo  "</table>"
       ?>
       
       <br>
<form id="hurl" action="/CSE135SUMMER/get.php" method="get">
First Name: <input type="text" name="last_name"><br>
Last Name: <input type="text" name="first_name"><br>

Favorite Color: <select name="colordropdown"><option value="Blue" selected>Blue</option>
                <option value="Brown">Brown</option><option value="Green">Green</option>
                <option value="Grey">Grey</option><option value="Red">Red</option>
                <option value="Yellow">Yellow</option></select> <br>
Method <select name="method" id ="method" onchange="changeSelect()" >
               <option value="GET">GET</option>
               <option value="POST">POST</option></select>
 <input type="submit" onclick="myfunction()">
</form>
       
       
       <script type="text/javascript" src="/CSE135SUMMER/form_action.js"></script>
</body>


</html>
