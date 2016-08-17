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
 
 

          echo "<h1>Hello Web World from Language PHP. ";
          $timezone = date_default_timezone_get();
          $date = date('m/d/Y h:i:s a', time());
echo "The current server timezone is: " . $date;
echo "</h1><br />\n";?>
<script type="text/javascript" src="/CSE135SUMMER/form_action.js"></script>
</body>
</html>
