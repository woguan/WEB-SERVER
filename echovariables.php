
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
 

  
echo  "<table> <tr>  <th>Firstname</th>   <th>Lastname</th>  </tr>";
 foreach ($_SERVER as $key=>$val ){
             echo "<tr><td>".$key."</td><td>" .$val."</tr>";
         }
echo  "</table>"
       ?>
</body>
</html>
