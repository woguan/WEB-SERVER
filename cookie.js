

function delcookie(){
  //document.body.style.backgroundColor = "#fffe1b";
  document.body.style.backgroundColor = "yellow";
  document.cookie = "Cookie_First_Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  document.cookie = "Cookie_Last_Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  document.cookie = "Cookie_Favorite_Color=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
  location.reload("false");
}


function setBackGroundColor(colorName){
  
  document.body.style.backgroundColor = colorName;
}
